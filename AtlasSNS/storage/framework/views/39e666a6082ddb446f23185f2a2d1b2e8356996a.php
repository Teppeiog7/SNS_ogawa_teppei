<?php $__env->startSection('content'); ?>

<?php echo Form::open(); ?>


<p>AtlasSNSへようこそ</p>

<?php echo e(Form::label('e-mail')); ?>

<?php echo e(Form::text('mail',null,['class' => 'input'])); ?>

<?php echo e(Form::label('password')); ?>

<?php echo e(Form::password('password',['class' => 'input'])); ?>


<?php echo e(Form::submit('ログイン')); ?>


<p><a href="/register">新規ユーザーの方はこちら</a></p>

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.logout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/AtlasSNS/resources/views/auth/login.blade.php ENDPATH**/ ?>