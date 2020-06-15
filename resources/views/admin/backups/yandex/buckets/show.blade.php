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
                                <a href="{{ url()->previous() }}"
                                   class="btn btn-xs btn-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i>
                                    @lang('messages.backups.yandex.buttons.title.back')
                                </a>
                                <a href="{{route('backups.ftp.edit', $bucket->id)}}"
                                   class="btn btn-xs bg-gradient-warning"
                                   title="Редактиование профиля">
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
                            <dt>@lang('messages.network.device.summary_information')</dt>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    Наименование
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    ID:
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    URL
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Мониторинг состояния сайта
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Файл мониторинга
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Используется HTTPS
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Контроль SSL
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    HTTP ответ сервера
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Версия Web сервера
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Контроль версии PHP
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Last update:
                                    <span class="float-right">

                                    </span>
                                </li>
                                <li class="small">
                                    Комментарий:
                                    <span class="float-right">
{{--                                        {{ $task->description }}--}}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">

{{--                    @if($task->logs->count() !== 0)--}}
{{--                        <div class="card card-warning">--}}
{{--                            <div class="card-header">--}}
{{--                                <dt>@lang('messages.network.device.notifications_and_errors')</dt>--}}
{{--                            </div>--}}
{{--                            @if($task->logs !== null)--}}
{{--                                <div class="card-body table-responsive p-0">--}}
{{--                                    <table class="table table-hover">--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($task->logs as $log)--}}
{{--                                            <tr>--}}
{{--                                                <td class="small">--}}
{{--                                                    @if($log->resolved === 1)--}}
{{--                                                        <span class="badge badge-secondary">--}}
{{--                                                            <i class="fas fa-eye"></i>--}}
{{--                                                        </span>--}}
{{--                                                        <span class="badge badge-secondary">--}}
{{--                                                            @lang('messages.network.device.type_status.alert')--}}
{{--                                                        </span>--}}
{{--                                                    @else--}}
{{--                                                        <span class="badge badge-danger">--}}
{{--                                                            <i class="fas fa-eye"></i>--}}
{{--                                                        </span>--}}
{{--                                                        @if($log->type === 1)--}}
{{--                                                            <span class="badge badge-danger">--}}
{{--                                                                @lang('messages.network.device.type_status.alert')--}}
{{--                                                            </span>--}}
{{--                                                        @else--}}
{{--                                                            <span class="badge badge-success">--}}
{{--                                                                @lang('messages.network.device.type_status.info')--}}
{{--                                                            </span>--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                                <td class="small">--}}
{{--                                                    @if($log->type === 1)--}}
{{--                                                        @lang('messages.network.device.snmp.device.log.down')--}}
{{--                                                    @else--}}
{{--                                                        @lang('messages.network.device.snmp.device.log.up')--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                                <td class="small">--}}
{{--                                                    {{\Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')}}--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <a class="btn btn-" href=""></a>--}}
{{--                                                    <i class="fas fa-eye"></i>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="card card-gray">--}}
{{--                            <div class="card-header">--}}
{{--                                <dt>@lang('messages.network.device.notifications_and_errors')</dt>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
