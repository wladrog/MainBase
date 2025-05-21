<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/now', function () {
    return Carbon::now()->toDateTimeString();
});
