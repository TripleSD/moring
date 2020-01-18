@section('newwebservers')
    <div class="col-sm-6" id="3_newwebservers">
        <div class="card" style="max-height: 300px; min-height: 300px;">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Статистика используемых версий для 5 новых web серверов, шт
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
                        height="30%">
                </canvas>
            </div>
        </div>
    </div>
@endsection
