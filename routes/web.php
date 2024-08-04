<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MastersGroupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'redirect'])->name('redirect');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin|designer|master'])->prefix('/')->group(function () {
	Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
	Route::put('/profile', [DashboardController::class, 'profileUpdate'])->name('profileUpdate');
	Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
	//===================================================== Orders routes ============================================================
	Route::post('orders/{order}/services', [OrderController::class, 'storeServices'])->name('orders.storeServices');
	Route::delete('orders/{order}/services', [OrderController::class, 'destroyService'])->name('orders.destroyService');
	Route::resource('orders', OrderController::class);
	//===================================================== end Orders routes ========================================================
	//============================================ clients routes ====================================================================
	Route::resource('clients', ClientController::class);
	//============================================ end clients routes ================================================================

});

Route::middleware(['auth', 'role:admin'])->prefix('/')->group(function () {
	//================================================== units routes ===============================================================
	Route::resource('units', UnitController::class);
	//=============================================== products routes ===============================================================
	Route::get('products/{product}/arrive', [ProductController::class, 'arrive'])->name('products.arrive');
	Route::post('products/{product}/arrive', [ProductController::class, 'storeArrive'])->name('products.storeArrive');
	Route::get('/arrived-products', [ProductController::class, 'arrivedProducts'])->name('arrivedProducts');
	Route::post('/arrived-products', [ProductController::class, 'filterByData'])->name('filterByData');
	//================================================================================================================================
	Route::get('/products/{product}/decomission', [ProductController::class, 'decomission'])->name('products.decomission');
	Route::post('/products/{product}/decomission', [ProductController::class, 'storeDecomission'])->name('products.storeDecomission');
	//================================================================================================================================
	Route::resource('products', ProductController::class);
	//============================================ end products routes ===============================================================
	//============================================ providers routes ==================================================================
	Route::resource('providers', ProviderController::class);
	//============================================ end providers routes ==============================================================
	//===================================================== services routes ==========================================================
	Route::resource('services', ServiceController::class);
	//===================================================== end services routes ======================================================
	//===================================================== Master Groups routes ====================================================
	Route::resource('master-groups', MastersGroupController::class);
	//===================================================== end Master Groups routes =================================================
	//===================================================== Masters routes ==========================================================
	Route::resource('masters', MasterController::class);
	//===================================================== end Masters routes ======================================================
	//===================================================== Designers routes ========================================================
	Route::resource('designers', DesignerController::class);
	//===================================================== end Designers routes ====================================================
});
