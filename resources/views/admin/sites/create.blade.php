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
                                        <label>Название сайта</label>
                                        {{ Form::text('name', null , ['class' => 'form-control', 'required','placeholder' => 'My website or so']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Адрес URL</label>
                                        {{ Form::text('url', null , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com/']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Путь к файлу мониторинга (опционально)</label>
                                        {{ Form::text('file_url', '',['class' => 'form-control', 'placeholder' => 'monitoring.php']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>HTTP ответ сервера</label>
                                        {{Form::text('http_code', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('http_code', 1, true) }}
                                    </div>

                                    <div class="form-group">
                                        <label>HTTPS</label>
                                        {{Form::text('https', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('https', 1, false) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Мониторинг HTTPS</label>
                                        {{Form::text('check_https', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_https', 1, false) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Проверка SSL</label>
                                        {{Form::text('check_ssl', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_ssl', 1, false) }}
                                    </div>

                                   <div class="form-group">
                                        <label>Проверка версии PHP</label>
                                       {{Form::text('check_php', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_php', 1, true) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Описание</label>
                                        {{ Form::text('comment', null , ['class' => 'form-control', 'placeholder' => 'My website, that I love to watch on-line, but sometimes ....']) }}
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
