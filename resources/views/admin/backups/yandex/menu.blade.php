<div class="btn-group">
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.connectors.index')) ? 'btn-danger' : 'btn-dark' }}"
       href="{{ route('backups.yandex.connectors.index') }}"
       title="Просмотр устройства">
        @lang('messages.backups.yandex.breadcrumbs.small.connectors')
    </a>
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.tasks.index')) ? 'btn-danger' : 'btn-dark' }}"
       href="{{ route('backups.yandex.tasks.index') }}" title="Просмотр устройства">
        @lang('messages.backups.yandex.breadcrumbs.small.tasks')
    </a>
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.buckets.index')) ? 'btn-danger' : 'btn-dark' }}"
       href="{{ route('backups.yandex.buckets.index') }}"
       title="Редактирование устройства">
        @lang('messages.backups.yandex.breadcrumbs.small.buckets')
    </a>
</div>
