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
                                        <th>ID</th>
                                        <th>URL</th>
                                        <th>Web server</th>
                                        <th>PHP Ver.</th>
                                        <th>Moring</th>
                                        <th>HTTP Code</th>
                                        <th>Info</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($sites as $site)
                                        @php
                                            /** @var \App\Models\ChecksSites $site */
                                        @endphp
                                        <tr class="table-row">
                                            <td class="site-id">{{ $site->id }}</td>
                                            <td>{{ $site->url }}</td>
                                            <td>{{ $site->server_info }}</td>
                                            <td>{{ $site->php_version}}</td>
                                            <td>
                                                @if($site->moring_file != '')
                                                    <span class="badge badge-success">
                                                        <i class="fa fa-wifi"></i>
                                                    </span>
                                                @else
                                                    <span class="badge badge-light">
                                                        <i class="fa fa-wifi"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if($site->http_code == 200)
                                                    <span class="badge badge-success">
                                                        {{ $site->http_code }}
                                                    </span>
                                                @elseif($site->http_code == '')
                                                    <span class="badge badge-light">
                                                        <i class="fa fa-exclamation-triangle"></i>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ $site->http_code }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>Info...</td>
                                            <td>
                                                <a href="{{route('admin.sites.show', $site->id)}}" class="btn btn-sm bg-gradient-warning"><i class="fa fa-eye"></i></a>
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
            </div>
        </div>
    </div>
@endsection
