<?php

use Illuminate\Support\Facades\Route;
use App\Services\CompatibilityService;
use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\Manager\BoloController;
use App\Http\Controllers\Setup\PostalController;
use App\Http\Controllers\Manager\DonorController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group([
    'prefix' => 'manager',
    'as' => 'manager.',
    'middleware' => 'auth'
], function () {
    Route::get('ada/{id}', [App\Http\Controllers\Manager\AdaController::class, 'create'])->name('ada.create');
    Route::post('ada', [App\Http\Controllers\Manager\AdaController::class, 'store'])->name('ada.store');
    Route::get('batch', [App\Http\Controllers\Manager\AdaController::class, 'status']);

    Route::post('/donor/search', [App\Http\Controllers\Manager\DonorController::class, 'search'])
        ->name('donor.search');
        
    Route::get('/donation/search', function(){
        return view('manager.donation.search');
    })->name('donation.search');
    Route::post('/donation/search', [App\Http\Controllers\Manager\DonationController::class, 'search'])
        ->name('donation.found');
    Route::resource('/donor', 'App\Http\Controllers\Manager\DonorController');
    Route::resource('/donation', 'App\Http\Controllers\Manager\DonationController');
    Route::resource('/process', 'App\Http\Controllers\Manager\ProcessController');
    Route::resource('/demand', 'App\Http\Controllers\Manager\DemandController');
    Route::resource('/inventory', 'App\Http\Controllers\Manager\InventoryController');
    Route::resource('/manager', 'App\Http\Controllers\Manager\ManagerController');
    Route::resource('/ada', 'App\Http\Controllers\Manager\AdaController');
    Route::resource('/camp', 'App\Http\Controllers\Manager\CampController');
    
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
], function(){
    Route::resource('/donation', 'App\Http\Controllers\Donor\DonationController');
});

Route::resource('/admin/bank', 'App\Http\Controllers\Admin\BankController', 
    ['as' => 'admin']);

require __DIR__.'/auth.php';
