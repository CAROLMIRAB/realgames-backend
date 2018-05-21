<div class="row">
    <div class="col-md-9 col-xs-12 transactionsdata" data-route="<?php echo e(route('dashboard.graphictransactions')); ?>">
        <div style="cursor: move;" class="box">
            <div style="" class="box-header">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-inbox"></i><?php echo e(__('Transacciones')); ?></h3>
                    <div class="pull-right">
                        <div class="form-group form-horizontal">
                            <div class="col-md-8">
                                <form id="form-mes" method="get" action="<?php echo e(route('dashboard.graphictransactions')); ?>">
                                    <select id="month" name="month" class="form-control">
                                        <option value=""><?php echo e(__('Ultimas 4 semanas')); ?></option>
                                        <option value="1"><?php echo e(__('Enero')); ?></option>
                                        <option value="2"><?php echo e(__('Febrero')); ?></option>
                                        <option value="3"><?php echo e(__('Marzo')); ?></option>
                                        <option value="4"><?php echo e(__('Abril')); ?></option>
                                        <option value="5"><?php echo e(__('Mayo')); ?></option>
                                        <option value="6"><?php echo e(__('Junio')); ?></option>
                                        <option value="7"><?php echo e(__('Julio')); ?></option>
                                        <option value="8"><?php echo e(__('Agosto')); ?></option>
                                        <option value="9"><?php echo e(__('Septiembre')); ?></option>
                                        <option value="10"><?php echo e(__('Octubre')); ?></option>
                                        <option value="11"><?php echo e(__('Noviembre')); ?></option>
                                        <option value="12"><?php echo e(__('Diciembre')); ?></option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <button name="btn-search" id="btn-search" class="btn btn-success"
                                        data-loading-text="<i class='fa fa-spin fa-spinner'></i> <?php echo e(__('Buscando')); ?>"><?php echo e(__('Buscar')); ?> </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart box-body chart-dasboard">
                    <canvas width="600" height="228" id="barChart" style="height: 228px; width: 200px;"></canvas>
                    <div class="no-data hidden">
                        <i class="fa fa-exclamation-circle"><?php echo e(__("No existen datos para esta consulta")); ?></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--scrollable-->

    <div class="col-md-3 col-xs-12 latesttransactions">
        <div class="box direct-chat direct-chat-primary" data-route="<?php echo e(route('dashboard.latesttransactions')); ?>">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__("Ultimas Transacciones")); ?></h3>
            </div>
            <div class="box-body">
                <div id="content-1" class="mCustomScrollbar" data-mcs-theme="3d-thick-dark">
                    <ul class="list">

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="box the-most-played">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__("Los más Jugados de la semana")); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <div class=" hidden">
                    <?php echo $__env->make('layout.calendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <button class="btn btn-success pull-right" type="button" name="btn-update"
                            id="btn-update"
                            data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo e(__('Consultando...')); ?>">
                        <i class="fa fa-refresh"></i>
                        <?php echo e(__("Actualizar")); ?>

                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row first-three" data-route="<?php echo e(route('reports.spinbygamefirst')); ?>">

                    <div class="col-md-4 first">

                    </div>
                    <div class="col-md-4 second">

                    </div>
                    <div class="col-md-4 third">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="box box-top-players" data-route="<?php echo e(route('dashboard.topplayers')); ?>">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(__("Top de Jugadores")); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <div class=" hidden">
                    <?php echo $__env->make('layout.calendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <button class="btn btn-success pull-right" type="button" name="btn-update"
                            id="btn-update"
                            data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo e(__('Consultando...')); ?>">
                        <i class="fa fa-refresh"></i>
                        <?php echo e(__("Actualizar")); ?>

                    </button>
                </div>
            </div>
            <div class="box-body" id="top-players">


            </div>
        </div>
    </div>
</div>


