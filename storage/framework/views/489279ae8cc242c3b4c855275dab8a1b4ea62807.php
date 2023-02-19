<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<?php if(Route::has('login')): ?>
	 <?php if(auth()->guard()->check()): ?>	
    <title><?php echo e($title); ?></title>
    <?php else: ?>
	 <title><?php echo e(__('Login')); ?></title>	
	<?php endif; ?>
	<?php endif; ?>	
	
    <!-- Scripts -->
	<script type='text/javascript' src="<?php echo e(asset('public/js/jquery-3.6.1.min.js')); ?>"></script>
	<script type='text/javascript' src="<?php echo e(asset('public/js/jquery-ui/jquery-ui.min.js')); ?>"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	
	<link rel="stylesheet" href="<?php echo e(asset('public/css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('public/js/jquery-ui/jquery-ui.min.css')); ?>">
	
	
</head>
<body>
  <canvas></canvas>
  <div class="interface-outer">
    <div class="interface-inner">
		<div class="banner-outer">
        <div class="banner-inner">

          <span class="image-placeholder">Quantum Social</span>
			 <!-- Authentication Links -->
            <?php if(Route::has('login')): ?> 
			<?php if(auth()->guard()->check()): ?>	
          <div class="banner-twitter-profile-wrap">
            <a href="#">
              <div class="banner-twitter-profile-inner">
                <img src="<?php echo e(asset('public/temp-images/william-wallace.jpg')); ?>" class="twitter-profile-image" />
                <span class="twitter-profile-name">
                  <?php echo e(Auth::user()->name); ?>

                </span>
              </div>  <!-- END .banner-twitter-profile-inner -->
            </a>
            <div class="banner-twitter-settings">
              <img src="<?php echo e(asset('public/ui-images/icons/00j-twitter-settings.svg')); ?>"
              class="menu-icon launch-twitter-settings" /></div>

            <div class="twitter-dropdown-wrap">
              <img src = "<?php echo e(asset('public/ui-images/icons/00-hamburger.svg')); ?>" class="menu-icon hamburger" />

              <div class="twitter-dropdown-menu-outer">
                <div class="twitter-dropdown-menu-inner frosted">

                  <div class="twitter-stat-bar">

                    <div class="twitter-stat">
                      <img src="<?php echo e(asset('public/ui-images/icons/00g-following.svg')); ?>" class="menu-icon" />
                      <span class="stat-title">Following</span>
                      <span class="stat-count count-following">1,520</span></div>

                    <div class="twitter-stat twitter-stat-center">
                      <img src="<?php echo e(asset('public/ui-images/icons/00h-followers.svg')); ?> " class="menu-icon" />
                      <span class="stat-title">Followers</span>
                      <span class="stat-count count-followers">52,498</span></div>

                    <div class="twitter-stat">
                      <img src="<?php echo e(asset('public/ui-images/icons/00i-unfollows.svg')); ?>" class="menu-icon" />
                      <span class="stat-title">Unfollows</span>
                      <span class="stat-count count-unfollows">240</span></div>

                  </div>  <!-- END .twitter-stat-bar -->

                  <span class="account-select-title">
                    Select An Account</span>

                  <div class="twitter-account-select-bar">

                    <div class="twitter-account-item">
                      <a href="#">
                      <div class="twitter-bar-profile-info">
                        <img src="<?php echo e(asset('public/temp-images/william-wallace.jpg')); ?>" />
                      @wimbleyJimbley</div></a>
                      <a href="#">
                      <img src="<?php echo e(asset('public/ui-images/icons/00j-twitter-settings.svg')); ?> "
                            class="menu-icon twitter-bar-settings-icon" /></a>
                    </div>  <!-- END .twitter-account-item -->

                                    <div class="twitter-account-item">
                                      <a href="#">
                                      <div class="twitter-bar-profile-info">
                                        <img src="<?php echo e(asset('public/temp-images/william-wallace.jpg')); ?>" />
                                      @wimbleyJimbley</div></a>
                                      <a href="#">
                                      <img src="<?php echo e(asset('public/ui-images/icons/00j-twitter-settings.svg')); ?>"
                                            class="menu-icon twitter-bar-settings-icon" /></a>
                                    </div>  <!-- END .twitter-account-item -->


                  </div>  <!-- END .twitter-account-select-bar -->

                </div>  <!-- END .twitter-dropdown-menu-inner -->
              </div>  <!-- END .twitter-dropdown-menu-outer -->

            </div>  <!-- END .twitter-dropdown-wrap -->
          </div>  <!-- END .banner-twitter-profile-wrap -->
			 <?php else: ?>
			<div>
			<a href="<?php echo e(route('login')); ?>">
			Login
			</a>
			</div>
			<?php endif; ?>
			<?php endif; ?> 	 
			 
			 
			<?php if(Route::has('login')): ?>
				<?php if(auth()->guard()->check()): ?>		
			  <span class="toggle-wrap">
				<img src = "<?php echo e(asset('public/ui-images/icons/00f-moon.svg')); ?>"
				  class="menu-icon dark-mode-toggle"
				  id="dark-mode-toggle" />
			  </span>
			 <?php else: ?>
				<?php endif; ?>				 
			<?php endif; ?> 
        </div>  <!-- END .banner-inner -->
      </div>  <!-- END .banner-outer -->
		 <div class="lower-area-outer">
        <div class="lower-area-inner">
		 
          <div class="menu-outer">
            <div class="menu-inner">

              <div class="main-menu">

                <ul>
				    <?php if(Route::has('login')): ?>
					<?php if(auth()->guard()->check()): ?>		
                  <li class="menu-item menu-margin">
				  <a href="<?php echo e(route('dashboard')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/01-dashboard.svg')); ?>" class="menu-icon" />
                    Dashboard
					</a>
					</li>
                  <li class="menu-item menu-margin launch-command-module">
                    <img src = "<?php echo e(asset('public/ui-images/icons/pg-command.svg')); ?>" class="menu-icon" />
                    Command Module</li>
                  <li class="menu-item menu-margin">
				 <a href="<?php echo e(route('profiles')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/02-profile.svg')); ?>" class="menu-icon" />
                    Profile</a></li>
					
                  <li class="menu-item">
				   <a href="<?php echo e(route('queue')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/03-posting.svg')); ?>" class="menu-icon" />
                    Posting
					</a>
					</li>
                    <ul class="sub-menu menu-margin">

                      <li>
                        <a href="<?php echo e(route('queue')); ?>"><img src = "<?php echo e(asset('public/ui-images/icons/04-queue.svg')); ?> " class="menu-icon" />
                        Queue</a></li>
						
                      <li>
                        <a href="<?php echo e(route('drafts')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/05-drafts.svg')); ?> " class="menu-icon" />
                        Drafts</a></li>
						
                      <li><a href="<?php echo e(route('posted')); ?>">
                        <img src = "<?php echo e(asset('public/ui-images/icons/06-posted.svg')); ?> " class="menu-icon" />
                        Posted</a></li>
					
                      <li>	<a href="<?php echo e(route('slot-scheduler')); ?>">
                        <img src = "<?php echo e(asset('public/ui-images/icons/07-schedule.svg')); ?> " class="menu-icon" />
                        Slot Scheduler</a></li>
					
                      <li>	<a href="<?php echo e(route('tweet-stormer')); ?>">
                        <img src = "<?php echo e(asset('public/ui-images/icons/08-tweet-storm.svg')); ?> " class="menu-icon" />
                        Tweet Stormer</a></li>
						
                      <li><a href="<?php echo e(route('bulk-uploader')); ?>">
                        <img src = " <?php echo e(asset('public/ui-images/icons/09-bulk-upload.svg')); ?> " class="menu-icon" />
                        Bulk Uploader</a></li>
                    </ul>
                  <li class="menu-item">
                    <a href="<?php echo e(route('social-engage')); ?>">
					<img src = "<?php echo e(asset('public/ui-images/icons/10-engagement.svg')); ?>" class="menu-icon" />
                    Engagement
					</a>
					</li>
                    <ul class="sub-menu menu-margin">
                      <li>
					  <a href="<?php echo e(route('social-engage')); ?>">
                        <img src = "<?php echo e(asset('public/ui-images/icons/11-engage.svg')); ?> " class="menu-icon" />
                        Engage</a></li>
                      <li>
                        <a href="<?php echo e(route('social-mentions')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/12-mentions.svg')); ?>" class="menu-icon" />
                        Mentions</a></li>
                      <li>
                        <a href="<?php echo e(route('social-user-feeds')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/13-user-feeds.svg')); ?> " class="menu-icon" />
                        User Feeds</a></li>
                      <li>
                        <a href="<?php echo e(route('social-user-lists')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/pg-list.svg')); ?> " class="menu-icon" />
                        User Lists</a></li>
                      <li>
                        <a href="<?php echo e(route('social-hashtag-feeds')); ?>"><img src = "<?php echo e(asset('public/ui-images/icons/14-hashtag-feeds.svg')); ?>" class="menu-icon" />
                        Hashtag Feeds</a></li>
                    </ul>
                  <li class="menu-item">
				   <a href="<?php echo e(route('promo-tweets')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/15-campaigns.svg')); ?> " class="menu-icon" />
                    Campaigns
					</a>
					</li>
                    <ul class="sub-menu menu-margin">
                      <li> <a href="<?php echo e(route('promo-tweets')); ?>">
                        <img src = "<?php echo e(asset('public/ui-images/icons/17-promos.svg')); ?> " class="menu-icon" />
                        Promo Tweets</a></li>
                      <li>
                        <a href="<?php echo e(route('evergreen-tweets')); ?>"><img src = "<?php echo e(asset('public/ui-images/icons/16-evergreen.svg')); ?> " class="menu-icon" />
                        Evergreen Tweets</a></li>
                      <li>
                       <a href="<?php echo e(route('tweet-storms')); ?>"> <img src = "<?php echo e(asset('public/ui-images/icons/pg-storms.svg')); ?> " class="menu-icon" />
                        Tweet Storms</a></li>
                      <li>
                         <a href="<?php echo e(route('tag-groups')); ?>"> <img src = "<?php echo e(asset('public/ui-images/icons/18-tag-groups.svg')); ?> " class="menu-icon" />
                        Tag Groups</a></li>
                    </ul>
                  <li class="menu-item">
				   <a href="<?php echo e(route('trending-topics')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/19-trending.svg')); ?> " class="menu-icon" />
                    Trending Topics</a></li>
						</ul>
						<div class="settings-bar-outer">
						  <div class="settings-bar-inner">
							<img src = "<?php echo e(asset('public/ui-images/icons/00b-gear.svg')); ?>" class="menu-icon launch-general-settings" />
							<img src = "<?php echo e(asset('public/ui-images/icons/00c-help.svg')); ?>" class="menu-icon" />
							<img src = "<?php echo e(asset('public/ui-images/icons/00d-compass.svg')); ?>" class="menu-icon" />
							<a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
					   onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							<img src = "<?php echo e(asset('public/ui-images/icons/00e-logout.svg')); ?>" class="menu-icon" />
							</a>
							<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
								<?php echo csrf_field(); ?>
							</form>
							
						  </div>  <!-- END .settings-bar-inner -->
						</div>  <!-- END .settings-bar-outer -->
					
					
					<?php else: ?>
						
						 <?php endif; ?>
					<?php endif; ?>
							
              </div>  <!-- END .main-menu -->

            </div>  <!-- END .menu-inner -->
          </div>  <!-- END .menu-outer -->
	
	

		<div class="content-outer">
			<div class="content-inner">
				<?php echo $__env->yieldContent('content'); ?>
				</div>
		</div>
    </div>  <!-- END .interface-inner -->
  </div>  <!-- END .interface-outer -->
		<?php if(Route::has('login')): ?>
	 <?php if(auth()->guard()->check()): ?>	
