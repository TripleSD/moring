<div class="btn-group">
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.connectors.index')) ? 'btn-info' : 'btn-dark' }}"
       href="{{ route('backups.yandex.connectors.index') }}"
       title="@lang('messages.backups.yandex.buttons.title.connectors')">
        @lang('messages.backups.yandex.breadcrumbs.small.connectors')
    </a>
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.tasks.index')) ? 'btn-info' : 'btn-dark' }}"
       href="{{ route('backups.yandex.tasks.index') }}"
       title="@lang('messages.backups.yandex.buttons.title.tasks')">
        @lang('messages.backups.yandex.breadcrumbs.small.tasks')
    </a>
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.buckets.index')) ? 'btn-info' : 'btn-dark' }}"
       href="{{ route('backups.yandex.buckets.index') }}"
       title="@lang('messages.backups.yandex.buttons.title.buckets')">
        @lang('messages.backups.yandex.breadcrumbs.small.buckets')
    </a>
</div>
