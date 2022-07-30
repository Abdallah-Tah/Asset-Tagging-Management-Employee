<?php

use App\Http\Controllers\AmazonSiteController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');


Route::group(['auth', 'verified'], function () {
    Route::resource('/amazon-sites', App\Http\Controllers\AmazonSiteController::class);
    Route::post('/amazon-sites/import', [\App\Http\Controllers\AmazonSiteController::class, 'import'])->name('amazon-sites.import');
    Route::resource('/employees', App\Http\Controllers\EmployeeController::class);
    Route::resource('/setting-sites', App\Http\Controllers\SettingSiteController::class);
    

});

require __DIR__ . '/auth.php';
