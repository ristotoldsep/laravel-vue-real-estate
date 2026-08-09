<?php

use App\Http\Controllers\ProfileController;
use App\Models\Apartment;
use App\Models\GalleryCategory;
use App\Notifications\ContactFormSubmission;
use Butschster\Head\Facades\Meta;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use NZTim\Mailchimp\MailchimpFacade as Mailchimp;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Any page rendering <ImageCarousel /> must pass galleryCategories, and the
// homepage must also pass heroImages — a missing prop renders an empty gallery
// silently rather than erroring.
Route::localized(function () {
    Route::get('/', function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('Index', [
            'heroImages' => GalleryCategory::heroImages(),
            'galleryCategories' => GalleryCategory::carouselPayload(),
        ]);
    })->name('avaleht');

    Route::get(Lang::uri('/ehitusinfo'), function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('Ehitusinfo');
    })->name('ehitusinfo');

    Route::get(Lang::uri('/aripinnad'), function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('Aripinnad');
    })->name('aripinnad');

    Route::get(Lang::uri('/interjoor'), function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('Interjoor');
    })->name('interjoor');

    Route::get(Lang::uri('/hinnad-plaanid'), function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        $apartments = Apartment::orderBy('floor')->orderBy('number')->with('media')->get();

        return Inertia::render('HinnadPlaanid', [
            'apartments' => $apartments,
            'images' => $apartments->mapWithKeys(function ($apartment) {
                return [$apartment->id => $apartment->getMedia('thumbnail')->first()?->getFullUrl()];
            }),
        ]);
    })->name('hinnad-plaanid');

    Route::get(Lang::uri('/asukoht'), function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('Asukoht', [
            'galleryCategories' => GalleryCategory::carouselPayload(),
        ]);
    })->name('asukoht');

    Route::get(Lang::uri('/galerii'), function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('Galerii', [
            'galleryCategories' => GalleryCategory::carouselPayload(),
        ]);
    })->name('galerii');

    Route::get(Lang::uri('/muugiinfo'), function () {
        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url('/'));

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('Muugiinfo');
    })->name('muugiinfo');

    Route::get(Lang::uri('/korter/{number}'), function ($number) {
        $apartment = Apartment::where('number', $number)->firstOrFail();

        if ($apartment->status === 'Müüdud') {
            return redirect()->route('hinnad-plaanid');
        }

        $og = new Butschster\Head\Packages\Entities\OpenGraphPackage('fb');

        $og->setType('website')
            ->setSiteName('Uus Loo uusarendus - Korterid ja Äripinnad Loo alevikus')
            ->setTitle("Korter {$apartment->number} | Uus Loo uusarendus")
            ->setDescription('Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!')
            ->setUrl(url()->current());

        $og->addImage('https://uusloo.hausers.ee/uus-loo-sotsmeedia.png');

        Meta::registerPackage($og);

        Meta::setDescription(
            'Energiasäästlikud ja kaasaegsed korterid ning äripinnad otse Loo aleviku südames. Maja on valmis! Registreeri huvi!'
        )->setKeywords(
            ['Loo alevik', 'Hausers', 'Uusarendus', 'Korterid', 'Äripinnad', 'Energiasäästlik', 'Kaasaegne', 'Korter', 'Äripind', 'Tallinn', 'Harjumaa', 'Eesti', 'Uus Loo',]
        );

        return Inertia::render('KorteriDetail', [
            'apartment' => $apartment,
            'images' => [
                'apartment' => $apartment->getMedia('apartment')->first()?->getFullUrl(),
                'floor' => $apartment->getMedia('floor')->first()?->getFullUrl(),
                'position' => $apartment->getMedia('position')->first()?->getFullUrl(),
            ],
            'gallery' => $apartment->getMedia('gallery')->map(fn ($m) => [
                'id' => $m->id,
                'url' => $m->getFullUrl(),
            ])->values(),
        ]);
    })->name('korteri-detail');
});

