 <div class="modal-large-anchor">
                    <div class="modal-large-backdrop">

                      <!-- BEGIN SETTINS MENUS -->

                      <div class="modal-large-outer main-settings-outer general-settings-outer frosted">
                       <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-general-settings" />
                        <div class="menu-header">General Settings</div>

                        <div class="modal-large-inner main-settings-inner general-settings-inner">

                          <div class="menu-section-outer quantum-settings-outer">
                            <div class="menu-section-inner quantum-settings-inner">
                              <span class="menu-section-header">
                                Quantum Account</span>

                                <div class="settings-item-wrap email-data-wrap">
                                  <div class="settings-item-label-wrap">
                                   <img src="{{ asset('public/')}}/ui-images/icons/12-mentions.svg" class="ui-icon" />
                                    <span class="settings-item-label">Email Address</span>
                                  </div>  <!-- END .settings-item-label -->
                                  <div class="settings-item-data-wrap">
                                    <span class="settings-item-data account-email">{{ Auth::user()->email }}</span>
                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-key.svg" class="ui-icon change-pass" />
                                  </div>  <!-- END .settings-item-data -->
                                </div>  <!-- END .email-data-wrap -->

                                <div class="settings-item-wrap plan-data-wrap">
                                  <div class="settings-item-label-wrap">
                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-planet.svg" class="ui-icon" />
                                    <span class="settings-item-label">Current Plan</span>
                                  </div>  <!-- END .settings-item-label -->
                                  <div class="settings-item-data-wrap">
                                    <span class="settings-item-data account-email">Advanced Plan</span>
                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-plan.svg" class="ui-icon change-plan" />
                                  </div>  <!-- END .settings-item-data -->
                                </div>  <!-- END .plan-data-wrap -->

                                <div class="settings-item-wrap timezone-data-wrap">
                                  <div class="settings-item-label-wrap">
                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon" />
                                    <span class="settings-item-label">Time Zone</span>
                                  </div>  <!-- END .settings-item-label -->
                                  <div class="settings-item-data-wrap">
                                    <!-- CARLO - Here's the source for that, which has SQL and Array versions:  https://gist.github.com/nodesocket/3919205 -->
                                    <select name="timezone_offset" id="timezone-offset" class="time-zone-data">
                                    	<option value="-12:00">(GMT -12:00) Eniwetok, Kwajalein</option>
                                    	<option value="-11:00">(GMT -11:00) Midway Island, Samoa</option>
                                    	<option value="-10:00">(GMT -10:00) Hawaii</option>
                                    	<option value="-09:50">(GMT -9:30) Taiohae</option>
                                    	<option value="-09:00">(GMT -9:00) Alaska</option>
                                    	<option value="-08:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
                                    	<option value="-07:00">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
                                    	<option value="-06:00">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
                                    	<option value="-05:00" selected="selected">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
                                    	<option value="-04:50">(GMT -4:30) Caracas</option>
                                    	<option value="-04:00">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                    	<option value="-03:50">(GMT -3:30) Newfoundland</option>
                                    	<option value="-03:00">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                                    	<option value="-02:00">(GMT -2:00) Mid-Atlantic</option>
                                    	<option value="-01:00">(GMT -1:00) Azores, Cape Verde Islands</option>
                                    	<option value="+00:00">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
                                    	<option value="+01:00">(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
                                    	<option value="+02:00">(GMT +2:00) Kaliningrad, South Africa</option>
                                    	<option value="+03:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                    	<option value="+03:50">(GMT +3:30) Tehran</option>
                                    	<option value="+04:00">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                    	<option value="+04:50">(GMT +4:30) Kabul</option>
                                    	<option value="+05:00">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                    	<option value="+05:50">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                                    	<option value="+05:75">(GMT +5:45) Kathmandu, Pokhara</option>
                                    	<option value="+06:00">(GMT +6:00) Almaty, Dhaka, Colombo</option>
                                    	<option value="+06:50">(GMT +6:30) Yangon, Mandalay</option>
                                    	<option value="+07:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                                    	<option value="+08:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                                    	<option value="+08:75">(GMT +8:45) Eucla</option>
                                    	<option value="+09:00">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                    	<option value="+09:50">(GMT +9:30) Adelaide, Darwin</option>
                                    	<option value="+10:00">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                                    	<option value="+10:50">(GMT +10:30) Lord Howe Island</option>
                                    	<option value="+11:00">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                    	<option value="+11:50">(GMT +11:30) Norfolk Island</option>
                                    	<option value="+12:00">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                                    	<option value="+12:75">(GMT +12:45) Chatham Islands</option>
                                    	<option value="+13:00">(GMT +13:00) Apia, Nukualofa</option>
                                    	<option value="+14:00">(GMT +14:00) Line Islands, Tokelau</option>
                                    </select>
                                  </div>  <!-- END .settings-item-data -->
                                </div>  <!-- END .plan-data-wrap -->

                            </div>  <!-- END .quantum-settings-inner -->
                          </div>  <!-- END .quantum-settings-outer -->

<!--     BEGIN TEAM MEMBERS   -->
<div class="menu-section-outer team-account-outer">

<div class="menu-section-inner team-account-inner">
  <span class="menu-section-header">
    Team Members </span>

    <!-- BEGIN .menu-team-account Instance -->
    <div class="menu-team-account-outer"> 
      <div class="menu-team-account-inner"> 

        <img src="{{ asset('public/')}}/ui-images/icons/02-profile.svg" class="ui-icon watermark-rotate10" />

        <div class="global-team-profile-header"> 
          <div class="global-profile-details">
            <div class="global-profile-name">
              <a href="#">
                William Wallace</a>
            </div>  <!-- END .global-profile-name -->
            <div class="global-profile-subdata">
              <span class="global-profile-email"> 
                <a href="">
                  will-wallace@email.com</a></span>
            </div>  <!-- END .global-post-date-wrap -->
          </div>  <!-- END .global-team-profile-details -->
        </div>  <!-- END .global-team-profile-header -->

        <div class="menu-social-account-options">
          <span class="menu-account-default" tool-tip="Set default account." default="active"></span>
          <span class="menu-account-icons">
            <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg" class="ui-icon" />
            <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon" />
          </span>
        </div>  <!-- END .menu-social-account-options -->

      </div>  <!-- END .menu-social-account-inner -->
    </div>  <!-- END .menu-social-account-outer -->
    <!-- END .menu-social-account Instance -->



    <div class="menu-team-members-add-accounts-section"> 
      <div class="add-account add-team">
        <img src="{{ asset('public/')}}/ui-images/icons/02-profile.svg" class="ui-icon" />
        + Add New Member
      </div>  <!-- END .add-twitter-account -->
    </div>  <!-- END .menu-social-add-accounts-section -->

</div>  <!-- END .social-accounts-inner -->


                        <!-- BEGIN ADD TEAM MEMBER MODAL -->

                        <div class="add-team-member-modal"> 
                          <div class="add-team-member-inner frosted"> 

                            <!-- BEGIN input copied from engage.html -->
                            <div class="global-input-email"> 
                              <form>
                                <div class="global-input-text input-text">  
                                  <input type="text" placeholder="Name" />
                                </div>

                                <div class="global-input-text input-text">  
                                  <input type="text" placeholder="Email address" />
                                </div>

                              </form>
                              <span class="add-team-button"> 
                                Add<span>
                            </div>
                            <!-- END copied from engage.html -->

                          </div>  <!-- END .add-team-member-inner -->
                        </div>  <!-- END .add-team-member-modal -->


                        <!-- END ADD TEAM MEMBER MODAL -->
</div>  <!-- END .team-account-outer -->

<!--     END TEAM MEMBERS    -->

                          <div class="menu-section-outer social-accounts-outer">
                            <div class="menu-section-inner social-accounts-inner">
                              <span class="menu-section-header">Social Accounts</span>
                                
                                @if ($acct_twitter_count > 0)
                                      @foreach($twitter_accts as $acct)
                                      <!-- BEGIN .menu-social-account Instance -->
                                      <div class="menu-social-account-outer">
                                        <div class="menu-social-account-inner">

                                        <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon menu-account-type-icon" />

                                          <div class="global-twitter-profile-header">
                                            <a href="#">
                                            <img src="{{ $acct->twitter_photo }}"
                                                class="global-profile-image" /></a>
                                            <div class="global-profile-details">
                                              <div class="global-profile-name">
                                                <a href="#">
                                                  {{ $acct->twitter_name }}</a>
                                              </div>  <!-- END .global-author-name -->
                                              <div class="global-profile-subdata">
                                                <span class="global-profile-handle">
                                                  @<a href="">{{ $acct->twitter_username }}</a>
                                                </span>
                                              </div>  <!-- END .global-post-date-wrap -->
                                            </div>  <!-- END .global-author-details -->
                                          </div>  <!-- END .global-twitter-profile-header -->
                              
                                          <div class="menu-social-account-options">
                                            <span class="menu-account-default" tool-tip="Set default account." default="active"></span>
                                            <span class="menu-account-icons">
                                            <img src="{{ asset('public/')}}/ui-images/icons/00j-twitter-settings.svg" class="ui-icon ui-icon-width" title="Settings" data-toggle="tooltip" />
                                            <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon" title="Delete" data-toggle="tooltip" />
                                            </span>
                                          </div>  <!-- END .menu-social-account-options -->

                                        </div>  <!-- END .menu-social-account-inner -->
                                      </div>  <!-- END .menu-social-account-outer -->
                                      <!-- END .menu-social-account Instance -->
                                      @endforeach
                                      
                                @else
                                    <p>No accounts found</p>
                                @endif

                                <div class="menu-social-add-accounts-section">
                                  <div class="add-account add-twitter-account">                                   
                                    <a href="{{ url('twitter/redirect') }}">
                                      <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon vertical-middle" />
                                        <span>+ Twitter</span>
                                    </a>
                                  </div>  <!-- END .add-twitter-account -->
                                </div>  <!-- END .menu-social-add-accounts-section -->

                            </div>  <!-- END .social-accounts-inner -->
                          </div>  <!-- END .social-accounts-outer -->


                          <div class="menu-section-outer command-module-outer">
                            <div class="menu-section-inner command-module-inner">

                                <div class="menu-section-twirl-header-outer">
                                  <div class="menu-section-twirl-header-inner">

                                    <span class="menu-section-header">
                                      Command Module Settings</span>

                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg"
                                      class="ui-icon menu-section-twirl-icon menu-section-command-twirl" data-toggle="collapse" data-target="#menu-section-command-twirl" aria-expanded="true"/>

                                  </div>  <!-- END .menu-section-twirl-header-inner -->
                                </div>  <!-- END .menu-section-twirl-header-outer -->

                                <div class="menu-section-twirl-section-outer collapse" id="menu-section-command-twirl">
                                  <div class="menu-section-twirl-section-inner">

                                    <div class="menu-twirl-option-outer">
                                      <div class="menu-twirl-option-inner">
                                        <div class="menu-twirl-left">
                                         <img src="{{ asset('public/')}}/ui-images/icons/pg-clone.svg" class="ui-icon menu-twirl-option-icon" />
                                          <span class="menu-twirl-option-text">
                                            When copying text into a new post, break long text into individual posts.</span>
                                        </div>  <!-- END .menu-twirl-left -->
                                        <div class="menu-twirl-right">
                                          <input type="checkbox" class="menu-twirl-toggle">
                                        </div>  <!-- END .menu-twirl-right -->
                                      </div>  <!-- END .menu-twirl-option-inner -->
                                    </div>  <!-- END .menu-twirl-option-outer -->

                                    <div class="menu-twirl-option-outer">
                                      <div class="menu-twirl-option-inner">
                                        <div class="menu-twirl-left">
                                         <img src="{{ asset('public/')}}/ui-images/icons/pg-next-post.svg" class="ui-icon menu-twirl-option-icon twirl-next-post-icon" />
                                          <span class="menu-twirl-option-text">
                                            Pressing Enter 3 times will add a new thread.</span>
                                        </div>  <!-- END .menu-twirl-left -->
                                        <div class="menu-twirl-right">
                                          <input type="checkbox" class="menu-twirl-toggle">
                                        </div>  <!-- END .menu-twirl-right -->
                                      </div>  <!-- END .menu-twirl-option-inner -->
                                    </div>  <!-- END .menu-twirl-option-outer -->

                                  </div>  <!-- END .menu-section-twirl-section-inner -->
                                </div>  <!-- END .menu-section-twirl-section-outer -->

                            </div>  <!-- END .command-module-inner -->
                          </div>  <!-- END .command-module-outer -->

                          <div class="menu-section-outer advanced-preferences-outer">
                            <div class="menu-section-inner advanced-preferences-inner">

                                <div class="menu-section-twirl-header-outer">
                                  <div class="menu-section-twirl-header-inner">

                                    <span class="menu-section-header">
                                      Advanced Preferences</span>

                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg"
                                      class="ui-icon menu-section-twirl-icon menu-section-preferences-twirl" data-toggle="collapse" data-target="#menu-section-preferences-twirl"  />

                                  </div>  <!-- END .menu-section-twirl-header-inner -->
                                </div>  <!-- END .menu-section-twirl-header-outer -->

                                <div class="menu-section-twirl-section-outer collapse" id="menu-section-preferences-twirl">
                                  <div class="menu-section-twirl-section-inner">

                                    <div class="menu-twirl-option-outer">
                                      <div class="menu-twirl-option-inner">
                                        <div class="menu-twirl-left">
                                         <img src="{{ asset('public/')}}/ui-images/icons/04-queue.svg" class="ui-icon menu-twirl-option-icon" />
                                          <span class="menu-twirl-option-text">
                                            Email me when an account queue is nearly empty.</span>
                                        </div>  <!-- END .menu-twirl-left -->
                                        <div class="menu-twirl-right">
                                          <input type="checkbox" class="menu-twirl-toggle">
                                        </div>  <!-- END .menu-twirl-right -->

                                      </div>  <!-- END .menu-twirl-option-inner -->
                                    </div>  <!-- END .menu-twirl-option-outer -->

                                    <div class="menu-twirl-option-outer">
                                      <div class="menu-twirl-option-inner">
                                        <div class="menu-twirl-left">
                                         <img src="{{ asset('public/')}}/ui-images/icons/pg-command.svg" class="ui-icon menu-twirl-option-icon" />
                                          <span class="menu-twirl-option-text">
                                            Automatically refresh the Command Module after adding to the queue.</span>
                                        </div>  <!-- END .menu-twirl-left -->
                                        <div class="menu-twirl-right">
                                          <input type="checkbox" class="menu-twirl-toggle">
                                        </div>  <!-- END .menu-twirl-right -->

                                      </div>  <!-- END .menu-twirl-option-inner -->
                                    </div>  <!-- END .menu-twirl-option-outer -->

                                    <div class="menu-twirl-option-outer">
                                      <div class="menu-twirl-option-inner">
                                        <div class="menu-twirl-left">
                                         <img src="{{ asset('public/')}}/ui-images/icons/pg-randomize.svg" class="ui-icon menu-twirl-option-icon" />
                                          <span class="menu-twirl-option-text">
                                            Randomize post times, to make things appear more natural (up or down by 7 minutes).</span>
                                        </div>  <!-- END .menu-twirl-left -->
                                        <div class="menu-twirl-right">
                                          <input type="checkbox" class="menu-twirl-toggle">
                                        </div>  <!-- END .menu-twirl-right -->

                                      </div>  <!-- END .menu-twirl-option-inner -->
                                    </div>  <!-- END .menu-twirl-option-outer -->

                                  </div>  <!-- END .menu-section-twirl-section-inner -->
                                </div>  <!-- END .menu-section-twirl-section-outer -->

                                <!--
                                Later:
                                - Import all recent tweets from Twitter.
                                - See a notification showing how many unviewed mentions an account has.
                                -->

                            </div>  <!-- END .advanced-preferences-inner -->
                          </div>  <!-- END .advanced-preferences-outer -->

                        </div>  <!-- END .general-settings-inner -->
                      </div>  <!-- END .general-settings-outer -->

                      <div class="modal-large-outer main-settings-outer twitter-settings-outer frosted">

                       <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-twitter-settings" />
                       <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-twitter-settings" />

                        <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-twitter-settings" />

                        <div class="account-settings-header-wrap">
                          <div class="menu-header">Social Account Settings</div>
                          <div class="global-twitter-profile-header profile-header-left">
                            <a href="#">
                              
                            <div class="global-profile-details">
                              <div class="global-profile-name text-right">
                              
                              </div>  <!-- END .global-author-name -->
                              <div class="global-profile-subdata">
                              
                              </div>  <!-- END .global-post-date-wrap -->
                            </div>  <!-- END .global-author-details -->
                          </div>  <!-- END .global-twitter-profile-header -->

                        </div>  <!-- END .account-settings-header-wrap -->


                        <div class="modal-large-inner main-settings-inner twitter-settings-inner">

                          <div class="menu-section-outer command-module-account-outer">
                            <div class="menu-section-inner command-module-account-inner">

                                <div class="menu-section-twirl-header-outer">
                                  <div class="menu-section-twirl-header-inner">

                                    <span class="menu-section-header">
                                      Account Level - Command Module Settings</span>

                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg"
                                      class="ui-icon menu-section-twirl-icon menu-section-command-twirl" data-toggle="collapse" data-target="#acct-menu-section-command-twirl" />

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
                                          <input type="checkbox" class="menu-twirl-toggle">
                                        </div>  <!-- END .menu-twirl-right -->
                                      </div>  <!-- END .menu-twirl-option-inner -->
                                      <!-- START auto-reply -->
                                      <div class="menu-subTwirl-outer">
                                                      <div class="subTwirl-header-wrap">
                                                        <span class="subTwirl-header">
                                                          Modify your Auto-reply message below:</span>
                                                      </div>  <!-- END .subTwirl-header-wrap -->
                                                      <div class="menu-subTwirl-inner">
                                                        <textarea class="auto-reply-text">Hey thank you for following (@accountHandle)! <br /><br />{{01}}</textarea>
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
                                          <input type="checkbox" class="menu-twirl-toggle">
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
                                          <input type="checkbox" class="menu-twirl-toggle">
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
                                          <input type="checkbox" class="menu-twirl-toggle">
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
                                          <input type="checkbox" class="menu-twirl-toggle">
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
                                          <input type="checkbox" class="menu-twirl-toggle">
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
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                            <option>13</option>
                                                            <option>14</option>
                                                            <option>15</option>
                                                            <option>16</option>
                                                            <option>17</option>
                                                            <option>18</option>
                                                            <option>19</option>
                                                            <option>20</option>
                                                            <option>21</option>
                                                            <option>22</option>
                                                            <option>23</option>
                                                            <option>24</option>
                                                            <option>25</option>
                                                            <option>26</option>
                                                            <option>27</option>
                                                            <option>28</option>
                                                            <option>29</option>
                                                            <option>30</option>
                                                            <option>31</option>
                                                            <option>32</option>
                                                            <option>33</option>
                                                            <option>34</option>
                                                            <option>35</option>
                                                            <option>36</option>
                                                            <option>37</option>
                                                            <option>38</option>
                                                            <option>39</option>
                                                            <option>40</option>
                                                            <option>41</option>
                                                            <option>42</option>
                                                            <option>43</option>
                                                            <option>44</option>
                                                            <option>45</option>
                                                            <option>46</option>
                                                            <option>47</option>
                                                            <option>48</option>
                                                            <option>49</option>
                                                            <option>50</option>
                                                            <option>51</option>
                                                            <option>52</option>
                                                            <option>53</option>
                                                            <option>54</option>
                                                            <option>55</option>
                                                            <option>56</option>
                                                            <option>57</option>
                                                            <option>58</option>
                                                            <option>59</option>
                                                            <option>60</option>
                                                            <option>61</option>
                                                            <option>62</option>
                                                            <option>63</option>
                                                            <option>64</option>
                                                            <option>65</option>
                                                            <option>66</option>
                                                            <option>67</option>
                                                            <option>68</option>
                                                            <option>69</option>
                                                            <option>70</option>
                                                            <option>71</option>
                                                            <option>72</option>
                                                            <option>73</option>
                                                            <option>74</option>
                                                            <option>75</option>
                                                            <option>76</option>
                                                            <option>77</option>
                                                            <option>78</option>
                                                            <option>79</option>
                                                            <option>80</option>
                                                            <option>81</option>
                                                            <option>82</option>
                                                            <option>83</option>
                                                            <option>84</option>
                                                            <option>85</option>
                                                            <option>86</option>
                                                            <option>87</option>
                                                            <option>88</option>
                                                            <option>89</option>
                                                            <option>90</option>
                                                          </select>
                                                          <select class="subTwirl-auto-retweet-frame">
                                                            <option>minutes</option>
                                                            <option>hours</option>
                                                            <option>days</option>
                                                          </select>
                                                          for
                                                          <select class="subTwirl-auto-retweet-iterations">
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
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
                                          <span class="menu-twirl-option-text">
                                            Automatically remove retweets after a time (helps keep your account clean).</span>
                                        </div>  <!-- END .menu-twirl-left -->
                                        <div class="menu-twirl-right">
                                          <input type="checkbox" class="menu-twirl-toggle">
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
                                                            <option>0</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                            <option>13</option>
                                                            <option>14</option>
                                                            <option>15</option>
                                                            <option>16</option>
                                                            <option>17</option>
                                                            <option>18</option>
                                                            <option>19</option>
                                                            <option>20</option>
                                                            <option>21</option>
                                                            <option>22</option>
                                                            <option>23</option>
                                                            <option>24</option>
                                                            <option>25</option>
                                                            <option>26</option>
                                                            <option>27</option>
                                                            <option>28</option>
                                                            <option>29</option>
                                                            <option>30</option>
                                                            <option>31</option>
                                                            <option>32</option>
                                                            <option>33</option>
                                                            <option>34</option>
                                                            <option>35</option>
                                                            <option>36</option>
                                                            <option>37</option>
                                                            <option>38</option>
                                                            <option>39</option>
                                                            <option>40</option>
                                                            <option>41</option>
                                                            <option>42</option>
                                                            <option>43</option>
                                                            <option>44</option>
                                                            <option>45</option>
                                                            <option>46</option>
                                                            <option>47</option>
                                                            <option>48</option>
                                                            <option>49</option>
                                                            <option>50</option>
                                                            <option>51</option>
                                                            <option>52</option>
                                                            <option>53</option>
                                                            <option>54</option>
                                                            <option>55</option>
                                                            <option>56</option>
                                                            <option>57</option>
                                                            <option>58</option>
                                                            <option>59</option>
                                                            <option>60</option>
                                                            <option>61</option>
                                                            <option>62</option>
                                                            <option>63</option>
                                                            <option>64</option>
                                                            <option>65</option>
                                                            <option>66</option>
                                                            <option>67</option>
                                                            <option>68</option>
                                                            <option>69</option>
                                                            <option>70</option>
                                                            <option>71</option>
                                                            <option>72</option>
                                                            <option>73</option>
                                                            <option>74</option>
                                                            <option>75</option>
                                                            <option>76</option>
                                                            <option>77</option>
                                                            <option>78</option>
                                                            <option>79</option>
                                                            <option>80</option>
                                                            <option>81</option>
                                                            <option>82</option>
                                                            <option>83</option>
                                                            <option>84</option>
                                                            <option>85</option>
                                                            <option>86</option>
                                                            <option>87</option>
                                                            <option>88</option>
                                                            <option>89</option>
                                                            <option>90</option>
                                                          </select>
                                                          <select class="subTwirl-remove-retweet-frame">
                                                            <option>minutes</option>
                                                            <option>hours</option>
                                                            <option>days</option>
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
                                            <input type="checkbox" class="menu-twirl-toggle">
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
                                            <input type="checkbox" class="menu-twirl-toggle">
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

                        </div>  <!-- END .twitter-settings-inner -->
                      </div>  <!-- END .twitter-settings-outer -->

                      <!-- END SETTINGS MENUS -->


                      <!-- BEGIN COMMAND MODULE -->

                    @include('commandmodule')

                      <!-- END COMMAND MODULE -->

                    </div>  <!-- END .main-settings-background -->
                  </div>  <!-- END .main-settings-anchor -->

<style>
.general-settings-outer, .twitter-settings-outer {display: none;}
</style>