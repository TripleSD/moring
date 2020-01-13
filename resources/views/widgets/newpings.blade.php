@section('newpings')
    <div class="col-6" id="2_newpings">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Результаты пинга последних 5 добавленных сайтов, мс
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
                <canvas id="newSitesPings" data-title="{{$titles}}" data-ping="{{$pings}}" width="75%"
                        height="50%">
                </canvas>
            </div>
        </div>
    </div>
@endsection
