<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\PurchaseOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::name('app.')
    ->prefix('app')
    ->group(function () {
        require __DIR__ . '/auth.php';

        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified',
        ])->group(function () {
            Route::middleware('can:view-admin-pages')->group(function () {
                Route::get('/dashboard', DashboardController::class)->name('dashboard');
                Route::resource('product', ProductController::class);
            });



            Route::middleware('can:view-customer-pages')->name('customer.')
                ->prefix('customer')->group(function () {
                    Route::get('/home', HomeController::class)->name('home');
                    Route::post('/purchase', PurchaseOrderController::class)->name('purchase');
                    Route::resource('orders', OrderController::class);
                });
        });
    });
