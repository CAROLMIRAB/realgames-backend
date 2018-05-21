<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('packages/datatables/media/css/dataTables.bootstrap.min.css')); ?>">

    <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo e(__('Usuarios')); ?></h3>
                </div>
                <div class="box-body">
                    <table id="users" class="table table-bordered table-striped table-condensed flip-content datatable-usersdatatable" data-route="<?php echo e(route('users.find', [$username])); ?>">
                        <thead>

                        <tr>
                            <th><?php echo e(__('Id')); ?></th>
                            <th><?php echo e(__('DNI')); ?></th>
                            <th><?php echo e(__('Usuario')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Nombre')); ?></th>
                            <th><?php echo e(__('Apellido')); ?></th>
                            <th><?php echo e(__('Detalles')); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('packages/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/datatables/media/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/users.js')); ?>"></script>
    <script>
        $(function() {
            Users.initUsersTable();
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>