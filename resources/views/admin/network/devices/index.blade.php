@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" text-dark"><i class="nav-icon fas fa-network-wired"></i> Сеть</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Сеть</li>
                        <li class="breadcrumb-item active">Устройства</li>
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
                            <h3 class="card-title">Список устройств</h3>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{route('network.devices.create')}}"
                                       class="btn btn-sm btn-success" title="Добавление нового устройства">
                                        <i class="fa fa-plus-square"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Вендор</th>
                                    <th>Устройство</th>
                                    <th>Платформа / Прошивка</th>
                                    <th>Доп.информация</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devices as $device)
                                    @if($device->enabled == 1)
                                        <tr class="table-row">
                                    @else
                                        <tr class="table-row" bgcolor="#a9a9a9">
                                            @endif
                                            <td>
                                                <div class="row">
                                                    @if($device->enabled === 1)
                                                        <div class="vl pt-1 text-success"></div>
                                                    @else
                                                        <div class="vl pt-1 text-gray"></div>
                                                    @endif
                                                    <div class="col">
                                                        <div>
                                                            @if($device->vendor->title == 'Cisco')
                                                                <img src="/img/vendors/cisco.png">
                                                            @elseif($device->vendor->title == 'MikroTik')
                                                                <img src="/img/vendors/mikrotik.png">
                                                            @elseif($device->vendor->title == 'DLink')
                                                                <img src="/img/vendors/d-link.png">
                                                            @elseif($device->vendor->title == 'Eltex')
                                                                <img src="/img/vendors/eltex.png">
                                                            @endif
                                                        </div>
                                                        <div>
                                                            @if($device->enabled === 1)
                                                                <div class="small">
                                                                    <div class="badge badge-success">
                                                                        @lang('messages.network.device.enabled')
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="small">
                                                                    <div class="small badge badge-secondary">
                                                                        @lang('messages.network.device.disabled')
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="small">
                                                            <b>Имя/IP адрес устройства:</b>
                                                            {{ $device->hostname }}:{{ $device->snmp_port }}
                                                        </div>
                                                        <div class="small">
                                                            <b>Время работы:</b>
                                                            {{ \Carbon\Carbon::now()->addSeconds($device->uptime / 100)->diffInDays() }}
                                                            д.
                                                            {{ \Carbon\Carbon::now()->addSeconds($device->uptime / 100)->diffAsCarbonInterval()->h }}
                                                            ч.
                                                            {{ \Carbon\Carbon::now()->addSeconds($device->uptime / 100)->diffAsCarbonInterval()->i }}
                                                            м.
                                                            {{ \Carbon\Carbon::now()->addSeconds($device->uptime / 100)->diffAsCarbonInterval()->s }}
                                                            с.
                                                        </div>
                                                        <div class="small text-gray">
                                                            <i class="fas fa-history"></i> {{ $device->updated_at }}

                                                            @if($device->ssh_port !== null)
                                                                <div class="badge badge-primary"
                                                                     title="@lang('messages.network.device.ssh_enabled')">
                                                                    <i class="fas fa-terminal"></i>
                                                                    ssh
                                                                </div>
                                                            @else
                                                                <div class="badge badge-secondary"
                                                                     title="@lang('messages.network.device.ssh_disabled')">
                                                                    <i class="fas fa-terminal"></i>
                                                                    ssh
                                                                </div>
                                                            @endif

                                                            @if($device->telnet_port !== null)
                                                                <div class="badge badge-primary"
                                                                     title="@lang('messages.network.device.telnet_enabled')">
                                                                    <i class="fas fa-terminal"></i>
                                                                    telnet
                                                                </div>
                                                            @else
                                                                <div class="badge badge-secondary"
                                                                     title="@lang('messages.network.device.telnet_disabled')">
                                                                    <i class="fas fa-terminal"></i>
                                                                    telnet
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="small">
                                                    <b>ОС:</b> {{ $device->firmware->title }}
                                                    {{ $device->packets_version }}
                                                </div>
                                                @if(!empty($device->firmware->version))
                                                    <div class="small">
                                                        <b>Прошивка:</b> {{ $device->firmware->version }}
                                                    </div>
                                                @endif
                                                <div class="small">
                                                    <b>Модель:</b> {{ $device->model->title }}
                                                    @if($device->platform_type == 0)
                                                        <i class="fas fa-network-wired text-success"></i>
                                                    @else
                                                        <i class="fas fa-cloud text-indigo"></i>
                                                    @endif

                                                    @empty(!$device->human_model)
                                                        ({{$device->human_model}})
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="small">
                                                    <b>Контакты:</b> {{ $device->contact }}
                                                </div>
                                                <div class="small">
                                                    <b>Расположение:</b> {{ $device->location }}
                                                </div>
                                                <div class="small">
                                                    <b>Описание:</b> {{ $device->title }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('network.devices.show',$device->id)}}"
                                                       class="btn btn-xs bg-gradient-info"
                                                       title="Просмотр устройства">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('network.devices.edit', $device->id)}}"
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
