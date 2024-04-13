<?php

declare(strict_types=1);

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ManualSyncController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', FrontController::class);
Route::get('/sync', (new ManualSyncController())->index(...))->middleware(EnsureTokenIsValid::class);
Route::post('/sync', (new ManualSyncController())->update(...))->middleware(EnsureTokenIsValid::class);
