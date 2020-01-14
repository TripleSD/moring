@section('newsites')
    <div class="col-sm-6" id="1_newsites">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Недавно добавленные веб сайты</h3>
                <div class="card-tools float-right">
                    <button type="button" class="btn btn-tool collapse_btn" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>URL</th>
                        <th>Статус</th>
                        <th>Дата проверки</th>
                        <th>Подробнее</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sites as $site)
                        <tr>
                            <td>
                                @if($site->enabled === 1)
                                    <small class="text-success mr-1">
                                        <i class="fas fa-globe" title="Мониторинг запущен"></i>
                                    </small>
                                @else
                                    <small class="text-warning mr-1">
                                        <i class="fas fa-globe" title="Мониторинг приостановлен"></i>
                                    </small>
                                @endif
                                {{$site->url}}
                            </td>
                            <td>
                                @if(isset($site->getHttpCode))
                                    @if($site->getHttpCode->http_code == 200)
                                        <span class="badge badge-success"
                                              title="Сайт полностью рабочий">
                                                            {{ $site->getHttpCode->http_code }}
                                                            </span>
                                    @elseif($site->getHttpCode->http_code == 301)
                                        <span class="badge badge-warning"
                                              title="На сайте установлен редирект">
                                                            {{ $site->getHttpCode->http_code }}
                                                            </span>
                                    @elseif($site->getHttpCode->http_code == 302)
                                        <span class="badge badge-warning"
                                              title="На сайте установлен редирект">
                                                            {{ $site->getHttpCode->http_code }}
                                                            </span>
                                    @else
                                        <span class="text-warning" title="Неопознанный код ответа">
                                                                <i class="fa fa-exclamation-triangle"></i>
                                                            </span>
                                    @endif
                                @else
                                    <span class="text-warning" title="Код ответа не был получен">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                        </span>
                                @endif
                            </td>
                            <td>
                                            <span
                                                @if($site->enabled === 1)
                                                class="pt-1 text-success">
                                            @else
                                                    class="pt-1 text-gray">
                                                @endif
                                                {{$site->getHttpCode->updated_at}}
                                            </span>
                            </td>
                            <td>
                                <a href="{{route('admin.sites.show',$site->id)}}"
                                   class="btn btn-xs bg-gradient-info"
                                   title="Подробнее">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
