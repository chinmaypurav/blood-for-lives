<?php

use Illuminate\Support\Facades\Route;
use App\Services\CompatibilityService;
use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\Manager\BoloController;
use App\Http\Controllers\Setup\PostalController;
use App\Http\Controllers\Manager\DonorController;
use App\Http\Controllers\Test\TestApiController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('test/', [App\Http\Controllers\Test\TestController::class, 'test']);

Route::apiResource('testapi', TestApiController::class);

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('bank/register/{bank}', [App\Http\Controllers\Admin\BankController::class, 'register'])
    ->middleware('signed')
    ->name('bank.register');

// Route::view('bank/register/{bank}', 'bank.register')->middleware('signed')->name('bank.register');

Route::group([
    'prefix' => 'bank',
    'as' => 'bank.',
    'middleware' => 'auth'
], function () {
    Route::get('ada/{id}', [App\Http\Controllers\Manager\AdaController::class, 'create'])->name('ada.create');
    Route::post('ada', [App\Http\Controllers\Manager\AdaController::class, 'store'])->name('ada.store');
    Route::get('batch', [App\Http\Controllers\Manager\AdaController::class, 'status']);

    Route::post('donor/search', [App\Http\Controllers\Manager\DonorController::class, 'search'])
        ->name('donor.search');

    Route::get('donation/search', function () {
        return view('manager.donation.search');
    })->name('donations.search');
    Route::post('donation/search', [App\Http\Controllers\Manager\DonationController::class, 'search'])
        ->name('donation.found');
    Route::resource('donors', 'App\Http\Controllers\Manager\DonorController');
    Route::resource('donations', 'App\Http\Controllers\Manager\DonationController');
    Route::resource('process', 'App\Http\Controllers\Manager\ProcessController');
    Route::resource('demand', 'App\Http\Controllers\Manager\DemandController');
    Route::resource('inventory', 'App\Http\Controllers\Manager\InventoryController');
    Route::resource('manager', 'App\Http\Controllers\Manager\ManagerController');
    Route::resource('ada', 'App\Http\Controllers\Manager\AdaController');
    Route::resource('camps', App\Http\Controllers\Bank\CampController::class);

    Route::group([], function () {
    });

    Route::prefix('c')->group(function () {
        Route::resource('/donation', 'App\Http\Controllers\Manager\CampDonationController', ['as' => 'camp'])
            ->names([
                // 'index' => 'camp.donation.index',
                // 'create' => 'camp.donation.create',
                // 'store' => 'camp.donation.store',
                // 'show' => 'camp.donation.show',
                // 'update' => 'camp.donation.update',
            ])
            ->parameters([
                'donation' => 'donor'
            ]);
    });
});

Route::group([
    'prefix' => 'donor',
    'as' => 'donor.',
    'middleware' => 'auth'
], function () {
    Route::resource('/donation', 'App\Http\Controllers\Donor\DonationController');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth'
], function () {
    Route::resource(
        'banks',
        'App\Http\Controllers\Admin\BankController',
        // ['as' => 'admin']
    );
});



require __DIR__ . '/auth.php';