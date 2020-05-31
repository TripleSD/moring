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
                                <span class="text-muted">Home | Backup | Список коннекторов Яндекс Диск</span>
                            </div>
                            <div class="card-tools">
                                <div class="btn-group">
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
                                <div class="btn-group">
                                    <a href="{{route('backups.yandex.connectors.create')}}"
                                       class="btn btn-xs btn-success" title="Добавление нового устройства">
                                        <i class="fas fa-plus-square"></i> Добавить</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
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
