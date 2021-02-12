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

Route::get('/test/{id}', function ($id) {
    return $id;
});

Route::get('/test', [TestController::class, 'encrypt'])->name('test');

Route::post('/test', function () {
    return json_encode("Suucccsss");
})->name('test');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/manager/donor/search', [App\Http\Controllers\Manager\DonorController::class, 'search'])->name('manager.donor.search');

Route::post('/manager/donation/search', [App\Http\Controllers\Manager\DonationController::class, 'search'])->name('manager.donation.search');

Route::resource('/manager/donor', 'App\Http\Controllers\Manager\DonorController', 
                ['as' => 'manager']);

Route::resource('/manager/donation', 'App\Http\Controllers\Manager\DonationController', 
['as' => 'manager']);

Route::resource('/manager/process', 'App\Http\Controllers\Manager\ProcessController', 
['as' => 'manager']);

Route::resource('/manager/inventory', 'App\Http\Controllers\Manager\InventoryController', 
['as' => 'manager']);


Route::group([
    'prefix' => 'manager',
    'as' => 'manager.',
    'middleware' => 'auth'
], function () {
    Route::resource('/demand', 'App\Http\Controllers\Manager\DemandController');
});


Route::resource('/admin/bank', 'App\Http\Controllers\Admin\BankController', 
['as' => 'admin']);

require __DIR__.'/auth.php';
