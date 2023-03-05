 <div class="modal-large-outer main-settings-outer twitter-settings-outer frosted">
    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-twitter-settings" id="twitter-settings"/>

    <div class="account-settings-header-wrap">
        <div class="menu-header">Social Account Settings</div>
        <div class="global-twitter-profile-header profile-header-left">
            <a href="#">
                <img src="{{ isset($user) ? $user->twitter_photo : asset('public/temp-images/william-wallace.jpg') }}"
                class="global-profile-image" />
            </a>
            <div class="global-profile-details">
                <div class="global-profile-name text-right">
                    {{ isset($user) ? $user->twitter_name : Auth::user()->name }}
                </div>  <!-- END .global-author-name -->
                <div class="global-profile-subdata">
                    <span class="global-profile-handle">
                        @<a href="">{{ isset($user) ? $user->twitter_username : "" }}</a>
                    </span>
                </div>  <!-- END .global-post-date-wrap -->
            </div>  <!-- END .global-author-details -->
        </div>  <!-- END .global-twitter-profile-header -->

    </div>  <!-- END .account-settings-header-wrap -->
    <div data-form-url="{{ route('save-settings') }}" data-twitterid=" {{ isset($user) ? $user->twitter_id : " " }}" id="twitter-settings"></div>
    
    <div class="modal-large-inner main-settings-inner twitter-settings-inner">

        <div class="menu-section-outer command-module-account-outer">
            <div class="menu-section-inner command-module-account-inner">
                <div class="menu-section-twirl-header-outer">
                    <div class="menu-section-twirl-header-inner">

                        <span class="menu-section-header">
                        Account Level - Command Module Settings</span>

                        <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon menu-section-twirl-icon menu-section-command-twirl" data-toggle="collapse" data-target="#acct-menu-section-command-twirl" />

                    </div>  <!-- END .menu-section-twirl-header-inner -->
                </div>  <!-- END .menu-section-twirl-header-outer -->

                <div class="menu-section-twirl-section-outer collapse" id="acct-menu-section-command-twirl">
                    <div class="menu-section-twirl-section-inner">

                        <div class="menu-twirl-option-outer">
                            <div class="menu-twirl-option-inner">
                            <div class="menu-twirl-left">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon menu-twirl-option-icon" />
                                <span class="menu-twirl-option-text">
                                Automatically reply to mentions on all scheduled posts.</span>
                            </div>  <!-- END .menu-twirl-left -->
                            <div class="menu-twirl-right">
                                <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="mentions" {{ isset($twitter_settings) ? ($twitter_settings[0]->meta_value > 0 ? 'checked' : '') : '' }}>
                            </div>  <!-- END .menu-twirl-right -->
                            </div>  <!-- END .menu-twirl-option-inner -->

                            <!-- START auto-reply -->
                            <div class="menu-subTwirl-outer">
                                <div class="subTwirl-header-wrap">
                                    <span class="subTwirl-header">Modify your Auto-reply message below:</span>
                                </div>  <!-- END .subTwirl-header-wrap -->
                                <div class="menu-subTwirl-inner"><textarea class="auto-reply-text">Hey thank you for following (@accountHandle)! <br /><br />{{01}}</textarea>
                                <div class="auto-reply-counter">
                                    <span class="auto-reply-count">154</span>/280 remaining
                                </div>  <!-- END .thread-ender-count -->
                                <div class="subTwirl-button auto-reply-button">
                                    Save Auto-reply
                                </div>  <!-- END .auto-reply-button -->
                            </div>  <!-- END .menu-subTwirl-inner -->
                            <!-- END auto-reply -->

                        </div>  <!-- END .menu-twirl-option-outer -->
                        
                        <div class="menu-twirl-option-outer">

                            <div class="menu-twirl-option-inner">
                                <div class="menu-twirl-left">
                                    <img src="{{ asset('public/')}}/ui-images/icons/pg-dots.svg" class="ui-icon menu-twirl-option-icon" />
                                    <span class="menu-twirl-option-text">
                                    Add a Thread Ender post to the end of threads asking them to follow and retweet the 1st tweet in your thread.</span>
                                </div>  <!-- END .menu-twirl-left -->
                                <div class="menu-twirl-right">                                    
                                    <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="threads" {{ isset($twitter_settings) ? ($twitter_settings[1]->meta_value > 0 ? 'checked' : '') : '' }}>
                                </div>  <!-- END .menu-twirl-right -->
                            </div>  <!-- END .menu-twirl-option-inner -->

                            <div class="menu-subTwirl-outer">
                                <div class="subTwirl-header-wrap">
                                <span class="subTwirl-header">
                                    Modify your default Thread Ender below:</span>
                                </div>  <!-- END .subTwirl-header-wrap -->
                                <div class="menu-subTwirl-inner">
                                <textarea class="thread-ender-text">If you liked this thread then please follow me (@accountHandle) and share this thread by retweeting the first tweet: <br /><br />{{01}}</textarea>
                                <div class="thread-ender-counter">
                                    <span class="thread-ender-count">154</span>/280 remaining
                                </div>  <!-- END .thread-ender-count -->
                                <div class="subTwirl-button thread-ender-button">
                                    Save Thread Ender
                                </div>  <!-- END .thread-ender-button -->
                                </div>  <!-- END .menu-subTwirl-inner -->
                            </div>  <!-- END .menu-subTwirl-outer -->

                        </div>  <!-- END .menu-twirl-option-outer -->

                    </div>  <!-- END .menu-section-twirl-section-inner -->
                </div>  <!-- END .menu-section-twirl-section-outer -->
            </div>  <!-- END .command-module-inner -->
        </div>  <!-- END .command-module-outer -->
    </div>  <!-- END .twitter-settings-inner -->


    <div class="menu-section-outer automated-retweet-settings-outer">
        <div class="menu-section-inner automated-retweet-settings-inner">

            <div class="menu-section-twirl-header-outer">
                <div class="menu-section-twirl-header-inner">

                <span class="menu-section-header">
                    Automated Retweet Settings</span>

                <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg"
                    class="ui-icon menu-section-twirl-icon menu-section-preferences-twirl" data-toggle="collapse" data-target="#automated-menu-section-preferences-twirl" />

                </div>  <!-- END .menu-section-twirl-header-inner -->
            </div>  <!-- END .menu-section-twirl-header-outer -->

            <div class="menu-section-twirl-section-outer collapse" id="automated-menu-section-preferences-twirl">
                <div class="menu-section-twirl-section-inner">

                    <div class="menu-twirl-option-outer">
                        <div class="menu-twirl-option-inner">
                        <div class="menu-twirl-left">
                            <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon menu-twirl-option-icon" />
                            <span class="menu-twirl-option-text">
                            Clone high-engagement tweets into an Evergreen post.</span>
                        </div>  <!-- END .menu-twirl-left -->
                        <div class="menu-twirl-right">
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="clone-engagement-to-evergreen" {{ isset($twitter_settings) ? ($twitter_settings[2]->meta_value > 0 ? 'checked' : '') : '' }}>
                        </div>  <!-- END .menu-twirl-right -->
                        </div>  <!-- END .menu-twirl-option-inner -->
                        <!-- Start Evergreen -->
                        <div class="menu-subTwirl-outer">
                            <div class="subTwirl-header-wrap">
                                <span class="subTwirl-header"></span>
                            </div>  <!-- END .subTwirl-header-wrap -->
                            <div class="menu-subTwirl-inner">

                            <div class="subTwirl-content">
                                <div class="subTwirl-evergreen-retweets-wrap"> <!-- was "subTwirl-engagement-retweets-wrap" -->
                                    <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon subTwirl-option-icon" />
                                    Retweet every
                                    <input type="text" class="subTwirl-micro-input" value="3"/>
                                retweets.
                                </div>  <!-- END .subTwirl-evergreen-retweets-wrap -->
                                <div class="subTwirl-evergreen-likes-wrap">
                                    <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon subTwirl-option-icon" />
                                    Retweet every
                                    <input type="text" class="subTwirl-micro-input" value="7"/>
                                likes.
                                </div>  <!-- END .subTwirl-evergreen-likes-wrap -->
                            </div>  <!-- END .subTwirl-content -->

                            <div class="subTwirl-button">
                                Save Evergreen Options
                            </div>  <!-- END .subTwirl-button -->
                            </div>  <!-- END .menu-subTwirl-inner -->
                        </div>  <!-- END .menu-subTwirl-outer -->
                        <!-- End Evergreen -->

                    </div>  <!-- END .menu-twirl-option-outer -->

                    <div class="menu-twirl-option-outer">
                        <div class="menu-twirl-option-inner">
                        <div class="menu-twirl-left">
                            <img src="{{ asset('public/')}}/ui-images/icons/19-trending.svg" class="ui-icon menu-twirl-option-icon" />
                            <span class="menu-twirl-option-text">
                            Automatically retweet your own high-engagement tweets.</span>
                        </div>  <!-- END .menu-twirl-left -->
                        <div class="menu-twirl-right">
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="retweet-high-engagement-tweets" {{ isset($twitter_settings) ? ($twitter_settings[3]->meta_value > 0 ? 'checked' : '') : '' }} >
                        </div>  <!-- END .menu-twirl-right -->
                        </div>  <!-- END .menu-twirl-option-inner -->

                                    <div class="menu-subTwirl-outer">
                                        <div class="subTwirl-header-wrap">
                                        <span class="subTwirl-header"></span>
                                        </div>  <!-- END .subTwirl-header-wrap -->
                                        <div class="menu-subTwirl-inner">

                                        <div class="subTwirl-content">
                                            <div class="subTwirl-engagement-retweets-wrap">
                                            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon subTwirl-option-icon" />
                                            Retweet every
                                            <input type="text" class="subTwirl-micro-input" value="3"/>
                                            retweets.
                                            </div>  <!-- END .subTwirl-engagement-retweets-wrap -->
                                            <div class="subTwirl-engagement-likes-wrap">
                                            <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon subTwirl-option-icon" />
                                            Retweet every
                                            <input type="text" class="subTwirl-micro-input" value="7"/>
                                            likes.
                                            </div>  <!-- END .subTwirl-engagement-likes-wrap -->
                                        </div>  <!-- END .subTwirl-content -->

                                        <div class="subTwirl-button">
                                            Save Engagement Options
                                        </div>  <!-- END .subTwirl-button -->
                                        </div>  <!-- END .menu-subTwirl-inner -->
                                    </div>  <!-- END .menu-subTwirl-outer -->

                    </div>  <!-- END .menu-twirl-option-outer -->


                    <div class="menu-twirl-option-outer">
                        <div class="menu-twirl-option-inner">
                        <div class="menu-twirl-left">
                            <img src="{{ asset('public/')}}/ui-images/icons/00h-followers.svg" class="ui-icon menu-twirl-option-icon" />
                            <span class="menu-twirl-option-text">
                            Set default accounts for automatic cross-retweeting via @WilliamWallace.</span>
                        </div>  <!-- END .menu-twirl-left -->
                        <div class="menu-twirl-right">
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="set-default-auto-retweet" {{ isset($twitter_settings) ? ($twitter_settings[4]->meta_value > 0 ? 'checked' : '') : '' }}>
                        </div>  <!-- END .menu-twirl-right -->
                        </div>  <!-- END .menu-twirl-option-inner -->

                                    <div class="menu-subTwirl-outer">
                                        <div class="subTwirl-header-wrap">
                                        <span class="subTwirl-header">Cross-retweet on:</span>
                                        </div>  <!-- END .subTwirl-header-wrap -->
                                        <div class="menu-subTwirl-inner">

                                        <div class="cross-tweet-profiles-outer subTwirl-profiles-outer">
                                            <div class="cross-tweet-header"></div>
                                            <div class="cross-tweet-profiles-inner">
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                            </div>  <!-- END .cross-tweet-profiles-inner -->
                                        </div>  <!-- END .cross-tweet-profiles-outer -->

                                        </div>  <!-- END .menu-subTwirl-inner -->
                                    </div>  <!-- END .menu-subTwirl-outer -->

                    </div>  <!-- END .menu-twirl-option-outer -->


                    <div class="menu-twirl-option-outer">
                        <div class="menu-twirl-option-inner">
                        <div class="menu-twirl-left">
                            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet-timer.svg" class="ui-icon menu-twirl-option-icon" />
                            <span class="menu-twirl-option-text">
                            Automatically retweet your own tweets after some time has elapsed.</span>
                        </div>  <!-- END .menu-twirl-left -->
                        <div class="menu-twirl-right">
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="retweet-after-time-elapse" {{ isset($twitter_settings) ? ($twitter_settings[5]->meta_value > 0 ? 'checked' : '') : '' }}>
                        </div>  <!-- END .menu-twirl-right -->
                        </div>  <!-- END .menu-twirl-option-inner -->
                    </div>  <!-- END .menu-twirl-option-outer -->

                    <div class="menu-subTwirl-outer">
                        <div class="subTwirl-header-wrap">
                            <span class="subTwirl-header"></span>
                        </div>  <!-- END .subTwirl-header-wrap -->
                                
                        <div class="menu-subTwirl-inner">
                            <div class="subTwirl-content">
                                <div class="subTwirl-auto-retweet-wrap">
                                        Automatically retweet every
                                    <select class="subTwirl-auto-retweet-time">
                                        @for ($i=0; $i <= 90; $i++ )
                                        <option>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select class="subTwirl-auto-retweet-frame">
                                    @php 
                                        $timeframes = ['minutes', 'hours', 'days']
                                    @endphp   

                                    @foreach ($timeframes as $timeframe)
                                        <option> {{ $timeframe }}</option>
                                    @endforeach
                                    </select>
                                    for
                                    <select class="subTwirl-auto-retweet-iterations" >
                                    @for ($i=0; $i <= 12; $i++ )
                                        <option>{{ $i }}</option>
                                    @endfor
                                    </select>
                                    iterations.
                                </div>  <!-- END .subTwirl-auto-retweet-wrap -->
                            </div>  <!-- END .subTwirl-content -->

                            <div class="subTwirl-button">
                                Save Auto-Retweet Options
                            </div>  <!-- END .subTwirl-button -->
                        </div>  <!-- END .menu-subTwirl-inner -->
                    </div>  <!-- END .menu-subTwirl-outer -->

                    <div class="menu-twirl-option-outer">
                        <div class="menu-twirl-option-inner">
                            <div class="menu-twirl-left">
                                <!-- INGRID - We need a retweet icon like the retweet one above, except instead of a timer, we need a minus sign -->
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-clone.svg" class="ui-icon menu-twirl-option-icon" />
                                <span class="menu-twirl-option-text">Automatically remove retweets after a time (helps keep your account clean).</span>
                            </div>  <!-- END .menu-twirl-left -->
                            <div class="menu-twirl-right">
                                <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="remove-retweets" {{ isset($twitter_settings) ? ($twitter_settings[6]->meta_value > 0 ? 'checked' : '') : '' }}>
                            </div>  <!-- END .menu-twirl-right -->
                        </div>  <!-- END .menu-twirl-option-inner -->
                    </div>  <!-- END .menu-twirl-option-outer -->

                    <div class="menu-subTwirl-outer">
                        <div class="subTwirl-header-wrap">
                            <span class="subTwirl-header"></span>
                        </div>  <!-- END .subTwirl-header-wrap -->
                        
                        <div class="menu-subTwirl-inner">

                            <div class="subTwirl-content">
                                <div class="subTwirl-remove-retweet-wrap">
                                    Automatically remove retweet after
                                    <select class="subTwirl-remove-retweet-time">
                                        @for($i=0; $i<=90; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor                                   
                                    </select>
                                    <select class="subTwirl-remove-retweet-frame">
                                        @php 
                                            $timeframes = ['minutes', 'hours', 'days']
                                        @endphp   
                                        @foreach ($timeframes as $timeframe)
                                            <option> {{ $timeframe }}</option>
                                        @endforeach
                                    </select>
                                </div>  <!-- END .subTwirl-auto-retweet-wrap -->
                            </div>  <!-- END .subTwirl-content -->

                            <div class="subTwirl-button">
                                Save Retweet Removal Options
                            </div>  <!-- END .subTwirl-button -->
                        </div>  <!-- END .menu-subTwirl-inner -->
                    </div>  <!-- END .menu-subTwirl-outer -->

                </div>  <!-- END .menu-section-twirl-section-inner -->
            </div>  <!-- END .menu-section-twirl-section-outer -->
        </div>  <!-- END .automated-retweet-settings-inner -->
    </div>  <!-- END .automated-retweet-settings-outer -->



    <div class="menu-section-outer command-module-account-outer">
        <div class="menu-section-inner command-module-account-inner">

            <div class="menu-section-twirl-header-outer">
            <div class="menu-section-twirl-header-inner">

                <span class="menu-section-header">
                Automated Monetization Boosters</span>

                <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg"
                class="ui-icon menu-section-twirl-icon menu-section-command-twirl" data-toggle="collapse" data-target="#monetization-menu-section-command-twirl" />

            </div>  <!-- END .menu-section-twirl-header-inner -->
            </div>  <!-- END .menu-section-twirl-header-outer -->

            <div class="menu-section-twirl-section-outer collapse" id="monetization-menu-section-command-twirl">
            <div class="menu-section-twirl-section-inner">

                <div class="menu-twirl-option-outer">
                <div class="menu-twirl-option-inner">
                    <div class="menu-twirl-left">
                    <!-- INGRID - We need a retweet icon like the retweet one above, except instead of a timer, we need a comment icon -->
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-clone.svg" class="ui-icon menu-twirl-option-icon" />
                    <span class="menu-twirl-option-text">
                        Automatically comment your offer, if any tweet goes viral.</span>
                    </div>  <!-- END .menu-twirl-left -->
                    <div class="menu-twirl-right">
                    <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="comment-offer-viral" {{ isset($twitter_settings) ? ($twitter_settings[7]->meta_value > 0 ? 'checked' : '') : '' }}>
                    </div>  <!-- END .menu-twirl-right -->
                </div>  <!-- END .menu-twirl-option-inner -->

                                <div class="menu-subTwirl-outer">
                                <div class="subTwirl-header-wrap">
                                    <span class="subTwirl-header">
                                    Modify your viral post comment below:</span>
                                </div>  <!-- END .subTwirl-header-wrap -->
                                <div class="menu-subTwirl-inner">
                                    <textarea class="thread-ender-text">For more great content please follow me @accountHandle</textarea>
                                    <div class="thread-ender-counter">
                                    <span class="thread-ender-count">154</span>/280 remaining
                                    </div>  <!-- END .thread-ender-count -->
                                    <div class="subTwirl-button">
                                    Save Viral Auto-Comment
                                    </div>  <!-- END .subTwirl-button -->
                                </div>  <!-- END .menu-subTwirl-inner -->
                                </div>  <!-- END .menu-subTwirl-outer -->

                </div>  <!-- END .menu-twirl-option-outer -->


                <div class="menu-twirl-option-outer">
                <div class="menu-twirl-option-inner">
                    <div class="menu-twirl-left">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-dm.svg" class="ui-icon menu-twirl-option-icon" />
                    <span class="menu-twirl-option-text">
                        Auto-send welcome Direct Message to new followers</span>
                    </div>  <!-- END .menu-twirl-left -->
                    <div class="menu-twirl-right">
                    <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="send-direct-msg-new" {{ isset($twitter_settings) ? ($twitter_settings[8]->meta_value > 0 ? 'checked' : '') : '' }}>
                    </div>  <!-- END .menu-twirl-right -->
                </div>  <!-- END .menu-twirl-option-inner -->

                                <div class="menu-subTwirl-outer">
                                <div class="subTwirl-header-wrap">
                                    <span class="subTwirl-header">
                                    Modify your DM to your new followers:</span>
                                </div>  <!-- END .subTwirl-header-wrap -->
                                <div class="menu-subTwirl-inner">
                                    <textarea class="thread-ender-text">Hello, thanks for following!</textarea>
                                    <div class="thread-ender-counter">
                                    <span class="thread-ender-count">154</span>/280 remaining
                                    </div>  <!-- END .thread-ender-count -->
                                    <div class="subTwirl-button">
                                    Save Auto-DM
                                    </div>  <!-- END .subTwirl-button -->
                                </div>  <!-- END .menu-subTwirl-inner -->
                                </div>  <!-- END .menu-subTwirl-outer -->

                </div>  <!-- END .menu-twirl-option-outer -->

            </div>  <!-- END .menu-section-twirl-section-inner -->
            </div>  <!-- END .menu-section-twirl-section-outer -->

        </div>  <!-- END .command-module-inner -->
    </div>  <!-- END .command-module-outer -->
        <!--
        Later:
        - Import all recent tweets from Twitter.
        - See a notification showing how many unviewed mentions an account has.
        -->

</div>  <!-- END .twitter-settings-outer -->