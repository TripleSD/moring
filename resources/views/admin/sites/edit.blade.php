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
                                    {{ Form::open(['url' => route('admin.sites.update', $site->id), 'method' => 'put']) }}

                                    <div class="form-group">
                                        <b>Название сайта</b>
                                        {{ Form::text('title', $site->title , ['class' => 'form-control', 'required','placeholder' => 'My website.']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Введите название сайта, которое поможет Вам легче ориентироваться в списке
                                            сайтов.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>URL сайта</b>
                                        {{ Form::text('url', $site->url , ['class' => 'form-control', 'readonly']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Введите URL сайта без указания http/https префиксов - эти настройки будут
                                            дальше.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Полный путь к файлу мониторинга (опционально)</b>
                                        {{ Form::text('file_url', $site->file_url , ['class' => 'form-control', 'placeholder' => 'monitoring.php']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Вы можете получать более подробную информацию о состоянии Вашего
                                            оборудования.
                                            Для этого необходимо установить файл мониторинга на контролируемый сервер
                                            (необходимо вводить полный путь к файлу)
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            {{ Form::checkbox('use_file', true, $site->checksList->use_file) }}
                                            <b>Использовать файл мониторинга</b><br>
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Если Вы не желаете использовать файл мониторинг на текущем этапе, просто
                                            снимите отметку с данного чекбокса.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            {{ Form::checkbox('http_code', 1, $site->checksList->http_code) }}
                                            <b>Проверка HTTP кода</b>
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Проверка возвращаемого сайтом ответа на HTTP запрос.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            {{ Form::checkbox('https', true, $site->https) }}
                                            <b>Поддержка HTTPS</b>
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Если сервер поддерживает защищенное соединение (HTTPS), отметьте этот
                                            чекбокс для получения корректных данных об ответе сервера на HTTP
                                            запрос.
                                        </details>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            {{ Form::checkbox('check_ssl', true, $site->checksList->check_ssl) }}
                                            <b>Проверка SSL</b>
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Отметьте чекбокс для проверки SSL сертификата сервера.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            {{ Form::checkbox('check_php', true, $site->checksList->check_php) }}
                                            <b>Контроль версии PHP</b>
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Отметьте чекбокс для контроля версии PHP.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Описание</b>
                                        {{ Form::text('comment', $site->comment, ['class' => 'form-control', 'placeholder' => 'Это мой любимый сайт и я всегда радуюсь, видя его онлайн, но иногда...']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Здесь Вы можете ввести дополнительную информацию для болеее полного описания
                                            сайта.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Ping threshold</b>
                                        {{ Form::text('ping_threshold', $site->ping_threshold , ['class' => 'form-control', 'placeholder' => '10']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Максимальное значение ping при котором необходимо уведомлять
                                                администратора
                                            </summary>
                                            Ping threshold
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            {{ Form::checkbox('enabled', true, $site->enabled) }}
                                            <b>Мониторить сайт</b>
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Для активации мониторинга отметьте данный чекбокс.
                                        </details>
                                    </div>

                                    <div class="form-row ">
                                        <div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-xs bg-gradient-cyan">Обновить</button>
                                            {{ Form::close() }}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{Form::open([ 'url' => route('admin.sites.destroy', $site->id), 'method' => 'delete'])}}
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
