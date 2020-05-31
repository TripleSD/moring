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
                        <li class="breadcrumb-item active">Yandex Disk</li>
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
                            <h3 class="card-title">Редактирование коннектора Яндекс Диск</h3>
                            <div class="card-tools">
                                <a href="{{route('backups.yandex.connectors.index')}}"
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

                                {{ Form::open([ 'url' => route('backups.yandex.connectors.update', $connector->id), 'method' => 'patch']) }}
                                <div class="form-group">
                                    <b>Краткое описание</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('description', $connector->description , ['class' => 'form-control',
                                        'required', 'placeholder' => 'Аккаунт клиента']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Токен</b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('description', $connector->token , ['class' => 'form-control',
                                        'required', 'placeholder' => 'Hhs7JushsksTgJdls']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Комментарий</b>
                                    {{ Form::textarea('description', $connector->comment , ['class' => 'form-control',
                                        'rows' => 10, 'placeholder' => 'Комментарий...']) }}
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
                                        {{Form::open([ 'url' => route('backups.yandex.connectors.destroy', $connector->id), 'method' => 'delete'])}}
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
