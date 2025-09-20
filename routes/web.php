<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/moods', [MoodController::class, 'index'])->name('moods.index');
Route::post('/moods', [MoodController::class, 'store'])->name('moods.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/weekly-report', [MoodController::class, 'weeklyReport'])->middleware(['auth', 'verified'])->name('weekly.report');
Route::get('/relief', [MoodController::class, 'relief'])->middleware(['auth', 'verified'])->name('relief');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
