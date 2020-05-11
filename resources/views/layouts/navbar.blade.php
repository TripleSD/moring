<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        @if($currentBuild < $latestBuild)
            <span class="badge badge-warning text-sm">
                <i class="fas fa-info-circle"></i>
                @lang('messages.top_menu.new_version') ({{ $latestBuild }} @lang('messages.top_menu.from') {{ $latestBuildDate }}г.)
            </span>
        @else
            <span class="badge badge-success text-sm">
                @lang('messages.top_menu.current_version')
            </span>
        @endif
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item p-1">
            @if(App::getLocale() === 'ru')
                <a href="{{ route('setLocale',['en']) }}"><img src="/img/theme/english.png" align="en"></a>
            @else
                <a href="{{ route('setLocale',['ru']) }}"><img src="/img/theme/russian.png" align="ru"></a>
            @endif
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('auth.logout')}}" class="nav-link text-white">
                <i class="nav-icon fas fa-door-open"></i>
                @lang('messages.top_menu.exit')
            </a>
        </li>
    </ul>
</nav>
