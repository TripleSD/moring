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
Route::any('/logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('/checks/sites', 'ChecksSitesController@getIndex')->name('checks.sites.getIndex');

//  Sites management
$groupData = [
    'namespace' => 'Admin\Sites',
    'prefix' => 'admin'
];

Route::group($groupData, function () {
    $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy'];
    Route::resource('sites', 'SitesController', ['names' =>'admin.sites'])
        ->only($methods)
        ->names('admin.sites');
});

Route::group(['prefix' => 'settings', 'namespace' => 'Admin\Settings','as' => 'settings.'], function () {
    $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy','show'];
    Route::resource('users', 'UsersController')
        ->only($methods);
})

Route::group(['namespace' => 'Admin\Servers'], function () {
    $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy','show'];
    Route::resource('servers', 'ServersController')
        ->only($methods);
});