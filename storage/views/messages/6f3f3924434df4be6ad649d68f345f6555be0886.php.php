<?php $__env->startSection('title'); ?>
    <?php echo e(__('Activación de su cuenta')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subtitle'); ?>
    <?php echo e(__('Activación del usuario ') . $name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('button'); ?>
    <br>
    <p>
        <?php echo e(__('Puede acceder al Administrador RaceBook con los siguientes datos:')); ?>

        <br>
        <strong><?php echo e(__('Username:')); ?></strong> <?php echo e($username); ?>

        <br>
        <strong><?php echo e(__('Password:')); ?></strong> <?php echo e($password); ?>

    </p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <strong><?php echo e(__('Importante: esta cuenta de correo no es monitoriada')); ?></strong>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('email', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>