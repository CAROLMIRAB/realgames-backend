<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(__('DotSpin | Error')); ?> </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('packages/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('packages/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('packages/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('admin-lte/dist/css/AdminLTE.min.css')); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo e(asset('packages/html5shiv/dist/html5shiv.min.js')); ?>"></script>
    <script src="<?php echo e(asset('packages/respond/dest/respond.min.js')); ?>"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo e(route('home')); ?>"><b><?php echo e(__('Dot')); ?></b><?php echo e(__('Spin')); ?></a>
    </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo e(__('Error 404')); ?>

            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-yellow"><?php echo e(__('404')); ?></h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> <?php echo e(__('Pagina no encontrada')); ?></h3>
                    <p>
                       <?php echo e(__('We could not find the page you were looking for.
                        Meanwhile, you may')); ?> <a href="<?php echo e(route('home')); ?>"> <?php echo e(__('return to dashboard')); ?> </a> <?php echo e(__('or try using the search form.')); ?>

                    </p>
                    <form class="search-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                            </div>
                        </div><!-- /.input-group -->
                    </form>
                </div><!-- /.error-content -->
            </div><!-- /.error-page -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo e(asset('packages/jquery/dist/jquery.min.js')); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo e(asset('packages/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
</body>
</html>
