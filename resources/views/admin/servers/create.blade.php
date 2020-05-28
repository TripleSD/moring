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
                            <h3 class="card-title">Добавление нового сервера</h3>
                            <div class="card-tools">
                                <a href="{{route('servers.index')}}"
                                   class="btn btn-sm bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-6">
                                {{ Form::open(['url' => route('servers.store'),'method' => 'post']) }}

                                <div class="form-group">
                                    <label>IP адрес сервера
                                        <span class="text text-danger text-sm">*</span></label>
                                    {{ Form::text('addr', null , ['class' => 'form-control', 'required','placeholder' => '127.0.0.1']) }}
                                </div>

                                <div class="form-group">
                                    <label>Краткое описание</label>
                                    {{ Form::text('description', null , ['class' => 'form-control', 'placeholder' => 'Тестовый сервер']) }}
                                </div>

                                <div class="form-group">
                                    <label>API Token</label>
                                    {{ Form::text('api_token', $token , ['class' => 'form-control', 'required', 'disabled']) }}
                                    {{ Form::text('api_token', $token , ['class' => 'form-control', 'required', 'hidden']) }}
                                </div>

                                <button type="submit" class="btn btn-sm bg-gradient-success">Добавить</button>
                                {{ Form::close() }}
                                <div class="text text-danger text-xs float-right">* (обязательный параметр)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
