<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('packages/x-editable/dist/bootstrap-editable/css/bootstrap-editable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('src/css/styles.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="box box-primary details-user" data-route="<?php echo e(route('users.detailsdata', $user)); ?>">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center fullname"></h3>
                        <div class="text-muted text-center">
                            <i class="fa fa-user">
                                <div class="username"></div>
                            </i>
                            <p class="user"></p>
                        </div>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>ID</b>
                                <div class="pull-right id" id="id" name="id"></div>
                            </li>
                            <li class="list-group-item">
                                <b>DNI</b>
                                <a class="pull-right x-editable dni" href="#" id="dni" name="dni"
                                   data-type="text"
                                   data-pk="<?php echo e($user); ?>" data-url="<?php echo e(route('users.edit', [$user])); ?>"
                                   data-title="DNI"></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo e(__('Nombres')); ?></b>
                                <a class="pull-right x-editable name" href="#" id="name" name="name" data-type="text"
                                   data-pk="<?php echo e($user); ?>" data-url="<?php echo e(route('users.edit', [$user])); ?>"
                                   data-title="<?php echo e(__('Nombres')); ?>"> </a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo e(__('Apellidos')); ?></b>
                                <a class="pull-right x-editable lastname" href="#" id="lastname" name="lastname"
                                   data-type="text" data-pk="<?php echo e($user); ?>" data-url="<?php echo e(route('users.edit', [$user])); ?>"
                                   data-title="<?php echo e(__('Apellidos')); ?>"> </a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b>
                                <a class="pull-right x-editable email" href="#" id="email" name="email" data-type="text"
                                   data-pk="<?php echo e($user); ?>" data-url="<?php echo e(route('users.edit', [$user])); ?>"
                                   data-title="<?php echo e(__('Email')); ?>"> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-9">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(__('Transacciones')); ?></h3>
                    </div>
                    <div class="box-body flip-scroll">
                        <table id="transactions"
                               class="table table-bordered table-striped dataTable flip-content datatable-transactions"
                               data-route="<?php echo e(route('users.transactions', $user)); ?>">
                            <thead class="flip-content">
                            <tr role="row">
                                <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                    colspan="1" rowspan="1" aria-controls="transactions" tabindex="0"
                                    class="sorting" width="10%"><?php echo e(__('Fecha')); ?></th>
                                <th class="sorting" width="10%"><?php echo e(__('Transacción')); ?></th>
                                <th class="sorting" width="10%"><?php echo e(__('Transacción de Cliente')); ?></th>
                                <th class="sorting" width="15%"><?php echo e(__('Juego')); ?></th>
                                <th class="sorting" width="15%"><?php echo e(__('Debito')); ?></th>
                                <th class="sorting" width="15%"><?php echo e(__('Credito')); ?></th>
                                <th class="sorting" width="25%"><?php echo e(__('Saldo Actual')); ?></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!--/details transaction datatable-->
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('packages/datatables-plugins/api/fnReloadAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/users.js')); ?>"></script>
    <script>
        $(function () {
            Users.detailsUsers();
            Users.initDataTableUsers();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>