<div class="row">
    <div class="col-md-9 transactionsdata" data-route="<?php echo e(route('dashboard.graphictransactions')); ?>">
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
                    <canvas width="539" height="200" id="barChart" style="height: 228px; width: 539px;"></canvas>
                    <div class="no-data hidden">
                        <i class="fa fa-exclamation-circle"><?php echo e(_("No existen datos para esta consulta")); ?></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--scrollable-->

    <div class="col-md-3 latesttransactions">
        <div class="box direct-chat direct-chat-primary" data-route="<?php echo e(route('dashboard.latesttransactions')); ?>">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(_("Ultimas Transacciones")); ?></h3>
            </div>
            <div class="box-body">
                <div id="content-1" class="mCustomScrollbar" data-mcs-theme="3d-thick-dark">
                    <ul class="list">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

