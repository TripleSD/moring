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
                            <h3 class="card-title">Редактирование FTP проверки</h3>
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

                                {{ Form::open([ 'url' => route('backups.yandex.baskets.update', $basket->id), 'method' => 'patch']) }}
                                <div class="form-group">
                                    <b>Краткое описание</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('description', $basket->description , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Коннектор</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::select('connector_id', $connectors, $basket->connector_id, ['class' => 'form-control', 'required', 'placeholder' => 'Выберите коннектор...']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Комментарий</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::textarea('comment', $basket->comment, ['class' => 'form-control',
                                            'rows' => 5, 'placeholder' => 'Комментарий...']) }}
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
                                        {{ Form::radio('interval', '1', $basket->interval === 1) }} every 1h
                                        {{ Form::radio('interval', '3', $basket->interval === 3) }} every 3h
                                        {{ Form::radio('interval', '6', $basket->interval === 6) }} every 6h
                                        {{ Form::radio('interval', '12', $basket->interval === 12) }} every 12h
                                        {{ Form::radio('interval', '24', $basket->interval === 24) }} every day
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
                                        {{Form::open([ 'url' => route('backups.yandex.baskets.destroy', $basket->id), 'method' => 'delete'])}}
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
