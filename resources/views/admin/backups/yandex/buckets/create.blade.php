@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" text-dark"><i class="nav-icon fas fa-box-open"></i> Backups</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Backups</li>
                        <li class="breadcrumb-item active">Ftp</li>
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
                            <h3 class="card-title">Создание FTP проверки</h3>
                            <div class="card-tools">
                                <a href="{{route('backups.ftp.index')}}"
                                   class="btn btn-sm bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="col-sm-6">
                                <span class="small text-danger float-right">
                                    * - обязательно для заполнения
                                </span>

                                {{ Form::open([ 'url' => route('backups.ftp.store'), 'method' => 'post']) }}
                                <div class="form-group">
                                    <b>Описание</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('description', null , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Сетевое имя устройства или IP адрес</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('hostname', null , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Порт</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('port', null, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: 21']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Логин</b>
                                    <span class="small text-danger">*</span>
                                    {{Form::text('login', null, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: backup-user'])}}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Пароль</b>
                                    {{Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Пример: 7{m5MUqpBDEmEXG'])}}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Папка</b>
                                    {{Form::text('folder', null, ['class' => 'form-control', 'placeholder' => 'Пример: BackupSite'])}}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Pre suffix</b>
                                    {{Form::text('pre', null, ['class' => 'form-control', 'placeholder' => 'Пример: backup_'])}}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Post suffix</b>
                                    {{Form::text('post', null, ['class' => 'form-control', 'placeholder' => 'Пример: _%Y-%m-%d'])}}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>File</b>
                                    <span class="small text-danger">*</span>
                                    {{Form::text('filename', null, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: test.tar'])}}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Interval</b>
                                    <span class="small text-danger">*</span>
                                    <div>
                                        {{ Form::radio('interval', '1', false) }} every 1h
                                        {{ Form::radio('interval', '3', false) }} every 3h
                                        {{ Form::radio('interval', '6', false) }} every 6h
                                        {{ Form::radio('interval', '12', false) }} every 12h
                                        {{ Form::radio('interval', '24', false) }} every day
                                    </div>
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
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
@endsection
