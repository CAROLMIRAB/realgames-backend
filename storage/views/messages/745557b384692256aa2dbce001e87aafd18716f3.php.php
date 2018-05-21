<div class="row transaction-resume" data-route="<?php echo e(route('dashboard.resume')); ?>">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 class="number-user">0</h3>
                <p><?php echo e(__('Usuarios')); ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            <a href="<?php echo e(route('users.advancedsearch')); ?>" class="small-box-footer"><?php echo e(__('Más información...')); ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6 ">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 class="played-day"> 0</h3>
                <p><?php echo e(__('Jugado del día')); ?></p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="<?php echo e(route('reports.profit')); ?>" class="small-box-footer"><?php echo e(__('Más información...')); ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 class="won-day">0</h3>
                <p><?php echo e(__('Ganado del día')); ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-ribbon-b"></i>
            </div>
            <a href="<?php echo e(route('reports.profit')); ?>" class="small-box-footer"><?php echo e(__('Más información...')); ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 class="profit">0</h3>
                <p><?php echo e(__('Profit del dia')); ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo e(route('reports.profit')); ?>" class="small-box-footer"><?php echo e(__('Más información...')); ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>