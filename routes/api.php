<?php

use Illuminate\Http\Request;

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
Route::get('visit', function () {
    return response('Resource not found', 404);
});
Route::options('visit', function() {
    return '';
})->middleware('cors');
Route::post('visit', 'API\VisitsController@store')->middleware('cors');
Route::post('subscribe', 'API\SubscribeController@subscribe')->middleware('cors');
