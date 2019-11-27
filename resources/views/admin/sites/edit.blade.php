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
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Введите название сайта, которое поможет Вам легче ориентироваться в списке сайтов.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <label>Адрес URL</label>
                                        {{ Form::text('url', $site->url , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com/']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Введите URL сайта без указания http/https префиксов - эти настройки будут дальше.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <label>Мониторить сайт</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('enabled', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('enabled', true, $site->enabled) }}
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Для активации мониторинга отметьте данный чекбокс.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <label>Путь к файлу мониторинга</label>
                                        {{ Form::text('file_url', $site->file_url , ['class' => 'form-control', 'placeholder' => 'monitoring.php']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Вы можете получать более подробную информацию о состоянии Вашего оборудования.
                                            Для этого необходимо установить файл мониторинга на контролируемый сервер (необходимо вводить полный путь к файлу)
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <label>Использовать файл мониторинга</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('use_file', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('use_file', true, $site->checksList->use_file) }}
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Если Вы не желаете использовать файл мониторинг на текущем этапе, просто снимите отметку с данного чекбокса.
                                        </details>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <b>HTTP ответ сервера</b>
                                            {{Form::text('http_code', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('http_code', 1, true) }}</div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Проверка возвращаемого сайтом ответа на HTTP запрос.
                                        </details>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Поддержка HTTPS</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('https', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('https', true, $site->https) }}
                                            </div>
                                            <details class="mt--3 small">
                                                <summary>
                                                    Дополнительная информация
                                                </summary>
                                                Если сервер поддерживает защищенное соединение (HTTPS), отметьте этот чекбокс для получения корректных данных об ответе сервера на HTTP запрос.
                                            </details>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Мониторинг HTTPS</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('check_https', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('check_https', true, $site->checksList->check_https) }}
                                            </div>
                                            <details class="mt--3 small">
                                                <summary>
                                                    Дополнительная информация
                                                </summary>
                                                Отметьте чекбокс для проверки ответа сервера на запрос HTTPS.
                                            </details>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Мониторинг SSL</label><br>
                                            <div class="form-check-inline">
                                            {{Form::text('check_ssl', '0', ['class' => 'form-control', 'hidden'])}}
                                                {{ Form::checkbox('check_ssl', true, $site->checksList->check_ssl) }}
                                            </div>
                                            <details class="mt--3 small">
                                                <summary>
                                                    Дополнительная информация
                                                </summary>
                                                Отметьте чекбокс для проверки SSL сертификата сервера.
                                            </details>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Контроль версии PHP</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('check_php', '0', ['class' => 'form-control', 'hidden'])}}
                                            {{ Form::checkbox('check_php', true, $site->checksList->check_php) }}
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Отметьте чекбокс для контроля версии PHP.
                                        </details>

                                    </div>

                                    <div class="form-group">
                                        <label>Описание</label>
                                        {{ Form::text('comment', $site->comment, ['class' => 'form-control', 'placeholder' => 'Это мой любимый сайт и я всегда радуюсь, видя его онлайн, но иногда...']) }}
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        Здесь Вы можете ввести дополнительную информацию для болеее полного описания сайта.
                                        </details>
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
