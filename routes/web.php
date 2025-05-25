<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/now', function () {
    return Carbon::now()->toDateTimeString();
});

Route::resource('projects', ProjectController::class);
