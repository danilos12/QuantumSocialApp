<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

<?php if($layout): ?>
    
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<div class="page-outer queue-outer">
                <div class="page-inner queue-inner" data-sched-method="save-draft">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Drafted</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->


                  <div class="drafted-posts-outer">
                    <div class="drafted-posts-inner">
                      <div class="queue-day-wrapper">
                        <span class="queue-date-heading">Today</span>
                      </div>

                    </div>  <!-- END .queue-posts-inner -->
                  </div>  <!-- END .queue-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type='text/javascript' src="<?php echo e(asset('public/js/posting.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAAMP\htdocs\Quantum\resources\views/drafts.blade.php ENDPATH**/ ?>