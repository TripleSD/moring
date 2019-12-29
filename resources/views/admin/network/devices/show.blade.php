@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="nav-icon fas fa-network-wired"></i> Сеть</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Сеть</li>
                        <li class="breadcrumb-item"><a href="{{ route('network.devices.index') }}">Устройства</a></li>
                        <li class="breadcrumb-item active">{{ $device->vendor->title }} {{ $device->model->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Карточка устройства
                            {{ $device->vendor->title }} {{ $device->model->title }}
                        </h3>
                        <div class="btn-group float-right">
                            <a href="{{route('network.devices.index')}}"
                               class="btn btn-sm bg-gradient-info" title="Вернуться">
                                <i class="fa fa-arrow-left"></i></a>
                            <a href="{{route('network.devices.edit', $device->id)}}"
                               class="btn btn-sm bg-gradient-warning"
                               title="Редактирование устройства">
                                <i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <dt>Общая информация</dt>
                                <div class="card-body p-0" style="display: block;">
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
                                            Модель:
                                            <span class="float-right">
                                            {{$device->vendor->title}}
                                                {{$device->model->title}}
                                        </span>
                                        </li>
                                        <li class="small">
                                            ID в базе:
                                            <span class="float-right">{{ $device->id }}
                                        </span>
                                        </li>
                                        <li class="small">
                                            Операционная система:
                                            <span class="float-right">{{ $device->firmware->title }}
                                        </span>
                                        </li>
                                        <li class="small">
                                            Версия прошивки:
                                            <span class="float-right">{{ $device->firmware->version }}
                                        </span>
                                        </li>
                                        <li class="small">
                                            Версия пакетов (только для Mikrotik <a href="#"><i
                                                    class="fas fa-info-circle"></i></a>):
                                            <span class="float-right">{{ $device->packets_version }}
                                        </span>
                                        </li>
                                        <li class="small">
                                            Тип платформы:
                                            <span class="float-right">
                                            @if($device->platform_type == 0)
                                                    <i class="fas fa-network-wired text-success"></i> аппаратная
                                                @else
                                                    <i class="fas fa-cloud text-indigo"></i> облачная
                                                @endif
                                        </span>
                                        </li>
                                        <li class="small">
                                            IP адрес / Имя устройства:
                                            <span class="float-right">{{ $device->hostname }}
                                        </span>
                                        </li>
                                        <li class="small">
                                            SNMP порт:
                                            <span class="float-right">{{ $device->snmp_port }}
                                        </span>
                                        </li>
                                        <li class="small">
                                            Версия SNMP протокола:
                                            <span class="float-right">{{ $device->snmp_version }}
                                        </span>
                                        </li>
                                        <li class="small">
                                            SNMP community:
                                            <span class="float-right">***** (<a href="{{ route('network.devices.edit',
                                            $device->id) }}"> настройки</a>)
                                        </span>
                                        </li>
                                        <li class="small">
                                            Краткое описание:
                                            <span class="float-right">{{ $device->title }}
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <dt>Порты</dt>
                                <div class="small text-danger mt-5 text-center">
                                    В разработке
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
