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
                                        <a href="{{ route('backups.yandex.buckets.index') }}">
                                            @lang('messages.backups.yandex.breadcrumbs.buckets.list')
                                        </a>
                                    </span>
                                    <span class="text-muted text-sm px-1 d-none d-sm-block">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm d-none d-sm-block">
                                        @lang('messages.backups.yandex.breadcrumbs.buckets.show')
                                    </span>
                                </div>
                            </div>
                            <span class="float-right">
                                <a href="{{ route('backups.yandex.buckets.index') }}"
                                   class="btn btn-xs btn-info"
                                   title="@lang('messages.backups.yandex.buttons.title.back')">
                                    <i class="fa fa-arrow-left"></i>
                                    @lang('messages.backups.yandex.buttons.title.back')
                                </a>
                                <a href="{{route('backups.yandex.buckets.edit', $bucket->id)}}"
                                   class="btn btn-xs bg-gradient-warning"
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
                        <h3>@lang('messages.backups.yandex.breadcrumbs.buckets.show')</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <span class="text-muted text-sm">
                                  @lang('messages.backups.yandex.tasks.titles.summary_information')
                              </span>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 text-bold">
                                            @lang('messages.backups.yandex.fields.description'):
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $bucket->description }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 text-bold">
                                            @lang('messages.backups.yandex.fields.status'):
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            @if($bucket->enabled === 1)
                                                <div class="badge badge-success">
                                                    @lang('messages.backups.yandex.fields.enabled')
                                                </div>
                                            @else
                                                <div class="small badge badge-secondary">
                                                    @lang('messages.backups.yandex.fields.disabled')
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 text-bold">
                                            @lang('messages.backups.yandex.fields.connector'):
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $bucket->connector->description }}
                                            (id: {{ $bucket->connector->id }})
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 text-bold">
                                            @lang('messages.backups.yandex.fields.interval'):
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $bucket->interval }}
                                            @lang('messages.backups.yandex.fields.hour')
                                        </div>
                                    </div>
                                </li>
                                <li class="small" style="word-wrap:">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 text-bold">
                                            @lang('messages.backups.yandex.fields.created'):
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ \Carbon\Carbon::parse($bucket->created_at)->format('Y-m-d_H:i:s') }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 text-bold">
                                            @lang('messages.backups.yandex.fields.last_check'):
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            @empty($bucket->lastCheck)
                                                -
                                            @else
                                                {{ \Carbon\Carbon::parse($bucket->lastCheck)->format('Y-m-d_H:i:s') }}
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 text-bold">
                                            @lang('messages.backups.yandex.fields.comment'):
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $bucket->comment }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                        <div class="card card">
                            <div class="card-header">
                                 <span class="text-muted text-sm">
                                    @lang('messages.backups.yandex.tasks.titles.errors')
                                 </span>
                                <span
                                    class="badge badge-{{ ($bucket->active_logs->count() > 0) ? 'danger' : 'success'}}">
                                    {{ $bucket->active_logs->count() }}
                                </span>
                            </div>
                            @if($bucket->active_logs !== null)
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tbody>
                                        @foreach($bucket->active_logs as $log)
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
@endsection
