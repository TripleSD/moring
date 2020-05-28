@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" text-dark"><i class="nav-icon fas fa-network-wired"></i> Сеть</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Сеть</li>
                        <li class="breadcrumb-item active">Устройства</li>
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
                            <h3 class="card-title">Список устройств</h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{route('network.devices.create')}}"
                                       class="btn btn-sm btn-success" title="Добавление нового устройства">
                                        <i class="fa fa-plus-square"></i></a>
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
                                                            <b>Имя/IP адрес устройства:</b>
                                                            {{ $task->hostname }}
                                                        </div>
                                                        <div class="small">
                                                            <b>Порт:</b>
                                                            {{ $task->port }}
                                                        </div>
                                                        <div class="small text-gray">
                                                            <i class="fas fa-history"></i>
                                                            Last check: {{ $task->logs->last()->created_at }}
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
                                                    {{ $task->pre }}
                                                    {{ $task->filename }}
                                                    {{ $task->post }}
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
                                                    <a href="{{route('backups.ftp.show',$task->id)}}"
                                                       class="btn btn-xs bg-gradient-info"
                                                       title="Просмотр устройства">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('backups.ftp.edit', $task->id)}}"
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
