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

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::any('/logout', 'Auth\LoginController@logout')->name('auth.logout');

//  Sites management
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin\Sites'], function () {
        Route::get('/sites/refresh', 'SitesBackendController@refreshList')
            ->name('admin.sites.refresh');

        $methods = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
        Route::resource('sites', 'SitesController',
            ['names' => 'admin.sites',
                'parameters' => ['sites' => 'id']])
            ->only($methods)
            ->names('admin.sites');
    });

    Route::group(['prefix' => 'settings', 'namespace' => 'Admin\Settings', 'as' => 'settings.'], function () {
        $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
        Route::resource('users', 'UsersController')
            ->only($methods);
        $methods = ['index'];
        Route::resource('system', 'SystemController')
            ->only($methods);
    });

    Route::group(['namespace' => 'Admin\Servers'], function () {
        $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
        Route::resource('servers', 'ServersController')
            ->only($methods);
    });

    Route::group(['namespace' => 'Admin\Support'], function () {
        Route::get('/documentation', 'DocumentationController@getIndex')
            ->name('documenation.index');
    });

    Route::group(['prefix' => 'network', 'namespace' => 'Admin\Network'], function () {
        Route::get('/switches', 'SwitchesController@getIndex')
            ->name('network.switches.index');
    });

    Route::group(['prefix' => 'news','namespace' => 'Admin\News'], function () {
        Route::get('/', 'NewsController@getIndex')
            ->name('admin.news.index');
    });

    Route::group(['prefix' => 'contacts', 'namespace' => 'Admin\Contacts'], function () {
        Route::get('/', 'ContactsController@getIndex')
            ->name('contacts.index');
    });
});