<div class="content-wrapper">
    @include('flash::message')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">{{$error}}
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            </div>
        @endforeach
    @endif
    @yield('content')
</div>