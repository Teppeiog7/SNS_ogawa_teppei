<?php $__env->startSection('content'); ?>

<?php echo Form::open(); ?>


<h2>新規ユーザー登録</h2>

<?php echo e(Form::label('ユーザー名')); ?>

<?php echo e(Form::text('username',null,['class' => 'input'])); ?>


<?php echo e(Form::label('メールアドレス')); ?>

<?php echo e(Form::text('mail',null,['class' => 'input'])); ?>


<?php echo e(Form::label('パスワード')); ?>

<?php echo e(Form::text('password',null,['class' => 'input'])); ?>


<?php echo e(Form::label('パスワード確認')); ?>

<?php echo e(Form::text('password-confirm',null,['class' => 'input'])); ?>


<?php echo e(Form::submit('登録')); ?>


<p><a href="/login">ログイン画面へ戻る</a></p>

<?php echo Form::close(); ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.logout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/AtlasSNS/resources/views/auth/register.blade.php ENDPATH**/ ?>