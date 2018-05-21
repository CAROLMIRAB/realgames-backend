<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet"
          href="<?php echo e(asset('packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo e(__('Profit por Juego')); ?></h3>
                        </div>
                        <form method="post" id="credit-transactions-form"
                              action="<?php echo e(route('reports.profitdatagame')); ?>">
                            <div class="page-toolbar">
                                <div class="pull-left">
                                    <select class="form-control providers" id="provider" name="provider"  data-route="<?php echo e(route('reports.findprovider')); ?>">>

                                    </select>
                                </div>
                            </div>
                            <div class="pull-right">
                                <?php echo $__env->make('layout.calendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <button class="btn btn-success pull-right" type="button" name="btn-update"
                                        id="btn-update"
                                        data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo e(__('Consultando...')); ?>">
                                    <i class="fa fa-refresh"></i>
                                    <?php echo e(__("Actualizar")); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-6 col-md-12 result hidden">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(__('Resultado de la busqueda')); ?></h3>
                    </div>
                    <div class="box-body table-responsive" id="result">
                        <div class="table-responsive">
                            <table id="profitbyGame"
                                   class="table table-bordered table-striped dataTable find-game-datatable"
                                   data-route="<?php echo e(route('reports.profitdatagame')); ?>">
                                <thead class="flip-content">
                                <tr role="row">
                                    <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                        aria-controls="transactions" tabindex="0"
                                        class="sorting" width="20%"><?php echo e(__('Juego')); ?></th>
                                    <th class="no-sort" width="20%"><?php echo e(__('Proveedor')); ?></th>
                                    <th class="sorting" width="20%"><?php echo e(__('Jugado')); ?></th>
                                    <th class="sorting" width="20%"><?php echo e(__('Ganado')); ?></th>
                                    <th class="sorting" width="20%"><?php echo e(__('Profit')); ?></th>
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
    <script src="<?php echo e(asset('src/js/date-range.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/reports.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/datatables-plugins/api/fnReloadAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/select2/dist/js/select2.min.js')); ?>"></script>
    <script>
        $('#user').select2();
        $(function () {
            Reports.initGameSearch();
            Reports.findProvider();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>