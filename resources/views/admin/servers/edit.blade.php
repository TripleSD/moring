@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Настройки</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                        <li class="breadcrumb-item">Настройки</li>
                        <li class="breadcrumb-item active"><a href="{{ route('settings.users.index') }}">
                                Пользователи</a></li>
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
                            <h3 class="card-title">Редактирование карточки пользователя</h3>
                            <span class="float-right">
                                <a href="{{route('servers.show',$server->id)}}"
                                   class="btn btn-sm bg-gradient-info" title="Вернуться">
                                                    <i class="fa fa-arrow-left"></i>
                                                </a>
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-6">
                                {{ Form::open(['url' => route('servers.update', $server->id),'method' => 'post', 'enctype' => "multipart/form-data"]) }}
                                @method('patch')

                                <div class="form-group">
                                    <label>IP адрес</label>
                                    {{ Form::text('addr', long2ip($server->addr) , ['class' => 'form-control', 'required','placeholder' => '192.168.0.1']) }}
                                </div>

                                <div class="form-group">
                                    <label>Краткое описание</label>
                                    {{ Form::text('description', $server->description, ['class' => 'form-control', 'placeholder' => 'dev сервер']) }}
                                </div>

                                <div class="form-group">
                                    <label>Включен/Не включен:</label>
                                    {{ Form::checkbox('enable', true, $server->enable) }}
                                </div>

                                <button type="submit" class="btn btn-sm bg-gradient-success">Сохранить</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
