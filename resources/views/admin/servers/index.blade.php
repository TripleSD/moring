@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Мониторинг</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Мониторинг</li>
                        <li class="breadcrumb-item active">Серверы</li>
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
                            <h3 class="card-title">Список серверов</h3>
                            <div class="card-tools">
                                <a href="{{route('servers.create')}}"
                                   class="btn btn-sm bg-gradient-success" title="Создание нового сервера">
                                    <i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Адрес</th>
                                    <th>Описание</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($servers as $server)
                                    @php
                                        /** @var \App\Models\ChecksSites $server */
                                    @endphp
                                    <tr>
                                        <td>{{ $server->id }}</td>
                                        <td>{{ long2ip($server->addr) }}</td>
                                        <td>{{ $server->description }}</td>
                                        <td>
                                            @if($server->enable == 1)
                                                <i class="fa fa-server text-success"></i>
                                            @else
                                                <i class="fa fa-server text-danger"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('servers.show',$server->id)}}"
                                               class="btn btn-sm bg-gradient-info" title="Просмотр сервера">
                                                <i class="fa fa-server"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
