<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <?php if(Route::has('tomemberauth')): ?>
         <?php if(auth()->guard()->check()): ?>
        <title><?php echo e($title); ?></title>
        <?php else: ?>
         <title><?php echo e(__('Member')); ?></title>
        <?php endif; ?>
        <?php endif; ?>

        <!-- Scripts -->
      
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      
      <script type='text/javascript' src="<?php echo e(asset('public/js/jquery-ui/jquery-ui.min.js')); ?>"></script>

        <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Montserrat&display=swap" rel="stylesheet">
    <!-- Add Toastr.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">




        <link rel="stylesheet" href="<?php echo e(asset('public/css/core.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/css/socialSettings.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/css/generalSettings.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/css/command-module.css')); ?>">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

      
      


      <script> var APP_URL = `<?php echo e(url('/')); ?>`; </script>
      <?php if(Route::has('tomemberauth')): ?>
      <?php if(auth()->guard('member')->check()): ?>
      <script> var TWITTER_ID = `<?php echo e($twitter_id); ?>`; </script>
      <script> var TWITTER_NAME = `<?php echo e($twitter_name); ?>`; </script>
      <script> var TWITTER_PHOTO = `<?php echo e($twitter_photo); ?>`; </script>
      <script> var TWITTER_USN = `<?php echo e($twitter_usn); ?>`; </script>
      <script> var QUANTUM_ID = `<?php echo e($user_id); ?>`; </script>
      <?php endif; ?>
      <?php endif; ?>

    </head>
