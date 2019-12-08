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
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-three-system-tab"
                                               data-toggle="pill" href="#custom-tabs-three-system" role="tab"
                                               aria-controls="custom-tabs-three-system" aria-selected="true">Система</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-bridge-tab" data-toggle="pill"
                                               href="#custom-tabs-three-bridge" role="tab"
                                               aria-controls="custom-tabs-three-bridge"
                                               aria-selected="false">Бридж</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-three-system"
                                             role="tabpanel" aria-labelledby="custom-tabs-three-system-tab">
                                            <dt> Операционная система:</dt>
                                            <dd>{{ php_uname() }}</dd>
                                            <dt> IP адрес сервера:</dt>
                                            <dd>{{ PHP_OS }}</dd>
                                            <dt> Версия PHP интерпретатора:</dt>
                                            <dd>{{ phpversion()  }}</dd>
                                            <dt>Временная зона</dt>
                                            <dd>{{env('TIMEZONE')}}</dd>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-bridge" role="tabpanel"
                                             aria-labelledby="custom-tabs-three-bridge-tab">
                                            <dt>Последнее обновление PHP версий:</dt>
                                            @if($bridgeStatistics['bridge_php_versions'] != null)
                                            @else
                                                <span class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Обновление никогда не выполнялось
                                                </span>
                                            @endif
                                            {{ $bridgeStatistics['bridge_php_versions'] }}
                                            <dt>Последнее обновление Moring версий:</dt>
                                            @if($bridgeStatistics['bridge_moring_versions'] != null)
                                                {{ $bridgeStatistics['bridge_moring_versions'] }}
                                            @else
                                                <span class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Обновление никогда не выполнялось
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
