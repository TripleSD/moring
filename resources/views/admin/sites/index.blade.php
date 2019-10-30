@extends('layouts.app')

@section('content')
    <script src="/js/admin/sites.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1 class="m-0 text-dark">New website</h1>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v3</li>
                        </ol>
                    </div>
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
                                <h3 class="card-title">Добавление нового сайта</h3>
                            </div>

                            <div class="card-body">
                                <div class="col-sm-6">
                                    {{ Form::open(['site' => route('admin.sites.store'),'method' => 'post', 'enctype' => "multipart/form-data"]) }}

                                    <div class="form-group">
                                        <label>Название сайта</label>
                                        {{ Form::text('name', null , ['class' => 'form-control', 'required','placeholder' => 'My website or so']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Адрес URL</label>
                                        {{ Form::url('url', null , ['class' => 'form-control', 'required', 'placeholder' => 'yourdomain.com']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>HTTPS</label>
                                        {{ Form::checkbox('https', ['class' => 'form-control']) }}
                                    </div>

                                    <div class="form-group">
                                        <label>Описание</label>
                                        {{ Form::textarea('comment', null , ['class' => 'form-control', 'placeholder' => 'My website, that I love to watch on-line, but sometimes ....']) }}
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
