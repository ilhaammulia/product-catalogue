<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestTicketController;
use App\Http\Controllers\UserController;

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
    return Inertia::render('Landing/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('landing.home');

Route::prefix('products')->group(function () {
    Route::get('/', [LandingController::class, 'products'])->name('landing.products');
    Route::post('/', [LandingController::class, 'products'])->name('landing.products.filter');
    Route::get('/{slug}', [LandingController::class, 'product_detail'])->name('landing.product.detail');
});

Route::prefix('tickets')->group(function () {
    Route::post('/', [RequestTicketController::class, 'store'])->name('ticket.store');
});

Route::get('/terms', [LandingController::class, 'terms'])->name('landing.terms');
Route::get('/about', [LandingController::class, 'about'])->name('landing.about');
Route::get('/contact', [LandingController::class, 'contact'])->name('landing.contact');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', [LandingController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('/admin/resources')->group(function () {
        Route::get('/products/new', [ProductController::class, 'create'])->name('admin.product.add');
        Route::post('/products/categories', [CategoryController::class, 'store'])->name('admin.product.category.add');
    });

    Route::prefix('/admin/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product');
        Route::post('/', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');
        Route::post('/{product}', [ProductController::class, 'update'])->name('admin.product.update');
    });

    Route::prefix('/admin/tickets')->group(function () {
        Route::get('/', [RequestTicketController::class, 'index'])->name('admin.ticket');
        Route::delete('/{ticket}', [RequestTicketController::class, 'destroy'])->name('admin.ticket.delete');
    });
});
