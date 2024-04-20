<div class="modal-large-outer main-settings-outer twitter-settings-outer frosted">
    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-twitter-settings" id="twitter-settings"/>

    <div class="account-settings-header-wrap">
        <div class="menu-header">Social Account Settings</div>
        <div class="global-twitter-profile-header profile-header-left">
            <a href="#">
                <img src="{{ $selected_user ? $selected_user->twitter_photo : asset('public/temp-images/imgpsh_fullsize_anim (1).png') }}"
                class="global-profile-image" />
            </a>
            <div class="global-profile-details">
                <div class="global-profile-name text-right">
                    {{ $selected_user ? $selected_user->twitter_name : 'No twitter linked' }}
                </div>  <!-- END .global-author-name -->
                <div class="global-profile-subdata">
                    <span class="global-profile-handle">
                        <a href="">{{ $selected_user ? "@" .$selected_user->twitter_username : "" }}</a>
                    </span>
                </div>  <!-- END .global-post-date-wrap -->
            </div>  <!-- END .global-author-details -->
        </div>  <!-- END .global-twitter-profile-header -->

    </div>  <!-- END .account-settings-header-wrap -->

    <div class="modal-large-inner main-settings-inner twitter-settings-inner">



        <div class="menu-section-outer x-share-access-outer">
            <div class="menu-section-inner x-share-access-inner">

                <div class="menu-section-twirl-header-outer">
                    <div class="menu-section-twirl-header-inner">

                    <span class="menu-section-header">
                        X Account Share access</span>

                    <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg"
                        class="ui-icon menu-section-twirl-icon menu-section-preferences-twirl" data-toggle="collapse" data-target="#x-share-access-twirl" />

                    </div>  <!-- END .menu-section-twirl-header-inner -->
                </div>  <!-- END .menu-section-twirl-header-outer -->

                <div class="menu-section-twirl-section-outer collapse" id="x-share-access-twirl">
                    <div class="menu-section-twirl-section-inner">



                        @foreach($xmembersaccess as $member)
                        <div class="menu-team-account-outer">
                          <div class="menu-team-account-inner">

                              <img src="{{ asset('public/')}}/ui-images/icons/02-profile.svg" class="ui-icon watermark-rotate10" />

                              <div class="global-team-profile-header">
                              <div class="global-profile-details">
                                  <div class="global-profile-name flex">

                                  <a href="#">
                                  {{$member->fullname}}
                                  @auth('member')
                                  @if(Auth::guard('member')->user()->id == $member->id)
                                   (You)
                                   @else

                                  @endif
                                  @endauth
                                  </a>

                                  </div>  <!-- END .global-profile-name -->
                                  <div class="global-profile-subdata">
                                  <span class="global-profile-email">
                                      <a href="">{{$member->email}}</a>
                                    </span>
                                  </div>  <!-- END .global-post-date-wrap -->
                              </div>  <!-- END .global-team-profile-details -->
                              </div>

                              @auth('member')


                              <!-- END .global-team-profile-header -->
                              @if(Auth::guard('member')->user()->id == $member->id)



                              @else

                              <div class="menu-social-account-options">
                                <span class="menu-qaccount-default" tool-tip="Set default account." default="active"></span>

                                <div class="childs-cont-2">
                                  <p class="childs-cont-p">Twitter ACCESS</p>

                                  <div class="">



                                    <input type="checkbox" class="menu-twirl-toggle  twitteraccess" data-trid="{{$selected_user->id}}" datas-xant="{{$member->account_holder_id}}" name="grant-x-access" data-twitter-id="{{$selected_user->twitter_id}}" id="toggle_x-{{$member->id}}" {{$idscheck->contains('member_id',$member->id) && $idscheck->contains('mtwitter_id',$selected_user->twitter_id) ? 'checked' : '' }}>





                                    </div>
                                </div>




                              </div>
                                <!-- END .menu-social-account-options -->
                              @endif
                              @endauth
                              @auth('web')




                              <div class="menu-social-account-options">
                                <span class="menu-qaccount-default" tool-tip="Set default account." default="active"></span>

                                <div class="childs-cont-2">
                                  <p class="childs-cont-p">Twitter ACCESS</p>

                                  <div class="">

                                    <input type="checkbox" class="menu-twirl-toggle twitteraccess" data-trid="{{ $selected_user ? $selected_user->id : '' }}" datas-xant="{{ $member->account_holder_id }}" name="grant-x-access" data-twitter-id="{{ $selected_user ? $selected_user->twitter_id : '' }}" id="toggle_x-{{ $member->id }}" {{ $selected_user && $idscheck->contains('member_id', $member->id) && $idscheck->contains('mtwitter_id', $selected_user->twitter_id) ? 'checked' : '' }}>




                                    </div>
                                </div>





                              </div>
                                <!-- END .menu-social-account-options -->

                              @endauth
                          </div>  <!-- END .menu-social-account-inner -->
                        </div>  <!-- END .menu-social-account-outer -->
                      @endforeach

                    </div>  <!-- END .menu-section-twirl-section-inner -->
                </div>  <!-- END .menu-section-twirl-section-outer -->
            </div>  <!-- END .x-share-access-inner -->
        </div>  <!-- END .x-share-access-outer -->

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
                                    <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_1" {{ isset($twitterSetting) ? ($twitterSetting->toggle_1 === 1) ? 'checked' : '' : ''}}>
                                </div>  <!-- END .menu-twirl-right -->
                            </div>  <!-- END .menu-twirl-option-inner -->

                            <!-- START auto-reply -->
                            <div class="menu-subTwirl-outer">
                                <div class="subTwirl-header-wrap">
                                    <span class="subTwirl-header">Modify your Auto-reply message below:</span>
                                </div>  <!-- END .subTwirl-header-wrap -->
                                <div class="menu-subTwirl-inner">
                                    <textarea class="auto-reply-text" id="auto_reply_text">{{ isset($twitterSetting) ? $twitterSetting->auto_reply_text : "" }}</textarea>
                                <div class="auto-reply-counter">
                                    <span class="auto-reply-count"></span><span class="auto-reply-limit">/200 remaining</span>
                                </div>  <!-- END .thread-ender-count -->
                                <div class="subTwirl-button" id="auto-reply-button">
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
                                    <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_2" {{ isset($twitterSetting) ? ($twitterSetting->toggle_2 === 1) ? 'checked' : '' : ''}}>
                                </div>  <!-- END .menu-twirl-right -->
                            </div>  <!-- END .menu-twirl-option-inner -->

                            <div class="menu-subTwirl-outer">
                                <div class="subTwirl-header-wrap">
                                    <span class="subTwirl-header">
                                        Modify your default Thread Ender below:</span>
                                </div>  <!-- END .subTwirl-header-wrap -->
                                <div class="menu-subTwirl-inner">
                                    <textarea class="thread-ender-text" id="text_draft_ender">{{ isset($twitterSetting) ? $twitterSetting->text_draft_ender : "" }}</textarea>
                                <div class="thread-ender-counter">
                                    <span class="thread-ender-count">154</span>/280 remaining
                                </div>  <!-- END .thread-ender-count -->
                                <div class="subTwirl-button" id="thread-ender-button">
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
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_3" {{ isset($twitterSetting) ? ($twitterSetting->toggle_3 === 1) ? 'checked' : '' : ''}}>
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
                                    <input type="text" class="subTwirl-micro-input" id="eg_rt_retweets" value="{{ isset($twitterSetting) ? $twitterSetting->eg_rt_retweets : "" }}"/>
                                retweets.
                                </div>  <!-- END .subTwirl-evergreen-retweets-wrap -->
                                <div class="subTwirl-evergreen-likes-wrap">
                                    <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon subTwirl-option-icon" />
                                    Retweet every
                                    <input type="text" class="subTwirl-micro-input" id="eg_rt_likes" value="{{ isset($twitterSetting) ? $twitterSetting->eg_rt_likes : "" }}"/>
                                likes.
                                </div>  <!-- END .subTwirl-evergreen-likes-wrap -->
                            </div>  <!-- END .subTwirl-content -->

                            <div class="subTwirl-button" id="save-evergreen-clHeRetweets">
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
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_4" {{ isset($twitterSetting) ? ($twitterSetting->toggle_4 === 1) ? 'checked' : '' : ''}}>
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
                                            <input type="text" class="subTwirl-micro-input" id="he_rt_retweets" value="{{ isset($twitterSetting) ? $twitterSetting->he_rt_retweets : "" }}"/>
                                            retweets.
                                            </div>  <!-- END .subTwirl-engagement-retweets-wrap -->
                                            <div class="subTwirl-engagement-likes-wrap">
                                            <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon subTwirl-option-icon" />
                                            Retweet every
                                            <input type="text" class="subTwirl-micro-input" id="he_rt_likes" value="{{ isset($twitterSetting) ? $twitterSetting->he_rt_likes : "" }}"/>
                                            likes.
                                            </div>  <!-- END .subTwirl-engagement-likes-wrap -->
                                        </div>  <!-- END .subTwirl-content -->

                                        <div class="subTwirl-button" id="save-evergreen-rtHeRetweets">
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
                            Set default accounts for automatic cross-retweeting via {{ !empty($selected_user->twitter_username) ? "@" . $selected_user->twitter_username : 'No username found' }}.</span>
                        </div>  <!-- END .menu-twirl-left -->
                        <div class="menu-twirl-right">
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_5" {{ isset($twitterSetting) ? ($twitterSetting->toggle_5 === 1) ? 'checked' : '' : ''}}>
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
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
                                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
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
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_6" {{ isset($twitterSetting) ? ($twitterSetting->toggle_6 === 1) ? 'checked' : '' : ''}}>
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
                                    <select class="subTwirl-auto-retweet-time" id="rt_auto_time">
                                        @for ($i=0; $i <= 90; $i++ )
                                        <option value="{{ $i }}"  {{ isset($twitterSetting) ? ($twitterSetting->rt_auto_time === $i) ? "selected" : "" : "" }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select class="subTwirl-auto-retweet-frame" id="rt_auto_frame">
                                    @php
                                        $timeframes = ['minutes', 'hours', 'days']
                                    @endphp

                                    @foreach ($timeframes as $timeframe)
                                        <option value="{{ $timeframe }}" {{ isset($twitterSetting) ? ($twitterSetting->rt_auto_frame === $i) ? "selected" : "" : "" }} >{{ $timeframe }}</option>
                                    @endforeach
                                    </select>
                                    for
                                    <select class="subTwirl-auto-retweet-iterations" id="rt_auto_ite" >
                                    @for ($i=0; $i <= 12; $i++ )
                                        <option value="{{ $i }}" {{ isset($twitterSetting) ? ($twitterSetting->rt_auto_ite === $i) ? "selected" : "" : "" }}>{{ $i }}</option>
                                    @endfor
                                    </select>
                                    iterations.
                                </div>  <!-- END .subTwirl-auto-retweet-wrap -->
                            </div>  <!-- END .subTwirl-content -->

                            <div class="subTwirl-button" id="save-autoRt">
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
                                <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_7" {{ isset($twitterSetting) ? ($twitterSetting->toggle_7 === 1) ? 'checked' : '' : ''}}>
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
                                    <select class="subTwirl-remove-retweet-time" id="rt_auto_rm_time">
                                        @for($i=0; $i<=90; $i++)
                                        <option value="{{ $i }}" {{ isset($twitterSetting) ? ($twitterSetting->rt_auto_rm_time === $i) ? "selected" : "" : "" }} >{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select class="subTwirl-remove-retweet-frame" id="rt_auto_rm_frame">
                                        @php
                                            $timeframes = ['minutes', 'hours', 'days']
                                        @endphp
                                        @foreach ($timeframes as $timeframe)
                                            <option value="{{ $timeframe }}" {{ isset($twitterSetting) ? ($twitterSetting->rt_auto_rm_frame === $i) ? "selected" : "" : "" }}  >{{ $timeframe }}</option>
                                        @endforeach
                                    </select>
                                </div>  <!-- END .subTwirl-auto-retweet-wrap -->
                            </div>  <!-- END .subTwirl-content -->

                            <div class="subTwirl-button" id="save-rtRm">
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
                            <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_8" {{ isset($twitterSetting) ? ($twitterSetting->toggle_8 === 1) ? 'checked' : '' : ''}}>
                            </div>  <!-- END .menu-twirl-right -->
                        </div>  <!-- END .menu-twirl-option-inner -->

                        <div class="menu-subTwirl-outer">
                            <div class="subTwirl-header-wrap">
                                <span class="subTwirl-header">
                                Modify your viral post comment below:</span>
                            </div>  <!-- END .subTwirl-header-wrap -->
                            <div class="menu-subTwirl-inner">
                                <textarea class="thread-ender-text" id="text_comment_offer">{{ isset($twitterSetting) ? $twitterSetting->text_comment_offer : "" }}</textarea>
                                <div class="thread-ender-counter">
                                <span class="thread-ender-count">154</span>/280 remaining
                                </div>  <!-- END .thread-ender-count -->
                                <div class="subTwirl-button" id="save-viral-autocm">
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
                        <input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_9" {{ isset($twitterSetting) ? ($twitterSetting->toggle_9 === 1) ? 'checked' : '' : ''}}>
                        </div>  <!-- END .menu-twirl-right -->
                    </div>  <!-- END .menu-twirl-option-inner -->

                                    <div class="menu-subTwirl-outer">
                                    <div class="subTwirl-header-wrap">
                                        <span class="subTwirl-header">
                                        Modify your DM to your new followers:</span>
                                    </div>  <!-- END .subTwirl-header-wrap -->
                                    <div class="menu-subTwirl-inner">
                                        <textarea class="thread-ender-text" id="text_ender_dm" >{{ isset($twitterSetting) ? $twitterSetting->text_comment_offer : "" }}</textarea>
                                        <div class="thread-ender-counter">
                                        <span class="thread-ender-count">154</span>/280 remaining
                                        </div>  <!-- END .thread-ender-count -->
                                        <div class="subTwirl-button" id="save-autodm">
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

<script type='text/javascript' src="{{asset('public/js/twitterSettings.js')}}"></script>
