<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('packages/x-editable/dist/bootstrap-editable/css/bootstrap-editable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('src/css/styles.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="box box-primary details-client" data-route="<?php echo e(route('clients.detailsdata', $username)); ?>">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="../src/cliente.jpg" alt="User profile picture">
                        <h3 class="profile-username text-center username"></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo e(__('Usuario')); ?></b>
                                <a class="pull-right username" href="#" id="username" name="username"> </a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo e(__('URL de Confirmacion')); ?></b>
                                <a class="btn btn-success pull-right" data-toggle="modal"
                                   data-target="#modalEditUrl"><span
                                            class="glyphicon glyphicon-edit pull-right"></span></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo e(__('IP')); ?></b>
                                <button class="btn btn-success pull-right open-modal" data-toggle="modal"
                                        data-target="#modalEditIp"><span
                                            class="glyphicon glyphicon-edit" > </span></button>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo e(__('Cambiar Contraseña')); ?></b>
                                <a class="btn btn-success pull-right" data-toggle="modal"
                                   data-target="#modalEditPassword"><span
                                            class="glyphicon glyphicon-edit pull-right"></span></a>

                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /details client -->
    <?php echo $__env->make('clients.modals.editpassword', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('clients.modals.editip', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('clients.modals.editurl', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('packages/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/bootstrapvalidator/dist/js/bootstrapValidator.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/client.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/modalsclient.js')); ?>"></script>
    <script>
        $(function () {
            Client.clientDetails();
            modalClient.showModals();
            modalClient.submitModals();
            modalClient.validateModals();
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>