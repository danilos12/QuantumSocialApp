<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : redirect()->route('memberhome'));
?>

<?php if(is_string($layout)): ?>
    
<?php else: ?>
    <?php echo e($layout->send()); ?>

<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="page-outer queue-outer">
  <div class="page-inner queue-inner" data-sched-method="queue">

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          The Queue</span>
        <div class="toggle-wrapper">
          <label class="toggleSwitch large">
            <input type="checkbox" id="post-status" <?php echo e($toggle > 0 ? 'checked' : ''); ?>/>

            <span>
                <span>INACTIVE</span>
                <span>ACTIVE</span>
            </span>
            <a></a>
          </label>
        </div>  <!-- END .toggle-wrapper -->
      </div>  <!-- END .head-left-wrap -->
      <div class="head-right-wrap">
        
        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/add-post.svg" class="ui-icon new-queue-cmdmod" />
        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
      </div>  <!-- END .head-icon-wrap -->
    </div>  <!-- END .page-head-n-sort -->

    <div class="filter-controls">
      <div class="drop-button-wrap filter-wrap queue-source-wrap">
        <span class="white-select-button profile-filter-select">
          <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/17-promos.svg" class="ui-icon" />
          Sort by Source:
          <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
        </span>
        <ul class="page-filters-dropdown profile-filter-dropdown frosted queue-page-dd">
          <li id="all">
            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/04-queue.svg" class="ui-icon" />
            All (0)
          </li>
          <li id="non-campaign">
            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-x.svg" class="ui-icon" />
            Non-Campaign (0)
          </li>
          
          <li id="retweet">
            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            Retweets
          </li>
        </ul>
      </div>  <!-- END .filter-wrap -->
      <div class="drop-button-wrap sort-wrap">
        <span class="white-select-button profile-sort-select">
          <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-sort.svg" class="ui-icon" />
          Month:
          <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
        </span>
        <ul class="page-filters-dropdown profile-sort-dropdown queue-months-dropdown frosted">
          <li>
            <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/07-schedule.svg" class="ui-icon" />All
          </li>
        </ul>
      </div>  <!-- END .sort-wrap -->
    </div>  <!-- END .filter-controls -->

    <div id="spinner" style="display: none;">
      Loading
    </div>
    <div id="error" style="display: none;">
    </div>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success">
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?>
    <div class="queued-posts-outer" id="queuePage" >
      <div class="queued-posts-inner">
        <div class="queue-day-wrapper page-wrapper">
          


        
        </div>  <!-- END .queue-day-wrapper" -->
      </div>  <!-- END .queue-posts-inner -->
    </div>  <!-- END .queue-posts-outer -->

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->
<button id="openModalButton" style="display: none;" data-toggle="modal" data-target="#editModal"></button>

<style>
  #container {
  height: 300px; /* Set a fixed height for the container */
  overflow-y: scroll; /* Enable vertical scrolling */
}

.div-item {
  /* Styling for the div items */
  margin-bottom: 10px;
  padding: 10px;
  background-color: #f0f0f0;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type='text/javascript' src="<?php echo e(asset('public/js/posting.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/queue.blade.php ENDPATH**/ ?>