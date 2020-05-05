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
                                @if($device->vendor->title == 'Cisco')
                                    <img src="/img/vendors/cisco.png">
                                @elseif($device->vendor->title == 'Mikrotik')
                                    <img src="/img/vendors/mikrotik.png">
                                @elseif($device->vendor->title == 'DLink')
                                    <img src="/img/vendors/d-link.png">
                                @elseif($device->vendor->title == 'Eltex')
                                    <img src="/img/vendors/eltex.png">
                                @endif
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
                    <div class="card card-info">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.summary_information')</dt>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="small">
                                    @lang('messages.network.device.model'):
                                    <span class="float-right">
                                        {{$device->vendor->title}} {{$device->model->title}}
                                        @if($device->serial_number)
                                            (SN: {{$device->serial_number}})
                                        @endif
                                    </span>
                                </li>
                                <li class="small">
                                    ID:
                                    <span class="float-right">
                                        {{ $device->id }}
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
                                    @lang('messages.network.device.short_description'):
                                    <span class="float-right">{{ $device->title }}
                                        </span>
                                </li>
                                <li class="small">
                                    Location:
                                    <span class="float-right">
                                        {{ $device->location }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.poll_information')</dt>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
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
                                    <span class="float-right">
                                        {{ $device->snmp_community }}
                                    </span>
                                </li>
                                <li class="small">
                                    Последнее время опроса:
                                    <span class="float-right">
                                        {{ \Carbon\Carbon::parse($device->updated_at)->format('d.m.Y H:i:s') }}
                                    </span>
                                </li>
                                <li class="small">
                                    SSH:
                                    <span class="float-right">
                                    @if($device->port_ssh !== null)
                                            ssh://{{$device->hostname}}:{{$device->port_ssh}}
                                            <a class="badge badge-primary"
                                               href="ssh://{{$device->hostname}}:{{$device->port_ssh}}"
                                               title="@lang('messages.network.device.ssh_enabled')">
                                            <i class="fas fa-terminal"></i>
                                            </a>
                                        @else
                                            <div class="badge badge-secondary"
                                                 title="@lang('messages.network.device.ssh_disabled')">
                                            <i class="fas fa-terminal"></i>
                                        </div>
                                        @endif
                                    </span>
                                <li class="small">
                                    Telnet:
                                    <span class="float-right">
                                    @if($device->port_telnet !== null)
                                            telnet://{{$device->hostname}}:{{$device->port_telnet}}
                                            <a class="badge badge-primary"
                                               href="telnet://{{$device->hostname}} {{$device->port_telnet}}"
                                               title="@lang('messages.network.device.telnet_enabled')">
                                                <i class="fas fa-terminal"></i>
                                            </a>
                                        @else
                                            <div class="badge badge-secondary"
                                                 title="@lang('messages.network.device.telnet_disabled')">
                                            <i class="fas fa-terminal"></i>
                                        </div>
                                        @endif
                                    </span>
                                </li>
                                <li class="small">
                                    Web:
                                    <span class="float-right">
                                    @if($device->web_url !== null)
                                            {{ $device->web_url }}
                                            <a class="text-primary" href="{{ $device->web_url}}"
                                               title="@lang('messages.network.device.web_enabled')" target="_blank">
                                                <i class="fas fa-globe"></i>
                                            </a>
                                        @else
                                            <div class="text-secondary"
                                                 title="@lang('messages.network.device.web_disabled')">
                                                 <i class="fas fa-globe"></i>
                                            </div>
                                        @endif
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    @if($device->logs->count() !== 0)
                        <div class="card card-warning">
                            <div class="card-header">
                                <dt>@lang('messages.network.device.notifications_and_errors')</dt>
                            </div>
                            @if($device->logs !== null)
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tbody>
                                        @foreach($logs as $log)
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
                                                    <a class="btn btn-" href=""
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

                <div class="col-6">
                    <div class="card card-gray">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.ports')</dt>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card card-gray">
                        <div class="card-header">
                            <dt>@lang('messages.network.device.other')</dt>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
