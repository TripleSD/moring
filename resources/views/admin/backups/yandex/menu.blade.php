<div class="btn-group">
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.connectors.index')) ? 'btn-danger' : 'btn-dark' }}"
       href="{{ route('backups.yandex.connectors.index') }}"
       title="Просмотр устройства">
        Коннекторы
    </a>
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.tasks.index')) ? 'btn-danger' : 'btn-dark' }}"
       href="{{ route('backups.yandex.tasks.index') }}" title="Просмотр устройства">
        Проверки
    </a>
    <a class="btn btn-xs {{ (request()->route()->named('backups.yandex.baskets.index')) ? 'btn-danger' : 'btn-dark' }}"
       href="{{ route('backups.yandex.baskets.index') }}"
       title="Редактирование устройства">
        Корзины</a>
</div>
