<?php

use App\Http\Controllers\MoodController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MoodController::class, 'dashboard'])->name('dashboard');
    Route::get('/moods', [MoodController::class, 'index'])->name('moods.index');
    Route::post('/moods', [MoodController::class, 'store'])->name('moods.store');
    Route::delete('/moods/{mood}', [MoodController::class, 'destroy'])->name('moods.destroy');
     Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');
    Route::get('/weekly-report', [MoodController::class, 'weeklyReport'])->name('weekly.report');
    Route::get('/relief', [MoodController::class, 'relief'])->name('relief');
});

