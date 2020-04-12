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

                            <div class="card-body">
                                <div class="col-sm-6">
                                    {{ Form::open([ 'route' => 'network.devices.store', 'method' => 'post', 'enctype' => "multipart/form-data"]) }}
                                    <div class="form-group">
                                        <b>Описание</b>
                                        {{ Form::text('title', null , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Сетевое имя устройства или IP адрес</b>
                                        {{ Form::text('hostname', null , ['class' => 'form-control', 'required', 'placeholder' => 'mydevice.local или 192.168.88.1']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Версия SNMP протокола</b>
                                        {{ Form::text('version', '2' , ['class' => 'form-control', 'required', 'placeholder' => 'Пример: 2']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Порт SNMP</b>
                                        {{ Form::text('port', '161', ['class' => 'form-control', 'required', 'placeholder' => 'Пример: 161']) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>SNMP community</b>
                                        {{Form::text('community', 'public', ['class' => 'form-control', 'required', 'placeholder' => 'Пример: public'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>SSH порт</b>
                                        {{Form::text('port_ssh', null, ['class' => 'form-control', 'placeholder' => 'Пример: 22'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Telnet порт</b>
                                        {{Form::text('port_telnet', null, ['class' => 'form-control', 'placeholder' => 'Пример: 23'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Web консоль управления</b>
                                        {{Form::text('web_url', null, ['class' => 'form-control', 'placeholder' => 'Пример: http://127.0.0.1'])}}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <div class="form-group">
                                        <b>Вкл/Выкл</b>
                                        {{ Form::checkbox('enabled', true, true) }}
                                        <details class="mt--3 small">
                                            <summary>
                                                Дополнительная информация
                                            </summary>
                                            ...
                                        </details>
                                    </div>

                                    <button type="submit" class="btn btn-xs bg-gradient-cyan">Добавить</button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
