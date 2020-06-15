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
                                    <span class="text-muted text-sm d-none d-sm-block">
                                        @lang('messages.backups.yandex.breadcrumbs.connectors.show')
                                    </span>
                                </div>
                            </div>
                            <span class="float-right">
                                <a href="{{ route('backups.yandex.connectors.index') }}"
                                   class="btn btn-xs btn-info"
                                   title="@lang('messages.backups.yandex.buttons.title.back')">
                                    <i class="fa fa-arrow-left"></i>
                                    @lang('messages.backups.yandex.buttons.title.back')
                                </a>
                                <a href="{{route('backups.yandex.connectors.edit', $connector->id)}}"
                                   class="btn btn-xs btn-warning"
                                   title="@lang('messages.backups.yandex.buttons.title.edit')">
                                    <i class="fas fa-edit"></i>
                                    @lang('messages.backups.yandex.buttons.title.edit')
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="d-block d-xl-none">
                        <h3>@lang('messages.backups.yandex.breadcrumbs.connectors.show')</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.connectors.titles.summary_information')
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row small">
                                        <div class="col-lg-4 col-5">
                                            <span class="text-bold">
                                                @lang('messages.backups.yandex.fields.description'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $connector->description }}
                                        </div>
                                    </div>
                                    <div class="row small">
                                        <div class="col-lg-4 col-5">
                                            <span class="text-bold">
                                                @lang('messages.backups.yandex.fields.token'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $connector->token }}
                                        </div>
                                    </div>
                                    <div class="row small">
                                        <div class="col-lg-4 col-5">
                                            <span class="text-bold">
                                                 @lang('messages.backups.yandex.fields.status'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            @if($connector->status === 1)
                                                <span class="badge badge-success">
                                                    @lang('messages.backups.yandex.fields.online')
                                                    |
                                                    {{ $connector->http_code }}
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    @lang('messages.backups.yandex.fields.offline')
                                                    |
                                                    {{ $connector->http_code }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row small">
                                        <div class="col-lg-4 col-5">
                                            <span class="text-bold">
                                                  @lang('messages.backups.yandex.fields.last_check'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            @if($connector->logs->count() > 0)
                                                {{ $connector->logs->last()->created_at }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row small mt-3">
                                        <div class="col-12">
                                            <i class="fas fa-hdd"></i>
                                            <span class="text-bold">
                                                        @lang('messages.backups.yandex.fields.total'):
                                                    </span>
                                            {{ $connector->used_space }}
                                            @lang('messages.backups.yandex.fields.gb')
                                            @lang('messages.backups.yandex.fields.of')
                                            {{ $connector->total_space }}
                                            @lang('messages.backups.yandex.fields.gb')
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-primary"
                                                     role="progressbar"
                                                     aria-valuenow="{{ $connector->percent_used }}"
                                                     aria-valuemin="0" aria-valuemax="100"
                                                     style="width: {{ $connector->percent_used }}%">
                                                        <span class="text-dark">
                                                            @lang('messages.backups.yandex.fields.used')
                                                            {{ $connector->percentused }}%
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row small mt-3">
                                        <div class="col-12">
                                            <i class="fas fa-dumpster"></i>
                                            <span class="text-bold">
                                                        @lang('messages.backups.yandex.fields.bucket'):
                                                    </span>
                                            {{ $connector->trash_size }}
                                            @lang('messages.backups.yandex.fields.gb')
                                            @lang('messages.backups.yandex.fields.of')
                                            {{ $connector->total_space }}
                                            @lang('messages.backups.yandex.fields.gb')
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                     aria-valuenow="{{ $connector->percent_bucket_used }}"
                                                     aria-valuemin="0" aria-valuemax="100"
                                                     style="width: {{ $connector->percent_bucket_used }}%">
                                                    <span class="text-dark">
                                                        @lang('messages.backups.yandex.fields.used')
                                                        {{ $connector->percent_bucket_used }}%
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr/>
                                    <div class="row small">
                                        <div class="col-lg-4 col-3">
                                            <span class="text-bold">
                                                @lang('messages.backups.yandex.fields.comment'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-9">
                                            {{ $connector->comment }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.connectors.titles.related_tasks')
                                    </span>
                                </div>
                                @if($tasks !== null)
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tbody>
                                            @foreach($tasks as $task)
                                                <tr class="table-row">
                                                    <td class="col-2 small">
                                                        # {{ $task->id }}
                                                    </td>
                                                    <td class="col-10 small">
                                                        {{ $task->description }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.connectors.titles.related_buckets')
                                    </span>
                                </div>
                                @if($tasks !== null)
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tbody>
                                            @foreach($buckets as $bucket)
                                                <tr class="table-row">
                                                    <td class="col-2 small">
                                                        # {{ $bucket->id }}
                                                    </td>
                                                    <td class="col-10 small">
                                                        {{ $bucket->description }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <span class="text-muted text-sm">
                              @lang('messages.backups.yandex.connectors.titles.errors')
                            </span>
                            <span class="badge badge-{{ ($logs->count() > 0) ? 'danger' : 'success'}}">
                                {{ $logs->count() }}
                            </span>
                            <div class="float-right">
                                <div class="btn-group">
                                    <a href="#"
                                       class="btn btn-xs btn-outline-dark" title="Добавление нового устройства">
                                        @lang('messages.backups.yandex.buttons.all_records')
                                    </a>
                                    @if($logs->count() > 0)
                                        <a href="{{ route('backups.yandex.backups.yandex.connectors.resolve') }}"
                                           class="btn btn-xs btn-outline-dark" title="Добавление нового устройства">
                                            @lang('messages.backups.yandex.buttons.read_all')
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($tasks !== null)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($logs as $log)
                                        <tr class="table-row" {{ ($log->resolved === 0) ? 'style=background:#f3b7bd' : '' }}>
                                            <td class="small">
                                                <span
                                                    class="px-2 badge badge-{{ ($log->resolved === 1) ? 'secondary' : 'danger' }}">
                                                    @lang('messages.backups.yandex.connectors.log.error')
                                                </span>
                                            </td>
                                            <td class="small">
                                                <span {{ ($log->resolved === 1) ? 'class=text-muted' : '' }}>
                                                    @lang('messages.backups.yandex.connectors.log.connector')
                                                    #{{ $log->connector_id }} |
                                                    @lang('messages.backups.yandex.connectors.log.down')
                                                </span>
                                            </td>
                                            <td class="small">
                                                <span {{ ($log->resolved === 1) ? 'class=text-muted' : '' }}>
                                                    {{\Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')}}
                                                </span>
                                            </td>
                                            <td class="small">
                                                <span {{ ($log->resolved === 1) ? 'class=text-muted' : '' }}>
                                                    <a class="btn btn-" href=""></a>
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
