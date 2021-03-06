<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        @if($currentBuild < $latestBuild)
            <span class="bg-warning text-xs rounded">
                ~~~ <b>@lang('messages.top_menu.new_version')</b> {{ $latestBuild }} @lang('messages.top_menu.from') {{ $latestBuildDate }} ~~~
            </span>
        @else
            <span class="bg-success text-xs disabled rounded">
                ~~~ @lang('messages.top_menu.current_version') ~~~
            </span>
        @endif
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link text-light" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge navbar-badge badge-{{ ($totalCount > 0) ? 'warning' : 'success' }}">
                    {{ $totalCount }}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $totalCount }} Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="{{ route('backups.yandex.connectors.index') }}" class="dropdown-item">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="badge badge-{{ ($yandexConnectorsLogsCount >0 ? 'danger' : 'success') }}">
                        {{ $yandexConnectorsLogsCount }}
                    </span>
                    Connectors alerts
                    <span class="float-right text-muted text-xs">{{ $yandexConnectorsLogsLastEvent }}</span>
                </a>
                <a href="{{ route('backups.yandex.tasks.index') }}" class="dropdown-item">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="badge badge-{{ ($yandexTasksLogsCount >0 ? 'danger' : 'success') }}">
                        {{ $yandexTasksLogsCount }}
                    </span>
                    Tasks alerts
                    <span class="float-right text-muted text-xs">{{ $yandexTasksLogsLastEvent }}</span>
                </a>
                <a href="{{ route('backups.yandex.buckets.index') }}" class="dropdown-item">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="badge badge-{{ ($yandexBucketsLogsCount >0 ? 'danger' : 'success') }}">
                        {{ $yandexBucketsLogsCount }}
                    </span>
                    Buckets alerts
                    <span class="float-right text-muted text-xs">{{ $yandexBucketsLogsLastEvent }}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
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
