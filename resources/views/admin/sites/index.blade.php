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
                                    <th>Status</th>
                                    <th>Web server</th>
                                    <th>PHP Ver.</th>
                                    <th>Moring</th>
                                    <th>Checks</th>
                                    <th>HTTP Code</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sites as $site)
                                    @php
                                        /** @var \App\Models\ChecksSites $site */
                                    @endphp
                                    <tr class="table-row">
                                        <td>
                                            {{$site->url}}
                                            @if ($site->https === 1)
                                                <i class="fa fa-lock fa-1" title="SSL cetificate OK"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($site->active === 1)
                                                <span class="badge badge-success">
                                                        <i class="fa fa-play"></i>
                                                    </span>
                                            @else
                                                <span class="badge badge-warning">
                                                        <i class="fa fa-pause"></i>
                                                    </span>
                                            @endif
                                        </td>
                                        <td>{{ $site->server_info }}</td>
                                        <td>
                                            @if (isset($site->getPhpVersion->php_version) && $site->getPhpVersion->php_version != 0)
                                                {{ $site->getPhpVersion->php_version}}</td>
                                        @else
                                            -
                                        @endif
                                        <td>
                                            @empty(!$site->file_url)
                                                <span class="badge badge-success" title="Путь до Moring файла указан">
                                                        <i class="fa fa-link"></i>
                                                    </span>
                                            @else
                                                <span class="badge badge-light" title="Путь до moring файла не указан">
                                                        <i class="fa fa-link"></i>
                                                    </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($site->checksList->http_code == 1)
                                                <span class="text-success" title="Мониторинг HTTP кодов включен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @else
                                                <span class="text-warning" title="Мониторинг HTTP кодов отключен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @endif

                                            @if($site->checksList->use_file == 1)
                                                <span class="text-success"
                                                      title="Мониторинг через Moring файл включен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @else
                                                <span class="text-gray"
                                                      title="Мониторинг через Moring файл отключен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @endif

                                            @if($site->checksList->check_php == 1)
                                                <span class="text-success" title="Мониторинг PHP версии включен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @else
                                                <span class="text-warning" title="Мониторинг PHP версии отключен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @endif

                                            @if($site->checksList->check_ssl == 1)
                                                <span class="text-success" title="Мониторинг PHP версии включен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @else
                                                <span class="text-warning" title="Мониторинг SSL сертификата отключен">
                                                        <i class="fa fa-circle"></i>
                                                    </span>
                                            @endif


                                        </td>
                                        <td>
                                            @isset($site->getHttpCode)
                                                @if($site->getHttpCode->http_code == 200)
                                                    <span class="badge badge-success">
                                                        {{ $site->getHttpCode->http_code }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ $site->getHttpCode->http_code }}
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge badge-light">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                                    </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.sites.show', $site->id) }}"
                                               class="btn btn-sm bg-gradient-warning"><i class="fa fa-eye"></i></a>
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
