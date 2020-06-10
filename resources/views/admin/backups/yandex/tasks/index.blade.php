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
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.breadcrumbs.dashboard')
                                    </span>
                                    <span class="text-muted text-sm px-1">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.breadcrumbs.backups')
                                    </span>
                                    <span class="text-muted text-sm px-1">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm">
                                        @lang('messages.backups.yandex.breadcrumbs.yandex')
                                    </span>
                                    <span class="text-muted text-sm px-1">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-sm">
                                        @lang('messages.backups.yandex.breadcrumbs.tasks.list')
                                    </span>
                                </div>
                            </div>
                            <div class="card-tools">
                                @include('admin.backups.yandex.menu')
                                <div class="btn-group">
                                    <a href="{{route('backups.yandex.tasks.create')}}"
                                       class="btn btn-xs btn-success" title="Добавление нового устройства">
                                        <i class="fa fa-plus-square"></i>
                                        @lang('messages.backups.yandex.buttons.add')
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="#"
                                       class="btn btn-xs btn-outline-dark" title="Добавление нового устройства"
                                       target="_blank">
                                        Help
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6" bgcolor="red">
                            @foreach($tasks as $task)
                                <div class="callout callout-{{ ($task->enabled) ? 'success' : 'default' }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <b>
                                                        <i class="fas fa-bookmark"></i>
                                                        {{ $task->description }}
                                                    </b>
                                                    <span class="small text-muted">#{{ $task->id }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-11">
                                                    <div class="row small">
                                                        <div class="col-3">
                                                            <b>Status:</b>
                                                        </div>
                                                        <div class="col-9">
                                                            @if($task->enabled === 1)
                                                                <div class="badge badge-success">
                                                                    @lang('messages.network.device.enabled')
                                                                </div>
                                                            @else
                                                                <div class="small badge badge-secondary">
                                                                    @lang('messages.network.device.disabled')
                                                                </div>
                                                            @endif

                                                            @if($task->logs->count() !== 0)
                                                                <div class="badge badge-danger">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                    {{ $task->logs->count() }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row small">
                                                        <div class="col-3">
                                                            <b>Коннектор:</b>
                                                        </div>
                                                        <div class="col-9">
                                                            {{ $task->connector->description }}
                                                            (id: {{ $task->connector->id }})
                                                        </div>
                                                    </div>
                                                    <div class="row small">
                                                        <div class="col-3">
                                                            <b>Интервал:</b>
                                                        </div>
                                                        <div class="col-9">
                                                            {{ $task->interval }} час.
                                                            <i class="fas fa-chevron-right"></i>
                                                            <b>Last update:</b>
                                                            @empty($task->lastCheck)
                                                                -
                                                            @else
                                                                {{ $task->lastCheck }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row small">
                                                        <div class="col-3">
                                                            <b>Файл:</b>
                                                        </div>
                                                        <div class="col-9">
                                                            @empty($task->folder)
                                                                {{ $task->FullFilename }}
                                                            @else
                                                                /{{ $task->folder }}/{{ $task->FullFilename }}
                                                            @endempty
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="btn-group-vertical float-right">
                                                        <a href="{{route('backups.yandex.tasks.show',$task->id)}}"
                                                           class="btn btn-xs bg-gradient-info"
                                                           title="Просмотр устройства">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{route('backups.yandex.tasks.edit', $task->id)}}"
                                                           class="btn btn-xs bg-gradient-warning"
                                                           title="Редактирование устройства">
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
                                        @lang('messages.backups.yandex.tasks.titles.errors')
                                    </span>
                                    <span class="badge badge-{{ ($logCount > 0) ? 'danger' : 'success'}}">
                                        {{ $logCount }}
                                    </span>
                                    <div class="float-right">
                                        <div class="btn-group">
                                            <a href="#"
                                               class="btn btn-xs btn-outline-info" title="Добавление нового устройства">
                                                <i class="fas fa-eye"></i> Все записи
                                            </a>
                                            @if($logCount > 0)
                                                <a href="{{ route('backups.yandex.backups.yandex.tasks.resolve') }}"
                                                   class="btn btn-xs btn-outline-info"
                                                   title="Добавление нового устройства">
                                                    <i class="fas fa-fire-extinguisher"></i> Прочитать все
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
                                                            @lang('messages.backups.yandex.tasks.log.error')
                                                        </span>
                                                    </td>
                                                    <td class="small">
                                                        <span {{ ($log->resolved === 1) ? 'class=text-muted' : '' }}>
                                                            @lang('messages.backups.yandex.tasks.log.task')
                                                            #{{ $log->task_id }} |
                                                            @lang('messages.backups.yandex.tasks.log.no_file')
                                                        </span>
                                                    </td>
                                                    <td class="small">
                                                        <span {{ ($log->resolved === 1) ? 'class=text-muted' : '' }}>
                                                            {{\Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')}}
                                                        </span>
                                                    </td>
                                                    <td class="small">
                                                        <span {{ ($log->resolved === 1) ? 'class=text-muted' : '' }}>
                                                            <a class="btn btn-"
                                                               href=""></a>
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
