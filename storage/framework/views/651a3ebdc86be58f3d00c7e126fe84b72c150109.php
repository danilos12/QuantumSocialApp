<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

<?php if($layout): ?>
    
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<div class="page-outer profile-outer">
      <div id="spinner" style="display: none; color: white">
        Getting the posts for you...
      </div>
      <div class="profileSection" style="display:none">
        <div id="getting-tweets" style="display: none; color: white">
          Getting posts...
        </div>

        <?php echo $__env->make('selectedAcctTweets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>  <!-- END .profile-outer -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type='text/javascript' src="<?php echo e(asset('public/js/profile.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<style>
  .profile-posts-inner {
    display: grid;
    width: 100%;
    height: 100%;
    grid-gap: 24px;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    row-gap: 32px;
  }
</style>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/profile.blade.php ENDPATH**/ ?>