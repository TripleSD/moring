@extends('layouts.app')

@section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0 text-dark">Добавление сайта</h1>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Добавление сайта</li>
                        </ol>
                    </div>
                </div>
            </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Добавление нового сайта</h3>
                                <div class="card-tools">
                                    <a href="{{route('admin.sites.index')}}"
                                       class="btn btn-sm bg-gradient-info" title="Вернуться">
                                        <i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-sm-6">
                                    {{ Form::open([ 'route' => 'admin.sites.store', 'method' => 'post', 'enctype' => "multipart/form-data"]) }}

                                    <div class="form-group">
                                        <b>Название сайта</b>
                                        {{ Form::text('title', null , ['class' => 'form-control', 'required','placeholder' => 'My website or so']) }}
                                        <p class="mt--3 small">(Название проверяемого сайта)</p>
                                    </div>

                                    <div class="form-group">
                                        <b>Адрес URL</b>
                                        {{ Form::text('url', null , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com/']) }}
                                        <p class="mt--3 small">(URL адрес сайта без указания htttp/https префиксов)</p>
                                    </div>

                                    <div class="form-group">
                                        <b>Полный путь к файлу мониторинга (опционально)</b>
                                        {{ Form::text('file_url', '',['class' => 'form-control', 'placeholder' => 'yourdomain.com/monitoring.php']) }}
                                        <p class="mt--3 small">(Использовать файл мониторинга (необходимо вводить полный путь))</p>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <b>HTTP ответ сервера</b>
                                            {{Form::text('http_code', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('http_code', 1, true) }}</div>
                                            <p class="mt--3 small">(Проверка возвращаемого сайтом ответа на HTTP запрос)</p>
                                    </div>

                                    <div class="form-group">
                                        <b>HTTPS</b>
                                        {{Form::text('https', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('https', 1, false) }}
                                        <p class="mt--3 small">(Сервер с поддержкой HTTPS)</p>
                                    </div>

                                    <div class="form-group">
                                        <b>Мониторинг HTTPS</b>
                                        {{Form::text('check_https', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_https', 1, false) }}
                                        <p class="mt--3 small">(Проверять HTTPS)</p>
                                    </div>

                                    <div class="form-group">
                                        <b>Проверка SSL</b>
                                        {{Form::text('check_ssl', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_ssl', 1, false) }}
                                        <p class="mt--3 small">(Проверять состояние SSL сертификата)</p>
                                    </div>

                                   <div class="form-group">
                                        <b>Проверка версии PHP</b>
                                       {{Form::text('check_php', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_php', 1, true) }}
                                       <p class="mt--3 small">(Проверять актуальность версии PHP)</p>
                                    </div>

                                    <div class="form-group">
                                        <b>Описание</b>
                                        {{ Form::text('comment', null , ['class' => 'form-control', 'placeholder' => 'My website, that I love to watch on-line, but sometimes ....']) }}
                                        <p class="mt--3 small">(Дополнительное описание)</p>
                                    </div>

                                    <button type="submit" class="btn btn-xs bg-gradient-cyan">Добавить</button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
