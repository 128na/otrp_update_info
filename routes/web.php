<?php

declare(strict_types=1);

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ManualSyncController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', FrontController::class);
Route::get('/sync', ManualSyncController::class)->middleware(EnsureTokenIsValid::class);
