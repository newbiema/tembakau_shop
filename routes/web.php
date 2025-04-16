<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ListProductController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/verify/{token}', [VerifyEmailController::class, 'verify'])->name('email.verification');

Route::group(['middleware' => ['auth', 'isVerify']], function() {
    Route::prefix('admin')->middleware(['role:Admin'])->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('product')->group(function() {
            Route::get('/', [ProductController::class, 'index'])->name('admin.product');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
            Route::put('/{id}/update', [ProductController::class, 'update'])->name('admin.product.update');
            Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        });

        Route::prefix('customer')->group(function() {
            Route::get('/', [CustomerController::class, 'index'])->name('admin.customer');
            Route::delete('/{id}/destroy', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');
        });
    });

    Route::prefix('user')->middleware(['role:User'])->group(function() {
        Route::prefix('product')->group(function() {
            Route::get('/', [ListProductController::class, 'index'])->name('user.product');
            Route::get('/{id}/detail', [ListProductController::class, 'show'])->name('user.product.detail');
            Route::post('/store', [ListProductController::class, 'store'])->name('user.product.store');
            Route::get('/{order_id}/payment', [ListProductController::class, 'payment'])->name('user.product.payment');
            Route::put('/{id}/update', [ListProductController::class, 'update'])->name('user.product.update');
        });
    });

    Route::prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('order');
        Route::get('/{id}/show', [OrderController::class, 'show'])->name('order.show');
        Route::delete('/{id}/destroy', [OrderController::class, 'destroy'])->name('order.delete')->middleware(['role:Admin']);
    });

    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::put('/{id}/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::put('/{id}/resetPassword', [ProfileController::class, 'resetPassword'])->name('resetPassword');
    });
});

