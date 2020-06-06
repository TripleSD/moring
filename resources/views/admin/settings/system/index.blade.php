@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Настройки</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Мониторинг</li>
                        <li class="breadcrumb-item active">Система</li>
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
                            <h3 class="card-title">Система</h3>
                        </div>

                        <div class="card-body">
                            <dt> Операционная система:</dt>
                            <dd>{{ php_uname() }}</dd>
                            <dt> IP адрес сервера:</dt>
                            <dd>{{ request()->server('SERVER_ADDR') }}</dd>
                            <dt> Версия PHP интерпретатора:</dt>
                            <dd>{{ phpversion()  }}</dd>
                            <dt>Временная зона</dt>
                            <dd>{{env('TIMEZONE')}}</dd>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table table-responsive">
                        <thead>
                        <th>Datetime</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>User</th>
                        </thead>
                    @foreach($logs as $log)
                        <tr>
                            <td class="col-2">
                                <span class="small">{{ $log->created_at }}</span>
                            </td>
                            <td class="col-2">
                                <span class="small">{{ $log->service }}</span>
                            </td>
                            <td class="col-3">
                                <span class="small">@lang($log->status)</span>
                            </td>
                            <td class="col-3">
                                <div>
                                    <span class="small">{{ $log->debug_info }}</span>
                                </div>
                                <div>
                                    <span class="small">{{ $log->route }}</span>
                                </div>
                            </td>
                            <td class="col-2">
                                <span class="small">{{ $log->user->name }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
