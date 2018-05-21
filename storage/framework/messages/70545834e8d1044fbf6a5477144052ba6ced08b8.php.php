<aside class="main-sidebar">
    <?php if(\Auth::user()->rol == 1): ?>
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo e(asset('admin-lte/dist/img/avatar5.png')); ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo e(\Auth::user()->username); ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i><?php echo e(__('Online')); ?></a>
                </div>
            </div>
            <form action="<?php echo e(route('users.search')); ?>" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="<?php echo e(__('Buscar')); ?>">
                    <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <ul class="sidebar-menu">
                <li class="header"><?php echo e(__('MENÚ')); ?></li>
                <li class="active">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="fa fa-dashboard"></i> <span><?php echo e(__('Dashboard')); ?></span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span><?php echo e(__('Usuarios')); ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo e(route('users.advancedsearch')); ?>">
                                <i class="fa fa-search"></i> <?php echo e(__('Búsqueda Avanzada')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-balance-scale"></i>
                        <span><?php echo e(__('Transacciones')); ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo e(route('transactions.viewtransactionsadvancedsearch')); ?>">
                                <i class="fa fa-search"></i> <?php echo e(__('Búsqueda Avanzada')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart"></i>
                        <span><?php echo e(__('Reportes')); ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo e(route('reports.profit')); ?>"><i class="fa fa-credit-card"></i> <?php echo e(__('Profit')); ?>

                            </a></li>
                        <li><a href="<?php echo e(route('reports.spinbygame')); ?>">
                                <i class="fa fa-credit-card"></i> <?php echo e(__('Spin por juego')); ?></a></li>
                        <li><a href="<?php echo e(route('reports.profitbygame')); ?>">
                                <i class="fa fa-credit-card"></i> <?php echo e(__('Profit por juego')); ?></a></li>
                        <li><a href="<?php echo e(route('reports.profitbyuser')); ?>">
                                <i class="fa fa-credit-card"></i> <?php echo e(__('Profit por usuario')); ?></a></li>
                        <li><a href="<?php echo e(route('reports.profitbyprovider')); ?>">
                                <i class="fa fa-credit-card"></i> <?php echo e(__('Profit por proveedor')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="<?php echo e(asset('DotSpin/index.htm')); ?>" target="_blank">
                        <i class="fa fa-question"></i>
                        <span><?php echo e(_('Ayuda')); ?></span>
                    </a>
                </li>
            </ul>
        </section>
    <?php else: ?>
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo e(asset('admin-lte/dist/img/avatar5.png')); ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo e(\Auth::user()->username); ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i><?php echo e(__('Online')); ?></a>
                </div>
            </div>
            <form action="<?php echo e(route('clients.searchclients')); ?>" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="<?php echo e(__('Buscar')); ?>">
                    <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <ul class="sidebar-menu">
                <li class="header"><?php echo e(__('MENÚ')); ?></li>
                <li class="active">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="fa fa-dashboard"></i> <span><?php echo e(__('Dashboard')); ?></span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span><?php echo e(__('Clientes')); ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo e(route('clients.createclients')); ?>"><i
                                        class="fa fa-pencil"></i> <?php echo e(__('Registrar')); ?></a></li>
                        <li><a href="<?php echo e(route('clients.advanced-search-clients-view')); ?>"><i
                                        class="fa fa-search"></i> <?php echo e(__('Búsqueda Avanzada')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart"></i>
                        <span><?php echo e(__('Reportes')); ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo e(route('reports.profitbyclient')); ?>"><i
                                        class="fa fa-credit-card"></i> <?php echo e(__('Profit')); ?></a></li>
                    </ul>
                </li>
            </ul>
        </section>
    <?php endif; ?>

</aside>