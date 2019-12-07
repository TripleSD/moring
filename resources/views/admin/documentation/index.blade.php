@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Документация</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Помощь</li>
                        <li class="breadcrumb-item active">Документация</li>
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
                            <h3 class="card-title">Разделы панели</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <b>Главная</b><br/>
                            <b>Новости</b><br/>
                            <b>Сеть</b><br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Коммутаторы<br/>
                            <b>Инфраструктура</b><br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Серверы<br/>
                            <b>Хостинг</b><br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сайты<br/>
                            <b>Настройки</b><br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Пользователи<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Системные настройки<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Интеграции<br/>
                            <b>Помощь</b><br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Документация<br/>
                            <b>Контакты</b><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
