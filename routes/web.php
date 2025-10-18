<?php

use App\Http\Controllers\MoodController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\WizardCatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JournalController;

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
     Route::patch('/profile/update', [ProfileController::class, 'update'])
        ->name('profile-info-update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile-info-update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/weekly-report', [MoodController::class, 'weeklyReport'])->name('weekly.report');
    Route::get('/relief', [MoodController::class, 'relief'])->name('relief');
    Route::post('/wizard-cat/respond', [WizardCatController::class, 'chat'])
        ->name('wizard-cat.respond');
        Route::middleware(['auth', 'verified'])->group(function () {
    // ... existing routes
Route::get('/Journal', [JournalController::class, 'index'])->name('journal.index'); 
Route::get('/Journal/{journal}', [JournalController::class, 'show'])->name('journal.show');
    // Show all entries
Route::get('/Journal/create', [JournalController::class, 'create'])->name('journal.create'); // Show "new entry" form
Route::post('/Journal', [JournalController::class, 'store'])->name('journal.store');        // Store new entry
Route::get('/Journal/{journal}/edit', [JournalController::class, 'edit'])->name('journal.edit');   // Edit entry
Route::patch('/Journal/{journal}', [JournalController::class, 'update'])->name('journal.update'); // Update entry
Route::delete('/Journal/{journal}', [JournalController::class, 'destroy'])->name('journal.destroy'); // Delete entry

});
   
});

