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
                                <a href="{{route('settings.users.show',$user->id)}}"
                                   class="btn btn-sm bg-gradient-info" title="Вернуться">
                                                    <i class="fa fa-arrow-left"></i>
                                                </a>
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-6">
                                {{ Form::open(['url' => route('settings.users.update', $user->id),'method' => 'post']) }}
                                @method('patch')

                                <div class="form-group">
                                    <label>Имя пользователя</label>
                                    {{ Form::text('name', $user->name , ['class' => 'form-control', 'required','placeholder' => 'Андрей Иванов']) }}
                                </div>

                                <div class="form-group">
                                    <label>Адрес электронной почты</label>
                                    {{ Form::email('email', $user->email , ['class' => 'form-control', 'required', 'placeholder' => 'a.ivanov@domain.ru']) }}
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
