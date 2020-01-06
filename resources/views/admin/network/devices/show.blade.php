@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-network-wired"></i> @lang('messages.network.device.title')
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">
                                @lang('messages.network.device.breadcrumbs.main')</a>
                        </li>
                        <li class="breadcrumb-item">
                            @lang('messages.network.device.breadcrumbs.network')
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('network.devices.index') }}">
                                @lang('messages.network.device.breadcrumbs.devices')
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $device->vendor->title }} {{ $device->model->title }}</li>
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
                            <h3 class="card-title">
                                @lang('messages.network.device.card_title')
                                {{ $device->vendor->title }} {{ $device->model->title }}
                            </h3>
                            <div class="btn-group float-right">
                                <a href="{{route('network.devices.index')}}"
                                   class="btn btn-sm bg-gradient-info" title="@lang('messages.network.device.back')">
                                    <i class="fa fa-arrow-left"></i></a>
                                <a href="{{route('network.devices.edit', $device->id)}}"
                                   class="btn btn-sm bg-gradient-warning"
                                   title="@lang('messages.network.device.edit')">
                                    <i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.summary_information')</dt>
                        </div>
                        <div class="card-body">
                            <blockquote class="quote-secondary">
                                @if($device->vendor->title == 'Cisco')
                                    <img src="/img/vendors/cisco.png">
                                @elseif($device->vendor->title == 'MikroTik')
                                    <img src="/img/vendors/mikrotik.png">
                                @elseif($device->vendor->title == 'D-Link')
                                    <img src="/img/vendors/d-link.png">
                                @elseif($device->vendor->title == 'Eltex')
                                    <img src="/img/vendors/eltex.png">
                                @endif
                            </blockquote>
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    @lang('messages.network.device.model'):
                                    <span class="float-right">
                                            {{$device->vendor->title}}
                                        {{$device->model->title}}
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.in_base'):
                                    <span class="float-right">{{ $device->id }}
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.operation_system'):
                                    <span class="float-right">{{ $device->firmware->title }}
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.firmware_version'):
                                    <span class="float-right">{{ $device->firmware->version }}
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.packets_version'):
                                    <a href="#"><i class="fas fa-question-circle"></i></a>
                                    <span class="float-right">{{ $device->packets_version }}
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.platform_type'):
                                    <span class="float-right">
                                            @if($device->platform_type == 0)
                                            <i class="fas fa-network-wired text-success"></i>
                                            @lang('messages.network.device.platform_type.hardware')
                                        @else
                                            <i class="fas fa-cloud text-indigo"></i>
                                            @lang('messages.network.device.platform_type.cloud')
                                        @endif
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.hostname'):
                                    <span class="float-right">{{ $device->hostname }}
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.snmp_port'):
                                    <span class="float-right">{{ $device->snmp_port }}
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.snmp_protocol'):
                                    <span class="float-right">{{ $device->snmp_version }}
                                        </span>
                                </li>
                                <li class="small">
                                    SNMP community:
                                    <span class="float-right">***** (<a href="{{ route('network.devices.edit',
                                            $device->id) }}">
                                            @lang('messages.network.device.settings')
                                        </a>)
                                        </span>
                                </li>
                                <li class="small">
                                    @lang('messages.network.device.short_description'):
                                    <span class="float-right">{{ $device->title }}
                                        </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.notifications_and_errors')</dt>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="small"><b>@lang('messages.network.device.error_description')</b></th>
                                    <th class="small"><b>@lang('messages.network.device.date_time')</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td class="small">
                                            @lang('messages.network.device.snmp_fail')
                                            @if($log->type === 1)
                                                <span class="badge badge-danger">
                                                    @lang('messages.network.device.type_status.error')
                                                </span>
                                                @endif
                                        </td>
                                        <td class="small">
                                            {{$log->created_at}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.ports')</dt>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.other')</dt>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
