@extends('layouts.app')

@section('content')
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0 text-dark">Редактирование сайта</h1>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Редактирование сайта</li>
                        </ol>
                    </div>
                </div>
            </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Редактирование сайта</h3>
                                <div class="card-tools">
                                    <a href="{{route('admin.sites.show', $site->id)}}"
                                       class="btn btn-sm bg-gradient-info" title="Вернуться">
                                        <i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="col-sm-6">
                                    {{ Form::open([ 'url' => route('admin.sites.update', $site->id), 'method' => 'put', 'enctype' => "multipart/form-data"]) }}

                                    <div class="form-group">
                                        <label>Название сайта</label>
                                        {{ Form::text('name', $site->name , ['class' => 'form-control', 'required','placeholder' => 'My website or so']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Адрес URL</label>
                                        {{ Form::text('url', $site->url , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Мониторить</label><br>
                                        <div class="form-check-inline">
                                            {{Form::text('active', 'off', ['class' => 'form-control', 'hidden'])}}
                                        @if($site->active === 'on')
                                            {{ Form::checkbox('active', null, true) }}
                                        @else
                                            {{ Form::checkbox('active', null, false) }}
                                        @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>HTTPS</label><br>
                                        <div class="form-check-inline">
                                        {{Form::text('https', 'off', ['class' => 'form-control', 'hidden'])}}
                                        @if($site->https === 'on')
                                            {{ Form::checkbox('https', null, true, ['class' => 'form-check-input']) }}
                                        @else
                                            {{ Form::checkbox('https', null, false, ['class' => 'form-check-input']) }}
                                        @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Описание</label>
                                        {{ Form::text('comment', $site->comment, ['class' => 'form-control', 'placeholder' => 'My website, that I love to watch on-line, but sometimes ....']) }}
                                    </div>
                                    <div class="form-row ">
                                        <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-xs bg-gradient-cyan">Обновить</button>
                                    {{ Form::close() }}
                                        </div>
                                        <div class="form-group col-md-6">
                                    {{Form::open([ 'url' => route('admin.sites.destroy', $site->id), 'method' => 'delete', 'enctype' => "multipart/form-data"])}}
                                    <button type="submit" class="btn btn-xs bg-gradient-red">Удалить</button>
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
