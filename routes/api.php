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

//Route::group(
//    ['middleware' => 'auth:api'],
//    function () {
//        Route::get('/user', function (Request $request) {
//            return $request->user();
//        });
//    });


Route::group(
    ['middleware' => ['throttle:500,1'], 'prefix' => 'pings', 'namespace' => 'Api'],
    function () {
        Route::get('/', 'ApiController@index');
        Route::post('/search', 'ApiController@search');
        Route::post('/query', 'ApiController@query');
    }
);
