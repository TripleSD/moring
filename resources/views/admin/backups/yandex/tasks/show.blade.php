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
                                <a href="{{ route('backups.yandex.tasks.index') }}"
                                   class="btn btn-xs btn-info"
                                   title="@lang('messages.backups.yandex.buttons.title.back')">
                                    <i class="fa fa-arrow-left"></i>
                                    @lang('messages.backups.yandex.buttons.title.back')
                                </a>
                                <a href="{{route('backups.yandex.tasks.edit', $task->id)}}"
                                   class="btn btn-xs btn-warning"
                                   title="@lang('messages.backups.yandex.buttons.title.edit')">
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
                    <div class="card">
                        <div class="card-header">
                              <span class="text-muted text-sm">
                                  @lang('messages.backups.yandex.tasks.titles.summary_information')
                              </span>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                            <span class="text-bold">
                                                @lang('messages.backups.yandex.fields.description'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->description }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small mt--3">
                                    <div class="row">
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
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.connector'):
                                    </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->connector->description }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                            <span class="text-bold">
                                                @lang('messages.backups.yandex.fields.folder'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->folder }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                            <span class="text-bold">
                                                @lang('messages.backups.yandex.fields.pre_suffix'):
                                            </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->pre }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.post_suffix'):
                                    </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->post }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.file'):
                                    </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->filename }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                       @lang('messages.backups.yandex.fields.interval'):
                                    </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->interval }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">
                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                       @lang('messages.backups.yandex.fields.last_check'):
                                    </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->updated_at }}
                                        </div>
                                    </div>
                                </li>
                                <li class="small">

                                    <div class="row">
                                        <div class="col-lg-4 col-5">
                                    <span class="text-bold">
                                        @lang('messages.backups.yandex.fields.comment'):
                                    </span>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            {{ $task->comment }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
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
@endsection
