<?php

use App\Http\Controllers\CacheController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FailedJobController;
use App\Http\Controllers\JobBatchController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\PasswordResetTokenController;
use App\Http\Controllers\PersonalAccessTokenController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CacheLockController;
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

// These routes are typically managed by Filament.
// You might not need explicit Route::resource declarations for
// the basic CRUD operations if you are primarily using Filament.
// However, if you have custom logic in your controllers that
// you want to access via web routes, you can define them here.

Route::resource('caches', CacheController::class);
Route::resource('categories', CategoryController::class);
Route::resource('customers', CustomerController::class);
Route::resource('failed-jobs', FailedJobController::class);
Route::resource('jobs', JobController::class);
Route::resource('job-batches', JobBatchController::class);
Route::resource('migrations', MigrationController::class);
Route::resource('password-reset-tokens', PasswordResetTokenController::class);
Route::resource('personal-access-tokens', PersonalAccessTokenController::class);
Route::resource('prescriptions', PrescriptionController::class);
Route::resource('products', ProductController::class);
Route::resource('sales', SaleController::class);
Route::resource('sale-items', SaleItemController::class);
Route::resource('sessions', SessionController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('users', UserController::class);
Route::resource('cache-locks', CacheLockController::class);

// If you have any custom routes for specific actions within your controllers,
// you can define them individually like this:
// Route::get('/caches/report', [CacheController::class, 'report'])->name('caches.report');
// Route::post('/products/{product}/restock', [ProductController::class, 'restock'])->name('products.restock');

// Filament handles the main resource routes automatically.
// You typically won't need to define basic CRUD routes here.

// Route::get('/', function () {
    // return view('welcome'); // Or your default homepage
// });