<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HolidayController;


Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Language switcher
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('lang.switch');

Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Projects
    Route::resource('projects', ProjectController::class);

    // Tasks nested in Projects (shallow routes)
    Route::resource('projects.tasks', TaskController::class)->shallow();

    Route::get('tasks', [App\Http\Controllers\Api\TaskController::class, 'index']);

    Route::get('/swieta', [HolidayController::class, 'index']);

});



require __DIR__.'/auth.php';
