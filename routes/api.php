<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('/index', 'Api\ProjectsController@index');
        Route::get('/show/{project:guid}', 'Api\ProjectsController@show');
        Route::post('/store', 'Api\ProjectsController@store');
    });

    Route::prefix('{project:guid}/artisans')->group(function () {
        Route::post('/send', 'Api\ArtisansController@send');
    });
});

Route::post('/callback/{ArtisanSent:guid}', 'Api\ArtisansController@callback')->name('artisan.callback');