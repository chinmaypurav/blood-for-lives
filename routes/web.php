<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test\TestController;
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
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});
Route::get('/modal', function () {
    return view('modal');
});

Route::get('/roles', [TestController::class, 'roles'])->name('test');
Route::get('/radius', [TestController::class, 'radius'])->name('radius');

Route::post('/test', function () {
    return json_encode("Suucccsss");
})->name('test');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');








Route::group([
    'prefix' => 'manager',
    'as' => 'manager.',
    'middleware' => 'auth'
], function () {
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
});


Route::resource('/admin/bank', 'App\Http\Controllers\Admin\BankController', 
['as' => 'admin']);

require __DIR__.'/auth.php';
