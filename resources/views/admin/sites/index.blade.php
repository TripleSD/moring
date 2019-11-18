@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Сайты</h1>
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
                                       class="btn btn-sm btn-info" title="Создание нового сервера">
                                        <i class="fa fa-plus-square"></i></a>
                                    @if($sites instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        <a href="{{route('admin.sites.index', ['view' => 'all'])}}"
                                           class="btn btn-sm btn-outline-success" title="Показать весь список">
                                            <i class="fa fa-list" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{route('admin.sites.index')}}"
                                           class="btn btn-sm btn-success" title="Показать весь список">
                                            <i class="fa fa-list" aria-hidden="true"></i></a>
                                    @endif
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-success">
                                        25</a>
                                    <a href="#" class="btn btn-sm btn-success">
                                        50</a>
                                    <a href="#" class="btn btn-sm btn-success">
                                        100</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Статус</th>
                                    <th>Веб сервер</th>
                                    <th>Версия PHP</th>
                                    <th>Moring файл</th>
                                    <th>Проверки</th>
                                    <th>HTTP Code</th>
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
                                        <tr class="table-row" bgcolor="#d3d3d3">
                                            @endif
                                            <td>
                                                {{$site->url}}
                                                @if ($site->https === 1)
                                                    <i class="fa fa-lock fa-1" title="SSL cetificate OK"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($site->enabled === 1)
                                                    <span class="badge badge-success" title="Мониторинг включен">
                                                    E
                                                </span>
                                                    <a href="#" class="btn btn-sm"><i class="fa fa-pause"></i></a>
                                                @else
                                                    <span class="badge badge-warning" title="Мониторинг отключен">
                                                    D
                                                </span>
                                                    <a href="" class="btn btn-sm"><i class="fa fa-play"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($site->getWebServer->web_server))
                                                    {{$site->getWebServer->web_server}}
                                                @endif
                                            </td>
                                            <td>
                                                @empty(!$site->getPhpVersion)
                                                    <div>
                                                        @if($bridgePhpVersion->isEmpty())
                                                            @if($site->getPhpVersion->version != 0)
                                                                <span class="text-gray">
                                                            {{ $site->getPhpVersion->version }}
                                                        </span>
                                                                <span class="text-danger"
                                                                      title="Отсутствуют данных бриджа об актуальной версии PHP">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                        </span>
                                                            @else
                                                                <span class="text-warning"
                                                                      title="Не был получен ответ сервера об установленной версии">
                                                                <i class="fa fa-exclamation-triangle"></i>
                                                        </span>
                                                            @endif
                                                        @else
                                                            @foreach($bridgePhpVersion as $versions)
                                                                @if($site->getPhpVersion->version != 0)
                                                                    @if($versions->branch == $site->getPhpVersion->branch)

                                                                        @if(version_compare($site->getPhpVersion->version, $versions->version) >= 0)
                                                                            <span class="text-success"
                                                                                  title="Установлена самая последняя версия {{$versions->version}}">
                                                                    {{ $site->getPhpVersion->version }}
                                                                    </span>
                                                                        @else
                                                                            <span class="text-danger"
                                                                                  title="Необходимо установить актуальную версию {{$versions->version}}">
                                                                            {{ $site->getPhpVersion->version }}
                                                                            <i class="fas fa-bug"></i>
                                                                    </span>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <span class="text-warning"
                                                                          title="Не был получен ответ сервера об установленной версии">
                                                                <i class="fa fa-exclamation-triangle"></i>
                                                            </span>
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @else
                                                            <span class="text-gray"
                                                                  title="Версия PHP не определена. Запрос к серверу не производился.">
                                                    <i class="fa fa-exclamation-triangle"></i>
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="small">
                                                        {{optional($site->getPhpVersion)->updated_at}}
                                                    </div>
                                            </td>
                                            <td>
                                                @empty(!$site->file_url)
                                                    <span class="text-success" title="Путь до Moring файла указан">
                                                        <i class="fa fa-link"></i>
                                                    </span>
                                                @else
                                                    <span class="text-gray" title="Путь до moring файла не указан">
                                                        <i class="fa fa-link"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="small">
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
                                                              title="Мониторинг PHP версии включен">
                                                        <i class="fas fa-check-square"></i>
                                                    </span>
                                                    @else
                                                        <span class="text-warning"
                                                              title="Мониторинг SSL сертификата отключен">
                                                        <i class="fas fa-square"></i>
                                                    </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
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
                                                        @else
                                                            <span class="text-gray" title="Код ответа не был получен">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                                    </span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray" title="Код ответа не был получен">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="small">
                                                    {{ optional($site->getHttpCode)->updated_at }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('admin.sites.show',$site->id)}}"
                                                       class="btn btn-xs bg-gradient-info"
                                                       title="Просмотр карточки сайта">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
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
