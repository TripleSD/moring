@auth
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.menu')
        @yield('content')
        @include('layouts.footer')
        @else
            @yield('content')
        @endauth

    </div>
    <script src="js/app.js"></script>
    </body>