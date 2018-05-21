<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('Buscar Usuario')); ?></h3>
                    </div>
                    <form role="form" action="" method="post"
                          id="form-user-search">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="rut"><?php echo e(__('ID de usuario')); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control" name="id"
                                           id="id" placeholder="<?php echo e(__('ID de Usuario')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dni"><?php echo e(__('DNI')); ?></label>
                                <input type="text" class="form-control" name="dni"
                                       id="dni" placeholder="DNI">
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Nombre')); ?></label>
                                <input type="text" class="form-control" name="name"
                                       id="name" placeholder="<?php echo e(__('Nombre')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname"><?php echo e(__('Apellido')); ?></label>
                                <input type="text" class="form-control" name="lastname"
                                       id="lastname" placeholder="<?php echo e(__('Apellido')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="username"><?php echo e(__('Usuario')); ?></label>
                                <input type="text" class="form-control" name="username"
                                       id="username" placeholder="<?php echo e(__('Usuario')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Correo')); ?></label>
                                <input type="text" class="form-control" name="email"
                                       id="email" placeholder="<?php echo e(__('Correo')); ?>">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" id="btn-update"
                                    data-loading-text="<i class='fa fa-spin fa-spinner'></i> <?php echo e(__('Buscando')); ?>">
                                <?php echo e(__('Buscar')); ?>

                            </button>
                            <button type="reset" class="btn btn-info"><?php echo e(__('Limpiar busqueda')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(__('Resultado de la busqueda')); ?></h3>
                    </div>
                    <div class="box-body flip-scroll" id="result">

                        <table id="transactions"
                               class="table table-bordered table-striped dataTable flip-content find-users-datatable"
                               data-route="<?php echo e(route('users.advancedsearchuser')); ?>">
                            <thead class="flip-content">
                            <tr role="row">
                                <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                    aria-controls="transactions" tabindex="0"
                                    class="sorting" width="5%"><?php echo e(__('ID')); ?></th>
                                <th class="sorting" width="10%"><?php echo e(__('DNI')); ?></th>
                                <th class="sorting" width="10%"><?php echo e(__('Usuario')); ?></th>
                                <th class="sorting" width="17%"><?php echo e(__('Nombre')); ?></th>
                                <th class="sorting" width="17%"><?php echo e(__('Apellido')); ?></th>
                                <th class="sorting" width="27%"><?php echo e(__('Correo')); ?></th>
                                <th class="sorting" width="10%"><?php echo e(__('Detalles')); ?></th>
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
    <script src="<?php echo e(asset('packages/datatables-plugins/api/fnReloadAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/users.js')); ?>"></script>
    <script>

        $(function () {
            Users.initAdvancedSearch();
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>