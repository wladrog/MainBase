<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectApiController;

Route::get('/projects', [ProjectApiController::class, 'index']);
