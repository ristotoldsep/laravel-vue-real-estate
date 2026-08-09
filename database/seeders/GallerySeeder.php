<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Imports the images that used to be hardcoded in HeroSlideshow.vue and
 * ImageCarousel.vue into the media library, so the site keeps rendering after
 * those components switched to DB-driven props.
 *
 * Idempotent: categories are matched on type + name_et, and a category that
 * already has media is skipped, so a half-failed run can be re-run safely.
 */
class GallerySeeder extends Seeder
{
    /**
     * Taken verbatim from HeroSlideshow.vue. Note this list differs from the
     * carousel's "Hoonest" tab — it includes saha-8_c4.
     */
    private const HERO_IMAGES = [
        '/images/renderid/saha-8_c1.webp',
        '/images/renderid/saha-8_c2.webp',
        '/images/renderid/saha-8_c3.webp',
        '/images/renderid/saha-8_c4.webp',
        '/images/renderid/saha-8_c7.webp',
        '/images/renderid/saha-8_c8.webp',
        '/images/renderid/saha-8_c9.webp',
        '/images/renderid/saha-8_c10.webp',
    ];

    /**
     * The four ImageCarousel tabs. Names come from the existing lang keys
     * (lang/en.json, lang/ru.json) so nothing visibly changes on the frontend.
     */
    private const CATEGORIES = [
        [
            'name_et' => 'Hoonest',
            'name_en' => 'About the building',
            'name_ru' => 'Дом',
            'images' => [
                // saha-8_c7 was listed twice in the original array; deduped here.
                '/images/renderid/saha-8_c1.webp',
                '/images/renderid/saha-8_c2.webp',
                '/images/renderid/saha-8_c7.webp',
                '/images/renderid/saha-8_c3.webp',
                '/images/renderid/saha-8_c8.webp',
                '/images/renderid/saha-8_c9.webp',
                '/images/renderid/saha-8_c10.webp',
            ],
        ],
        [
            'name_et' => 'Ümbruskond',
            'name_en' => 'Surroundings',
            'name_ru' => 'Окружение',
            'images' => [
                '/images/umbruskond/loo-alevik1.webp',
                '/images/umbruskond/loo-alevik2.webp',
                '/images/umbruskond/loo-alevik3.webp',
                '/images/umbruskond/loo-alevik4.webp',
                '/images/umbruskond/loo-alevik5.webp',
                '/images/umbruskond/loo-alevik6.webp',
                '/images/umbruskond/loo-alevik7.webp',
            ],
        ],
        [
            'name_et' => 'Interjöör',
            'name_en' => 'Interior',
            'name_ru' => 'Интерьер',
            'images' => [
                '/images/interjoor/saha-8-elutuba.webp',
                '/images/interjoor/saha-8-elutuba-2.webp',
                '/images/interjoor/saha-8-kook.webp',
                '/images/interjoor/saha-8-vannituba.webp',
                '/images/interjoor/saha-8-elutuba-3.webp',
                '/images/interjoor/saha-8-rodu.webp',
                '/images/interjoor/saha-8-fuajee.webp',
            ],
        ],
        [
            'name_et' => 'Ehitus',
            'name_en' => 'Construction',
            'name_ru' => 'Строительство',
            'images' => [
                '/images/renderid/saha_main.webp',
                '/images/ehitus/ehitus-1.webp',
                '/images/ehitus/ehitus-16.webp',
                '/images/ehitus/ehitus-17.webp',
                '/images/ehitus/ehitus-2.webp',
                '/images/ehitus/ehitus-4.webp',
                '/images/ehitus/ehitus-5.webp',
                '/images/ehitus/ehitus-6.webp',
                '/images/ehitus/ehitus-7.webp',
                '/images/ehitus/ehitus-8.webp',
                '/images/ehitus/ehitus-9.webp',
                '/images/ehitus/ehitus-10.webp',
                '/images/ehitus/ehitus-11.webp',
                '/images/ehitus/ehitus-12.webp',
                '/images/ehitus/ehitus-13.webp',
                '/images/ehitus/ehitus-14.webp',
                '/images/ehitus/ehitus-15.webp',
            ],
        ],
    ];

    public function run(): void
    {
        $hero = GalleryCategory::firstOrCreate(
            ['type' => GalleryCategory::TYPE_HERO],
            ['name_et' => 'Esilehe slaidid', 'sort_order' => 0]
        );

        $this->importImages($hero, self::HERO_IMAGES);

        foreach (self::CATEGORIES as $index => $definition) {
            $category = GalleryCategory::firstOrCreate(
                [
                    'type' => GalleryCategory::TYPE_CAROUSEL,
                    'name_et' => $definition['name_et'],
                ],
                [
                    'name_en' => $definition['name_en'],
                    'name_ru' => $definition['name_ru'],
                    'sort_order' => $index,
                ]
            );

            $this->importImages($category, $definition['images']);
        }
    }

    private function importImages(GalleryCategory $category, array $paths): void
    {
        if ($category->getMedia(GalleryCategory::COLLECTION)->isNotEmpty()) {
            $this->command?->info("Skipping '{$category->name_et}' — already has images.");

            return;
        }

        foreach ($paths as $path) {
            $absolute = public_path(ltrim($path, '/'));

            if (! File::exists($absolute)) {
                $this->command?->warn("Missing file, skipped: {$path}");

                continue;
            }

            // preservingOriginal is required: other components still reference
            // these public/images paths directly, and addMedia would move them.
            $category->addMedia($absolute)
                ->preservingOriginal()
                ->toMediaCollection(GalleryCategory::COLLECTION);
        }

        $this->command?->info("Imported ".count($paths)." image(s) into '{$category->name_et}'.");
    }
}
