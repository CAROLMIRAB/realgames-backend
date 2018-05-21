<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet"
          href="<?php echo e(asset('packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="row first-three" data-route="<?php echo e(route('reports.spinbygamefirst')); ?>">
            <div class="col-md-12"><h3><?php echo e(__('Los más jugados')); ?></h3></div>
            <div class="col-md-2 col-md-offset-1 first">

            </div>
            <div class="col-md-2 col-md-offset-2 second">

            </div>
            <div class="col-md-2 col-md-offset-2 third">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12 result">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(__('Spin por games')); ?></h3>
                        <div class="box-tools">
                            <form method="post" id="credit-transactions-form"
                                  action="<?php echo e(route('reports.profitdatauser')); ?>">
                                <?php echo $__env->make('layout.calendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <button class="btn btn-success pull-right" type="button" name="btn-update"
                                        id="btn-update"
                                        data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo e(__('Consultando...')); ?>">
                                    <i class="fa fa-refresh"></i>
                                    <?php echo e(__("Actualizar")); ?>

                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="box-body table-responsive" id="result">
                        <div class="table-responsive">
                            <table id="spinbygame"
                                   class="table table-bordered table-striped dataTable"
                                   data-route="<?php echo e(route('reports.spinbygamedata')); ?>">
                                <thead class="flip-content">
                                <tr role="row">
                                    <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                        aria-controls="transactions" tabindex="0"
                                        class="no-sort" width="3%"><?php echo e(__('')); ?></th>
                                    <th class="sorting" width="30%"><?php echo e(__('Juego')); ?></th>
                                    <th class="sorting" width="20%"><?php echo e(__('Proveedor')); ?></th>
                                    <th class="no-sort" width="30%"><?php echo e(__('')); ?></th>
                                    <th class="sorting" width="17%"><?php echo e(__('Spins')); ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(asset('packages/datatables-plugins/api/fnReloadAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/date-range.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/reports.js')); ?>"></script>
    <script>
        $(function () {
            Reports.spinData();
            Reports.firstThreeSpin();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>