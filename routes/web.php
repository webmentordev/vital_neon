<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/size', [SizeController::class, 'index'])->name('size');
    Route::post('/size', [SizeController::class, 'create']);

    Route::get('/shape', [ShapeController::class, 'index'])->name('shape');
    Route::post('/shape', [ShapeController::class, 'create']);
});

require __DIR__.'/auth.php';