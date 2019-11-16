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
                                        {{ Form::text('title', $site->name , ['class' => 'form-control', 'required','placeholder' => 'My website or so']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Адрес URL</label>
                                        {{ Form::text('url', $site->url , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com/']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Мониторить сайт</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('active', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('active', true, $site->active) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Путь к файлу мониторинга</label>
                                        {{ Form::text('file_url', $site->file_url , ['class' => 'form-control', 'placeholder' => 'monitoring.php']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Использовать файл мониторинга</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('use_file', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('use_file', true, $site->checksList->use_file) }}
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Поддержка HTTPS</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('https', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('https', true, $site->https) }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Мониторить HTTPS</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('check_https', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('check_https', true, $site->checksList->check_https) }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Мониторить SSL</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('check_ssl', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('check_ssl', true, $site->checksList->check_ssl) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Контроль версии PHP</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('check_php', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('check_php', true, $site->checksList->check_php) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Описание</label>
                                        {{ Form::text('comment', $site->comment, ['class' => 'form-control', 'placeholder' => 'My website, that I love to watch on-line, but sometimes ....']) }}
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
