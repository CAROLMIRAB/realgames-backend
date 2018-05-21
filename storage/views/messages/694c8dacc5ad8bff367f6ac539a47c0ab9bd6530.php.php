<?php $__env->startSection('title'); ?>
    <?php echo e(__('Bienvenido')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subtitle'); ?>
    <?php echo e(__('Bienvenido') . $username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(__('Bienvenido a nuestro sistema DotSpin.')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('button'); ?>
    <a href="<?php echo e(route('clients.login')); ?>"
       style="color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 13px; background: #ff6b57; padding:  15px 40px; text-transform: uppercase; font-weight: bold; text-decoration: none; border-radius: 5px;">
        <?php echo e(__('Ir al administrador')); ?>

    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <strong>
        <?php echo e(__('sino ve el boton entrar a : ')); ?>

    </strong>
    <br>
    <br>
    <?php echo e(route('clients.login')); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('email', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>