<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Web</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">NETWORK</li>
                <li class="nav-item">
                    <a href="{{ route('checks.sites.getIndex') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            PHP версии
                        </p>
                    </a>
                </li>


                <li class="nav-header">INFRASTRUCTURE</li>
                <li class="nav-item">
                    <a href="{{ route('servers.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Серверы
                        </p>
                    </a>
                </li>

                <li class="nav-header">WEB</li>
                <li class="nav-item">
                    <a href="{{ route('admin.sites.index') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Сайты
                        </p>
                    </a>
                    <a href="{{ route('checks.sites.getIndex') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            PHP версии
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('checks.sites.getIndex') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            SSL сертификаты
                        </p>
                    </a>
                </li>

                <li class="nav-header">Настройка</li>
                <li class="nav-item">
                    <a href="{{ route('settings.users.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Пользователи
                        </p>
                    </a>
                </li>

                <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.0" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Documentation</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>