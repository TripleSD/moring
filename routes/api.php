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
    ['middleware' => ['throttle:500,1'], 'prefix' => 'sites'],
    function () {
        Route::group(
            ['prefix' => 'pings', 'namespace' => 'Api\Sites'],
            function () {
                Route::get('/', 'PingsController@index');
                Route::post('/search', 'PingsController@search');
                Route::post('/query', 'PingsController@query');
            }
        );

        Route::group(
            ['prefix' => 'ssl', 'namespace' => 'Api\Sites'],
            function () {
                Route::get('/', 'SslController@index');
                Route::post('/search', 'SslController@search');
                Route::post('/query', 'SslController@query');
            }
        );
    }
);
