@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0 text-dark">Сетевые устройства</h1>
                </div>
                <div class="col-sm-8">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Сеть</li>
                        <li class="breadcrumb-item active">Сетевые устройства</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Добавление нового устройства</h3>
                                <div class="card-tools">
                                    <a href="{{route('network.devices.index')}}"
                                       class="btn btn-sm bg-gradient-info" title="Вернуться">
                                        <i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="col-sm-6">
                                    {{ Form::open([ 'url' => route('network.devices.update', $device->id), 'method' => 'put', 'enctype' => "multipart/form-data"]) }}
                                    <div class="form-group">
                                        <b>Описание</b>
                                        {{ Form::text('title', $device->title , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Сетевое имя устройства или IP адрес</b>
                                        {{ Form::text('hostname', $device->hostname , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Версия SNMP протокола</b>
                                        {{ Form::text('version', $device->version , ['class' => 'form-control', 'required', 'placeholder' => 'Пример: 2']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Порт SNMP</b>
                                        {{ Form::text('port', $device->port, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: 161']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>SNMP community</b>
                                        {{Form::text('community', $device->community, ['class' => 'form-control', 'required', 'placeholder' => 'Пример: public'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>SSH порт</b>
                                        {{Form::text('port_ssh', $device->port_ssh, ['class' => 'form-control', 'placeholder' => 'Пример: 22'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Telnet порт</b>
                                        {{Form::text('port_telnet', $device->port_telnet, ['class' => 'form-control', 'placeholder' => 'Пример: 23'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Web консоль управления</b>
                                        {{Form::text('web_url', $device->web_url, ['class' => 'form-control', 'placeholder' => 'Пример: http://127.0.0.1'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Вкл/Выкл</b>
                                        {{ Form::checkbox('enabled', true, $device->enabled) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-xs bg-gradient-success">Обновить</button>
                                        {{ Form::close() }}

                                        <div class="float-right">
                                            {{Form::open([ 'url' => route('network.devices.destroy', $device->id), 'method' => 'delete', 'enctype' => "multipart/form-data"])}}
                                            <button type="submit" class="btn btn-xs bg-gradient-red">Удалить
                                            </button>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
