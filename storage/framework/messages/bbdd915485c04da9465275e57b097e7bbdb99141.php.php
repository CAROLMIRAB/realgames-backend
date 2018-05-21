<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            <?php echo e(__('Dashboard')); ?>

            <small><?php echo e(__('Control panel')); ?></small>
        </h1>

    </section>
    <section class="content">
        <?php echo $__env->make('core.client.dashboardresume', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('core.client.dashboardinfo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/datatables-plugins/api/fnReloadAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/jquery-number/jquery.number.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/date-range.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/money-format.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/dashboard.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/reports.js')); ?>"></script>
    <script>
        $(function () {
            Dashboard.loadData();
            Dashboard.drawChart();
            Dashboard.transactionsViewer();
            Dashboard.sortableResume();
            Dashboard.firstThreeSpin();
            Dashboard.topPlayers();
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>