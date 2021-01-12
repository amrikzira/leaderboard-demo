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

Route::get('getAllPlayers', 'ApiController@getAllPlayers');
Route::get('getPlayer/{id}', 'ApiController@getPlayer');
Route::post('createPlayer', 'ApiController@createPlayer');
Route::put('updatePointCount', 'ApiController@updatePlayer');
Route::delete('deletePlayer', 'ApiController@deletePlayer');

Route::any('{path}', function () {
    return response()->json([
        'message' => 'Route not found.',
    ], 404);
})->where('path', '.*');
