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
                        <h3 class="box-title"><?php echo e(__('Clientes')); ?></h3>
                    </div>
                    <div class="box-body">
                        <table id="users"
                               class="table table-bordered table-striped table-condensed flip-content datatable-clientsdatatable"
                               data-route="<?php echo e(route('clients.findclients', [$username])); ?>">
                            <thead>
                            <tr role="row">
                                <th  aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                     aria-controls="transactions" tabindex="0"
                                     class="sorting" width="5%"><?php echo e(__('ID')); ?></th>
                                <th class="no-sort" width="15%"><?php echo e(__('Secret')); ?></th>
                                <th class="sorting" width="10%"><?php echo e(__('Usuario')); ?></th>
                                <th class="sorting" width="10%"><?php echo e(__('Nombre')); ?></th>
                                <th class="sorting" width="18%"><?php echo e(__('Correo')); ?></th>
                                <th class="no-sort" width="12%"><?php echo e(__('IP')); ?></th>
                                <th class="sorting" width="5%"><?php echo e(__('URL')); ?></th>
                                <th class="sorting" width="20%"><?php echo e(__('Moneda')); ?></th>
                                <th class="sorting" width="15%"><?php echo e(__('Timezone')); ?></th>
                                <th class="sorting" width="5%"><?php echo e(__('Rol')); ?></th>
                                <th class="sorting" width="5%"><?php echo e(__('Estatus')); ?></th>
                                <th class="no-sort" width="5%"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo $__env->make('clients.modals.editclient', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('packages/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/datatables/media/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/client.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/modalsclient.js')); ?>"></script>
    <script>
        $(function () {
            Client.initClientsTable();
            modalClient.chargeSelects();
            modalClient.modalEditClient();
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>