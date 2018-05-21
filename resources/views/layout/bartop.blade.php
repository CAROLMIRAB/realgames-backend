<header class="main-header">
    <a href="{{ route('dashboard') }}" class="logo">
        <span class="logo-mini"><b>Dot</b><strong>S</strong></span>
        <span class="logo-lg"><b>{{ __('Dot')}}</b><strong>{{ __('Spin') }}</strong></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"> {{ __('Toggle navigation') }}</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle core-language" data-toggle="dropdown" aria-expanded="false"
                       data-route="{{ route('dashboard.language') }}">
                        <span class="top-language"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                            {{ __('Seleccione un lenguaje') }}
                        </li>
                        <li>
                            <div class="slimScrollDiv language-items" style="position: relative; overflow: hidden;">

                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('admin-lte/dist/img/avatar5.png') }}" class="user-image"
                             alt="User Image">
                        <span class="hidden-xs">{{ \Auth::user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('admin-lte/dist/img/avatar5.png') }}" class="img-circle"
                                 alt="User Image">
                            <p>
                                {{ \Auth::user()->username }}
                                <small>{{ __('Member since Mar. 2016') }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('clients.details') }}"
                                   class="btn btn-default btn-flat">{{ __('Perfil') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('clients.logout') }}"
                                   class="btn btn-default btn-flat">{{ __('Salir') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="tasks-help">
                    <a href="{{ asset('DotSpin/index.htm') }}" target="_blank">
                        <i class="fa fa-question"></i>
                        <span>{{ __('Ayuda') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>