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
{{--                                <a href="{{route('servers.edit',$server->id)}}"--}}
{{--                                   class="btn btn-sm bg-gradient-warning" title="Редактирование пользователя">--}}
{{--                                    <i class="fa fa-edit"></i></a>--}}
                            </span>
                        </div>


                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                         aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                           href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                           aria-selected="true">Система</a>
                                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                           href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
                                           aria-selected="false">Агент</a>
                                    </div>
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-home"
                                             role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                            <div class="col-sm-6">
                                                <dl>
                                                    <dt> ОС:</dt>
                                                    <dd>{{ php_uname() }}</dd>
                                                    <dt> IP адрес сервера:</dt>
                                                    <dd>{{ PHP_OS }}</dd>
                                                    <dt> Краткое описание:</dt>
                                                    <dd>{{ phpversion()  }}</dd>
                                                    <dd>{{ date_default_timezone_get()  }}</dd>

                                                    config/app.php<br/>
                                                    'timezone' => 'UTC',<br/>
                                                    'timezone' => 'Europe/Moscow',<br/>

                                                </dl>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                             aria-labelledby="vert-tabs-profile-tab">
                                            <div class="callout callout-info">
{{--                                                @foreach($settingsFile as $value)--}}
{{--                                                    {{$value}}<br/>--}}
{{--                                                @endforeach--}}
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
    </div>
    </div>
    </div>
@endsection
