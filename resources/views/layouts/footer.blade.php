<footer class="main-footer">
    <strong>Copyright &copy; 2019
        @if(Config::get('moring.createYear') != \Carbon\Carbon::now()->format('Y'))
            - {{ Config::get('moring.createYear') }}
        @endif
        <a href="https://moring.ru">moring.ru</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Bridge:</b>
        @if($bridgeInfo['status'] == 1)
            v.{{$bridgeInfo['version']}}
            <span class="badge badge-success">
                Connected | {{$bridgeInfo['statusCode']}}
            </span>
        @else
            <span class="badge badge-danger">
                Disconnected |  Error
            </span>
        @endif
        <b>Moring</b> <span class="badge badge-dark">v.{{Config::get('moring.version')}}</span>
    </div>
</footer>
