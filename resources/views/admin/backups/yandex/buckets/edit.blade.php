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
                                        <i class="fa fa-home"></i>
                                    </a>
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
                                        <a href="{{ route('backups.yandex.buckets.index') }}">
                                            @lang('messages.backups.yandex.breadcrumbs.buckets.list')
                                        </a>
                                    </span>
                                    <span class="text-muted text-sm px-1 d-none d-sm-block">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm d-none d-sm-block">
                                        @lang('messages.backups.yandex.breadcrumbs.buckets.edit')
                                    </span>
                                </div>
                            </div>
                            <div class="card-tools">
                                <a href="{{ route('backups.yandex.buckets.show', $bucket->id) }}"
                                   class="btn btn-xs btn-info"
                                   title="@lang('messages.backups.yandex.buttons.title.back')">
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
                    <div class="d-block d-xl-none">
                        <h3>@lang('messages.backups.yandex.breadcrumbs.buckets.edit')</h3>
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

                                {{ Form::open([ 'url' => route('backups.yandex.buckets.update', $bucket->id), 'method' => 'patch']) }}
                                <div class="form-group">
                                    <b>
                                        @lang('messages.backups.yandex.fields.description')
                                    </b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::text('description', $bucket->description , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            @lang('messages.backups.yandex.fields.more_details')
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>
                                        @lang('messages.backups.yandex.fields.connector')
                                    </b>
                                    <span class="small text-danger">*</span>
                                    {{ Form::select('connector_id', $connectors, $bucket->connector_id, ['class' => 'form-control', 'required', 'placeholder' => 'Выберите коннектор...']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            @lang('messages.backups.yandex.fields.more_details')
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <b>
                                        @lang('messages.backups.yandex.fields.interval')
                                    </b>
                                    <span class="small text-danger">*</span>
                                    <div>
                                        {{ Form::radio('interval', '1', $bucket->interval === 1) }}
                                        1 @lang('messages.backups.yandex.fields.hour')
                                        {{ Form::radio('interval', '3', $bucket->interval === 3) }}
                                        3 @lang('messages.backups.yandex.fields.hour')
                                        {{ Form::radio('interval', '6', $bucket->interval === 6) }}
                                        6 @lang('messages.backups.yandex.fields.hour')
                                        {{ Form::radio('interval', '12', $bucket->interval === 12) }}
                                        12 @lang('messages.backups.yandex.fields.hour')
                                        {{ Form::radio('interval', '24', $bucket->interval === 24) }}
                                        @lang('messages.backups.yandex.fields.day')
                                    </div>
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
                                    <span class="small text-danger">*</span>
                                    {{ Form::textarea('comment', $bucket->comment, ['class' => 'form-control',
                                            'rows' => 5, 'placeholder' => 'Комментарий...']) }}
                                    <details class="mt--3 small">
                                        <summary>
                                            @lang('messages.backups.yandex.fields.more_details')
                                        </summary>
                                        ...
                                    </details>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 mt-2">
                                            <button type="submit" class="btn btn-xs btn-success btn-block">
                                                @lang('messages.backups.yandex.buttons.title.save')
                                            </button>
                                            {{ Form::close() }}
                                        </div>

                                        <div class="col-lg-2 mt-2">
                                            {{Form::open([ 'url' => route('backups.yandex.buckets.destroy', $bucket->id), 'method' => 'delete'])}}
                                            <button type="submit" class="btn btn-xs btn-danger btn-block">
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
    </div>
@endsection
