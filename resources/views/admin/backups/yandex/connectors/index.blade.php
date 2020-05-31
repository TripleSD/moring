@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" text-dark"><i class="nav-icon fas fa-box-open"></i> Backups</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Backups</li>
                        <li class="breadcrumb-item active">Yandex Disk</li>
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
                            <h3 class="card-title">Список коннекторов</h3>
                            <div class="btn-group px-1">
                                <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.connectors.index')) ? 'btn-danger' : 'btn-dark' }}"
                                   href="{{ route('backups.yandex.connectors.index') }}"
                                   title="Просмотр устройства">
                                    Коннекторы
                                </a>
                                <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.tasks.index')) ? 'btn-danger' : 'btn-dark' }}"
                                   href="{{ route('backups.yandex.tasks.index') }}" title="Просмотр устройства">
                                    Проверки
                                </a>
                                <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.trash.index')) ? 'btn-danger' : 'btn-dark' }}"
                                   href="{{ route('backups.yandex.trash.index') }}"
                                   title="Редактирование устройства">
                                    Корзины</a>
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{route('backups.ftp.create')}}"
                                       class="btn btn-xs btn-success" title="Добавление нового устройства">
                                        <i class="fas fa-plus-square"></i> Новый</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Подключение</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($connectors as $connector)
                                    <tr class="table-row">
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="small">
                                                    <span
                                                        class="{{ ($connector->status) ? 'text-success' : 'text-gray' }}">
                                                            <i class="fab fa-yandex"></i>
                                                            <i class="fas fa-link"></i>
                                                            </span>
                                                        {{ $connector->description }}
                                                    </div>
                                                    <div class="small">
                                                    Последнее подключение {{ $connector->status_updated_at }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('backups.yandex.connectors.show',$connector->id)}}"
                                                   class="btn btn-xs bg-gradient-info"
                                                   title="Просмотр устройства">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route('backups.yandex.connectors.edit', $connector->id)}}"
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
