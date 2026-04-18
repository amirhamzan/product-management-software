<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth',])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);

    Route::get('/products', [ProductController::class, 'index']);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
