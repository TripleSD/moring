@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fas fa-globe"></i> Сайты</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Мониторинг</li>
                        <li class="breadcrumb-item active">Сайты</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список сайтов</h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{route('admin.sites.create')}}"
                                       class="btn btn-sm btn-success" title="Создание нового сервера">
                                        <i class="fa fa-plus-square"></i></a>
                                    <a href="{{route('admin.sites.refresh')}}"
                                       class="btn btn-sm btn-primary" title="Обновить список">
                                        <i class="fas fa-sync-alt"></i></a>
                                </div>
                                <div class="btn-group">
                                    @if($sites instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        <a href="{{route('admin.sites.index', ['view' => 'all'])}}"
                                           class="btn btn-sm btn-outline-primary" title="Показать весь список">
                                            <i class="fa fa-list" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{route('admin.sites.index')}}"
                                           class="btn btn-sm btn-primary" title="Показать весь список">
                                            <i class="fa fa-list" aria-hidden="true"></i></a>
                                    @endif

                                    @if(request()->view == 10)
                                        <a href="{{ route('admin.sites.index', ['view' => '10']) }}"
                                           class="btn btn-sm btn-primary">
                                            10</a>
                                    @elseif(request()->view == null)
                                        <a href="{{ route('admin.sites.index', ['view' => '10']) }}"
                                           class="btn btn-sm btn-primary">
                                            10</a>
                                    @else
                                        <a href="{{ route('admin.sites.index', ['view' => '10']) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            10</a>
                                    @endif
                                    @if(request()->view == 25)
                                        <a href="{{ route('admin.sites.index', ['view' => '25']) }}"
                                           class="btn btn-sm btn-primary">
                                            25</a>
                                    @else
                                        <a href="{{ route('admin.sites.index', ['view' => '25']) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            25</a>
                                    @endif
                                    @if(request()->view == 50)
                                        <a href="{{ route('admin.sites.index', ['view' => '50']) }}"
                                           class="btn btn-sm btn-primary">
                                            50</a>
                                    @else
                                        <a href="{{ route('admin.sites.index', ['view' => '50']) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            50</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <div class="row">
                                <a class="btn btn-app" href="{{route('admin.sites.index', 'allSites')}}">
                                    <span class="badge bg-success">{{ count($counts['allSites']) }}</span>
                                    <i class="fas fa-globe text-info"></i> Активные
                                </a>
                                <a class="btn btn-app" href="{{route('admin.sites.index', 'deprecatedPHPVersion')}}">
                                    @if(count($counts['deprecatedPHPVersion']) > 0)
                                        <span
                                            class="badge bg-danger">{{ count($counts['deprecatedPHPVersion'])  }}</span>
                                    @else
                                        <span
                                            class="badge bg-success">{{ count($counts['deprecatedPHPVersion'])  }}</span>
                                    @endif
                                    <i class="fas fa-archive text-danger"></i> Старое ПО
                                </a>
                                <a class="btn btn-app" href="{{route('admin.sites.index', 'bridgeErrors')}}">
                                    @if(count($counts['bridgeErrors']) > 0)
                                        <span class="badge bg-danger">{{ count($counts['bridgeErrors']) }}</span>
                                    @else
                                        <span class="badge bg-success">{{ count($counts['bridgeErrors']) }}</span>
                                    @endif
                                    <i class="fa fa-exclamation-triangle text-danger"></i> API
                                </a>
                                <a class="btn btn-app" href="{{route('admin.sites.index', 'softwareErrorsSites')}}">
                                    @if(count($counts['softwareErrorsSites']) > 0)
                                        <span class="badge bg-danger">{{ count($counts['softwareErrorsSites']) }}</span>
                                    @else
                                        <span
                                            class="badge bg-success">{{ count($counts['softwareErrorsSites']) }}</span>
                                    @endif
                                    <i class="fa fa-exclamation-triangle text-warning"></i> Ошибки
                                </a>
                                <a class="btn btn-app">
                                    <span class="badge bg-success">{{ count($counts['sslSuccessSites']) }}</span>
                                    <i class="fa fa-lock fa-1 text-success"></i> SSL проверен
                                </a>
                                <a class="btn btn-app" href="{{route('admin.sites.index', 'sslExpirationsDaysSites')}}">
                                    @if(count($counts['sslExpirationsDaysSites']) > 0)
                                        <span
                                            class="badge bg-danger">{{ count($counts['sslExpirationsDaysSites']) }}</span>
                                    @else
                                        <span
                                            class="badge bg-success">{{ count($counts['sslExpirationsDaysSites']) }}</span>
                                    @endif
                                    <i class="fa fa-lock fa-1 text-warning"></i> Истек серт.
                                </a>
                                <a class="btn btn-app" href="{{route('admin.sites.index', 'sslErrorsSites')}}">
                                    @if(count($counts['sslErrorsSites']) > 0)
                                        <span class="badge bg-danger">{{ count($counts['sslErrorsSites']) }}</span>
                                    @else
                                        <span class="badge bg-success">{{ count($counts['sslErrorsSites']) }}</span>
                                    @endif
                                    <i class="fa fa-lock fa-1 text-gray"></i> Ошибки SSL
                                </a>
                                <a class="btn btn-app" href="{{route('admin.sites.index', 'disabledSites')}}">
                                    @if(count($counts['disabledSites']) > 0)
                                        <span class="badge bg-danger">{{ count($counts['disabledSites']) }}</span>
                                    @else
                                        <span class="badge bg-success">{{ count($counts['disabledSites']) }}</span>
                                    @endif
                                    <i class="far fa-hourglass text-gray"></i> Отключено
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Веб окружение</th>
                                    <th>Интерпретатор</th>
                                    <th>Проверки</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sites as $site)
                                    @php
                                        /** @var \App\Models\ChecksSites $site */
                                    @endphp
                                    @if($site->enabled == 1)
                                        <tr class="table-row">
                                    @else
                                        <tr class="table-row" style="background-color: #a9a9a9;">
                                            @endif
                                            <td>
                                                <div class="small">
                                                    <div class="row">
                                                        @if($site->enabled === 1)
                                                            <div class="vl pt-1 text-success"></div>
                                                        @else
                                                            <div class="vl pt-1 text-gray"></div>
                                                        @endif

                                                        <div class="col">
                                                            <span class="text text-bold text-sm">{{$site->url}}</span>
                                                            @if($site->enabled === 1)
                                                                @if($site->https === 1)
                                                                    @if($site->checksList->check_ssl == 1)
                                                                        @isset($site->getSslCertification->getSSL->expiration_days)
                                                                            @if ($site->getSslCertification->getSSL->expiration_days >= 10)
                                                                                <span class="badge badge-success">
                                                                                <i class="fa fa-lock fa-1x"
                                                                                   title="Действующий SSL сертификат"></i>
                                                                                <span class="text-dark">
                                                                                    {{ $site->getSslCertification->getSSL->expiration_days }}
                                                                                </span>
                                                                            </span>
                                                                            @elseif($site->getSslCertification->getSSL->expiration_days >= 5)
                                                                                <span class="badge badge-warning">
                                                                                <i class="fa fa-lock fa-1x"
                                                                                   title="Действующий SSL сертификат"></i>
                                                                                <span class="text-dark">
                                                                                        {{ $site->getSslCertification->getSSL->expiration_days }}
                                                                                </span>
                                                                            </span>
                                                                            @elseif($site->getSslCertification->getSSL->expiration_days >= 1)
                                                                                <span class="badge badge-danger">
                                                                                <i class="fa fa-lock fa-1x"
                                                                                   title="Действующий SSL сертификат"></i>
                                                                                <span class="text-dark">
                                                                                        {{ $site->getSslCertification->getSSL->expiration_days }}
                                                                                </span>
                                                                            </span>
                                                                            @else
                                                                                <span class="badge badge-secondary">
                                                                                <i class="fa fa-lock fa-1x"
                                                                                   title="SSL сертификат истек"></i>
                                                                                <span class="text-dark">
                                                                                        {{ $site->getSslCertification->getSSL->expiration_days }}
                                                                                </span>
                                                                            </span>
                                                                            @endif
                                                                        @else
                                                                            <i class="fa fa-lock fa-1 text-gray"
                                                                               title="SSL сертификат не установлен / Не включена SSL проверка"></i>
                                                                        @endif
                                                                    @else
                                                                        <i class="fa fa-lock fa-1 text-gray"
                                                                           title="SSL сертификат не установлен / Не включена SSL проверка"></i>
                                                                    @endif
                                                                @endif
                                                                <a href="https://{{$site->url}}" target="_blank">
                                                                    <i class="fas fa-globe"></i>
                                                                </a>
                                                                <div class="text-muted small">
                                                                    Check URL:
                                                                    @if($site->https === 1)
                                                                        @if($site->checksList->use_file === 1)
                                                                            https://{{ $site->url }}
                                                                            /{{ $site->file_url}}
                                                                        @else
                                                                            https://{{ $site->url }}
                                                                        @endif
                                                                    @else
                                                                        @if($site->checksList->use_file === 1)
                                                                            http://{{ $site->url }}/{{ $site->file_url}}
                                                                        @else
                                                                            http://{{ $site->url }}
                                                                        @endif
                                                                    @endif
                                                                </div>

                                                                @isset($site->getSslCertification->getSSL->expiration_days)
                                                                    <div class="text-gray">
                                                                        <details>
                                                                            <summary>Издатель SSL сертификата</summary>
                                                                            {{ $site->getSslCertification->getSSL->issuer }}
                                                                        </details>
                                                                    </div>
                                                                    <div class="text-gray">
                                                                        <i class="fas fa-flag-checkered"></i>
                                                                        {{ $site->getSslCertification->getSSL->updated_at }}
                                                                    </div>
                                                                @else
                                                                    <div>
                                                                        <br/><br/>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    @if($site->enabled === 1)
                                                        <div>
                                                            @empty($site->getWebServer->web_server)
                                                                <span class="text-warning"
                                                                      title="Не был получен ответ сервера об установленной версии">
                                                                        <i class="fa fa-exclamation-triangle"></i>
                                                                </span>
                                                            @else
                                                                @if(preg_match('/Nginx|nginx/', $site->getWebServer->web_server))
                                                                    <div class="badge badge-success">
                                                                        Nginx
                                                                    </div>
                                                                    <div>
                                                                        {{$site->getWebServer->web_server}}
                                                                    </div>
                                                                @elseif(preg_match('/Apache|apache/', $site->getWebServer->web_server))
                                                                    <div class="badge badge-success">
                                                                        Apache
                                                                    </div>
                                                                    <div>
                                                                        {{$site->getWebServer->web_server}}
                                                                    </div>

                                                                @elseif(preg_match('/IIS|iis/', $site->getWebServer->web_server))
                                                                    <div class="badge badge-success">
                                                                        IIS
                                                                    </div>
                                                                    <div class="text-break">
                                                                        {{$site->getWebServer->web_server}}
                                                                    </div>
                                                                @else
                                                                    <div class="badge badge-dark">
                                                                        Unknown
                                                                    </div>
                                                                    <div>
                                                                        {{$site->getWebServer->web_server}}
                                                                    </div>
                                                                @endif
                                                            @endempty
                                                        </div>
                                                        <div>
                                                            <br>
                                                        </div>
                                                        <div class="text-gray">
                                                            <i class="fas fa-flag-checkered"></i>
                                                            {{optional($site->getWebServer)->updated_at}}
                                                        </div>
                                                    @else
                                                        <span class="text-gray"
                                                              title="Сайт отключен">
                                                                <i class="far fa-hourglass"></i>
                                                            </span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    @if($site->enabled === 1)
                                                        @empty(!$site->getPhpVersion)
                                                            @if(empty($bridgePhpVersion))
                                                                @if($site->getPhpVersion->version != 0)
                                                                    <span class="text-gray">
                                                                        {{ $site->getPhpVersion->version }}
                                                                    </span>
                                                                    <span class="text-danger"
                                                                          title="Отсутствуют данные от бриджа об актуальной версии PHP в данной ветке">
                                                                            <i class="fa fa-exclamation-triangle"></i>
                                                                    </span>
                                                                @else
                                                                    <i class="far fa-frown"
                                                                       title="Не был получен ответ сервера об установленной версии"></i>
                                                                    Unknown
                                                                @endif
                                                            @else
                                                                @if($site->getPhpVersion->version != 0)
                                                                    <div class="badge badge-primary">
                                                                        PHP
                                                                    </div>
                                                                    <div>
                                                                        Version:
                                                                        @if($bridgePhpVersion->contains('version',$site->getPhpVersion->version))
                                                                            @foreach($bridgePhpVersion as $version)
                                                                                @if($version->branch == $site->getPhpVersion->branch)
                                                                                    @if(version_compare($site->getPhpVersion->version, $version->version) < 0)
                                                                                        @php
                                                                                            $deprecatedVersion = true;
                                                                                        @endphp
                                                                                        @break
                                                                                    @elseif(version_compare($site->getPhpVersion->version, $version->version) == 0)
                                                                                        @if($version->deprecated_status == '1')
                                                                                            @php
                                                                                                $deprecatedVersion = true;
                                                                                            @endphp
                                                                                            @break
                                                                                        @else
                                                                                            @php
                                                                                                $deprecatedVersion = false;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @else
                                                                                        @php
                                                                                            $deprecatedVersion = false;
                                                                                        @endphp
                                                                                        @continue
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach

                                                                            @if($deprecatedVersion == false)
                                                                                <span class="text-success"
                                                                                      title="Установлена самая последняя версия в ветке">
                                                                                    {{ $site->getPhpVersion->version }}
                                                                            </span>
                                                                            @endif

                                                                            @if($deprecatedVersion == true)
                                                                                <span class="text-danger"
                                                                                      title="Необходимо установить более новую версию">
                                                                                    {{ $site->getPhpVersion->version }}
                                                                                  <i class="fas fa-archive"></i>
                                                                            </span>
                                                                            @endif
                                                                        @else
                                                                            <span class="text-gray">
                                                                            {{ $site->getPhpVersion->version }}
                                                                        </span>
                                                                            <span class="text-danger"
                                                                                  title="Отсутствуют данные от бриджа об актуальной версии PHP в данной ветке">
                                                                                <i class="fa fa-exclamation-triangle"></i>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <br/>
                                                                    </div>
                                                                @else
                                                                    <div>
                                                                        <i class="far fa-question-circle"
                                                                           title=" Не был получен ответ сервера об установленной версии"></i>
                                                                        Unknown
                                                                    </div>
                                                                    <div>
                                                                        <br/>
                                                                        <br/>
                                                                    </div>
                                                                @endif
                                                            @endif

                                                            <div class="text-gray">
                                                                <i class="fas fa-flag-checkered"></i>
                                                                {{optional($site->getPhpVersion)->updated_at}}
                                                            </div>
                                                        @endempty
                                                    @else
                                                        <span class="text-gray"
                                                              title="Сайт отключен">
                                                                <i class="far fa-hourglass"></i>
                                                            </span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    @if($site->enabled === 1)
                                                        @empty(!$site->file_url)
                                                            <span class="text-success"
                                                                  title="Путь до Moring файла указан">
                                                                <i class="fa fa-link"></i>
                                                            </span>
                                                        @else
                                                            <span class="text-gray"
                                                                  title="Путь до moring файла не указан">
                                                                <i class="fa fa-link"></i>
                                                            </span>
                                                        @endempty

                                                        @if($site->checksList->http_code == 1)
                                                            <span class="text-success"
                                                                  title="Мониторинг HTTP кодов включен">
                                                                <i class="fas fa-check-square"></i>
                                                            </span>
                                                        @else
                                                            <span class="text-warning"
                                                                  title="Мониторинг HTTP кодов отключен">
                                                                <i class="fas fa-square"></i>
                                                            </span>
                                                        @endif

                                                        @if($site->checksList->use_file == 1)
                                                            <span class="text-success"
                                                                  title="Мониторинг через Moring файл включен">
                                                                <i class="fas fa-check-square"></i>
                                                            </span>
                                                        @else
                                                            <span class="text-gray"
                                                                  title="Мониторинг через Moring файл отключен">
                                                                <i class="fas fa-square"></i>
                                                            </span>
                                                        @endif

                                                        @if($site->checksList->check_php == 1)
                                                            <span class="text-success"
                                                                  title="Мониторинг PHP версии включен">
                                                                <i class="fas fa-check-square"></i>
                                                            </span>
                                                        @else
                                                            <span class="text-warning"
                                                                  title="Мониторинг PHP версии отключен">
                                                                <i class="fas fa-square"></i>
                                                            </span>
                                                        @endif

                                                        @if($site->checksList->check_ssl == 1)
                                                            <span class="text-success"
                                                                  title="Мониторинг SSL сертификата включен">
                                                                <i class="fas fa-check-square"></i>
                                                            </span>
                                                        @else
                                                            <span class="text-warning"
                                                                  title="Мониторинг SSL сертификата отключен">
                                                                <i class="fas fa-square"></i>
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray"
                                                              title="Сайт отключен">
                                                            <i class="far fa-hourglass"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    @if($site->enabled === 1)
                                                        <div>
                                                            @isset($site->getHttpCode)
                                                                @if($site->getHttpCode->http_code == 200)
                                                                    <span class="badge badge-success"
                                                                          title="Сайт полностью рабочий">
                                                                {{ $site->getHttpCode->http_code }}
                                                                </span>
                                                                @elseif($site->getHttpCode->http_code == 301)
                                                                    <span class="badge badge-warning"
                                                                          title="На сайте установлен редирект">
                                                                {{ $site->getHttpCode->http_code }}
                                                                </span>
                                                                @elseif($site->getHttpCode->http_code == 302)
                                                                    <span class="badge badge-warning"
                                                                          title="На сайте установлен редирект">
                                                                {{ $site->getHttpCode->http_code }}
                                                                </span>
                                                                @else
                                                                    <span class="text-warning"
                                                                          title="Неопознанный код ответа">
                                                                    <i class="fa fa-exclamation-triangle"></i>
                                                                </span>
                                                                @endif
                                                            @endif

                                                            @empty($site->ip_address)
                                                                <i class="fas fa-map-marker-alt"></i>
                                                                <i class="far fa-frown"
                                                                   title="Не удалось определить IP адрес"></i>
                                                                Unknown
                                                            @else
                                                                <i class="fas fa-map-marker-alt"></i>
                                                                {{ $site->ip_address }}
                                                            @endempty
                                                        </div>
                                                        <div>
                                                            <br/><br/>
                                                        </div>
                                                        <div class="text-gray">
                                                            @empty(!$site->getHttpCode)
                                                                <i class="fas fa-flag-checkered"></i>
                                                                {{ optional($site->getHttpCode)->updated_at }}
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div>
                                                        <span class="text-gray" title="Сайт отключен">
                                                            <i class="far fa-hourglass"></i>
                                                        </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    <div class="btn-group">
                                                        <a href="{{route('admin.sites.show',$site->id)}}"
                                                           class="btn btn-xs bg-gradient-info"
                                                           title="Просмотр сайта">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{route('admin.sites.edit', $site->id)}}"
                                                           class="btn btn-xs bg-gradient-warning"
                                                           title="Редактирование сайта">
                                                            <i class="fa fa-edit"></i></a>
                                                        @if($site->enabled == 1)
                                                            <a href="{{route('admin.site.refresh', $site->id)}}"
                                                               class="btn btn-xs bg-gradient-green"
                                                               title="Обновить данные сайта">
                                                                <i class="fas fa-sync-alt"></i></a>
                                                        @else
                                                            <a class="btn btn-xs bg-gradient-gray"
                                                               title="Обновить данные сайта">
                                                                <i class="fas fa-sync-alt"></i></a>
                                                        @endif
                                                    </div>
                                                    <div class="btn-group">
                                                        @if($site->enabled === 1)
                                                            <a href="{{route('admin.site.switch', [$site->id, 0])}}"
                                                               class="btn btn-xs btn-warning">
                                                                <i class="fa fa-pause"></i></a>
                                                        @else
                                                            <a href="{{route('admin.site.switch', [$site->id, 1])}}"
                                                               class="btn btn-xs btn-success">
                                                                <i class="fa fa-play"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if($sites instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <ul class="pagination pagination-xs">
                    @if ($sites->lastPage() >= $sites->currentPage() && $sites->lastPage() > 1)
                        {{ $sites->links('vendor.pagination.bootstrap-4') }}
                    @endif
                </ul>
            @endif
        </div>
    </div>
@endsection
