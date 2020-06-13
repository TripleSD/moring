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
                                    <span class="text-sm">
                                        @lang('messages.backups.yandex.breadcrumbs.buckets.list')
                                    </span>
                                </div>
                            </div>
                            <div class="card-tools">
                                @include('admin.backups.yandex.menu')
                                <div class="btn-group">
                                    <a href="{{route('backups.yandex.buckets.create')}}"
                                       class="btn btn-xs btn-outline-success"
                                       title="@lang('messages.backups.yandex.buttons.title.add_bucket')">
                                        @lang('messages.backups.yandex.buttons.add')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="https://github.com/TripleSD/moring-documentation/blob/master/en/Backups/Yandex/Buckets/README.md"
                                       class="btn btn-xs btn-outline-dark"
                                       title="@lang('messages.backups.yandex.buttons.title.help')"
                                       target="_blank">
                                        @lang('messages.backups.yandex.buttons.help')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            @foreach($buckets as $bucket)
                                <div class="callout callout-{{ ($bucket->enabled) ? 'success' : 'warning' }}"
                                     style="background: {{ ($bucket->status) ? 'white' : '#FFF5EE' }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <b>
                                                        <i class="fas fa-dumpster"></i>
                                                        {{ $bucket->description }}
                                                    </b>
                                                    <span class="small text-muted">#{{ $bucket->id }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-11">
                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <b>
                                                                @lang('messages.backups.yandex.fields.status'):
                                                            </b>
                                                        </div>
                                                        <div class="col-8">
                                                            @if($bucket->enabled === 1)
                                                                <div class="badge badge-success">
                                                                    @lang('messages.backups.yandex.fields.enabled')
                                                                </div>
                                                            @else
                                                                <div class="small badge badge-secondary">
                                                                    @lang('messages.backups.yandex.fields.disabled')
                                                                </div>
                                                            @endif
                                                            @if($bucket->logs->count() !== 0)
                                                                <div class="badge badge-danger">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                    {{ $bucket->logs->count() }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <b>
                                                                @lang('messages.backups.yandex.fields.connector'):
                                                            </b>
                                                        </div>
                                                        <div class="col-8">
                                                            {{ $bucket->connector->description }}
                                                            (id: {{ $bucket->connector->id }})
                                                        </div>
                                                    </div>
                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <b>
                                                                @lang('messages.backups.yandex.fields.interval'):
                                                            </b>
                                                        </div>
                                                        <div class="col-8">
                                                            {{ $bucket->interval }}
                                                            @lang('messages.backups.yandex.fields.hour')
                                                        </div>
                                                    </div>
                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <b>
                                                                @lang('messages.backups.yandex.fields.added'):
                                                            </b>
                                                        </div>
                                                        <div class="col-8">
                                                            {{ $bucket->created_at }}
                                                        </div>
                                                    </div>
                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <b>
                                                                @lang('messages.backups.yandex.fields.last_check'):
                                                            </b>
                                                        </div>
                                                        <div class="col-8">
                                                            @empty($bucket->lastCheck)
                                                                -
                                                            @else
                                                                {{ $bucket->lastCheck }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="btn-group-vertical float-right">
                                                        <a href="{{route('backups.yandex.buckets.show',$bucket->id)}}"
                                                           class="btn btn-xs btn-outline-info"
                                                           title="@lang('messages.backups.yandex.buttons.title.view')">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{route('backups.yandex.buckets.edit', $bucket->id)}}"
                                                           class="btn btn-xs btn-outline-warning"
                                                           title="@lang('messages.backups.yandex.buttons.title.edit')">
                                                            <i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.buckets.titles.errors')
                                    </span>
                                    <span class="badge badge-{{ ($logCount > 0) ? 'danger' : 'success'}}">
                                        {{ $logCount }}
                                    </span>
                                    <div class="float-right">
                                        <div class="btn-group">
                                            <a href="#"
                                               class="btn btn-xs btn-outline-dark"
                                               title="@lang('messages.backups.yandex.buttons.titles.all_records')">
                                                @lang('messages.backups.yandex.buttons.all_records')
                                            </a>
                                            @if($logCount > 0)
                                                <a href="{{ route('backups.yandex.backups.yandex.buckets.resolve') }}"
                                                   class="btn btn-xs btn-outline-dark"
                                                   title="@lang('messages.backups.yandex.buttons.titles.read_all')">
                                                    @lang('messages.backups.yandex.buttons.read_all')
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($logs !== null)
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
        </div>
    </div>
@endsection
