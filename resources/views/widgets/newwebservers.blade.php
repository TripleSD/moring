@section('newwebservers')
    <div class="col-6" id="3_newwebservers">
        <div class="card">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Статистика используемых версий для последних добавленных 5 web серверов, шт
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="newSitesWebServers" data-server="{{$servers}}" data-count="{{$counts}}"
                        width="75%"
                        height="50%">
                </canvas>
            </div>
        </div>
    </div>
@endsection
