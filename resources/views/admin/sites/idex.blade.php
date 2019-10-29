@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard v3</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v3</li>
                        </ol>
                    </div>
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
                                <h3 class="card-title">Responsive Hover Table</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
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
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($sites as $site)
                                        @php
                                            /** @var \App\Models\ChecksSites $site */
                                        @endphp
                                        <tr>
                                            <td>{{ $site->id }}</td>
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
