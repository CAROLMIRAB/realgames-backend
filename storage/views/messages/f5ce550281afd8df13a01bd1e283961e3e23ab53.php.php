<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('packages/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('Crear Clientes')); ?></h3>
                    </div>
                    <form role="form" action="<?php echo e(route('clients.create-post')); ?>" method="post"
                          id="form-client-register" name="form-client-register" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="id" class="col-md-2 control-label"><?php echo e(__('ID de cliente')); ?></label>
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
                                <label for="email" class="col-md-2 control-label"><?php echo e(__('Correo')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="email"
                                           id="email" placeholder="<?php echo e(__('Correo')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="urlconfirm"
                                       class="col-md-2 control-label"><?php echo e(__('Url Confirmación')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="urlconfirm"
                                           id="urlconfirm" placeholder="<?php echo e(__('Url Confirmacion')); ?>">
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
                                <label for="timezone" class="col-md-2 control-label"><?php echo e(__('Zona Horaria')); ?></label>
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
                                            <option value="<?php echo e($rol->id); ?>" <?php if($rol->id==1): ?> <?php echo e("selected"); ?> <?php endif; ?>><?php echo e($rol->description); ?></option>
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
                                            <option value="<?php echo e($stat->id); ?>" <?php if($stat->id==1): ?> <?php echo e("selected"); ?> <?php endif; ?>><?php echo e($stat->description); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ip" class="col-md-2 control-label"><?php echo e(__('Ip')); ?></label>
                                <div class="col-md-10">
                                    <ol class="ipreg">
                                        <li class=" ipli">
                                            <div class="ipl input-group input-group-sm">
                                                <input type="text" name="ip[]" class="ip form-control" id="ip"/>
                                                <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat"
                                                    onclick="javascript:Client.addIp();">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                            </span>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="box-footer">
                        <button type="button" id="btn-create" name="btn-create"
                                class="btn btn-primary pull-right"><?php echo e(__('Crear')); ?></button>
                        <button type="reset" class="btn btn-default pull-left"><?php echo e(__('Limpiar')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('packages/bootstrapvalidator/dist/js/bootstrapValidator.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/client.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/validatorentry.js')); ?>"></script>
    <script>
        $('#name').validCampFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#timezone, #currency, #status, #rol').select2();
        $(function () {
            Client.validateRegister();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>