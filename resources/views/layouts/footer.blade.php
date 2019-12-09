<footer class="main-footer">
    <strong>Copyright &copy; 2019
        @if(Config::get('moring.createYear') != \Carbon\Carbon::now()->format('Y'))
            - {{ Config::get('moring.createYear') }}
        @endif
        <a href="https://moring.ru">moring.ru</a>.</strong>
    All rights reserved.
    <a href="https://github.com/TripleSD/moring" target="_blank"><i class="fab fa-github-square"></i></a>
    <div class="float-right d-none d-sm-inline-block">
        <b>Moring</b> <span class="badge badge-dark">b: {{Config::get('moring.build')}}</span>
        |
        <b>Bridge </b>
        @if($bridgeInfo['status'] == 1)
            <span class="badge badge-dark">
                b: {{$bridgeInfo['version']}}
            </span>
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
