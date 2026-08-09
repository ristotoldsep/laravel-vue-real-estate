<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GalleryCategory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const TYPE_HERO = 'hero';

    public const TYPE_CAROUSEL = 'carousel';

    public const COLLECTION = 'images';

    protected $fillable = [
        'type',
        'name_et',
        'name_en',
        'name_ru',
        'sort_order',
    ];

    /**
     * The carousel tabs, in the order the admin arranged them.
     * Tie-break on id: every row is created with sort_order 0.
     */
    public function scopeCarousel(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_CAROUSEL)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /**
     * The single row backing the homepage hero slideshow.
     */
    public static function hero(): self
    {
        return static::firstOrCreate(
            ['type' => self::TYPE_HERO],
            ['name_et' => 'Esilehe slaidid']
        );
    }

    /**
     * Images shaped for both the admin page and the public components.
     * getMedia() sorts by order_column; the raw media() relation does not.
     */
    public function imagePayload(): array
    {
        return $this->getMedia(self::COLLECTION)
            ->map(fn ($media) => [
                'id' => $media->id,
                'url' => $media->getFullUrl(),
            ])
            ->values()
            ->all();
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => [
                'et' => $this->name_et,
                'en' => $this->name_en,
                'ru' => $this->name_ru,
            ],
            'images' => $this->imagePayload(),
        ];
    }

    public static function heroImages(): array
    {
        return static::with('media')
            ->where('type', self::TYPE_HERO)
            ->first()
            ?->imagePayload() ?? [];
    }

    public static function carouselPayload(): array
    {
        return static::with('media')
            ->carousel()
            ->get()
            ->map(fn (self $category) => $category->toPayload())
            ->all();
    }
}
