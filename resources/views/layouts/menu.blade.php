<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset('img/theme/logo.jpg')}}"
             alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MoRiNg</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/theme/no_user.png')}}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ request()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                            Новости
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p>
                            Сеть
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('network.devices.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Устройства</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            Инфраструктура
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('servers.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Серверы</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            Хостинг
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sites.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Сайты</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Настройки
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.users.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Пользователи</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.system.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Система</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.bridge.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Бридж</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.integrations.telegram.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Интеграции</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>
                            Помощь
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('documenation.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Документация</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('documenation.changelog') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>История версий</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Контакты
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
