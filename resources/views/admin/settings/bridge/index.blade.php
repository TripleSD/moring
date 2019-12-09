@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--                    <h1 class="m-0 text-dark">{{ $server->description }} ({{long2ip($server->addr)}})</h1>--}}
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
                            </span>
                        </div>

                        <div class="card-body">
                            <dt>Последнее обновление PHP версий:</dt>
                            @if($bridgeStatistics['bridge_php_versions'] != null)
                                {{ $bridgeStatistics['bridge_php_versions'] }}
                            @else
                                <span class="text-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Обновление никогда не выполнялось
                                </span>
                            @endif

                            <dt>Последнее обновление Moring версий:</dt>
                            @if($bridgeStatistics['bridge_moring_versions'] != null)
                                {{ $bridgeStatistics['bridge_moring_versions'] }}
                            @else
                                <span class="text-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Обновление никогда не выполнялось
                                </span>
                            @endif

                            <div class="mt-3">
                                <a class="btn btn-success btn-sm" href="{{ route('settings.bridge.update') }}">Обновить данные</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
