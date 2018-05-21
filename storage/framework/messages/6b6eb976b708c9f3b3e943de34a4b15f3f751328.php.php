<section>
    <div class="row">
        <div class="col-md-9 transactionsdata" data-route="<?php echo e(route('dashboard.graphictransactionsadmin')); ?>">
            <div style="cursor: move;" class="box">
                <div style="" class="box-header">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-inbox"></i><?php echo e(__('Profit diario de clientes')); ?></h3>
                    </div>
                    <div class="chart">
                        <canvas width="539" height="230" id="barChart" style="height: 230px; width: 539px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>