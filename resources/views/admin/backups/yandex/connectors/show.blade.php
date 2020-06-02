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
                                    <span class="text-sm">Просмотр коннектора</span>
                                </div>
                            </div>
                            <span class="float-right">
                                <a href="{{route('backups.yandex.connectors.index')}}"
                                   class="btn btn-xs bg-gradient-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i> Назад</a>
                                <a href="{{route('backups.yandex.connectors.edit', $connector->id)}}"
                                   class="btn btn-xs bg-gradient-warning"
                                   title="Редактиование профиля">
                                    <i class="fas fa-edit"></i> Правка</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.summary_information')</dt>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    Краткое описание:
                                    <span class="float-right">
{{ $connector->description }}
                                                </span>
                                </li>
                                <li class="small">
                                    Token:
                                    <span class="float-right">
                                        {{ $connector->token }}
                                    </span>
                                </li>
                                <li class="small">
                                    Статус:
                                    <span class="float-right">
                                        <span class="badge {{ ($connector->status) ? 'badge-success' : 'badge-gray' }}">
                                            Активен
                                        </span>
                                        {{ $connector->http_code }}
                                    </span>
                                </li>
                                <li class="small">
                                    Последний опрос:
                                    <span class="float-right">
                                        {{ $connector->status_updated_at }}
                                    </span>
                                </li>
                                <li class="small">
                                    Комментарий:
                                    <span class="float-right">
                                        {{ $connector->description }}
                                    </span>
                                </li>
                                <li class="small">
                                    <i class="fas fa-dumpster"></i>
                                    Trash: {{ $connector->trash_size / 1024 / 1024 / 1024}} Гб из
                                    {{ $connector->total_space / 1024 / 1024 / 1024 }} Гб
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                             aria-valuenow="{{ $connector->percent_bucket_used }}"
                                             aria-valuemin="0" aria-valuemax="100"
                                             style="width: {{ $connector->percent_bucket_used }}%">
                                                    <span
                                                        class="text-dark">{{ $connector->percent_bucket_used }}% Used</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <i class="fas fa-hdd"></i>
                                    Total: {{ $connector->used_space / 1024 / 1024 / 1024}} Гб из
                                    {{ $connector->total_space / 1024 / 1024 / 1024 }} Гб
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-primary"
                                             role="progressbar"
                                             aria-valuenow="{{ $connector->percent_used }}"
                                             aria-valuemin="0" aria-valuemax="100"
                                             style="width: {{ $connector->percent_used }}%">
                                                        <span
                                                            class="text-dark">{{ $connector->percentused }}% Used</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
