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
                                    <span class="text-muted text-sm d-none d-sm-block">
                                        @lang('messages.backups.yandex.breadcrumbs.dashboard')
                                    </span>
                                    <span class="text-muted text-sm px-1 d-none d-sm-block">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm d-none d-sm-block">
                                         @lang('messages.backups.yandex.breadcrumbs.backups')
                                    </span>
                                    <span class="text-muted text-sm px-1 d-none d-sm-block">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm d-none d-sm-block">
                                        @lang('messages.backups.yandex.breadcrumbs.yandex')
                                    </span>
                                    <span class="text-muted text-sm px-1 d-none d-sm-block">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm d-none d-sm-block">
                                        <a href="{{ route('backups.yandex.connectors.index') }}">
                                            @lang('messages.backups.yandex.breadcrumbs.connectors.list')
                                        </a>
                                    </span>
                                    <span class="text-muted text-sm px-1 d-none d-sm-block">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-sm">
                                         @lang('messages.backups.yandex.breadcrumbs.connectors.edit')
                                    </span>
                                </div>
                            </div>
                            <div class="card-tools">
                                <a href="{{ url()->previous() }}"
                                   class="btn btn-xs btn-outline-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i>
                                    @lang('messages.backups.yandex.buttons.title.back')
                                </a>
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
                                    * @lang('messages.backups.yandex.fields.required')
                                </span>

                                {{ Form::open([ 'url' => route('backups.yandex.connectors.update', $connector->id), 'method' => 'patch']) }}
                                <div class="form-group">
                                    <b>
                                        @lang('messages.backups.yandex.fields.description')
                                    </b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('description', $connector->description, ['class' => 'form-control',
                                        'required', 'placeholder' => 'Пример: Аккаунт клиента или disk@site.local']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            @lang('messages.backups.yandex.fields.more_details')
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>
                                        @lang('messages.backups.yandex.fields.token')
                                    </b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('token', $connector->token, ['class' => 'form-control',
                                        'required', 'placeholder' => 'Пример: Hhs7JushsksTgJdls']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            @lang('messages.backups.yandex.fields.more_details')
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>
                                        @lang('messages.backups.yandex.fields.comment')
                                    </b>
                                    {{ Form::textarea('comment', $connector->comment, ['class' => 'form-control',
                                        'rows' => 5, 'placeholder' => 'Комментарий...']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            @lang('messages.backups.yandex.fields.more_details')
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-xs btn-success">
                                            @lang('messages.backups.yandex.buttons.title.save')
                                        </button>
                                        {{ Form::close() }}
                                    </div>

                                    <div class="btn-group">
                                        {{Form::open([ 'url' => route('backups.yandex.connectors.destroy', $connector->id), 'method' => 'delete'])}}
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            @lang('messages.backups.yandex.buttons.title.delete')
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
@endsection
