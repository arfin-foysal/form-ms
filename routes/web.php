<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [FormController::class, 'userIndex'])->name('form.user.index');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/builder', [FormController::class, 'builder'])->name('builder');

    
    Route::get('/dashboard', [FormController::class, 'index'])->name('dashboard');
    Route::post('/submit', [FormController::class, 'create'])->name('form.submit');
    Route::get('/forms', [FormController::class, 'index'])->name('form.index');
    Route::get('/forms/{id}', [FormController::class, 'edit'])->name('form.edit');
    Route::get('/forms-show/{id}', [FormController::class, 'show'])->name('form.show');
    Route::post('/forms/{id}', [FormController::class, 'update'])->name('form.update');
    Route::delete('/forms/{id}', [FormController::class, 'destroy'])->name('form.delete');

    //client side
});

require __DIR__.'/auth.php';