Route::get('/switch', function (Request $request) {
    $previousLocale = app()->getLocale();
    $locale = $request->query('locale');

    if (in_array($locale, ['et', 'en', 'ru'])) {
        App::setLocale($locale);
        session(['locale' => $locale]);
        Cookie::queue(Cookie::make('locale', $locale, '40320'));
    }

    $url = url()->previous();
    $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
    $parameters = app('router')->getRoutes($url)->match(app('request')->create($url))->parameters();

    if ($route === 'avaleht') {
        return Inertia::location(route('avaleht', [], true, $locale));
    }

    return Inertia::location(route($route, $parameters, true, $locale));
})->name('language.switch');

Route::post('/subscribe', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ], [
        'email.required' => 'Palun sisesta e-posti aadress',
        'email.email' => 'Palun sisesta korrektne e-posti aadress',
    ]);

    $tags = [
        'Uus Loo'
    ];

    if ($request->selectedOption === 'korterid') {
        $tags[] = 'Korterid';
    } else {
        $tags[] = 'Äripinnad';
    }

    try {
        Mailchimp::subscribe('0beade8d4f', $request->email, [], false);

        Mailchimp::addTags('0beade8d4f', $request->email, $tags);
    } catch (\Exception $e) {
        Log::error($e->getMessage());

        return redirect()->back()->with('error', 'Something went wrong!');
    }

    return redirect()->back()->with('success', 'You have been subscribed!');
})->name('subscribe');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'firstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required',
    ], [
        'email.required' => 'Palun sisesta e-posti aadress',
        'email.email' => 'Palun sisesta korrektne e-posti aadress',
        'firstName.required' => 'Palun sisesta eesnimi',
        'lastName.required' => 'Palun sisesta perekonnanimi',
        'phone.required' => 'Palun sisesta telefoninumber',
    ]);

    $previous = url()->previous();

    Notification::route('mail', [
        'jevgeni@hausers.ee' => 'Jevgeni Lipin',
        'andra@hausers.ee' => 'Andra',
        'ristotoldsep@gmail.com' => 'Risto Toldsep',
    ])->notify(new ContactFormSubmission($request->all(), $previous));

    return redirect()->back()->with('success', 'You have been subscribed!');
})->name('contact');

