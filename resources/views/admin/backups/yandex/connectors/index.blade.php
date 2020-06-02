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
                                    <span class="text-sm">Список коннекторов</span>
                                </div>
                            </div>
                            <div class="card-tools">
                                @include('admin.backups.yandex.menu')
                                <div class="btn-group">
                                    <a href="{{route('backups.yandex.connectors.create')}}"
                                       class="btn btn-xs btn-success" title="Добавление нового устройства">
                                        <i class="fas fa-plus-square"></i> Добавить</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($connectors as $connector)
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row small">
                                                    <div class="col-6">
                                                        <b>Идентификатор:</b>
                                                    </div>
                                                    <div class="col-6">
                                                        #{{ $connector->id }}
                                                    </div>
                                                </div>
                                                <div class="row small">
                                                    <div class="col-6">
                                                        <b>Краткое описание:</b>
                                                    </div>
                                                    <div class="col-6">
                                                        {{ $connector->description }}
                                                    </div>
                                                </div>
                                                <div class="row small">
                                                    <div class="col-6">
                                                        <b>Статус:</b>
                                                    </div>
                                                    <div class="col-6">
                                                                <span
                                                                    class="badge {{ ($connector->status) ? 'badge-success' : 'badge-gray' }}">
                                                                    Активен
                                                                </span>
                                                        {{ $connector->http_code }}
                                                    </div>
                                                </div>
                                                <div class="row small">
                                                    <div class="col-6">
                                                        <b>Последний опрос:</b>
                                                    </div>
                                                    <div class="col-6">
                                                        {{ $connector->status_updated_at }}
                                                    </div>
                                                </div>

                                                <hr/>

                                                <div class="row small">
                                                    <div class="col-12">
                                                        <i class="fas fa-hdd"></i>
                                                        Total: {{ $connector->used_space }} Гб из
                                                        {{ $connector->total_space }} Гб
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
                                                    </div>
                                                </div>
                                                <div class="row small">
                                                    <div class="col-12">
                                                        <i class="fas fa-dumpster"></i>
                                                        Trash: {{ $connector->trash_size }} Гб из
                                                        {{ $connector->total_space }} Гб
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                 aria-valuenow="{{ $connector->percent_bucket_used }}"
                                                                 aria-valuemin="0" aria-valuemax="100"
                                                                 style="width: {{ $connector->percent_bucket_used }}%">
                                                    <span
                                                        class="text-dark">{{ $connector->percent_bucket_used }}% Used</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                    <span class="btn-group float-right">
                                                <a href="{{route('backups.yandex.connectors.show',$connector->id)}}"
                                                   class="btn btn-xs bg-info"
                                                   title="Просмотр устройства">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route('backups.yandex.connectors.edit', $connector->id)}}"
                                                   class="btn btn-xs bg-warning"
                                                   title="Редактирование устройства">
                                                    <i class="fas fa-pencil-alt"></i></a>

                                                <a href="{{route('backups.yandex.backups.yandex.connectors.refresh', $connector->id)}}"
                                                   class="btn btn-xs bg-success"
                                                   title="Обновить данные">
                                                    <i class="fas fa-sync-alt"></i></a>

                                                @if($connector->trash_size > 0)
                                                            <a href="{{route('backups.yandex.backups.yandex.connectors.clean', $connector->id)}}"
                                                               class="btn btn-xs bg-danger"
                                                               title="Очистка корзины">
                                                        <i class="fas fa-dumpster-fire"></i></a>
                                                        @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
