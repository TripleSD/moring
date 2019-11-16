@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class="m-0 text-dark">Сайты</h1>
                </div>

                <div class="col-sm-10">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Список сайтов</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Список сайтов</h3>
                                <div class="card-tools">
                                    <a href="{{route('admin.sites.create')}}"
                                       class="btn btn-sm bg-gradient-success" title="Добавление нового сайта">
                                        <i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Web server</th>
                                        <th>PHP Ver.</th>
                                        <th>Moring</th>
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
                                            <td class="site-id">{{($sites->currentPage() - 1) * $sites->perPage() + $loop->iteration}}</td>
                                            <td>
                                                {{$site->url}}
                                                @if ($site->https === 1)
                                                    <i class="fa fa-lock fa-1" data-toggle="tooltip"
                                                       data-placement="right" title="SSL cetificate OK"></i>
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
                                                @if($site->moring_file != '')
                                                    <span class="badge badge-success">
                                                        <i class="fa fa-wifi"></i>
                                                    </span>
                                                @else
                                                    <span class="badge badge-light">
                                                        <i class="fa fa-wifi"></i>
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
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                @if ($sites->lastPage() >= $sites->currentPage() && $sites->lastPage() > 1)
                    <div class="card">
                        <div class="card-body">
                            {{$sites->links()}}
                            <a href="{{route('admin.sites.index', ['view' => 'all'])}}" class="btn btn-primary">View
                                all</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
