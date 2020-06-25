@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Сайт</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Настройки</li>
                        <li class="breadcrumb-item active">Сайт</li>
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
                            <h3 class="card-title">
                                Просмотр профиля
                            </h3>
                            <span class="float-right">
                                <a href="{{route('admin.sites.index')}}"
                                   class="btn btn-sm bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i></a>
                            <a href="{{route('admin.site.refresh', $site->id)}}"
                               class="btn btn-sm bg-gradient-green"
                               title="Обновить данные сайта">
                                                        <i class="fas fa-sync-alt"></i></a>
                                <a href="{{route('admin.sites.edit', $site->id)}}"
                                   class="btn btn-sm bg-gradient-warning" title="Редактиование профиля">
                                    <i class="fa fa-user-edit"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.summary_information')</dt>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    Краткое описание:
                                    <span class="float-right">
                                        {{ $site->title }}
                                    </span>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col">
                                            IP:
                                            <span class="float-right">
                                                <i class="fas fa-map-marker-alt"></i>
                                                {{ $site->ip_address }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-gray float-right">
                                                <i class="fas fa-flag-checkered"></i>
                                                {{ $site->updated_at }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    URL:
                                    <span class="float-right">
                                        {{ $site->url }}
                                    </span>
                                </li>
                                <li class="small">
                                    Мониторинг состояния сайта:
                                    <span class="float-right">
                                        @if($site->enabled === 1)
                                            <span class="text-success">
                                                <i class="fas fa-check-square" data-toggle="tooltip"
                                                   data-placement="right" title="Monitoring is active"></i>
                                            </span>
                                        @else
                                            <span class="text-gray">
                                                <i class="fas fa-check-square" data-toggle="tooltip"
                                                   data-placement="right" title="Monitoring paused"></i>
                                            </span>
                                        @endif
                                    </span>
                                </li>
                                <li class="small">
                                    Файл мониторинга:
                                    <span class="float-right">
                                    @if(strlen($site->file_url) >= 5)
                                            {{ $site->file_url }}
                                            @if($site->checksList->use_file === 1)
                                                <span class="text-success">
                                                        <i class="fas fa-check-square" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS control is On"></i>
                                                    </span>
                                            @else
                                                <span class="text-gray">
                                                        <i class="fas fa-check-square" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS contorl is Off"></i>
                                                    </span>
                                            @endif
                                        @else
                                            Не используется
                                        @endif
                                    </span>
                                </li>
                                <li class="small">
                                    Поддержка HTTPS:
                                    <span class="float-right">
                                    @if($site->https === 1)
                                            <span class="text-success">
                                                        <i class="fas fa-check-square" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS control is On"></i>
                                                    </span>
                                        @else
                                            <span class="text-gray">
                                                        <i class="fas fa-check-square" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS contorl is Off"></i>
                                        </span>
                                        @endif
                                                                            </span>
                                </li>
                                <li class="small">
                                    Контроль SSL:
                                    <span class="float-right">
                                        <i class="fas fa-globe-americas"></i> {{$site->url}}
                                        @isset($site->getSslCertification->expiration_days)
                                            @if ($site->getSslCertification->expiration_days >= 10)
                                                <i class="fa fa-lock fa-1 text-success"
                                                   title="Действующий SSL сертификат"></i>
                                            @elseif($site->getSslCertification->expiration_days >= 5)
                                                <i class="fa fa-lock fa-1 text-warning"
                                                   title="Действующий SSL сертификат"></i>
                                            @elseif($site->getSslCertification->expiration_days >= 1)
                                                <i class="fa fa-lock fa-1 text-danger"
                                                   title="Действующий SSL сертификат"></i>
                                            @else
                                                <i class="fa fa-lock fa-1 text-gray"
                                                   title="SSL сертификат истек"></i>
                                            @endif
                                            <span class="small">
                                                ({{ $site->getSslCertification->expiration_days }} дней)
                                            </span>
                                        @endif
                                        @if($site->checksList->check_ssl === 1)
                                            <span class="text-success">
                                                <i class="fas fa-check-square" data-toggle="tooltip"
                                                   data-placement="right" title="HTTPS control is On"></i>
                                                </span>
                                        @else
                                            <span class="text-gray">
                                                <i class="fas fa-check-square" data-toggle="tooltip"
                                                   data-placement="right" title="HTTPS contorl is Off"></i>
                                            </span>
                                        @endif
                                    </span>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col">
                                            SSL сертификат:
                                            <span class="float-right">
                                                @isset($site->getSslCertification->getSSL->expiration_days)
                                                    {{ $site->getSslCertification->getSSL->issuer }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-gray float-right">
                                                <i class="fas fa-flag-checkered"></i>
                                                {{ $site->getSslCertification->getSSL->updated_at }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col">
                                            HTTP ответ сервера:
                                            <span class="float-right">
                                                @if(isset($site->getHttpCode->http_code) && $site->getHttpCode->http_code == 200)
                                                    <span class="badge badge-success">
                                                        {{ $site->getHttpCode->http_code }}
                                                    </span>
                                                @elseif(isset($site->getHttpCode->http_code) && $site->getHttpCode->http_code == '')
                                                    <span class="badge badge-light">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                                    </span>
                                                @elseif (isset($site->getHttpCode->http_code) && $site->getHttpCode->http_code > 200)
                                                    <span class="badge badge-danger">
                                                        {{ $site->getHttpCode->http_code }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        -- // --
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-gray float-right">
                                                <i class="fas fa-flag-checkered"></i>
                                                {{ $site->getHttpCode->updated_at }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col">
                                            Версия web сервера:
                                            <span class="float-right">
                                                @empty($site->getWebServer->web_server)
                                                    <span class="text-warning"
                                                          title="Не был получен ответ сервера об установленной версии">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                        </span>
                                                @else
                                                    @if(preg_match('/nginx/', $site->getWebServer->web_server))
                                                        <div class="badge badge-success">
                                                                            Nginx
                                                                        </div>
                                                        {{$site->getWebServer->web_server}}
                                                    @elseif(preg_match('/Apache/', $site->getWebServer->web_server))
                                                        <div class="badge badge-success">
                                                                            Apache
                                                                        </div>
                                                        {{$site->getWebServer->web_server}}
                                                    @elseif(preg_match('/IIS/', $site->getWebServer->web_server))
                                                        <div class="badge badge-success">
                                                                            IIS
                                                                        </div>
                                                        {{$site->getWebServer->web_server}}
                                                    @else
                                                        <div class="badge badge-dark">
                                                                            Unknown
                                                                        </div>
                                                        {{$site->getWebServer->web_server}}
                                                    @endif
                                                @endempty
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-gray float-right">
                                                <i class="fas fa-flag-checkered"></i>
                                                {{ $site->getWebServer->updated_at }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col">
                                            Контроль версии PHP:
                                            <span class="float-right">
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
                                                                <span class="badge badge-primary">
                                                            PHP
                                                        </span>
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
                                                            @else
                                                                <i class="far fa-question-circle"
                                                                   title=" Не был получен ответ сервера об
                                                                установленной версии"></i>
                                                                Unknown
                                                            @endif
                                                        @endif
                                                    @endempty
                                                @else
                                                    <span class="text-gray"
                                                          title="Сайт отключен">
                                                        <i class="far fa-hourglass"></i>
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-gray float-right">
                                                <i class="fas fa-flag-checkered"></i>
                                                {{optional($site->getPhpVersion)->updated_at}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    Комментарий:
                                    <span class="float-right">
                                        {{ $site->comment }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.poll_information')</dt>
                        </div>
                        <div class="card-body">
                            <canvas id="sitePings" data-time="{{$time}}" data-ping="{{$averages}}" width="100%"
                                    height="100%">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
