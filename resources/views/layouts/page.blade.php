@auth
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.menu')

        @include('layouts.includes')

        @include('layouts.footer')
        @else
            @yield('content')
        @endauth

    </div>
    <script src="/js/app.js"></script>
    </body>