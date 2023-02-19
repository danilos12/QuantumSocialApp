 <!-- BEGIN MAIN MENU -->

                  <div class="modal-large-anchor main-settings-anchor">
                    <div class="modal-large-backdrop main-settings-background">

                      <div class="modal-large-outer main-settings-outer frosted">

                       <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close" />
                        <div class="menu-header">General Settings</div>

                        <div class="modal-large-inner main-settings-inner">

                          <div class="menu-section-outer quantum-settings-outer">
                            <div class="menu-section-inner quantum-settings-inner">
                              <span class="menu-section-header">
                                Quantum Account</span>

                                <div class="settings-item-wrap email-data-wrap">
                                  <div class="settings-item-label-wrap">
                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/12-mentions.svg" class="ui-icon" />
                                    <span class="settings-item-label">Email Address</span>
                                  </div>  <!-- END .settings-item-label -->
                                  <div class="settings-item-data-wrap">
                                    <span class="settings-item-data account-email">users-address@email.com</span>
                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-key.svg" class="ui-icon change-pass" />
                                  </div>  <!-- END .settings-item-data -->
                                </div>  <!-- END .email-data-wrap -->

                                <div class="settings-item-wrap plan-data-wrap">
                                  <div class="settings-item-label-wrap">
                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-planet.svg" class="ui-icon" />
                                    <span class="settings-item-label">Current Plan</span>
                                  </div>  <!-- END .settings-item-label -->
                                  <div class="settings-item-data-wrap">
                                    <span class="settings-item-data account-email">Advanced Plan</span>
                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-plan.svg" class="ui-icon change-plan" />
                                  </div>  <!-- END .settings-item-data -->
                                </div>  <!-- END .plan-data-wrap -->

                                <div class="settings-item-wrap timezone-data-wrap">
                                  <div class="settings-item-label-wrap">
                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-time.svg" class="ui-icon" />
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


                          <div class="menu-section-outer social-accounts-outer">
                            <div class="menu-section-inner social-accounts-inner">
                              <span class="menu-section-header">
                                Social Accounts</span>

                                <!-- BEGIN .menu-social-account Instance -->
                                <div class="menu-social-account-outer">
                                  <div class="menu-social-account-inner">

                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-twitter.svg" class="ui-icon menu-account-type-icon" />

                                    <div class="global-twitter-profile-header">
                                      <a href="#">
                                       <img src="<?php echo e(asset('public/')); ?>/temp-images/william-wallace.jpg"
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

                          <!-- FAITH - We need a global jQuery function to have the tool tip show up on hover (see below).
                                        - Use this for the class="tool-tip" and have it show up right below the element they hover on.

                                        For anything beyond that, please coordinate with Ingrid on style.
                          -->
                                    <div class="menu-social-account-options">
                                      <span class="menu-account-default" tool-tip="Set default account." default="active"></span>
                                      <span class="menu-account-icons">
                                       <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/05-drafts.svg" class="ui-icon" />
                                       <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-trash.svg" class="ui-icon" />
                                      </span>
                                    </div>  <!-- END .menu-social-account-options -->

                                  </div>  <!-- END .menu-social-account-inner -->
                                </div>  <!-- END .menu-social-account-outer -->
                                <!-- END .menu-social-account Instance -->

                                <div class="menu-social-add-accounts-section">
                                  <div class="add-account add-twitter-account">
                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-twitter.svg" class="ui-icon" />
                                    + Twitter
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

                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-arrow.svg"
                                      class="ui-icon menu-section-twirl-icon menu-section-command-twirl" />

                                  </div>  <!-- END .menu-section-twirl-header-inner -->
                                </div>  <!-- END .menu-section-twirl-header-outer -->

                                <div class="menu-section-twirl-section-outer">
                                  <div class="menu-section-twirl-section-inner">

                                    <div class="menu-twirl-option-outer">
                                      <div class="menu-twirl-option-inner">
                                        <div class="menu-twirl-left">
                                         <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-clone.svg" class="ui-icon menu-twirl-option-icon" />
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
                                         <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-next-post.svg" class="ui-icon menu-twirl-option-icon twirl-next-post-icon" />
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

                                   <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-arrow.svg"
                                      class="ui-icon menu-section-twirl-icon menu-section-preferences-twirl" />

                                  </div>  <!-- END .menu-section-twirl-header-inner -->
                                </div>  <!-- END .menu-section-twirl-header-outer -->

                                <div class="menu-section-twirl-section-outer">
                                  <div class="menu-section-twirl-section-inner">

                                    <div class="menu-twirl-option-outer">
                                      <div class="menu-twirl-option-inner">
                                        <div class="menu-twirl-left">
                                         <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/04-queue.svg" class="ui-icon menu-twirl-option-icon" />
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
                                         <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-command.svg" class="ui-icon menu-twirl-option-icon" />
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
                                         <img src="<?php echo e(asset('public/')); ?>/ui-images/icons/pg-randomize.svg" class="ui-icon menu-twirl-option-icon" />
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

                        </div>  <!-- END .main-settings-inner -->
                      </div>  <!-- END .main-settings-outer -->

                    </div>  <!-- END .main-settings-background -->
                  </div>  <!-- END .main-settings-anchor --><?php /**PATH /home/quantum_social/app.quantumsocial.io/resources/views/main-menu.blade.php ENDPATH**/ ?>