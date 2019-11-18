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
                            <h3 class="card-title">Список пользователей</h3>
                            <div class="card-tools">
                                <a href="{{route('settings.users.create')}}"
                                   class="btn btn-sm bg-gradient-success" title="Создание нового пользователя">
                                    <i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ФИО</th>
                                    <th>Электронная почта(логин)</th>
                                    <th>Роль</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    @php
                                        /** @var \App\Models\ChecksSites $site */
                                    @endphp
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>?</td>
                                        <td>
                                            <a href="{{route('settings.users.show',$user->id)}}"
                                               class="btn btn-sm bg-gradient-info" title="Просмотр пользователя">
                                                <i class="fa fa-user"></i>
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
