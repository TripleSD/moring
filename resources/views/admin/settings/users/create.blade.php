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
                            <li class="breadcrumb-item active">Пользователи</li>
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
                                <h3 class="card-title">Добавление нового пользователя</h3>
                                <div class="card-tools">
                                    <a href="{{route('settings.users.index')}}"
                                       class="btn btn-sm bg-gradient-info" title="Вернуться">
                                        <i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-sm-6">
                                    {{ Form::open(['url' => route('settings.users.store'),'method' => 'post', 'enctype' => "multipart/form-data"]) }}

                                    <div class="form-group">
                                        <label>Имя пользователя</label>
                                        {{ Form::text('name', null , ['class' => 'form-control', 'required','placeholder' => 'Андрей Иванов']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Адрес электронной почты</label>
                                        {{ Form::email('email', null , ['class' => 'form-control', 'required', 'placeholder' => 'a.ivanov@domain.ru']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Пароль</label>
                                        {{ Form::password('password', ['class' => 'form-control','required','placeholder' => 'Пароль']) }}
                                    </div>

                                    <button type="submit" class="btn btn-sm bg-gradient-success">Добавить</button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
