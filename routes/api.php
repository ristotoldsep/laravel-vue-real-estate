<?php

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Must be registered BEFORE the generic /upload/{collection} route below,
// otherwise that route captures collection="gallery" with the wrong rules.
Route::post('/upload/gallery/{apartment}', function (Request $request, Apartment $apartment) {
    $request->validate([
        'file'   => 'required',
        'file.*' => 'image|mimes:jpeg,png,jpg,webp,gif|max:10000000',
    ]);

    $uploaded = $request->file('file');
    $files = is_array($uploaded) ? $uploaded : [$uploaded];

    foreach ($files as $file) {
        $contents = file_get_contents($file->getRealPath());
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        // Photo path: no blendTransparency/trim (those are for plan PNGs).
        // Just downscale for web performance and convert to WebP.
        $image = Image::read($contents)->scaleDown(width: 1920);

        $apartment->addMediaFromString((string) $image->toWebp(80))
            ->usingFileName($name . '_' . Str::random(6) . '.webp')
            ->toMediaCollection('gallery'); // additive: no clearMediaCollection
    }

    return response()->json(['count' => count($files)]);
});

Route::post('/upload/{collection}/{apartment}', function (Request $request, $collection, Apartment $apartment) {
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000048',
    ]);

    $path = $request->file('file')->store('uploads');

    $contents = Storage::drive('local')->get($path);

    // Get images file name
    $name = pathinfo($path, PATHINFO_FILENAME);

    // Create cropped images full file name
    $croppedImage = $name . '_cropped' . '_'. Str::random(6)  . '.webp';

    // Create cropped image version with intervention image
    $image = Image::read($contents)
        ->blendTransparency('efedeb')
        ->trim(20);

    // Store cropped image
    Storage::drive('local')->put($croppedImage, (string) $image->toWebp(80));

    $apartment->clearMediaCollection($collection);

    $apartment->addMediaFromString((string) $image->toWebp(80))
        ->usingFileName($croppedImage)
        ->toMediaCollection($collection);

    if ($collection === 'position') {
        try {
            $apartment->clearMediaCollection('thumbnail');

            $thumb = $image
                ->scaleDown(height: 600)
                ->toWebp(80);

            $thumbnailName = $name . '_thumb' . '_'. Str::random(6)  . '.webp';

            Storage::put('thumbnails/' . $thumbnailName, (string) $thumb);

            $apartment->addMediaFromDisk('thumbnails/' . $thumbnailName, 'local')
                ->toMediaCollection('thumbnail');
        } catch (\Exception $e) {
            Log::error("Error processing thumb for apartment {$apartment->id}: {$e->getMessage()}");
        }
    }

    return response()->json(['path' => $croppedImage]);
});

Route::delete('/gallery/{apartment}/{media}', function (Apartment $apartment, $media) {
    $item = $apartment->media()
        ->where('collection_name', 'gallery')
        ->where('id', $media)
        ->firstOrFail();

    $item->delete();

    return response()->json(['deleted' => true]);
});

Route::post('/gallery/{apartment}/reorder', function (Request $request, Apartment $apartment) {
    $ids = $request->validate([
        'ids'   => 'required|array',
        'ids.*' => 'integer',
    ])['ids'];

    // Only allow reordering this apartment's gallery media.
    $valid = $apartment->media()
        ->where('collection_name', 'gallery')
        ->whereIn('id', $ids)
        ->pluck('id')
        ->all();

    $ordered = array_values(array_filter($ids, fn ($id) => in_array($id, $valid)));

    \Spatie\MediaLibrary\MediaCollections\Models\Media::setNewOrder($ordered);

    return response()->json(['ok' => true]);
});
