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
                                    <span class="text-muted text-sm">
                                        <a href="{{ route('backups.yandex.tasks.index') }}">Яндекс Диск</a>
                                    </span>
                                    <span class="text-muted text-sm px-1"><i class="fas fa-chevron-right"></i></span>
                                    <span class="text-sm">Редактирование коннектора</span>
                                </div>
                            </div>
                            <div class="card-tools">
                                <a href="{{route('backups.yandex.connectors.index')}}"
                                   class="btn btn-xs bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i> Назад</a>
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
                                    {{ Form::text('description', $connector->description, ['class' => 'form-control',
                                        'required', 'placeholder' => 'Пример: Аккаунт клиента или disk@site.local']) }}
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
                                    {{ Form::text('token', $connector->token, ['class' => 'form-control',
                                        'required', 'placeholder' => 'Пример: Hhs7JushsksTgJdls']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>Комментарий</b>
                                    {{ Form::textarea('comment', $connector->comment, ['class' => 'form-control',
                                        'rows' => 5, 'placeholder' => 'Комментарий...']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            Дополнительная информация
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-xs bg-gradient-success">Сохранить</button>
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
