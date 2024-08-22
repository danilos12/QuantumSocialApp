




        <li class="menu-item menu-margin">
            <a href="<?php echo e(route('dashboard')); ?>">
                <img src = "<?php echo e(asset('public/ui-images/icons/01-dashboard.svg')); ?>" class="menu-icon" />Dashboard
            </a>
        </li>

        <li class="menu-item menu-margin launch-command-module" data-id="modal" id="command-module">
            <img src = "<?php echo e(asset('public/ui-images/icons/pg-command.svg')); ?>" class="menu-icon" />
            Command Module
        </li>
        <li class="menu-item menu-margin">
            <a href="<?php echo e(route('profiles')); ?>">
                <img src = "<?php echo e(asset('public/ui-images/icons/02-profile.svg')); ?>" class="menu-icon" />Profile
            </a>
        </li>

        <li class="menu-item" data-toggle="collapse" data-target="#posting" aria-expanded="false">
            <img src = "<?php echo e(asset('public/ui-images/icons/03-posting.svg')); ?>" class="menu-icon" />Posting
        </li>
        <ul class="sub-menu menu-margin" id="posting" aria-expanded="false">
            <li id="queue">
                <a href="<?php echo e(route('queue')); ?>"><img src = "<?php echo e(asset('public/ui-images/icons/04-queue.svg')); ?> " class="menu-icon" />
                    Queue
                </a>
            </li>

            <li id="drafts">
                <a href="<?php echo e(route('drafts')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/05-drafts.svg')); ?> " class="menu-icon" />
                    Drafts
                </a>
            </li>

            <li id="posted">
                <a href="<?php echo e(route('posted')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/06-posted.svg')); ?> " class="menu-icon" />
                    Posted
                </a>
            </li>

            <li id="slot-scheduler">
                <a href="<?php echo e(route('slot-scheduler')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/07-schedule.svg')); ?> " class="menu-icon" id="a-slot"/>
                    Slot Scheduler
                </a>
            </li>

            

            <li id="bulk">
                <a href="<?php echo e(route('bulk-uploader')); ?>">
                    <img src = " <?php echo e(asset('public/ui-images/icons/09-bulk-upload.svg')); ?> " class="menu-icon" />
                    Bulk Uploader
                </a>
            </li>
            <li id="bulk-queue">
                <a href="<?php echo e(route('bulk-queue')); ?>">
                    <img src = " <?php echo e(asset('public/ui-images/icons/09-bulk-upload.svg')); ?> " class="menu-icon" />
                    Bulk Queue
                </a>
            </li>
        </ul>
        <?php if(Auth::guard('web')): ?>

        <?php if(auth()->guard('member')->check()): ?>


        <li class="menu-item" data-toggle="collapse" data-target="#engagement">
        <!-- <a href="<?php echo e(route('social-engage')); ?>"></a> -->
            <img src = "<?php echo e(asset('public/ui-images/icons/10-engagement.svg')); ?>" class="menu-icon" />Engagement
        </li>
        
        <ul  class="sub-menu menu-margin" id="engagement">
            <li id="engage">
                <a href="<?php echo e(route('social-engage')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/11-engage.svg')); ?> " class="menu-icon" />
                    Engage
                </a>
            </li>
            <li id="mentions">
                <a href="<?php echo e(route('social-mentions')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/12-mentions.svg')); ?>" class="menu-icon" />
                    Mentions
                </a>
            </li>
            <li id="user-feeds">
                <a href="<?php echo e(route('social-user-feeds')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/13-user-feeds.svg')); ?> " class="menu-icon" />
                    User Feeds
                </a>
            </li>
            <li id="user-lists">
                <a href="<?php echo e(route('social-user-lists')); ?>"><img src = " <?php echo e(asset('public/ui-images/icons/pg-list.svg')); ?> " class="menu-icon" />
                    User Lists
                </a>
            </li>
            <li id="hashtag-feeds">
                <a href="<?php echo e(route('social-hashtag-feeds')); ?>"><img src = "<?php echo e(asset('public/ui-images/icons/14-hashtag-feeds.svg')); ?>" class="menu-icon" />
                    Hashtag Feeds
                </a>
            </li>
        </ul>
        <?php endif; ?>
        <?php else: ?>
        
        <?php endif; ?>

        <li class="menu-item" data-toggle="collapse" data-target="#campaigns">
        <!-- <a href="<?php echo e(route('promo-tweets')); ?>"></a> -->
            <img src = "<?php echo e(asset('public/ui-images/icons/15-campaigns.svg')); ?> " class="menu-icon" />
                Post Types
        </li>
        <ul class="sub-menu menu-margin" id="campaigns">
            <li id="promo">
                <a href="<?php echo e(route('promo-tweets')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/17-promos.svg')); ?> " class="menu-icon" />
                    Promo Posts
                </a>
            </li>
            <li id="evergreen">
                <a href="<?php echo e(route('evergreen-tweets')); ?>">
                    <img src = "<?php echo e(asset('public/ui-images/icons/16-evergreen.svg')); ?> " class="menu-icon" />
                    Evergreen Posts
                </a>
            </li>
            

        </ul>
        <?php if(Auth::guard('web')->check() || (Auth::guard('member')->check() && Auth::guard('member')->user()->role == 'Admin')): ?>

        <li id="tag-groups">
            <a href="<?php echo e(route('tag-groups')); ?>">
                <img src="<?php echo e(asset('public/ui-images/icons/18-tag-groups.svg')); ?>" class="menu-icon" />
                Hashtag Manager
            </a>
        </li>

        <?php endif; ?>

        
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/main/resources/views/main-menu.blade.php ENDPATH**/ ?>