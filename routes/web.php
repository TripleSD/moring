<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::any('/logout','Auth\LoginController@logout')->name('auth.logout');
Route::get('/checks/sites', 'ChecksSitesController@getIndex')->name('checks.sites.getIndex');