@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Сводные данные</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="breadcrumb-item active">Сводные данные</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <section class="col-lg-12 connectedSortable">
                @if( count($sort) > 0 )
                    @foreach($sort as $item)
                        @php
                            $item_name = $item->item_name;
                            $widget = "widgets." . $item_name;
                        @endphp
                        @include($widget)
                        @yield($item_name)
                    @endforeach
                @else
                    @include('widgets.newsites')
                    @yield('newsites')
                    @include('widgets.newpings')
                    @yield('newpings')
                    @include('widgets.newwebservers')
                    @yield('newwebservers')
                @endif
            </section>
        </div>
    </section>
@endsection
