<?php

namespace App\Console\Commands;

use App\Models\Apartment;
use Illuminate\Console\Command;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CropApartmentImages extends Command
{
    protected $signature = 'apartments:crop-images';
    protected $description = 'Crop apartment images to 600px height and save as thumbnails';

    public function handle()
    {
        Apartment::has('media')->chunk(100, function ($apartments) {
            foreach ($apartments as $apartment) {
                $media = $apartment->getMedia('position')->first();

                if (!$media) continue;

                try {
                    $image = Image::read($media->getPath())
                        ->scaleDown(height: 600)
                        ->toWebp(80);

                    $thumbnailName = 'thumbnail_' . $media->file_name;

                    Storage::put('thumbnails/' . $thumbnailName, (string) $image);

                    $apartment->addMediaFromDisk('thumbnails/' . $thumbnailName, 'local')
                        ->toMediaCollection('thumbnail');
                } catch (\Exception $e) {
                    $this->error("Error processing image for apartment {$apartment->id}: {$e->getMessage()}");
                    continue;
                }
            }
        });

        $this->info("All apartment images have been processed.");
    }
}