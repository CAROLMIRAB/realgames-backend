<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('packages/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('Busqueda Avanzada')); ?></h3>
                    </div>
                    <form role="form" action="" method="post"
                          id="form-client-search" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="id" class="col-md-2 control-label"><?php echo e(__('ID')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="id"
                                           id="id" placeholder="<?php echo e(__('ID de Cliente')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label"><?php echo e(__('Nombre')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control col-md-4" name="name"
                                           id="name" placeholder="<?php echo e(__('Nombre')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-md-2 control-label"><?php echo e(__('Usuario')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="username"
                                           id="username" placeholder="<?php echo e(__('Usuario')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="urlconfirm"
                                       class="col-md-2 control-label"><?php echo e(__('URL')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="urlconfirm"
                                           id="urlconfirm" placeholder="<?php echo e(__('Url de Confirmacion')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="currency" class="col-md-2 control-label"><?php echo e(__('Moneda')); ?></label>
                                <div class="col-md-10">
                                    <select class="form-control" id="currency" name="currency">
                                        <option value=""><?php echo e(__('Seleccione')); ?></option>
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($currency->iso); ?>"><?php echo e($currency->description); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="timezone" class="col-md-2 control-label"><?php echo e(__('Timezone')); ?></label>
                                <div class="col-md-10">
                                    <select class="form-control" id="timezone" name="timezone">
                                        <option value=""><?php echo e(__('Seleccione')); ?></option>
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($timezone); ?>"><?php echo e($timezone); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rol" class="col-md-2 control-label"><?php echo e(__('Rol')); ?></label>
                                <div class="col-md-10">
                                    <select class="form-control" id="rol" name="rol">
                                        <option value=""><?php echo e(__('Seleccione')); ?></option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($rol->id); ?>"><?php echo e($rol->description); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-2 control-label"><?php echo e(__('Estatus')); ?></label>
                                <div class="col-md-10">
                                    <select class="form-control" id="status" name="status">
                                        <option value=""><?php echo e(__('Seleccione')); ?></option>
                                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($stat->id); ?>"><?php echo e($stat->description); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-primary pull-right" id="btn-search"
                                        data-loading-text="<i class='fa fa-spin fa-spinner'></i> <?php echo e(__('Buscando')); ?>">
                                    <?php echo e(__('Buscar')); ?>

                                </button>
                                <button type="reset" class="btn btn-default pull-left"><?php echo e(__('Limpiar')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(__('Resultado de la busqueda')); ?></h3>
                    </div>
                    <div class="box-body table-responsive" id="result">
                        <div class="table-responsive">
                            <table id="transactions"
                                   class="table table-bordered table-striped dataTable find-clients-datatable"
                                   data-route="<?php echo e(route('clients.advance-search-clients')); ?>">
                                <thead class="flip-content">
                                <tr role="row">
                                    <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                        aria-controls="transactions" tabindex="0"
                                        class="sorting" width="5%"><?php echo e(__('ID')); ?></th>
                                    <th class="no-sort" width="12%"><?php echo e(__('Secret')); ?></th>
                                    <th class="sorting" width="10%"><?php echo e(__('Usuario')); ?></th>
                                    <th class="sorting" width="10%"><?php echo e(__('Nombre')); ?></th>
                                    <th class="sorting" width="15%"><?php echo e(__('Correo')); ?></th>
                                    <th class="no-sort" width="12%"><?php echo e(__('IP')); ?></th>
                                    <th class="sorting" width="5%"><?php echo e(__('URL')); ?></th>
                                    <th class="sorting" width="3%"><?php echo e(__('Moneda')); ?></th>
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
        </div>
    </section>
    <?php echo $__env->make('clients.modals.editclient', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('packages/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/datatables/media/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/datatables-plugins/api/fnReloadAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/client.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/modalsclient.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/validatorentry.js')); ?>"></script>
    <script>
        $('#timezone, #currency, #status, #rol').select2();
        $(function () {
            Client.initAdvancedSearch();
        });
        Client.sendPass();
        modalClient.chargeSelects();
        modalClient.modalEditClient();
        modalClient.updateClient();

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>