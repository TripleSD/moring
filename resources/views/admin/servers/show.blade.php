@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $server->description }} ({{long2ip($server->addr)}})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Мониторинг</li>
                        <li class="breadcrumb-item"><a href="{{route('servers.index')}}">Серверы</a></li>
                        <li class="breadcrumb-item active">Карточка сервера</li>
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
                            <h3 class="card-title">Карточка сервера</h3>
                            <span class="float-right">
                                <a href="{{route('servers.index')}}"
                                   class="btn btn-sm bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i></a>
                                <a href="{{route('servers.edit',$server->id)}}"
                                   class="btn btn-sm bg-gradient-warning" title="Редактирование пользователя">
                                    <i class="fa fa-edit"></i></a>
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-6">
                                <dl>
                                    <dt> ID сервера:</dt>
                                    <dd>{{ $server->id }}</dd>
                                    <dt> IP адрес сервера:</dt>
                                    <dd>{{ long2ip($server->addr) }}</dd>
                                    <dt> Краткое описание:</dt>
                                    <dd>{{ $server->description }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
