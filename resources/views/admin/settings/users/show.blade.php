@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Пользователи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
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
                            <h3 class="card-title">Карточка пользователя</h3>
                            <span class="float-right">
                                <a href="{{route('settings.users.index')}}"
                                   class="btn btn-sm bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i></a>
                                <a href="{{route('settings.users.edit',$user->id)}}"
                                   class="btn btn-sm bg-gradient-warning" title="Редактирование пользователя">
                                    <i class="fa fa-user-edit"></i></a>
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="col-sm-6">
                                <dl>
                                    <dt> ID пользователя:</dt>
                                    <dd>{{ $user->id }}</dd>
                                    <dt> Имя пользователя:</dt>
                                    <dd>{{ $user->name }}</dd>
                                    <dt>Email пользователя:</dt>
                                    <dd>{{ $user->email }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
