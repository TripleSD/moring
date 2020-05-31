@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="btn-group">
                                    <a href="{{route('home')}}"
                                       class="btn btn-xs btn-outline-secondary" title="Вернуться">
                                        <i class="fa fa-home"></i></a>
                                </div>
                                <span class="text-muted">Home | Backup | Яндекс Диск | Просмотр коннектора</span>
                            </div>
                            <span class="float-right">
                                <a href="{{route('backups.yandex.connectors.index')}}"
                                   class="btn btn-xs bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i> Назад</a>
                                <a href="{{route('backups.yandex.connectors.edit', $connector->id)}}"
                                   class="btn btn-xs bg-gradient-warning"
                                   title="Редактиование профиля">
                                    <i class="fas fa-edit"></i> Правка</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.summary_information')</dt>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    Наименование
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    ID:
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    URL
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Мониторинг состояния сайта
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Файл мониторинга
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Используется HTTPS
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Контроль SSL
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    HTTP ответ сервера
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Версия Web сервера
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Контроль версии PHP
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Last update:
                                    <span class="float-right">

                                                </span>
                                </li>
                                <li class="small">
                                    Комментарий:
                                    <span class="float-right">
                                        {{ $connector->description }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
