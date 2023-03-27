<?php

use App\Http\Controllers\LineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemoteController;
use App\Http\Controllers\ShapeController;
use App\Http\Controllers\SizeController;
use App\Http\Livewire\CreateDesign;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create-design', CreateDesign::class)->name('create-design');

Route::get('/cancel/{id}', [OrderController::class, 'cancel']);
Route::get('/success/{id}', [OrderController::class, 'success']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/shape', [ShapeController::class, 'index'])->name('shape');
    Route::post('/shape', [ShapeController::class, 'create']);

    Route::get('/remote', [RemoteController::class, 'index'])->name('remote');
    Route::post('/remote', [RemoteController::class, 'create']);

    Route::get('/lines', [LineController::class, 'index'])->name('line');
    Route::post('/lines', [LineController::class, 'create']);
});

require __DIR__.'/auth.php';