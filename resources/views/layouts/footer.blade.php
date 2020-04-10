<footer class="main-footer">
    <strong>Copyright &copy; 2019
        @if(Config::get('moring.createYear') != \Carbon\Carbon::now()->format('Y'))
            - {{ \Carbon\Carbon::now()->format('Y') }}
        @endif
        <a href="https://moring.ru">moring.ru</a>.</strong>
    All rights reserved.
    <a href="https://github.com/TripleSD/moring" target="_blank"><i class="fab fa-github-square"></i></a>
    <div class="float-right d-none d-sm-inline-block">
        <b>Moring</b> <span class="badge badge-dark">v: {{Config::get('moring.version')}}</span>
        <span class="badge badge-dark">b: {{Config::get('moring.build')}}</span>

        @if(App::environment() == 'production')
            <span class="badge badge-secondary">env: {{App::environment()}}</span>
        @elseif ( App::environment() == 'development' ?? 'staging' ?? 'local')
            <span class="badge badge-danger">env: {{App::environment()}}</span>
        @else
            <span class="badge badge-warning">env: {{App::environment()}}</span>
        @endif
        |
        <b>Bridge </b>
        @if($bridgeInfo['status'] == 1)
            @if(is_numeric($bridgeInfo['version']))
                <span class="badge badge-dark">
                    b: {{$bridgeInfo['version']}}
                </span>
            @else
                <span class="badge badge-danger">
                    {{$bridgeInfo['version']}}
                </span>
            @endif

            <span class="badge badge-success">
                Connected | {{$bridgeInfo['statusCode']}}
            </span>
        @else
            <span class="badge badge-danger">
                Disconnected |  Error
            </span>
        @endif
        <a href="{{ route('settings.bridge.index') }}"
           class="btn btn-xs text-primary"
           title="Статус обновлений бриджа">
            <i class="fas fa-history"></i></a>
    </div>
</footer>
