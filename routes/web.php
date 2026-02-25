<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LanguageMiddleware;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Middleware\Auth as MustLogin;
use App\Http\Middleware\cmslogin;
use App\Http\Controllers\PltuServiceController;


Route::get('/pltu/login', [CmsController::class, 'login'])->name('login');


Route::get('/get-data', [PltuServiceController::class, 'getMarker']);
Route::get('/provinsi-bounds/{nama}', [PltuServiceController::class, 'getProvinsiBounds']);
Route::get('/provinsi-centroid', [PltuServiceController::class, 'getProvinsiCentroid']);
Route::get('/provinsi-centroid-pltu', [PltuServiceController::class, 'getProvinsiCentroidPltu']);
Route::get('/provinsi-cql-filter', [PltuServiceController::class, 'getProvinsiCqlFilter']);

Route::get('/kota-centroid-provinsi/{provinsi}', [PltuServiceController::class, 'getKotaCentroidByProvinsi']);
Route::get('/kota-bounds/{nama}', [PltuServiceController::class, 'getKotaBounds']);
Route::get('/kota-cql-filter/{provinsi}', [PltuServiceController::class, 'getKotaCqlFilterByProvinsi']);
Route::get('/pltu-marker-kota/{kota}', [PltuServiceController::class, 'getPltuMarkerByKota']);
Route::get('/geojson-indonesia', [PltuServiceController::class, 'getIndonesiaPolygon']);


Route::get('/desa-centroid-kota/{kota}', [PltuServiceController::class, 'getDesaCentroidByKota']);
Route::get('/pltu-marker-desa/{desa}', [PltuServiceController::class, 'getPltuMarkerByDesa']);




Route::fallback(function () {
    $locale = app()->getLocale();
    return redirect("/{$locale}");
});


Route::group([
    'prefix' => 'laravel-filemanager',
], function () {
    Lfm::routes();
});

Route::get('/', function () {
    $locale = app()->getLocale();
    return redirect("/{$locale}");
});



Route::pattern('locale', 'en|id');


//User Routes
Route::middleware(LanguageMiddleware::class)
    ->prefix('{locale}')
    ->group(function () {



        Route::get('/', [UserController::class, 'Index'])
            ->name('index');


        // about
        Route::get('/about', [UserController::class, 'About'])
            ->name('about');

        // aktivitas
        Route::get('/activity', [UserController::class, 'activityIndex'])
            ->name('activity.index');

        // Background -> CoalCrowd
        Route::get('background/coal-crowd', [UserController::class, 'coalcrowdIndex'])
            ->name('background.coal-crowd');

        // Background -> Coal Permit
        Route::get('background/coal-permit', [UserController::class, 'coalpermitIndex'])
            ->name('background.coal-permit');

        // Background -> Regulation
        Route::get('background/regulation', [UserController::class, 'regulationIndex'])
            ->name('background.regulation');

        // Background -> Benchmark Price
        Route::get('background/benchmark-price', [UserController::class, 'benchmarkpriceIndex'])
            ->name('background.benchmark-price');

        // Background -> Coal Production
        Route::get('background/coal-production', [UserController::class, 'coalproductionIndex'])
            ->name('background.coal-production');

        // Background -> Coal Consumption
        Route::get('background/coal-consumption', [UserController::class, 'coalconsumptionIndex'])
            ->name('background.coal-consumption');

        // Background -> Mining and Deforestation
        Route::get('background/mining-and-deforestation', [UserController::class, 'mininganddeforestationIndex'])
            ->name('background.mining-and-deforestation');

        // Coal-Ruption -> Mining and Deforestation
        Route::get('coal-ruption/cases', [UserController::class, 'casesIndex'])
            ->name('coal-ruption.cases');

        // Action
        Route::get('action', [UserController::class, 'actionIndex'])
            ->name('action.index');

        // Action -> detail action
        Route::get('/action/{id}/{slug}', [UserController::class, 'actionDetail'])
            ->name('action.detail');

        // Data -> Check PLTU
        Route::get('data/resource', [UserController::class, 'resourceIndex'])
            ->name('data.resource.index');

        // Data -> Check PLTU
        Route::get('data/check-pltu', [UserController::class, 'checkpltuIndex'])
            ->name('data.check-pltu.index');

        Route::prefix('map')->group(function () {
            Route::get('/', [CmsController::class, 'map'])
                ->name('map.index');

            Route::get('/{id}', [CmsController::class, 'mapDetail'])
                ->name('map.detail');
        });

    });


