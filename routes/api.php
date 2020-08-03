<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::post('receiver', 'Api\ApiController@receiver')->name('api.receiver');

Route::middleware(['cache.headers:public;max_age=3600'])->group(function () {
    Route::get('v1/update-info', 'Api\ApiController@index');
});
