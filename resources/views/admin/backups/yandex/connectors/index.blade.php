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
                                    <span class="text-sm d-none d-sm-block">
                                        @lang('messages.backups.yandex.breadcrumbs.connectors.list')
                                    </span>
                                </div>
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{route('backups.yandex.connectors.create')}}"
                                       class="btn btn-xs btn-success"
                                       title="@lang('messages.backups.yandex.buttons.title.add_connector')">
                                        @lang('messages.backups.yandex.buttons.add')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    @include('admin.backups.yandex.menu')
                                </div>
                                <div class="btn-group">
                                    <a href="https://github.com/TripleSD/moring-documentation/blob/master/en/Backups/Yandex/Connectors/README.md"
                                       class="btn btn-xs btn-outline-dark d-none d-sm-block"
                                       title="@lang('messages.backups.yandex.buttons.title.help')"
                                       target="_blank">
                                        @lang('messages.backups.yandex.buttons.help')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-block d-xl-none">
                                <h3>@lang('messages.backups.yandex.breadcrumbs.connectors.list')</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            @foreach($connectors as $connector)
                                <div class="callout callout-{{ ($connector->status) ? 'success' : 'danger' }}"
                                     style="background: {{ ($connector->status) ? 'white' : '#FFF5EE' }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="text-bold">
                                                        <i class="fas fa-plug"></i>
                                                        {{ $connector->description }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-11">
                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <span class="text-bold">
                                                                @lang('messages.backups.yandex.fields.connector')
                                                                :
                                                            </span>
                                                        </div>
                                                        <div class="col-8">
                                                            #{{ $connector->id }}
                                                        </div>
                                                    </div>
                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <span class="text-bold">
                                                                @lang('messages.backups.yandex.fields.status'):
                                                            </span>
                                                        </div>
                                                        <div class="col-8">
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
                                                            @if($connector->logs->count() !== 0)
                                                                <div class="badge badge-danger">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                    {{ $connector->logs->count() }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row small">
                                                        <div class="col-4">
                                                            <span class="text-bold">
                                                                @lang('messages.backups.yandex.fields.last_check'):
                                                            </span>
                                                        </div>
                                                        <div class="col-8">
                                                            @empty($connector->lastCheck)
                                                                -
                                                            @else
                                                                {{ $connector->lastCheck }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <span class="btn-group-vertical float-right">
                                                <a href="{{route('backups.yandex.connectors.show',$connector->id)}}"
                                                   class="btn btn-xs btn-outline-info"
                                                   title="@lang('messages.backups.yandex.buttons.title.view')">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route('backups.yandex.connectors.edit', $connector->id)}}"
                                                   class="btn btn-xs btn-outline-warning"
                                                   title="@lang('messages.backups.yandex.buttons.title.edit')">
                                                    <i class="fas fa-pencil-alt"></i></a>

                                                <a href="{{route('backups.yandex.backups.yandex.connectors.refresh', $connector->id)}}"
                                                   class="btn btn-xs btn-outline-success"
                                                   title="@lang('messages.backups.yandex.buttons.title.update_status')">
                                                    <i class="fas fa-sync-alt"></i></a>

                                                @if($connector->trash_size > 0)
                                                            <a href="{{route('backups.yandex.backups.yandex.connectors.clean', $connector->id)}}"
                                                               class="btn btn-xs btn-outline-danger"
                                                               title="Очистка корзины">
                                                        <i class="fas fa-dumpster-fire"></i></a>
                                                        @endif
                                                </span>
                                                </div>
                                            </div>

                                            <div class="row small">
                                                <div class="col-6">
                                                    <i class="fas fa-hdd"></i>
                                                    @lang('messages.backups.yandex.fields.total'):
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
                                                                    {{ $connector->percent_used }}%
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <i class="fas fa-dumpster"></i>
                                                    @lang('messages.backups.yandex.fields.bucket'):
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.titles.errors')
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
                                                <a href="{{ route('backups.yandex.backups.yandex.connectors.resolve') }}"
                                                   class="btn btn-xs btn-outline-dark"
                                                   title="@lang('messages.backups.yandex.buttons.titles.read_all')">
                                                    @lang('messages.backups.yandex.buttons.read_all')
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
