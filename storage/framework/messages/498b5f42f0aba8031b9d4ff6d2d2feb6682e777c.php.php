<?php $__env->startSection('content'); ?>
    <h1 class="page-header">Dashboard</h1>

    <div class="row">
        <div class="col-md-3">
            <canvas id="stats-doughnut-chart"></canvas>
        </div>
        <div class="col-md-9">
            <section class="box-body">
                <div class="row">
                    <?php $__currentLoopData = $percents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div class="col-md-4">
                            <div class="info-box level level-<?php echo e($level); ?> <?php echo e($item['count'] === 0 ? 'level-empty' : ''); ?>">
                                <span class="info-box-icon">
                                    <?php echo log_styler()->icon($level); ?>

                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo e($item['name']); ?></span>
                                    <span class="info-box-number">
                                        <?php echo e($item['count']); ?> entries - <?php echo $item['percent']; ?> %
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo e($item['percent']); ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function() {
            var data = <?php echo $reports; ?>;

            new Chart($('#stats-doughnut-chart')[0].getContext('2d'))
                .Doughnut(data, {
                    animationEasing : "easeOutQuart"
                });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('log-viewer::_template.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>