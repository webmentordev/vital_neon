<?php

use App\Http\Livewire\Product;
use App\Http\Livewire\CreateDesign;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShapeController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\RemoteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryPriceController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create-design', CreateDesign::class)->name('create-design');

Route::get('/upload-design', [DesignController::class, 'index'])->name('upload-design');
Route::post('/upload-design', [DesignController::class, 'store']);

Route::get('/support', [SupportController::class, 'index'])->name('support');
Route::post('/support', [SupportController::class, 'store'])->middleware(['throttle:2,5']);

Route::get('/cancel/{id}', [OrderController::class, 'cancel']);
Route::get('/success/{id}', [OrderController::class, 'success']);

Route::get('/product/{slug}', Product::class)->name('listing');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/search', [ProductsController::class, 'search'])->name('product.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/shape', [ShapeController::class, 'index'])->name('shape');
    Route::post('/shape', [ShapeController::class, 'create']);

    Route::get('/remote', [RemoteController::class, 'index'])->name('remote');
    Route::post('/remote', [RemoteController::class, 'create']);
    
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    Route::get('/lines', [LineController::class, 'index'])->name('line');
    Route::post('/lines', [LineController::class, 'create']);

    Route::get('/category', [CategoryPriceController::class, 'index'])->name('category');
    Route::post('/category', [CategoryPriceController::class, 'create']);

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/upload', [ProductController::class, 'upload'])->name('upload');
    Route::post('/product', [ProductController::class, 'create']);

    Route::get('/searches', [SearchController::class, 'index'])->name('searches');
});

require __DIR__.'/auth.php';