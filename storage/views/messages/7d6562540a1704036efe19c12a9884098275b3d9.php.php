<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet"
          href="<?php echo e(asset('packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo e(__('Profit por cliente')); ?></h3>
                        </div>
                        <form method="post" id="credit-transactions-form" action="<?php echo e(route('reports.profit.data')); ?>">
                            <div class="page-toolbar">
                                <div class="pull-left">
                                    <select class="form-control" id="client" name="client">
                                        <option value=""><?php echo e(__('Seleccione Cliente')); ?></option>
                                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($client->id); ?>"><?php echo e($client->username); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                                <div class="pull-right">
                                    <?php echo $__env->make('layout.calendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <button class="btn btn-success pull-right" type="button" name="btn-update"
                                            id="btn-update" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo e(__('Consultando...')); ?>">
                                        <i class="fa fa-refresh"></i>
                                        <?php echo e(_("Actualizar")); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(_("Jugado")); ?></span>
                        <span class="info-box-number"><ul class="horizontal-list-ul"
                                                          id="purchase"></ul></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ribbon-b"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(_("Ganado")); ?></span>
                        <span class="info-box-number"><ul class="horizontal-list-ul"
                                                          id="won"></ul></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e(_("Profit")); ?></span>
                        <span class="info-box-number"><ul class="horizontal-list-ul"
                                                          id="profit"></ul></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('src/js/date-range.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/reports.js')); ?>"></script>
    <script>
        $(function () {
            Reports.initProfitReports();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>