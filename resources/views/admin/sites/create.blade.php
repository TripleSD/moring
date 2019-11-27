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
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Введите название сайта, которое поможет Вам легче ориентироваться в списке сайтов.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Адрес URL</b>
                                        {{ Form::text('url', null , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com/']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Введите URL сайта без указания http/https префиксов - эти настройки будут дальше.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Полный путь к файлу мониторинга (опционально)</b>
                                        {{ Form::text('file_url', '',['class' => 'form-control', 'placeholder' => 'yourdomain.com/monitoring.php']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Вы можете получать более подробную информацию о состоянии Вашего оборудования.
                                            Для этого необходимо установить файл мониторинга на контролируемый сервер (необходимо вводить полный путь к файлу)
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

                                    <div class="form-group">
                                        <b>HTTPS</b>
                                        {{Form::text('https', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('https', 1, false) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Если сервер поддерживает защищенное соединение (HTTPS), отметьте этот чекбокс для получения корректных данных об ответе сервера на HTTP запрос.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Мониторинг HTTPS</b>
                                        {{Form::text('check_https', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_https', 1, false) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Отметьте чекбокс для проверки ответа сервера на запрос HTTPS.
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Проверка SSL</b>
                                        {{Form::text('check_ssl', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_ssl', 1, false) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Отметьте чекбокс для проверки SSL сертификата сервера.
                                        </details>
                                    </div>

                                   <div class="form-group">
                                        <b>Проверка версии PHP</b>
                                       {{Form::text('check_php', '0', ['class' => 'form-control', 'hidden'])}}
                                        {{ Form::checkbox('check_php', 1, true) }}
                                       <details class="mt--3 small">
                                           <summary>
                                               Дополнительная информация
                                           </summary>
                                           Отметьте чекбокс для контроля версии PHP.
                                       </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Описание</b>
                                        {{ Form::text('comment', null , ['class' => 'form-control', 'placeholder' => 'Это мой любимый сайт и я всегда радуюсь, видя его онлайн, но иногда...']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            Здесь Вы можете ввести дополнительную информацию для болеее полного описания сайта.
                                        </details>
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
