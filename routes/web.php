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

Route::get('bank/register/{bank:bank_code}', [App\Http\Controllers\Bank\BankRegisterController::class, 'create'])
    ->middleware('signed')
    ->name('bank.register');
Route::post('bank/register/{bank:bank_code}', [App\Http\Controllers\Bank\BankRegisterController::class, 'store'])
    ->middleware('guest');

// Route::view('bank/register/{bank}', 'bank.register')->middleware('signed')->name('bank.register');

Route::group([
    'prefix' => 'bank',
    'as' => 'bank.',
    'middleware' => 'auth'
], function () {
    Route::get('ada/{id}', [App\Http\Controllers\Bank\AdaController::class, 'create'])->name('ada.create');
    Route::post('ada', [App\Http\Controllers\Bank\AdaController::class, 'store'])->name('ada.store');
    Route::get('batch', [App\Http\Controllers\Bank\AdaController::class, 'status']);

    Route::post('donor/search', [App\Http\Controllers\Bank\DonorController::class, 'search'])
        ->name('donor.search');

    Route::get('donation/search', function () {
        return view('bank.donation.search');
    })->name('donations.search');
    Route::post('donation/search', [App\Http\Controllers\Bank\DonationController::class, 'search'])
        ->name('donation.found');
    Route::resource('donors', App\Http\Controllers\Bank\DonorController::class);
    Route::resource('donations', App\Http\Controllers\Bank\DonationController::class);
    Route::resource('demands', 'App\Http\Controllers\Bank\DemandController');
    Route::resource('inventories', App\Http\Controllers\Bank\InventoryController::class);
    Route::resource('managers', App\Http\Controllers\Bank\ManagerController::class);
    Route::resource('ada', App\Http\Controllers\Bank\AdaController::class);
    Route::resource('camps', App\Http\Controllers\Bank\CampController::class);
    Route::resource('camps.donations', App\Http\Controllers\Bank\CampDonationController::class);


    // Route::resource('processes', App\Http\Controllers\Bank\ProcessController::class);
    Route::get('processes', [App\Http\Controllers\Bank\ProcessController::class, 'index'])->name('processes.index');
    Route::post('processes', [App\Http\Controllers\Bank\ProcessController::class, 'store'])->name('processes.store');
    Route::put('processes/{donation}', [App\Http\Controllers\Bank\ProcessController::class, 'update'])->name('processes.update');


    Route::group([], function () {
    });

    // Route::prefix('c')->group(function () {
    //     Route::resource('/donation', 'App\Http\Controllers\Manager\CampDonationController', ['as' => 'camp'])
    //         ->names([
    //             // 'index' => 'camp.donation.index',
    //             // 'create' => 'camp.donation.create',
    //             // 'store' => 'camp.donation.store',
    //             // 'show' => 'camp.donation.show',
    //             // 'update' => 'camp.donation.update',
    //         ])
    //         ->parameters([
    //             'donation' => 'donor'
    //         ]);
    // });
});

Route::group([
    'prefix' => 'donor',
    'as' => 'donor.',
    'middleware' => 'auth'
], function () {
    Route::resource('donations', App\Http\Controllers\Donor\DonationController::class);
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
