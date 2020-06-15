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
                                        <a href="{{ route('backups.yandex.tasks.index') }}">
                                            @lang('messages.backups.yandex.breadcrumbs.tasks.list')
                                        </a>
                                    </span>
                                    <span class="text-muted text-sm px-1 d-none d-sm-block">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="text-muted text-sm d-none d-sm-block">
                                        @lang('messages.backups.yandex.breadcrumbs.tasks.show')
                                    </span>
                                </div>
                            </div>
                            <span class="float-right">
                                <a href="{{ url()->previous() }}"
                                   class="btn btn-xs btn-info" title="Вернуться">
                                    <i class="fa fa-arrow-left"></i>
                                    @lang('messages.backups.yandex.buttons.title.back')
                                </a>
                                <a href="{{route('backups.yandex.tasks.edit', $task->id)}}"
                                   class="btn btn-xs btn-warning"
                                   title="Редактиование профиля">
                                    <i class="fa fa-edit"></i>
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
                        <h3>@lang('messages.backups.yandex.breadcrumbs.tasks.show')</h3>
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
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.description'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->description }}
                                </div>
                            </div>
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.status'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    @if($task->enabled === 1)
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
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.connector'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->connector->description }}
                                </div>
                            </div>
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.folder'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->folder }}
                                </div>
                            </div>
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.pre_suffix'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->pre }}
                                </div>
                            </div>
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.post_suffix'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->post }}
                                </div>
                            </div>
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.file'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->filename }}
                                </div>
                            </div>
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                       @lang('messages.backups.yandex.fields.interval'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->interval }}
                                </div>
                            </div>
                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                       @lang('messages.backups.yandex.fields.last_check'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->updated_at }}
                                </div>
                            </div>

                            <hr/>

                            <div class="row small">
                                <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.comment'):
                                    </span>
                                </div>
                                <div class="col-lg-8 col-7">
                                    {{ $task->comment }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    @if($task->active_logs->count() !== 0)
                        <div class="card card-warning">
                            <div class="card-header">
                                <span class="text-muted text-sm">
                                    @lang('messages.backups.yandex.tasks.titles.errors')
                                </span>
                                <span class="badge badge-{{ ($task->active_logs->count() > 0) ? 'danger' : 'success'}}">
                                {{ $task->active_logs->count() }}
                            </span>
                            </div>
                            @if($task->active_logs !== null)
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tbody>
                                        @foreach($task->active_logs as $log)
                                            <tr>
                                                <td class="small">
                                                    @if($log->resolved === 1)
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                        <span class="badge badge-secondary">
                                                            @lang('messages.network.device.type_status.alert')
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                        @if($log->type === 1)
                                                            <span class="badge badge-danger">
                                                                @lang('messages.network.device.type_status.alert')
                                                            </span>
                                                        @else
                                                            <span class="badge badge-success">
                                                                @lang('messages.network.device.type_status.info')
                                                            </span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="small">
                                                    @if($log->type === 1)
                                                        @lang('messages.network.device.snmp.device.log.down')
                                                    @else
                                                        @lang('messages.network.device.snmp.device.log.up')
                                                    @endif
                                                </td>
                                                <td class="small">
                                                    {{\Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')}}
                                                </td>
                                                <td>
                                                    <a class="btn btn-" href=""></a>
                                                    <i class="fas fa-eye"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="card card-gray">
                            <div class="card-header">
                                <dt>@lang('messages.network.device.notifications_and_errors')</dt>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
