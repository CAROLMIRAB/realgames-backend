<div id="date-range" class="btn btn-fit-height grey-salt">
    <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp;
    <i class="fa fa-angle-down"></i>
</div>
<input type="hidden" id="start-date" name="start-date">
<input type="hidden" id="end-date" name="end-date">

<?php $__env->startSection('scripts'); ?>
    @parent
    <script src="<?php echo e(asset('packages/moment/min/moment-with-locales.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<?php $__env->stopSection(); ?>