<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title> <?php echo e(__('DotSpin')); ?>  |  <?php echo e(__('Dashboard')); ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="<?php echo e(url('')); ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo e(asset('packages/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin-lte/dist/css/AdminLTE.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/Ionicons/css/ionicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin-lte/dist/css/skins/_all-skins.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/iCheck/skins/flat/blue.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/datatables/media/css/dataTables.bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/toastr/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('src/css/spinner.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('packages/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('src/css/styles.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
    <script src="<?php echo e(asset('packages/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script>
        $(window).load(function () {
            $('#page-loader').fadeOut(500)
            $('#page-logo-loader').fadeOut(500);
        });
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="page-logo-loader"></div>
<div id="page-loader"><span class="preloader-interior"></span></div>
<div class="wrapper">
    <?php echo $__env->make('layout.bartop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('layout.control', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script src="<?php echo e(asset('packages/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo e(asset('packages/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/jquery-knob/js/jquery.knob.js')); ?>"></script>
<script src="<?php echo e(asset('packages/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/chart.js/dist/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('packages/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('packages/jquery.slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/fastclick/lib/fastclick.js')); ?>"></script>
<script src="<?php echo e(asset('packages/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/datatables-tabletools/js/dataTables.tableTools.js')); ?>"></script>
<script src="<?php echo e(asset('packages/datatables/media/js/dataTables.bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/jquery-validation/dist/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/toastr/toastr.js')); ?>"></script>
<script src="<?php echo e(asset('packages/jquery.maskedinput/dist/jquery.maskedinput.min.js')); ?>"></script>
<script src="<?php echo e(asset('packages/bootstrapvalidator/dist/js/language/es_ES.js')); ?>"></script>
<script src="<?php echo e(asset('admin-lte/dist/js/app.min.js')); ?>"></script>
<script src="<?php echo e(asset('src/js/toastrconfiguration.js')); ?>"></script>
<script src="<?php echo e(asset('src/js/animateNumber.min.js')); ?>"></script>
<script src="<?php echo e(asset('src/js/core.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>
<script>
    $(function() {
        Core.activateMenu();
    });
</script>
</body>
</html>
