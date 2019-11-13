<footer class="main-footer">
    <strong>Copyright &copy; 2019
        @if(Config::get('moring.createYear') != \Carbon\Carbon::now()->format('Y'))
            - {{ Config::get('moring.createYear') }}
        @endif
        <a href="https://moring.ru">moring.ru</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Moring</b> <span class="badge badge-dark">v.{{Config::get('moring.version')}}</span>
    </div>
</footer>