//CMS Routes
Route::middleware(LanguageMiddleware::class)
    ->prefix('{locale}/cms')
    ->name('cms.')
    ->middleware([cmslogin::class . ':admin', LanguageMiddleware::class])
    ->group(function () {

        Route::post('/logout', [CmsController::class, 'logout'])->name('logout');

        Route::get('/map', [CmsController::class, 'map'])->name('map');
        Route::get('/map/center', [CmsController::class, 'map.center']);
        Route::get('/map/layer', [CmsController::class, 'map.layer']);
        Route::get('/map/input', [CmsController::class, 'mapInput']);
        Route::get('/map/{id}', [CmsController::class, 'map.detail']);

        // Index
        Route::get('/', [CmsController::class, 'Index'])
            ->name('index');

        // Account
        Route::get('/account', [CmsController::class, 'accountIndex'])
            ->name('account.index');


        // Ngopini
        Route::get('/ngopini', [CmsController::class, 'ngopiniIndex'])
            ->name('ngopini.index');
        Route::get('/ngopini/insert', [CmsController::class, 'ngopiniInsert'])
            ->name('ngopini.insert');
        Route::get('/ngopini/edit/{id}', [CmsController::class, 'ngopiniEdit'])
            ->name('ngopini.edit');

        // Aktivitas
        Route::get('/activity', [CmsController::class, 'activityIndex'])
            ->name('activity.index');
        Route::get('/activity/insert', [CmsController::class, 'activityInsert'])
            ->name('activity.insert');
        Route::get('/activity/edit/{id}', [CmsController::class, 'activityEdit'])
            ->name('activity.edit');


        // About
        Route::get('/about', [CmsController::class, 'About'])
            ->name('about');

        // Background
        // Backgorund -> Coalcrowd
        Route::get('/background/coalcrowd', [CmsController::class, 'coalcrowdIndex'])
            ->name('background.coalcrowd.index');
        Route::get('/background/coalcrowd/insert', [CmsController::class, 'coalcrowdInsert'])
            ->name('background.coalcrowd.insert');
        Route::get('/background/coalcrowd/edit/{id}', [CmsController::class, 'coalcrowdEdit'])
            ->name('background.coalcrowd.edit');

        // Backgorund -> Coal Permit
        Route::get('/background/coal-permit', [CmsController::class, 'coalpermitIndex'])
            ->name('background.coal-permit.index');

        // Backgorund -> Regulation
        Route::get('/background/regulation', [CmsController::class, 'regulationIndex'])
            ->name('background.regulation.index');
        Route::get('/background/regulation/insert', [CmsController::class, 'regulationInsert'])
            ->name('background.regulation.insert');
        Route::get('/background/regulation/edit/{id}', [CmsController::class, 'regulationEdit'])
            ->name('background.regulation.edit');

        // Backgorund -> Benchmark Price
        Route::get('/background/benchmark-price', [CmsController::class, 'benchmarkpriceIndex'])
            ->name('background.benchmark-price.index');

        // Backgorund -> Coal Production
        Route::get('/background/coal-production', [CmsController::class, 'coalproductionIndex'])
            ->name('background.coal-production.index');

        // Backgorund -> Coal Consumption
        Route::get('/background/coal-consumption', [CmsController::class, 'coalconsumptionIndex'])
            ->name('background.coal-consumption.index');

        // Backgorund -> Mining and Deforestation
        Route::get('/background/mining-and-deforestation', [CmsController::class, 'mininganddeforestationIndex'])
            ->name('background.mining-and-deforestation.index');

        // Coal-Ruption -> Cases
        Route::get('/coal-ruption/cases', [CmsController::class, 'casesIndex'])
            ->name('coal-ruption.cases.index');
        Route::get('/coal-ruption/cases/insert', [CmsController::class, 'casesInsert'])
            ->name('coal-ruption.cases.insert');
        Route::get('/coal-ruption/cases/edit/{id}', [CmsController::class, 'casesEdit'])
            ->name('coal-ruption.cases.edit');

        // Action
        Route::get('/action', [CmsController::class, 'actionIndex'])
            ->name('action.index');
        Route::get('/action/insert', [CmsController::class, 'actionInsert'])
            ->name('action.insert');
        Route::get('/action/edit/{id}', [CmsController::class, 'actionEdit'])
            ->name('action.edit');
        Route::get('/action/preview/{id}', [CmsController::class, 'actionPreview'])
            ->name('action.preview');

        // Data -> Resource
        Route::get('/data/resource', [CmsController::class, 'resourceIndex'])
            ->name('data.resource.index');
        Route::get('/data/resource/insert', [CmsController::class, 'resourceInsert'])
            ->name('data.resource.insert');
        Route::get('/data/resource/edit/{id}', [CmsController::class, 'resourceEdit'])
            ->name('data.resource.edit');

        // Data -> Check PLTU
        Route::get('/data/check-pltu', [CmsController::class, 'checkpltuIndex'])
            ->name('data.check-pltu.index');

        Route::get('/data/check-pltu/detail/{id}', [CmsController::class, 'checkpltuDetail'])
            ->name('data.check-pltu.detail');

        Route::get('/data/check-pltu/insert', [CmsController::class, 'checkpltuInsert'])
            ->name('data.check-pltu.insert');

        Route::get('/data/check-pltu/edit/{id}', [CmsController::class, 'checkpltuEdit'])
            ->name('data.check-pltu.edit');

        Route::get('/pltu/detail', [CmsController::class, 'detailpltuIndex'])
            ->name('detail-pltu.index');

        Route::get('/pltu/detail/add', [CmsController::class, 'detailpltuInsert'])
            ->name('data.detail-pltu.insert');


    });

