@extends('layouts.app')

@section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0 text-dark">Редактирование сайта</h1>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Редактирование сайта</li>
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
                                <h3 class="card-title">Редактирование сайта</h3>
                                <div class="card-tools">
                                    <a href="{{route('admin.sites.show', $site->id)}}"
                                       class="btn btn-sm bg-gradient-info" title="Вернуться">
                                        <i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-sm-6">
                                    {{ Form::open([ 'url' => route('admin.sites.update', $site->id), 'method' => 'put', 'enctype' => "multipart/form-data"]) }}

                                    <div class="form-group">
                                        <label>Название сайта</label>
                                        {{ Form::text('title', $site->title , ['class' => 'form-control', 'required','placeholder' => 'My website or so']) }}
                                        <p class="mt--3 small">(Название проверяемого сайта)</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Адрес URL</label>
                                        {{ Form::text('url', $site->url , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com/']) }}
                                        <p class="mt--3 small">(URL адрес сайта без указания htttp/https префиксов)</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Мониторить сайт</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('enabled', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('enabled', true, $site->enabled) }}
                                        </div>
                                        <p class="mt--3 small">(Активировать мониторинг сайта)</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Путь к файлу мониторинга</label>
                                        {{ Form::text('file_url', $site->file_url , ['class' => 'form-control', 'placeholder' => 'monitoring.php']) }}
                                        <p class="mt--3 small">(Для использования файла мониторинга необходимо вводить полный путь до него)</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Использовать файл мониторинга</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('use_file', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('use_file', true, $site->checksList->use_file) }}
                                        </div>
                                        <p class="mt--3 small">(Использовать файл мониторинга)</p>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <b>HTTP ответ сервера</b>
                                            {{Form::text('http_code', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('http_code', 1, true) }}</div>
                                        <p class="mt--3 small">(Проверка возвращаемого сайтом ответа на HTTP запрос)</p>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Поддержка HTTPS</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('https', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('https', true, $site->https) }}
                                            </div>
                                            <div class="mt--3 small">(Сервер с поддержкой HTTPS)</div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Мониторить HTTPS</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('check_https', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('check_https', true, $site->checksList->check_https) }}
                                            </div>
                                            <p class="mt--3 small">(Проверять HTTPS)</p>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Мониторить SSL</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('check_ssl', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('check_ssl', true, $site->checksList->check_ssl) }}
                                            </div>
                                            <p class="mt--3 small">(Проверять состояние SSL сертификата)</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Контроль версии PHP</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('check_php', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('check_php', true, $site->checksList->check_php) }}
                                        </div>
                                        <p class="mt--3 small">(Проверять актуальность версии PHP)</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Описание</label>
                                        {{ Form::text('comment', $site->comment, ['class' => 'form-control', 'placeholder' => 'My website, that I love to watch on-line, but sometimes ....']) }}
                                        <p class="mt--3 small">(Дополнительное описание)</p>
                                    </div>
                                    <div class="form-row ">
                                        <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-xs bg-gradient-cyan">Обновить</button>
                                    {{ Form::close() }}
                                        </div>
                                        <div class="form-group col-md-4">
                                    {{Form::open([ 'url' => route('admin.sites.destroy', $site->id), 'method' => 'delete', 'enctype' => "multipart/form-data"])}}
                                    <button type="submit" class="btn btn-xs bg-gradient-red">Удалить</button>
                                    {{ Form::close() }}
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