<?php if($title == 'Slot Scheduler'): ?>
	<div class="new-slot-anchor">
        <div class="new-slot-overlay">
          <div class="new-slot-outer">

            <img src="<?php echo e(asset('public')); ?>/ui-images/icons/pg-close.svg" class="slot-popup-close" />

            <div class="new-slot-inner frosted">

              <span class="new-slot-title">
                Schedule A Slot</span>

              <form class="new-slot-form">
				<?php echo csrf_field(); ?>
                <select id="days-selector" name="days-selector" class="days-selector">
				  <option value="">Choose days</option>
                  <option value="sunday">Sunday</option>
                  <option value="monday">Monday</option>
                  <option value="tuesday">Tuesday</option>
                  <option value="wednesday">Wednesday</option>
                  <option value="thursday">Thursday</option>
                  <option value="friday">Friday</option>
                  <option value="saturday">Saturday</option>
                  <option value="weekdays">Weekdays</option>
                  <option value="weekend">Weekend Days</option>
                  <option value="everyday">Every Day</option>
                </select>  <!-- END .days-selector -->

                <div class="new-slot-time-wrapper">

                  <select id="hour-selector" name="hour-selector" class="hour-selector">
                    <option value="">Hour</option>
					<?php for($i = 0; $i <= 12; $i++): ?>
						<?php if( $i < 10 ): ?> 
							<option value="0<?php echo e($i); ?>"> 0<?php echo e($i); ?></option>
						<?php else: ?>
							<option value="<?php echo e($i); ?>"> <?php echo e($i); ?></option>
						<?php endif; ?>
						
					<?php endfor; ?>
                   
                  </select>  <!-- END .hour-selector -->

                  <select id="minute-selector" name="minute-selector" class="minute-selector">
                     <option value="">Minute</option>
					 <?php for($i = 0; $i <= 59; $i++): ?>
						<?php if( $i < 10 ): ?> 
							<option value="0<?php echo e($i); ?>"> 0<?php echo e($i); ?></option>
						<?php else: ?>
							<option value="<?php echo e($i); ?>"> <?php echo e($i); ?></option>
						<?php endif; ?>
						
					<?php endfor; ?>
                  </select>  <!-- END .minute-selector -->

                  <select id="am-pm-selector" name="am-pm-selector" class="am-pm-selector">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                  </select>  <!-- END .am-pm-selector -->

                </div>  <!-- END .new-slot-time-wrapper -->

                <div class="checkbox-wraps">
                  <input type="checkbox" id="make-promo" name="make-promo" value="promos-tweets" class="slot-type-checkbox">
                  <label for="make-promo">Reserve Slot for Promos</label>
                </div>  <!-- END .checkbox-wraps -->

                <div class="checkbox-wraps">
                  <input type="checkbox" id="make-evergreen" name="make-evergreen" value="evergreen-tweets" class="slot-type-check-label">
                  <label for="make-evergreen">Reserve Slot for Evergreen</label>
                </div>  <!-- END .checkbox-wraps -->
				 <div class="checkbox-wraps">
                  <input type="checkbox" id="make-tweetstorm" name="make-tweetstorm" value="tweet-storm-tweets" class="slot-type-check-label">
                  <label for="make-tweetstorm">Reserve Slot for Tweet Storms</label>
                </div>  <!-- END .checkbox-wraps -->

                <input type="submit" class="save-new-slot" value="Save Time Slot" />
				<div class="some-messages"></div>
				<div class="redirectLink" style="display: none">
				<span >You will be refreshed in </span><span id="saved-countdown"> </span><span>seconds</span>
				</div>
              </form>  <!-- END .new-slot-form -->

            </div>  <!-- END .new-slot-inner -->
          </div>  <!-- END .new-slot-outer -->

        </div>  <!-- END .new-slot-overlay -->
      </div>  <!-- END .new-slot-anchor -->
		
	<?php endif; ?>	
    <?php else: ?>
	
	<?php endif; ?>
	<?php endif; ?>	
</div>
	</div>	
	<?php if(Route::has('login')): ?>
	 <?php if(auth()->guard()->check()): ?>	
	<?php echo $__env->make('account-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		 <style>
	.general-settings-outer, .twitter-settings-outer {display: none;}
	</style>
		<?php if($title == 'Slot Scheduler'): ?>
		<script type='text/javascript' src="<?php echo e(asset('public/js/schedule.js')); ?>"></script>
		<?php endif; ?>
	 <script type='text/javascript' src="<?php echo e(asset('public/js/quantum.js')); ?>"></script>
	  <script type='text/javascript' src="<?php echo e(asset('public/js/command-module.js')); ?>"></script>
	 <?php else: ?>
	<?php endif; ?>
<?php endif; ?>	
 
</body>
</html>
<?php /**PATH C:\xampp\htdocs\app.quantumsocial.io\resources\views/layouts/app.blade.php ENDPATH**/ ?>