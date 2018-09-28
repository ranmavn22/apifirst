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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/* API route */
Route::group(['prefix' => '/v1', 'namespace' => 'API\V1'], function () {
    Route::post('/auth/register', 'ApiController@registerUser')->name('api.v1.users.register');

});