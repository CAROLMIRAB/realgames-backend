<header class="main-header">
    <a href="<?php echo e(route('dashboard')); ?>" class="logo">
        <span class="logo-mini"><b>Dot</b><strong>S</strong></span>
        <span class="logo-lg"><b><?php echo e(__('Dot')); ?></b><strong><?php echo e(__('Spin')); ?></strong></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"> <?php echo e(__('Toggle navigation')); ?></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle core-language" data-toggle="dropdown" aria-expanded="false"
                       data-route="<?php echo e(route('dashboard.language')); ?>">
                        <span class="top-language"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                            <?php echo e(__('Seleccione un lenguaje')); ?>

                        </li>
                        <li>
                            <div class="slimScrollDiv language-items" style="position: relative; overflow: hidden;">

                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo e(asset('admin-lte/dist/img/avatar5.png')); ?>" class="user-image"
                             alt="User Image">
                        <span class="hidden-xs"><?php echo e(\Auth::user()->username); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(asset('admin-lte/dist/img/avatar5.png')); ?>" class="img-circle"
                                 alt="User Image">
                            <p>
                                <?php echo e(\Auth::user()->username); ?>

                                <small><?php echo e(__('Member since Mar. 2016')); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo e(route('clients.details')); ?>"
                                   class="btn btn-default btn-flat"><?php echo e(__('Perfil')); ?></a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo e(route('clients.logout')); ?>"
                                   class="btn btn-default btn-flat"><?php echo e(__('Salir')); ?></a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>