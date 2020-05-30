@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0 text-dark">Backups</h1>
                </div>
                <div class="col-sm-8">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Backup</li>
                        <li class="breadcrumb-item active">Ftp</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Редактирование FTP проверки</h3>
                                <div class="card-tools">
                                    <a href="{{route('backups.ftp.index')}}"
                                       class="btn btn-sm bg-gradient-info" title="Вернуться">
                                        <i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-sm-6">
                                    <span class="small text-danger float-right">
                                        * - обязательно для заполнения
                                    </span>

                                    {{ Form::open([ 'url' => route('backups.ftp.update', $task->id), 'method' => 'patch']) }}
                                    <div class="form-group">
                                        <b>Описание</b>
                                        <span class="small text-danger">*</span>
                                        {{ Form::text('description', $task->description , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
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
                                        {{ Form::text('hostname', $task->hostname , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
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
                                        {{ Form::text('port', $task->port, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: 21']) }}
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
                                        {{Form::text('login', $task->login, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: backup-user'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Пароль</b>
                                        {{Form::text('password', $task->password, ['class' => 'form-control', 'placeholder' => 'Пример: 7{m5MUqpBDEmEXG'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Папка</b>
                                        {{Form::text('folder', $task->folder, ['class' => 'form-control', 'placeholder' => 'Пример: BackupSite'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Pre suffix</b>
                                        {{Form::text('pre', $task->pre, ['class' => 'form-control', 'placeholder' => 'Пример: backup_'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Post suffix</b>
                                        {{Form::text('post', $task->post, ['class' => 'form-control', 'placeholder' => 'Пример: _%Y-%m-%d'])}}
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
                                        {{Form::text('filename', $task->filename, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: test.tar'])}}
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
                                            {{ Form::radio('interval', '1', $task->interval === 1) }} every 1h
                                            {{ Form::radio('interval', '3', $task->interval === 3) }} every 3h
                                            {{ Form::radio('interval', '6', $task->interval === 6) }} every 6h
                                            {{ Form::radio('interval', '12', $task->interval === 12) }} every 12h
                                            {{ Form::radio('interval', '24', $task->interval === 24) }} every day
                                        </div>
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-xs bg-gradient-success">Обновить</button>
                                        {{ Form::close() }}

                                        <div class="float-right">
                                            {{Form::open([ 'url' => route('backups.ftp.destroy', $task->id), 'method' => 'delete'])}}
                                            <button type="submit" class="btn btn-xs bg-gradient-red">Удалить
                                            </button>
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