/*
*/
Route::get('/dashboard', function () {
    $apartments = Apartment::all();

    return Inertia::render('Dashboard', [
        'apartments' => $apartments,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/edit/apartment/{apartment}', function (Apartment $apartment) {
        return Inertia::render('Admin/EditApartment', [
            'apartment' => $apartment,
            'images' => [
                'apartment' => $apartment->getMedia('apartment')->first()?->getFullUrl(),
                'floor' => $apartment->getMedia('floor')->first()?->getFullUrl(),
                'position' => $apartment->getMedia('position')->first()?->getFullUrl(),
            ],
            'gallery' => $apartment->getMedia('gallery')->map(fn ($m) => [
                'id' => $m->id,
                'url' => $m->getFullUrl(),
            ])->values(),
        ]);
    })->name('edit.apartment');

    Route::get('/create/apartment', function () {
        return Inertia::render('Admin/EditApartment');
    })->name('create.apartment');

    Route::post('/create/apartment', function (Request $request) {
        $request->validate([
            'number' => 'required',
            'floor' => 'required',
            'rooms' => 'required',
            'area' => 'required',
            'balcony' => 'nullable',
            'price' => 'nullable',
        ]);

        if ($request->balcony === null) {
            $request->merge(['balcony' => 0]);
        }

        $apartment = Apartment::create($request->all());

        return redirect()->route('edit.apartment', [
            'apartment' => $apartment,
        ])->with('success', 'Apartment created!');
    })->name('apartment.create');

    Route::post('/edit/apartment/{apartment}', function (Request $request, Apartment $apartment) {
        $request->validate([
            'number' => 'required',
            'floor' => 'required',
            'rooms' => 'required',
            'area' => 'required',
            'balcony' => 'nullable',
            'price' => 'nullable',
        ]);

        if ($request->balcony === null) {
            $request->merge(['balcony' => 0]);
        }

        $apartment->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Apartment updated!');
    })->name('apartment.update');
    Route::delete('/delete/apartment/{apartment}', function (Apartment $apartment) {
        $apartment->delete();

        return redirect()->route('dashboard')->with('success', 'Apartment deleted!');
    })->name('apartment.delete');

    /*
    |--------------------------------------------------------------------------
    | Galerii haldus
    |--------------------------------------------------------------------------
    |
    | Deliberately here rather than in routes/api.php like the apartment gallery:
    | the "api" middleware group has no StartSession (see app/Http/Kernel.php),
    | so `auth` cannot work there. Living in the web group gives these endpoints
    | session auth and CSRF for free.
    |
    */
    Route::get('/admin/gallery', function () {
        return Inertia::render('Admin/Gallery', [
            'hero' => GalleryCategory::hero()->toPayload(),
            'categories' => GalleryCategory::carouselPayload(),
        ]);
    })->name('admin.gallery');

    Route::post('/admin/gallery/categories', function () {
        GalleryCategory::create([
            'type' => GalleryCategory::TYPE_CAROUSEL,
            'name_et' => 'Uus kategooria',
            'sort_order' => (int) GalleryCategory::carousel()->max('sort_order') + 1,
        ]);

        return back();
    })->name('admin.gallery.category.create');

    Route::post('/admin/gallery/categories/reorder', function (Request $request) {
        $ids = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ])['ids'];

        // Scope to carousel categories so the hero row can't be dragged into the list.
        $valid = GalleryCategory::where('type', GalleryCategory::TYPE_CAROUSEL)
            ->whereIn('id', $ids)
            ->pluck('id')
            ->all();

        foreach (array_values(array_filter($ids, fn ($id) => in_array($id, $valid))) as $position => $id) {
            GalleryCategory::where('id', $id)->update(['sort_order' => $position]);
        }

        return back();
    })->name('admin.gallery.category.reorder');

    Route::post('/admin/gallery/categories/{category}', function (Request $request, GalleryCategory $category) {
        $category->update($request->validate([
            'name_et' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
        ]));

        return back();
    })->name('admin.gallery.category.update');

    Route::delete('/admin/gallery/categories/{category}', function (GalleryCategory $category) {
        // The hero row backs the homepage slideshow and has no re-create path in the UI.
        abort_if($category->type === GalleryCategory::TYPE_HERO, 403);

        $category->delete();

        return back();
    })->name('admin.gallery.category.delete');

    Route::post('/admin/gallery/{category}/images', function (Request $request, GalleryCategory $category) {
        $request->validate([
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,webp,gif|max:10000000',
        ]);

        $uploaded = $request->file('file');
        $files = is_array($uploaded) ? $uploaded : [$uploaded];

        foreach ($files as $file) {
            $contents = file_get_contents($file->getRealPath());
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            // Same treatment as the apartment gallery: downscale for the web,
            // convert to WebP. No trim/blend — those are for plan PNGs.
            $image = Image::read($contents)->scaleDown(width: 1920);

            $category->addMediaFromString((string) $image->toWebp(80))
                ->usingFileName($name . '_' . Str::random(6) . '.webp')
                ->toMediaCollection(GalleryCategory::COLLECTION);
        }

        return response()->json(['count' => count($files)]);
    })->name('admin.gallery.images.upload');

    Route::post('/admin/gallery/{category}/images/reorder', function (Request $request, GalleryCategory $category) {
        $ids = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ])['ids'];

        // Media::setNewOrder is an unscoped whereIn, so filter to this category first.
        $valid = $category->media()
            ->where('collection_name', GalleryCategory::COLLECTION)
            ->whereIn('id', $ids)
            ->pluck('id')
            ->all();

        Media::setNewOrder(array_values(array_filter($ids, fn ($id) => in_array($id, $valid))));

        return back();
    })->name('admin.gallery.images.reorder');

    Route::delete('/admin/gallery/{category}/images/{media}', function (GalleryCategory $category, $media) {
        $category->media()
            ->where('collection_name', GalleryCategory::COLLECTION)
            ->where('id', $media)
            ->firstOrFail()
            ->delete();

        return back();
    })->name('admin.gallery.images.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
