<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset('img/theme/logo.png')}}"
             alt="AdminLTE Logo" height="50">
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
                            @lang('messages.main_menu.home')
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                            @lang('messages.main_menu.news')
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p>
                            @lang('messages.main_menu.network')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('network.devices.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.network.devices')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            @lang('messages.main_menu.infrastructure')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('servers.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.infrastructure.servers')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            @lang('messages.main_menu.hosting')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sites.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.hosting.sites')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Backups
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backups.ftp.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>FTP</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backups.yandex.tasks.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>Yandex Disk</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang('messages.main_menu.settings')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.users.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.settings.users')</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.system.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.settings.system')</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.bridge.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.settings.bridge')</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('settings.integrations.telegram.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.settings.integrations')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>
                            @lang('messages.main_menu.help')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('documenation.index') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.help.documentation')</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('documenation.changelog') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>@lang('messages.main_menu.help.changelog')</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('documenation.about') }}" class="nav-link">
                                <i class="fa fa-angle-right nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            @lang('messages.main_menu.contacts')
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
