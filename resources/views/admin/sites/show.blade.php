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
                                <a href="{{route('admin.sites.edit', $site->id)}}"
                                   class="btn btn-sm bg-gradient-warning" title="Редактиование профиля">
                                    <i class="fa fa-user-edit"></i></a>
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-6">
                                <dl>
                                    <dt> ID:</dt>
                                    <dd>{{ $site->id }}</dd>
                                    <dt> Наименование:</dt>
                                    <dd>{{ $site->title }}</dd>
                                    <dt>URL:</dt>
                                    <dd>{{ $site->url }}</dd>
                                    <dt>Мониторинг состояния сайта:</dt>
                                    @if($site->enabled === 1)
                                        <span class="badge badge-success">
                                                        <i class="fa fa-toggle-on" data-toggle="tooltip"
                                                           data-placement="right" title="Monitoring is active"></i>
                                                    </span>
                                    @else
                                        <span class="badge badge-warning">
                                                        <i class="fa fa-toggle-off" data-toggle="tooltip"
                                                           data-placement="right" title="Monitoring paused"></i>
                                        </span>
                                    @endif
                                    <dt>Файл мониторинга:</dt>
                                        @if(strlen($site->file_url) >= 5)
                                            <dd>
                                                {{ $site->file_url }}
                                                @if($site->checksList->use_file === 1)
                                                    <span class="badge badge-success">
                                                        <i class="fa fa-toggle-on" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS control is On"></i>
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        <i class="fa fa-toggle-off" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS contorl is Off"></i>
                                                    </span>
                                                @endif
                                            </dd>
                                        @else
                                            <dd>Не используется</dd>
                                    @endif
                                    <dt>Используется HTTPS:</dt>
                                    @if($site->https === 1)
                                        <span class="badge badge-success">
                                                        <i class="fa fa-toggle-on" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS control is On"></i>
                                                    </span>
                                    @else
                                        <span class="badge badge-danger">
                                                        <i class="fa fa-toggle-off" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS contorl is Off"></i>
                                        </span>
                                    @endif
                                    <dt>Контроль HTTPS:</dt>
                                    @if($site->checksList->check_https === 1)
                                        <span class="badge badge-success">
                                                        <i class="fa fa-toggle-on" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS control is On"></i>
                                                    </span>
                                    @else
                                        <span class="badge badge-danger">
                                                        <i class="fa fa-toggle-off" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS contorl is Off"></i>
                                        </span>
                                    @endif
                                    <dt>Контроль SSL:</dt>
                                    <div>
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
                                                            ({{ $site->getSslCertification->expiration_days }} дней)</span>
                                        @endif
                                    </div>
                                    @if($site->checksList->check_ssl === 1)
                                        <span class="badge badge-success">
                                                        <i class="fa fa-toggle-on" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS control is On"></i>
                                                    </span>
                                    @else
                                        <span class="badge badge-danger">
                                                        <i class="fa fa-toggle-off" data-toggle="tooltip"
                                                           data-placement="right" title="HTTPS contorl is Off"></i>
                                        </span>
                                    @endif
                                    <dt>HTTP ответ сервера:</dt>
                                    <dd>
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
                                    </dd>
                                    <dt>Версия Web сервера:</dt>
                                    <dd>
                                        @empty($site->getWebServer->web_server)
                                            <span class="text-warning"
                                                  title="Не был получен ответ сервера об установленной версии">
                                                                    <i class="fa fa-exclamation-triangle"></i>
                                                    </span>
                                            @else
                                                {{$site->getWebServer->web_server}}
                                            @endif
                                    </dd>
                                    <dt>Контроль версии PHP:</dt>
                                    <dd>
                                        @empty(!$site->getPhpVersion)
                                            <div>
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
                                                        <span class="text-warning"
                                                              title="Не был получен ответ сервера об установленной версии">
                                                                        <i class="fa fa-exclamation-triangle"></i>
                                                                </span>
                                                    @endif
                                                @else
                                                    @if($site->getPhpVersion->version != 0)
                                                        @if(in_array($site->getPhpVersion->branch,$bridgeBranchVersion))
                                                            @foreach($bridgePhpVersion as $version)
                                                                @if($version->branch == $site->getPhpVersion->branch)
                                                                    @if(version_compare($site->getPhpVersion->version, $version->version) >= 0)
                                                                        <span class="text-success"
                                                                              title="Установлена самая последняя версия {{$version->version}}">
                                                                                      {{ $site->getPhpVersion->version }}
                                                                                </span>
                                                                    @else
                                                                        <span class="text-danger"
                                                                              title="Необходимо установить актуальную версию {{$version->version}}">
                                                                                      {{ $site->getPhpVersion->version }}
                                                                            <i class="fas fa-bug"></i>
                                                                                </span>
                                                                    @endif
                                                                @endif
                                                            @endforeach
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
                                                        <span class="text-warning"
                                                              title="Не был получен ответ сервера об установленной версии">
                                                                        <i class="fa fa-exclamation-triangle"></i>
                                                                    </span>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="small">
                                                {{optional($site->getPhpVersion)->updated_at}}
                                            </div>
                                        @endempty
                                    </dd>
                                    <dt>Комментарий:</dt>
                                    <dd>{{ $site->comment }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
