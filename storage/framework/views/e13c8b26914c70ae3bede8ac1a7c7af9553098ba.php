<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title); ?></title>

    <!-- Scripts -->
	<script type='text/javascript' src="<?php echo e(asset('js/jquery-3.6.1.min.js')); ?>"></script>
	<script type='text/javascript' src="<?php echo e(asset('js/jquery-ui/jquery-ui.min.js')); ?>"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
	
	<link rel="stylesheet" href="<?php echo e(asset('css/core.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('js/jquery-ui/jquery-ui.min.css')); ?>">
	
	
</head>
<body>
  <canvas></canvas>
  <div class="interface-outer">
    <div class="interface-inner">
		<div class="banner-outer">
        <div class="banner-inner">

          <span class="image-placeholder">Quantum Social</span>

          <div class="banner-twitter-profile-wrap">
            <a href="#">
              <div class="banner-twitter-profile-inner">
                <img src="<?php echo e(asset('temp-images/william-wallace.jpg')); ?>" class="twitter-profile-image" />
                <span class="twitter-profile-name">
                  William Wallace
                </span>
              </div>  <!-- END .banner-twitter-profile-inner -->
            </a>
            <div class="banner-twitter-settings">
              <img src="<?php echo e(asset('ui-images/icons/00j-twitter-settings.svg')); ?>"
              class="menu-icon" /></div>

            <div class="twitter-dropdown-wrap">
              <img src = "<?php echo e(asset('ui-images/icons/00-hamburger.svg')); ?>" class="menu-icon hamburger" />

              <div class="twitter-dropdown-menu-outer">
                <div class="twitter-dropdown-menu-inner frosted">

                  <div class="twitter-stat-bar">

                    <div class="twitter-stat">
                      <img src="<?php echo e(asset('ui-images/icons/00g-following.svg')); ?>" class="menu-icon" />
                      <span class="stat-title">Following</span>
                      <span class="stat-count count-following">1,520</span></div>

                    <div class="twitter-stat twitter-stat-center">
                      <img src="<?php echo e(asset('ui-images/icons/00h-followers.svg')); ?> " class="menu-icon" />
                      <span class="stat-title">Followers</span>
                      <span class="stat-count count-followers">52,498</span></div>

                    <div class="twitter-stat">
                      <img src="ui-images/icons/00i-unfollows.svg" class="menu-icon" />
                      <span class="stat-title">Unfollows</span>
                      <span class="stat-count count-unfollows">240</span></div>

                  </div>  <!-- END .twitter-stat-bar -->

                  <span class="account-select-title">
                    Select An Account</span>

                  <div class="twitter-account-select-bar">

                    <div class="twitter-account-item">
                      <a href="#">
                      <div class="twitter-bar-profile-info">
                        <img src="<?php echo e(asset('temp-images/william-wallace.jpg')); ?>" />
                      @wimbleyJimbley</div></a>
                      <a href="#">
                      <img src="<?php echo e(asset('ui-images/icons/00j-twitter-settings.svg')); ?> "
                            class="menu-icon twitter-bar-settings-icon" /></a>
                    </div>  <!-- END .twitter-account-item -->

                                    <div class="twitter-account-item">
                                      <a href="#">
                                      <div class="twitter-bar-profile-info">
                                        <img src="<?php echo e(asset('temp-images/william-wallace.jpg')); ?>" />
                                      @wimbleyJimbley</div></a>
                                      <a href="#">
                                      <img src="<?php echo e(asset('ui-images/icons/00j-twitter-settings.svg')); ?>"
                                            class="menu-icon twitter-bar-settings-icon" /></a>
                                    </div>  <!-- END .twitter-account-item -->


                  </div>  <!-- END .twitter-account-select-bar -->

                </div>  <!-- END .twitter-dropdown-menu-inner -->
              </div>  <!-- END .twitter-dropdown-menu-outer -->

            </div>  <!-- END .twitter-dropdown-wrap -->
          </div>  <!-- END .banner-twitter-profile-wrap -->

          <span class="toggle-wrap">
            <img src = "<?php echo e(asset('ui-images/icons/00f-moon.svg')); ?>"
              class="menu-icon dark-mode-toggle"
              id="dark-mode-toggle" />
          </span>

        </div>  <!-- END .banner-inner -->
      </div>  <!-- END .banner-outer -->
		 <div class="lower-area-outer">
        <div class="lower-area-inner">

          <div class="menu-outer">
            <div class="menu-inner">

              <div class="main-menu">

                <ul>
                  <li class="menu-item menu-margin">
				  <a href="<?php echo e(route('dashboard')); ?>">
                    <img src = "ui-images/icons/01-dashboard.svg" class="menu-icon" />
                    Dashboard
					</a>
					</li>
                  <li class="menu-item menu-margin launch-command-module">
                    <img src = "ui-images/icons/pg-command.svg" class="menu-icon" />
                    Command Module</li>
                  <li class="menu-item menu-margin">
				 <a href="<?php echo e(route('profiles')); ?>">
                    <img src = "ui-images/icons/02-profile.svg" class="menu-icon" />
                    Profile</li>
					</a>
                  <li class="menu-item">
				   <a href="<?php echo e(route('posting')); ?>">
                    <img src = "ui-images/icons/03-posting.svg" class="menu-icon" />
                    Posting
					</a>
					</li>
                    <ul class="sub-menu menu-margin">
                      <li>
                        <img src = "ui-images/icons/04-queue.svg" class="menu-icon" />
                        Queue</li>
                      <li>
                        <img src = "ui-images/icons/05-drafts.svg" class="menu-icon" />
                        Drafts</li>
                      <li>
                        <img src = "ui-images/icons/06-posted.svg" class="menu-icon" />
                        Posted</li>
                      <li>
                        <img src = "ui-images/icons/07-schedule.svg" class="menu-icon" />
                        Slot Scheduler</li>
                      <li>
                        <img src = "ui-images/icons/08-tweet-storm.svg" class="menu-icon" />
                        Tweet Stormer</li>
                      <li>
                        <img src = "ui-images/icons/09-bulk-upload.svg" class="menu-icon" />
                        Bulk Uploader</li>
                    </ul>
                  <li class="menu-item">
                    <a href="<?php echo e(route('engagement')); ?>">
					<img src = "ui-images/icons/10-engagement.svg" class="menu-icon" />
                    Engagement
					</a>
					</li>
                    <ul class="sub-menu menu-margin">
                      <li>
                        <img src = "ui-images/icons/11-engage.svg" class="menu-icon" />
                        Engage</li>
                      <li>
                        <img src = "ui-images/icons/12-mentions.svg" class="menu-icon" />
                        Mentions</li>
                      <li>
                        <img src = "ui-images/icons/13-user-feeds.svg" class="menu-icon" />
                        User Feeds</li>
                      <li>
                        <img src = "ui-images/icons/pg-list.svg" class="menu-icon" />
                        User Lists</li>
                      <li>
                        <img src = "ui-images/icons/14-hashtag-feeds.svg" class="menu-icon" />
                        Hashtag Feeds</li>
                    </ul>
                  <li class="menu-item">
				   <a href="<?php echo e(route('campaigns')); ?>">
                    <img src = "ui-images/icons/15-campaigns.svg" class="menu-icon" />
                    Campaigns
					</a>
					</li>
                    <ul class="sub-menu menu-margin">
                      <li>
                        <img src = "ui-images/icons/17-promos.svg" class="menu-icon" />
                        Promo Tweets</li>
                      <li>
                        <img src = "ui-images/icons/16-evergreen.svg" class="menu-icon" />
                        Evergreen Tweets</li>
                      <li>
                        <img src = "ui-images/icons/pg-storms.svg" class="menu-icon" />
                        Tweet Storms</li>
                      <li>
                        <img src = "ui-images/icons/18-tag-groups.svg" class="menu-icon" />
                        Tag Groups</li>
                    </ul>
                  <li class="menu-item">
                    <img src = "ui-images/icons/19-trending.svg" class="menu-icon" />
                    Trending Topics</li>
                </ul>

                <div class="settings-bar-outer">
                  <div class="settings-bar-inner">
                    <img src = "ui-images/icons/00b-gear.svg" class="menu-icon" />
                    <img src = "ui-images/icons/00c-help.svg" class="menu-icon" />
                    <img src = "ui-images/icons/00d-compass.svg" class="menu-icon" />
                    <img src = "ui-images/icons/00e-logout.svg" class="menu-icon" />
                  </div>  <!-- END .settings-bar-inner -->
                </div>  <!-- END .settings-bar-outer -->

              </div>  <!-- END .main-menu -->

            </div>  <!-- END .menu-inner -->
          </div>  <!-- END .menu-outer -->
	
	

		<div class="content-outer">
			<div class="content-inner">
				<?php echo $__env->yieldContent('content'); ?>
			</div>
		</div>
	
	</div>
	</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\quantumsocial\resources\views/layouts/app.blade.php ENDPATH**/ ?>