<body class="<?php echo e(Route::has('tomemberauth') ? 'darkmode' : ''); ?>">
  <canvas></canvas>
  <div class="interface-outer">
    <div class="interface-inner">
		  <div class="banner-outer">
        <div class="banner-inner">
          <img src="<?php echo e(asset('public/')); ?>/ui-images/logo/QuantumLogo-Horizontal-white.svg" class="image-placeholder" height="100%" />

          <!-- Authentication Links -->
          <?php if(Route::has('tomemberauth')): ?>
            <?php if(auth()->guard('member')->check()): ?>
            <div class="banner-twitter-profile-wrap">
              <a href="#">
                <div class="banner-twitter-profile-inner">
                  <img src="<?php echo e($twitter_photo ?: asset('public/temp-images/imgpsh_fullsize_anim (1).png')); ?>" class="twitter-profile-image" />
                  <span class="twitter-profile-name">
                    <?php echo e($selected_user && $selected_user->twitter_name ? $selected_user->twitter_name : 'No twitter assigned'); ?>

                  </span>
                </div>  <!-- END .banner-twitter-profile-inner -->
              </a>
              <div class="banner-twitter-settings">
                <?php if(Auth::guard('member')->user()->role == 'Admin'): ?>
                  <?php if($acct_twitter_count >  0): ?>
                  <img src="<?php echo e(asset('public/ui-images/icons/00j-x-settings.svg')); ?>" class="menu-icon launch-twitter-settings" data-id="modal" id="twitter-settings" />
                  <?php endif; ?>
                  <?php else: ?>

                <?php endif; ?>

              </div>
              <div class="twitter-dropdown-wrap">
                <img src = "<?php echo e(asset('public/ui-images/icons/00-hamburger.svg')); ?>" class="menu-icon hamburger" />

                <div class="twitter-dropdown-menu-outer">
                  <div class="twitter-dropdown-menu-inner frosted">

                    <?php if($acct_twitter_count > 0): ?>
                      <div class="twitter-stat-bar">
                        <div class="twitter-stat">
                          <img src="<?php echo e(asset('public/ui-images/icons/00g-following.svg')); ?>" class="menu-icon" />
                          <span class="stat-title">Following</span>
                          <span class="stat-count count-following"><?php echo e($selected_user ? $selected_user->twitter_followingCount : 0); ?></span></div>

                        <div class="twitter-stat twitter-stat-center">
                          <img src="<?php echo e(asset('public/ui-images/icons/00h-followers.svg')); ?> " class="menu-icon" />
                          <span class="stat-title">Followers</span>
                          <span class="stat-count count-followers"><?php echo e($selected_user ? $selected_user->twitter_followersCount  : 0); ?></span></div>

                        <div class="twitter-stat">
                          <img src="<?php echo e(asset('public/ui-images/icons/00i-unfollows.svg')); ?>" class="menu-icon" />
                          <span class="stat-title">Unfollows</span>
                          <span class="stat-count count-unfollows"><?php echo e(0); ?></span></div>
                      </div>  <!-- END .twitter-stat-bar -->


                      <span class="account-select-title">Select An Account</span>

                      <?php $__currentLoopData = $memberaccts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $twitter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      
                      <div class="twitter-account-select-bar <?php echo e($twitter->twitter_id == $twitter_id ? "active" : ""); ?>" data-id="twitter-<?php echo e($twitter->twitter_id); ?>">
                        <div class="twitter-account-item ">
                          <div class="profile-twitter-account-item">
                            <div class="twitter-bar-profile-info">
                              <img src="<?php echo e($twitter->twitter_photo); ?>" />
                              <?php echo e('@' . $twitter->twitter_username); ?>

                            </div>
                          </div>
                          <img src="<?php echo e(asset('public/ui-images/icons/00j-x-settings.svg')); ?> "class="menu-icon twitter-bar-settings-icon" id="twitter-settings"/></a>
                        </div>  <!-- END .twitter-account-item -->
                      </div>  <!-- END .twitter-account-select-bar -->
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <span class="account-select-title">You have <?php echo e($acct_twitter_count); ?> account.</span>
                    <?php endif; ?>
                  </div>  <!-- END .twitter-dropdown-menu-inner -->
                </div>  <!-- END .twitter-dropdown-menu-outer -->

              </div>  <!-- END .twitter-dropdown-wrap -->
            </div>  <!-- END .banner-twitter-profile-wrap -->
          <?php else: ?>
          <div style="display:flex;align-items:center">
            <a href="https://quantumsocial.io">
            Register
            </a>
          </div>
            <?php endif; ?>
          <?php endif; ?>


          <?php if(Route::has('tomemberauth')): ?>
            <?php if(auth()->guard('member')->check()): ?>
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
                <?php if(Route::has('tomemberauth')): ?>
                  <?php if(auth()->guard('member')->check()): ?>
                  <?php echo $__env->make('main-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </ul>

                <div class="settings-bar-outer">
                  <div class="settings-bar-inner">
                    <?php if(Auth::guard('member')->user()->role == 'Admin'): ?>
                    <?php if(auth()->guard('member')->check()): ?>
                    <img src = "<?php echo e(asset('public/ui-images/icons/00b-gear.svg')); ?>" class="menu-icon launch-general-settings" data-id="modal" id="general-settings"/>
                    <?php endif; ?>
                    <?php else: ?>

                      <?php endif; ?>
                      <a href="https://quantumsocial.io/help/" target="new">
                        <img src = "<?php echo e(asset('public/ui-images/icons/00c-help.svg')); ?>" class="menu-icon launch-help-page" />
                      </a>
                      
                      <a href="https://quantumsocial.io/roadmap/" target="new">
                        <img src = "<?php echo e(asset('public/ui-images/icons/00d-compass.svg')); ?>" class="menu-icon" />
                      </a>
                      <a class="dropdown-item" href="<?php echo e(route('memberlogout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-formx').submit();">
                          <img src = "<?php echo e(asset('public/ui-images/icons/00e-logout.svg')); ?>" class="menu-icon" />
                      </a>
                      <form id="logout-formx" action="<?php echo e(route('memberlogout')); ?>" method="POST" class="d-none">
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
            <?php if(session()->has('alert')): ?>
              <div class="alert alert-<?php echo e(session('alert_type', 'info')); ?>">
                  <?php echo e(session('alert')); ?>

              </div>
            <?php endif; ?>



            <?php if(isset($message)): ?>
            <div class="alert alert-warning" role="alert">
              <?php echo e($message); ?>

            </div>
            <?php else: ?>
            <?php echo $__env->yieldContent('content'); ?>
            <?php endif; ?>

          </div>
        </div>
        <div class="footer">
            <span id="api-banner">
              Facebook and Instagram coming soon!
          </span>
        </div>
    </div>  <!-- END .interface-inner -->
  </div>  <!-- END .interface-outer -->
	<?php if(Route::has('tomemberauth')): ?>
	  <?php if(auth()->guard('member')->check()): ?>
      <?php if($title == 'Slot Scheduler'): ?>
      <div class="new-slot-anchor">
        <div class="new-slot-overlay">
          <?php echo $__env->make('newSlot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>  <!-- END .new-slot-overlay -->
      </div>  <!-- END .new-slot-anchor -->

      <?php endif; ?>
      <div class="upgrade">
        <?php if(isset($modalContent)): ?>
            <!-- Render the modal content -->
            <?php echo $modalContent; ?>

        <?php endif; ?>
      </div>
    <?php else: ?>
      <?php endif; ?>
    <?php endif; ?>
    </div>  <!-- END .new-slot-overlay -->
  </div>  <!-- END .new-slot-anchor -->

	<?php if(Route::has('tomemberauth')): ?>
    <?php if(auth()->guard('member')->check()): ?>
	  <?php echo $__env->make('account-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php else: ?>
    <?php endif; ?>
  <?php endif; ?>

  <script type='text/javascript' src="<?php echo e(asset('public/js/quantum2.js')); ?>"></script>
  <script type='text/javascript' src="<?php echo e(asset('public/js/generalSettings.js')); ?>"></script>
  <script type='text/javascript' src="<?php echo e(asset('public/js/command-module.js')); ?>"></script>
  <script type='text/javascript' src="<?php echo e(asset('public/js/dashboard.js')); ?>"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  
  

  <?php echo $__env->yieldContent('scripts'); ?>

  <script>
     $(document).ready(function() {
            // Alert
      var alert = $('.warning-sign ');

      if(alert.length == 1) {
        setTimeout(function(){
          alert.fadeOut('slow');
        }, 5000);
      }

      $('.sub-menu').css('display', 'none');
      $('.menu-item').click(function(e) {
        var menuId = e.target.dataset.target;
        // console.log(menuId)
        if (menuId) {
        // If menuId is defined, toggle its visibility
            $(`${menuId}`).toggle();
            console.log($(`ul:not(${menuId})`)) //.css('display', 'none')
        } else {
            // If menuId is not defined or falsy, close all menus
            // $(`ul:not(${menuId})`).hide();
            // $(`li:not(${menuId})`).attr('aria-expanded', false);
          // Replace 'your-menu-selector' with the appropriate selector for your menus
        }
      })

      // Sub Menu
      var uri =  "<?php echo e(basename($_SERVER['REQUEST_URI'])); ?>";

      $('.sub-menu').each(function(e, i) {
        var slug = $(this).text().toLowerCase();

        $(this).find('li').each(function(index, value) {
          if (value.id === $.trim(uri)) {
            $(this).closest('ul.sub-menu').toggle();
          }
          var li = $(this).find('li');
        });
      })

    });
  </script>
</body>
</html>
<?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/layouts/membersdashboard.blade.php ENDPATH**/ ?>