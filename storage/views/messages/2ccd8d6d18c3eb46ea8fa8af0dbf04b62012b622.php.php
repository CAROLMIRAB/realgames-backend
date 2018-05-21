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
                            <h3 class="box-title"><?php echo e(__('Profit por usuario')); ?></h3>
                        </div>
                        <form method="post" id="credit-transactions-form"
                              action="<?php echo e(route('reports.profitdatauser')); ?>">
                            <div class="page-toolbar">
                                <div class="pull-left">
                                    <select class="form-control" id="user" name="user"
                                            data-route="<?php echo e(route('reports.searchUsers')); ?>">
                                    </select>
                                </div>
                            </div>
                            <div class="pull-right">
                                <?php echo $__env->make('layout.calendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <button class="btn btn-success pull-right" type="button" name="btn-update"
                                        id="btn-update"
                                        data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo e(__('Consultando...')); ?>">
                                    <i class="fa fa-refresh"></i>
                                    <?php echo e(_("Actualizar")); ?>

                                </button>
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
            <div class="col-xs-12 col-sm-6 col-md-12 result hidden">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(__('Resultado de la busqueda')); ?></h3>
                    </div>
                    <div class="box-body table-responsive" id="result">
                        <div class="table-responsive">
                            <table id="profitbyGame"
                                   class="table table-bordered table-striped dataTable find-userprovider-datatable"
                                   data-route="<?php echo e(route('reports.profituserprovider')); ?>">
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

    <script src="<?php echo e(asset('packages/datatables-plugins/api/fnReloadAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/date-range.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/reports.js')); ?>"></script>
    <script>
        $(function () {
            Reports.initProfitReports();
            Reports.initProfitUsersProvider();
            Reports.initUsersSearch();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>