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
                <div class="page-inner queue-inner" data-sched-method="tweet-storms">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        PostStorms</span>
                      <div class="toggle-wrapper">
                        <label class="toggleSwitch large" onclick="">
                          <input type="checkbox" checked />
                          <span>
                              <span>INACTIVE</span>
                              <span>ACTIVE</span>
                          </span>
                          <a></a>
                        </label>
                      </div>  <!-- END .toggle-wrapper -->
                    </div>  <!-- END .head-left-wrap -->
                    <div class="head-right-wrap">
                     <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/add-post.svg" class="ui-icon new-promo-tweet" />
                     <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
                    </div>  <!-- END .head-icon-wrap -->
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="filter-controls">
                    <div class="drop-button-wrap sort-wrap">
                      <span class="white-select-button profile-sort-select">
                       <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-sort.svg" class="ui-icon" />
                        Month:
                       <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
                      </span>
                      <ul class="page-filters-dropdown profile-sort-dropdown queue-months-dropdown frosted">
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          December 2022</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          January 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          February 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          March 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          April 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          May 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          June 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          July 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          August 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          September 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          October 2023</li>
                        <li><img src="ui-images/icons/07-schedule.svg" class="ui-icon" />
                          November 2023</li>
                      </ul>
                    </div>  <!-- END .sort-wrap -->
                  </div>  <!-- END .filter-controls -->


                  <div class="queued-posts-outer">
                    <div class="queued-posts-inner">

<!--
Queue Types:

- empty
- custom
- comment
- retweet
- evergreen
- promo
- storm

-->


                      <div class="queue-day-wrapper">
                        <span class="queue-date-heading">Today</span>

                        <!-- BEGIN TweetStorm Queued Post Instance -->
                        <div class="tweetStorm-outer">
                          <div class="queued-single-post-wrapper queue-type-storm" status="active" queue-type="storm">
                            <div class="queued-single-post">

                             <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/08-tweet-storm.svg" class="queued-watermark" />

                              <div class="queued-single-start">
                                <span class="queued-post-time">
                                  10:30am</span>
                                <span class="queued-post-data">
                                  Sample of truncated post text #test https://...
                                </span>
                              </div>  <!-- END .queue-single-start -->

                              <div class="queued-single-end">
                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-dots.svg"
                                  class="ui-icon queued-icon queued-options-icon" />
                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-view.svg"
                                  class="ui-icon queued-icon queued-view-icon" />
                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg"
                                  class="ui-icon queued-icon queued-edit-icon" title="Drafts" data-toggle="tooltip" />
                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-trash.svg"
                                  class="ui-icon queued-icon queued-trash-icon" />
                              </div>  <!-- END .queued-single-end -->

                            </div>  <!-- END .queued-single-post -->
                            <div class="queued-options-wrapper frosted">
                              <div class="queued-options-inner">
                                <span class="queued-option-item">
                                  Post Now</span>
                                <span class="queued-option-item">
                                  Duplicate Post</span>
                                <span class="queued-option-item">
                                  Move to Top</span>
                              </div>  <!-- END .queued-options-inner -->
                            </div>  <!-- END .queued-options-wrapper -->
                          </div>  <!-- END .queued-single-post-wrapper -->

                          <div class="tweetStorm-subWrap">

                            <!-- BEGIN subTweetStorm Post Instance -->
                            <div class="queued-single-post-wrapper queue-type-storm" status="active" queue-type="storm">
                              <div class="queued-single-post">

                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/08-tweet-storm.svg" class="queued-watermark" />

                                <div class="queued-single-start">
                                  <span class="queued-post-time">
                                    10:32am</span>
                                  <span class="queued-post-data">
                                    Sample of truncated post text #test https://...
                                  </span>
                                </div>  <!-- END .queue-single-start -->

                                <div class="queued-single-end">
                                 <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-view.svg"
                                    class="ui-icon queued-icon queued-view-icon" />
                                 <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-trash.svg"
                                    class="ui-icon queued-icon queued-trash-icon" />
                                </div>  <!-- END .queued-single-end -->
                              </div>  <!-- END .queued-single-post -->
                            </div>  <!-- END .queued-single-post-wrapper -->
                            <!-- END subTweetStorm Post Instance -->

                                          <!-- BEGIN subTweetStorm Post Instance -->
                                          <div class="queued-single-post-wrapper queue-type-storm" status="active" queue-type="storm">
                                            <div class="queued-single-post">

                                             <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/08-tweet-storm.svg" class="queued-watermark" />

                                              <div class="queued-single-start">
                                                <span class="queued-post-time">
                                                  10:33am</span>
                                                <span class="queued-post-data">
                                                  Sample of truncated post text #test https://...
                                                </span>
                                              </div>  <!-- END .queue-single-start -->

                                              <div class="queued-single-end">
                                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-view.svg"
                                                  class="ui-icon queued-icon queued-view-icon" />
                                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-trash.svg"
                                                  class="ui-icon queued-icon queued-trash-icon" />
                                              </div>  <!-- END .queued-single-end -->
                                            </div>  <!-- END .queued-single-post -->
                                          </div>  <!-- END .queued-single-post-wrapper -->
                                          <!-- END subTweetStorm Post Instance -->

                                          <!-- BEGIN subTweetStorm Post Instance -->
                                          <div class="queued-single-post-wrapper queue-type-storm" status="active" queue-type="storm">
                                            <div class="queued-single-post">

                                             <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/08-tweet-storm.svg" class="queued-watermark" />

                                              <div class="queued-single-start">
                                                <span class="queued-post-time">
                                                  10:34am</span>
                                                <span class="queued-post-data">
                                                  Sample of truncated post text #test https://...
                                                </span>
                                              </div>  <!-- END .queue-single-start -->

                                              <div class="queued-single-end">
                                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-view.svg"
                                                  class="ui-icon queued-icon queued-view-icon" />
                                               <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-trash.svg"
                                                  class="ui-icon queued-icon queued-trash-icon" />
                                              </div>  <!-- END .queued-single-end -->
                                            </div>  <!-- END .queued-single-post -->
                                          </div>  <!-- END .queued-single-post-wrapper -->
                                          <!-- END subTweetStorm Post Instance -->

                          </div>  <!-- END .tweetStorm-subWrap -->

                        </div>  <!-- END .tweetStorm-outer -->
                        <!-- END TweetStorm Queued Post Instance -->


<style>
.tweetStorm-outer {
  display: flex;
  flex-direction: column;
}
.tweetStorm-subWrap {
  display: flex;
  flex-direction: column;
  padding-left: 150px;
}
</style>


                      </div>  <!-- END .queue-day-wrapper" -->

                    </div>  <!-- END .queue-posts-inner -->
                  </div>  <!-- END .queue-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type='text/javascript' src="<?php echo e(asset('public/js/posting.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/tweetstorms.blade.php ENDPATH**/ ?>