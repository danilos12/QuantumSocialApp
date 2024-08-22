<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : redirect()->route('memberhome'));
?>

<?php if(is_string($layout)): ?>
    
<?php else: ?>
    <?php echo e($layout->send()); ?>

<?php endif; ?>

<?php $__env->startSection('content'); ?>

<div class="page-outer engage-outer">
                <div class="page-inner engage-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">

              <!-- CARLO, the Profile Header updates in a couple of ways...
                      1. "Choose How You Engage" is the initial option
                      2. If the user chooses a list,
                          then the Profile header gets updated with the list name
                      3. If the user inputs a hashtag,
                          then the Profile header gets updated with the hashtag
                      4. If the user inputs a Twitter handle,
                          a. then the Profile header gets hidden
                          b. the twitter profile shows with the target's data
                    -->

                        <span class="profile-heading">
                          Choose How You Engage</span>

                        <div class="global-twitter-profile-header" style="display:none;">
                          <a href="#">
                            <img src="<?php echo e(asset('public/')); ?>/temp-images/imgpsh_fullsize_anim (1).png"
                              class="global-profile-image" /></a>
                          <div class="global-profile-details">
                            <div class="global-profile-name">
                              <a href="#">
                                William Wallace</a>
                            </div>  <!-- END .global-author-name -->
                            <div class="global-profile-subdata">
                              <span class="global-profile-handle">
                                <a href="">
                                  @WilliamWallace</a></span>
                            </div>  <!-- END .global-post-date-wrap -->
                          </div>  <!-- END .global-author-details -->
                        </div>  <!-- END .global-twitter-profile-header -->

                      </div>  <!-- END .head-left-wrap -->
                    <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="filter-controls">
                    <div class="drop-button-wrap filter-wrap user-list-wrap">
                      <span class="white-select-button profile-filter-select">
                        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                        User's Lists:
                        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
                      </span>
                      <ul class="page-filters-dropdown profile-filter-dropdown frosted">
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #1</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #2</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #3</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #4</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #5</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #6</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #7</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #8</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #9</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #10</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #11</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #12</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #13</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #14</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #15</li>
                      </ul>
                    </div>  <!-- END .filter-wrap -->
                    <div class="drop-button-wrap sort-wrap">
                      <span class="white-select-button profile-sort-select">
                        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-sort.svg" class="ui-icon" />
                        Sort by:
                        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
                      </span>
                      <ul class="page-filters-dropdown profile-sort-dropdown frosted">
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-comments.svg" class="ui-icon" />
                          Chronology</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-comments.svg" class="ui-icon" />
                          Retweets</li>
                        <li><img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Favorites</li>
                      </ul>
                    </div>  <!-- END .sort-wrap -->
                    <div class="global-handle-search engage-search">
                      <input type="text" placeholder="i.e. @elonmusk" />
                    </div>
                    <div class="global-handle-search hashtag-search engage-search">
                      <input type="text" placeholder="i.e. #marketing" />
                    </div>
                  </div>  <!-- END .filter-controls -->


                  <div class="queued-posts-outer">
                    <div class="profile-posts-inner">

                      <!-- BEGIN Single Post Instance -->
                      <div class="mosaic-posts-outer">
                        <div class="mosaic-watermark-wrap frosted">
                          <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/11-engage.svg" class="mosaic-watermark engage-watermark" />
                          <div class="mosaic-posts-inner">

                            <div class="mosaic-post-controls">
                              <span class="mosaic-control-icon">
                                <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-x.svg" class="ui-icon" /></span>
                              <span class="mosaic-control-icon">
                                <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-trash.svg" class="ui-icon" /></span>
                            </div>  <!-- END .mosaic-post-controls -->

                            <div class="global-twitter-profile-header">
                              <a href="#">
                                <img src="<?php echo e(asset('public/')); ?>/temp-images/imgpsh_fullsize_anim (1).png"
                                  class="global-profile-image" /></a>
                              <div class="global-profile-details">
                                <div class="global-profile-name">
                                  <a href="#">
                                    William Wallace</a>
                                </div>  <!-- END .global-author-name -->
                                <div class="global-profile-subdata">
                                  <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-time.svg" class="ui-icon" />
                                  <span class="global-post-date">
                                    <a href="">
                                      Dec. 16, 2022 @ 5:20 p.m.</a></span>
                                </div>  <!-- END .global-post-date-wrap -->
                              </div>  <!-- END .global-author-details -->
                            </div>  <!-- END .global-twitter-profile-header -->

                            <div class="mosaic-post-data">
                              <div class="mosaic-post-text">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                              </div>  <!-- END .mosaic-post-text -->
                              <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                class="mosaic-post-image" />
                            </div>  <!-- END .mosaic-post-data -->

                            <div class="mosaic-post-scheduling">

                              <div class="mosaic-scheduling mosaic-post-analytics engage-scheduling">

                                <span class="mosaic-label mosaic-analytics-label">
                                  <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-command.svg" class="ui-icon" />
                                  Engage
                                </span>
                                <span class="mosaic-sched-buttons">
                                  <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                  <span class="mosaic-stat stat-retweets">2.20</span>
                                  <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                  <span class="mosaic-stat stat-hearts">2010</span>
                                </span>

                              </div>  <!-- END .mosaic-post-analytics -->

                              <div class="glogal-engage-comment-area">
                                <form>
                                  <textarea placeholder="Add a comment..."></textarea>
                                </form>
                                <span class="engage-comment-button">
                                  Send Comment<span>
                              </div>

                            </div>  <!-- END .mosaic-post-scheduling -->

                          </div>  <!-- END .mosaic-posts-inner -->
                        </div>  <!-- END .mosaic-watermark-wrap -->
                      </div>  <!-- END .mosaic-posts-outer -->
                      <!-- END Single Post Instance -->


                                    <!-- BEGIN Single Post Instance -->
                                    <div class="mosaic-posts-outer">
                                      <div class="mosaic-watermark-wrap frosted">
                                        <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/11-engage.svg" class="mosaic-watermark engage-watermark" />
                                        <div class="mosaic-posts-inner">

                                          <div class="mosaic-post-controls">
                                            <span class="mosaic-control-icon">
                                              <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-x.svg" class="ui-icon" /></span>
                                            <span class="mosaic-control-icon">
                                              <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-trash.svg" class="ui-icon" /></span>
                                          </div>  <!-- END .mosaic-post-controls -->

                                          <div class="global-twitter-profile-header">
                                            <a href="#">
                                              <img src="<?php echo e(asset('public/')); ?>/temp-images/imgpsh_fullsize_anim (1).png"
                                                class="global-profile-image" /></a>
                                            <div class="global-profile-details">
                                              <div class="global-profile-name">
                                                <a href="#">
                                                  William Wallace</a>
                                              </div>  <!-- END .global-author-name -->
                                              <div class="global-profile-subdata">
                                                <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-time.svg" class="ui-icon" />
                                                <span class="global-post-date">
                                                  <a href="">
                                                    Dec. 16, 2022 @ 5:20 p.m.</a></span>
                                              </div>  <!-- END .global-post-date-wrap -->
                                            </div>  <!-- END .global-author-details -->
                                          </div>  <!-- END .global-twitter-profile-header -->

                                          <div class="mosaic-post-data">
                                            <div class="mosaic-post-text">
                                              Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                                            </div>  <!-- END .mosaic-post-text -->
                                    <!--    <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                              class="mosaic-post-image" /> -->
                                          </div>  <!-- END .mosaic-post-data -->

                                          <div class="mosaic-post-scheduling">

                                            <div class="mosaic-scheduling mosaic-post-analytics engage-scheduling">

                                              <span class="mosaic-label mosaic-analytics-label">
                                                <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-command.svg" class="ui-icon" />
                                                Engage
                                              </span>
                                              <span class="mosaic-sched-buttons">
                                                <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                                <span class="mosaic-stat stat-retweets">2.20</span>
                                                <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                                <span class="mosaic-stat stat-hearts">2010</span>
                                              </span>

                                            </div>  <!-- END .mosaic-post-analytics -->

                                            <div class="glogal-engage-comment-area">
                                              <form>
                                                <textarea placeholder="Add a comment..."></textarea>
                                              </form>
                                              <span class="engage-comment-button">
                                                Send Comment<span>
                                            </div>

                                          </div>  <!-- END .mosaic-post-scheduling -->

                                        </div>  <!-- END .mosaic-posts-inner -->
                                      </div>  <!-- END .mosaic-watermark-wrap -->
                                    </div>  <!-- END .mosaic-posts-outer -->
                                    <!-- END Single Post Instance -->



                    </div>  <!-- END .profile-posts-inner -->
                  </div>  <!-- END .queued-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->


<?php $__env->stopSection(); ?>




<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAAMP\htdocs\Quantum\resources\views/engage.blade.php ENDPATH**/ ?>