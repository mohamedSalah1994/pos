<?php

use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\WelcomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'],
    ], function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('', [WelcomeController::class, 'index'])->name('welcome');
//=======================================users====================================================
            Route::resource('users', UserController::class);
//=======================================categories===============================================
            Route::view('categories', 'dashboard.categories.index');
//=======================================products=================================================
            Route::view('products', 'dashboard.products.index');
//=======================================clients==================================================
            Route::view('clients', 'dashboard.clients.index');
//=======================================orders===================================================
            Route::view('orders', 'dashboard.orders.index');
        });
    });
