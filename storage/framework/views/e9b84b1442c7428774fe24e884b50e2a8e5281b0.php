<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

<?php if($layout): ?>
    
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<div class="page-outer queue-outer">
  <div class="page-inner queue-inner" data-sched-method="posted">

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          Posted</span>
      </div>  <!-- END .head-left-wrap -->
      <div class="head-right-wrap">
        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
      </div>  <!-- END .head-icon-wrap -->
    </div>  <!-- END .page-head-n-sort -->
    
    <div class="posted-posts-outer">
      <div class="posted-posts-inner">

        <div class="queue-day-wrapper">

        </div>  <!-- END .queue-day-wrapper" -->
        <!-- END TweetStorm Queued Post Instance -->

      </div>  <!-- END .queue-posts-inner -->
    </div>  <!-- END .queue-posts-outer -->

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type='text/javascript' src="<?php echo e(asset('public/js/posting.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/posted.blade.php ENDPATH**/ ?>