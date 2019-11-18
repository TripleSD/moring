<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
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
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                            Новости
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>...</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">
                    <span class="text-uppercase">Сеть</span></li>
                <li class="nav-item">
                    <a href="{{ route('checks.sites.getIndex') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Коммутаторы
                        </p>
                    </a>
                </li>


                <li class="nav-header">
                    <span class="text-uppercase">Инфраструктура</span></li>
                <li class="nav-item">
                    <a href="{{ route('servers.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Серверы
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    <span class="text-uppercase">Хостинг</span></li>
                <li class="nav-item">
                    <a href="{{ route('admin.sites.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-link"></i>
                        <p>
                            Сайты
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('checks.sites.getIndex') }}" class="nav-link">
                        <i class="nav-icon fa fa-shield-alt"></i>
                        <p>
                            SSL сертификаты
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    <span class="text-uppercase">Настройки</span></li>
                <li class="nav-item">
                    <a href="{{ route('settings.users.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Пользователи
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>