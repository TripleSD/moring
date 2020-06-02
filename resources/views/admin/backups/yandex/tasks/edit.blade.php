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
                                <div class="btn-group">
                                    <span class="text-muted text-sm">Dashboard</span>
                                    <span class="text-muted text-sm px-1"><i class="fas fa-chevron-right"></i></span>
                                    <span class="text-muted text-sm">Backup</span>
                                    <span class="text-muted text-sm px-1"><i class="fas fa-chevron-right"></i></span>
                                    <span class="text-muted text-sm">Яндекс Диск</span>
                                    <span class="text-muted text-sm px-1"><i class="fas fa-chevron-right"></i></span>
                                    <span class="text-sm">Редактирование проверки</span>
                                </div>
                            </div>
                            <div class="card-tools">
                                <a href="{{route('backups.ftp.index')}}"
                                   class="btn btn-xs bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i> Назад</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--            <div class="row">--}}
            {{--                <div class="col-12">--}}
            {{--                    <div class="card card-info">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="col-sm-6">--}}
            {{--                                    <span class="small text-danger float-right">--}}
            {{--                                        * - обязательно для заполнения--}}
            {{--                                    </span>--}}

            {{--                                {{ Form::open([ 'url' => route('backups.ftp.update', $task->id), 'method' => 'patch']) }}--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <b>Описание</b>--}}
            {{--                                    <span class="small text-danger">*</span>--}}
            {{--                                    {{ Form::text('description', $task->description , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Сетевое имя устройства или IP адрес</b>--}}
            {{--                                    <span class="small text-danger">*</span>--}}
            {{--                                    {{ Form::text('hostname', $task->hostname , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Порт</b>--}}
            {{--                                    <span class="small text-danger">*</span>--}}
            {{--                                    {{ Form::text('port', $task->port, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: 21']) }}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Логин</b>--}}
            {{--                                    <span class="small text-danger">*</span>--}}
            {{--                                    {{Form::text('login', $task->login, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: backup-user'])}}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Пароль</b>--}}
            {{--                                    {{Form::text('password', $task->password, ['class' => 'form-control', 'placeholder' => 'Пример: 7{m5MUqpBDEmEXG'])}}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Папка</b>--}}
            {{--                                    {{Form::text('folder', $task->folder, ['class' => 'form-control', 'placeholder' => 'Пример: BackupSite'])}}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Pre suffix</b>--}}
            {{--                                    {{Form::text('pre', $task->pre, ['class' => 'form-control', 'placeholder' => 'Пример: backup_'])}}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Post suffix</b>--}}
            {{--                                    {{Form::text('post', $task->post, ['class' => 'form-control', 'placeholder' => 'Пример: _%Y-%m-%d'])}}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>File</b>--}}
            {{--                                    <span class="small text-danger">*</span>--}}
            {{--                                    {{Form::text('filename', $task->filename, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: test.tar'])}}--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <b>Interval</b>--}}
            {{--                                    <span class="small text-danger">*</span>--}}
            {{--                                    <div>--}}
            {{--                                        {{ Form::radio('interval', '1', $task->interval === 1) }} every 1h--}}
            {{--                                        {{ Form::radio('interval', '3', $task->interval === 3) }} every 3h--}}
            {{--                                        {{ Form::radio('interval', '6', $task->interval === 6) }} every 6h--}}
            {{--                                        {{ Form::radio('interval', '12', $task->interval === 12) }} every 12h--}}
            {{--                                        {{ Form::radio('interval', '24', $task->interval === 24) }} every day--}}
            {{--                                    </div>--}}
            {{--                                    <details class="mt--3 small">--}}
            {{--                                        <summary>--}}
            {{--                                            Дополнительная информация--}}
            {{--                                        </summary>--}}
            {{--                                        ...--}}
            {{--                                    </details>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group">--}}
            {{--                                    <button type="submit" class="btn btn-xs bg-gradient-success">Обновить</button>--}}
            {{--                                    {{ Form::close() }}--}}

            {{--                                    <div class="float-right">--}}
            {{--                                        {{Form::open([ 'url' => route('backups.ftp.destroy', $task->id), 'method' => 'delete'])}}--}}
            {{--                                        <button type="submit" class="btn btn-xs bg-gradient-red">Удалить--}}
            {{--                                        </button>--}}
            {{--                                        {{ Form::close() }}--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
    </div>
@endsection
