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
                        <li class="breadcrumb-item">Настройки</li>
                        <li class="breadcrumb-item active">Интеграции</li>
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
                            <h3 class="card-title">Интеграции</h3>
                        </div>


                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                         aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                           href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                           aria-selected="true"><i class="fab fa-telegram text-info"></i> Телеграм</a>
                                    </div>
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade active show" id="vert-tabs-home"
                                             role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                            {{ Form::open(['url' => route('settings.integrations.telegram.update'), 'method' => 'patch']) }}
                                            <p>
                                                <dt>Bot API Token</dt>
                                                {{ Form::text('telegram_api_key', $apiToken , ['class' => 'form-control',
                                                    'placeholder' => 'Пример: 101xxxxxx:1AF1223........']) }}
                                                <details class="small">
                                                    <summary>Подробнее</summary>
                                                    Указывается APIKEY бота
                                                </details>
                                            </p>
                                            <p>
                                                <dt>ChatID</dt>
                                                {{ Form::text('telegram_group_chat_id', $chatId , ['class' => 'form-control',
                                                    'placeholder' => 'Пример: -101xxxxxx']) }}
                                                <details class="small">
                                                    <summary>Подробнее</summary>
                                                    Указывается ID чата в который бот осуществляет отправку сообщений
                                                </details>
                                            </p>
                                            <p>
                                                <dt>
                                                    {{ Form::checkbox('telegram_enable_status', 1, $status) }}
                                                    Вкл/Выкл
                                                    <details class="small">
                                                        <summary>Подробнее</summary>
                                                        Включить/Выключить отправку Telegram уведомлений
                                                    </details>
                                                </dt>
                                            </p>
                                            <button type="submit" class="btn btn-xs bg-gradient-cyan mt-3">
                                                Обновить
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
