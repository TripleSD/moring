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

Route::get('lang/{locale}', 'LocalizationController@index')->name('setLocale');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::any('/logout', 'Auth\LoginController@logout')->name('auth.logout');

        //  Sites management
        Route::group(
            ['prefix' => 'admin', 'namespace' => 'Admin\Sites'],
            function () {
                Route::get('/sites/refresh', 'SitesBackendController@refreshList')
                    ->name('admin.sites.refresh');

                $methods = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
                Route::resource(
                    'sites',
                    'SitesController',
                    [
                        'names' => 'admin.sites',
                        'parameters' => ['sites' => 'id'],
                    ]
                )
                    ->only($methods)
                    ->names('admin.sites');
            }
        );

        //Simple route for refreshing data of one site
        Route::get('/admin/sites/{id}/refresh/', 'Admin\Sites\SitesController@refresh')->where(
            'id',
            '[0-9]+'
        )->name(
            'admin.site.refresh'
        );

        //Simple switch on/of one site
        Route::get('/admin/sites/{id}/{on}/', 'Admin\Sites\SitesController@switchOnOff')->where(
            ['id' => '[0-9]+', 'on' => '[0-9]+']
        )->name('admin.site.switch');

        Route::group(
            ['prefix' => 'settings', 'namespace' => 'Admin\Settings', 'as' => 'settings.'],
            function () {
                $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
                Route::resource('users', 'UsersController')
                    ->only($methods);
                $methods = ['index'];
                Route::resource('system', 'SystemController')
                    ->only($methods);
            }
        );

        Route::group(
            ['prefix' => 'settings/bridge', 'namespace' => 'Admin\Settings'],
            function () {
                Route::get('/', 'BridgeController@getIndex')
                    ->name('settings.bridge.index');
                Route::get('/update', 'BridgeController@updateInfo')
                    ->name('settings.bridge.update');
            }
        );

        Route::group(
            ['prefix' => 'settings/integrations', 'namespace' => 'Admin\Settings\Integrations'],
            function () {
                Route::get('/', 'TelegramIntegrationsController@index')
                    ->name('settings.integrations.telegram.index');
                Route::post('/', 'TelegramIntegrationsController@update')
                    ->name('settings.integrations.telegram.update');
            }
        );

        Route::group(
            ['prefix' => 'backups', 'namespace' => 'Admin\Backups', 'as' => 'backups.'],
            function () {
                $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
                Route::resource('ftp', 'BackupFtpController')->only($methods);
                Route::group(
                    ['prefix' => 'yandex', 'as' => 'yandex.'],
                    function () {
                        $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
                        Route::get('/tasks/resolve', 'YandexTaskController@resolve')
                            ->name('backups.yandex.tasks.resolve');
                        Route::resource('tasks', 'YandexTaskController',
                                        ['parameters' => ['tasks' => 'id']])->only($methods);
                        Route::get('/connectors/resolve', 'YandexConnectorController@resolve')
                            ->name('backups.yandex.connectors.resolve');
                        Route::resource('connectors', 'YandexConnectorController',
                                        ['parameters' => ['connectors' => 'id']])->only($methods);
                        Route::get('/connectors/{id}/clean', 'YandexConnectorController@clean')
                            ->name('backups.yandex.connectors.clean');
                        Route::get('/connectors/{id}/refresh', 'YandexConnectorController@refresh')
                            ->name('backups.yandex.connectors.refresh');
                        Route::get('/buckets/resolve', 'YandexBucketsController@resolve')
                            ->name('backups.yandex.buckets.resolve');
                        Route::resource('buckets', 'YandexBucketsController',
                                        ['parameters' => ['buckets' => 'id']])->only($methods);
                    }
                );
            }
        );

        Route::group(
            ['namespace' => 'Admin\Servers'],
            function () {
                $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
                Route::resource('servers', 'ServersController')
                    ->only($methods);
            }
        );

        Route::group(
            ['prefix' => 'documentation', 'namespace' => 'Admin\Support'],
            function () {
                Route::get('/', 'DocumentationController@getIndex')
                    ->name('documenation.index');
                Route::get('/changelog', 'DocumentationController@getChangeLog')
                    ->name('documenation.changelog');
                Route::get('/about', 'DocumentationController@about')
                    ->name('documenation.about');
            }
        );

        Route::group(
            ['prefix' => 'network', 'namespace' => 'Admin\Network', 'as' => 'network.'],
            function () {
                $methods = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
                Route::resource('devices', 'NetworkDevicesController')
                    ->only($methods);
            }
        );

        Route::group(
            ['prefix' => 'news', 'namespace' => 'Admin\News'],
            function () {
                Route::get('/', 'NewsController@getIndex')
                    ->name('admin.news.index');
            }
        );

        Route::group(
            ['prefix' => 'contacts', 'namespace' => 'Admin\Contacts'],
            function () {
                Route::get('/', 'ContactsController@getIndex')
                    ->name('contacts.index');
            }
        );

        // Item positions storage
        Route::group(
            ['prefix' => '/admin/panel/items/', 'namespace' => 'Admin\Sites'],
            function () {
                Route::post('sort', 'ItemsSortController')->name('sort');
            }
        );
    }
);
