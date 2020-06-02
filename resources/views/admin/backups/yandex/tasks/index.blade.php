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
                                    <span class="text-muted text-sm">Яндекс Диск</span>
                                    <span class="text-muted text-sm px-1"><i class="fas fa-chevron-right"></i></span>
                                    <span class="text-sm">Список проверок</span>
                                </div>
                            </div>
                            <div class="card-tools">
                                @include('admin.backups.yandex.menu')
                                <div class="btn-group">
                                    <a href="{{route('backups.yandex.tasks.create')}}"
                                       class="btn btn-xs btn-success" title="Добавление нового устройства">
                                        <i class="fa fa-plus-square"></i> Добавить</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Подключение</th>
                                    <th>Доп.информация</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    @if($task->enabled == 1)
                                        <tr class="table-row">
                                    @else
                                        <tr class="table-row" bgcolor="#a9a9a9">
                                            @endif
                                            <td>
                                                <div class="row">
                                                    @if($task->enabled === 1)
                                                        <div class="vl pt-1 text-success"></div>
                                                    @else
                                                        <div class="vl pt-1 text-gray"></div>
                                                    @endif
                                                    <div class="col">
                                                        <div>
                                                            <i class="fas fa-box-open"></i>
                                                        </div>
                                                        <div>
                                                            <div class="small">
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
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="small">
                                                            <b>Коннектор:</b>
                                                                {{ $task->connector->description }}
                                                        </div>
                                                        <div class="small">
                                                            <b>Интервал проверки:</b>
                                                            {{ $task->interval }} час.
                                                        </div>
                                                        <div class="small text-gray">
                                                            <i class="fas fa-history"></i>
                                                            Last check: {{ $task->updated_at }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    <b>Папка:</b>
                                                    {{ $task->folder }}
                                                </div>
                                                <div class="small">
                                                    <b>Файл:</b>
                                                    {{ $task->FullFilename }}
                                                </div>
                                                <div class="small">
                                                    <b>Описание:</b>
                                                    <span style="word-break: break-all;">
                                                        {{ $task->description }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
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
@endsection
