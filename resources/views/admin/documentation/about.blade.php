@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Документация</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item">Помощь</li>
                        <li class="breadcrumb-item active">Документация</li>
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
                            <h3 class="card-title">Разделы панели</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            {!! $text !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
