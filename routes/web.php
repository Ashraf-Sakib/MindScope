<?php

use App\Http\Controllers\MoodController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\WizardCatController;
use App\Http\Controllers\ProfileController;

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
    Route::get('/profile/partials/update-profile-information', function () {
        return view('profile.partials.update-profile-information-form');
    })->name('profile-info-update');
    Route::get('/weekly-report', [MoodController::class, 'weeklyReport'])->name('weekly.report');
    Route::get('/relief', [MoodController::class, 'relief'])->name('relief');
    Route::post('/wizard-cat/respond', [WizardCatController::class, 'respond'])
        ->name('wizard-cat.respond');
   
});

