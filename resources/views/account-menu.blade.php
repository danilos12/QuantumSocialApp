 <div class="modal-large-anchor">
      <div class="modal-large-backdrop">

        <!-- BEGIN SETTINS MENUS -->

        <div class="modal-large-outer main-settings-outer general-settings-outer frosted">
          <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-general-settings" id="general-settings"/>
          <div class="menu-header">General Settings</div>

          <div class="modal-large-inner main-settings-inner general-settings-inner">

            <div data-form-url="{{ route('save-settings') }}" data-userid="{{ Auth::id() }}" id="quantum-general-settings"></div>
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
                      <span class="settings-item-data subscription-text">{{ $membership ? ucfirst($membership->subscription) : "Free" }} Plan</span>
                      <img src="{{ asset('public/')}}/ui-images/icons/pg-plan.svg" class="ui-icon change-plan" />
                    </div>  <!-- END .settings-item-data -->
                    <div class="settings-item-data-wrap">
                      <!-- CARLO - Here's the source for that, which has SQL and Array versions:  https://gist.github.com/nodesocket/3919205 -->
                      <select name="membership" id="membership" class="time-zone-data">                        
                        <option value="free" {{ isset($membership) ? ($membership->subscription === "free") ? "selected" : "" : "" }}>Free</option>                       
                        <option value="premium" {{ isset($membership) ? ($membership->subscription === "premium") ? "selected" : "" : "" }}>Premium</option>                       
                      </select>
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
                        @if ($timezones)
                        @foreach ($timezones as $timezone)
                        <option value='{{ isset($timezone) ? $timezone->value : "" }}' {{ isset($timezone) ? ($getTimezone->timezone ?? "") === $timezone->value ? "selected" : "" : "" }}>{{ isset($timezone) ? $timezone->label : "" }}</option>                       
                        @endforeach
                        @endif
                      </select>

                    </div>  <!-- END .settings-item-data -->
                  </div>  <!-- END .plan-data-wrap -->

              </div>  <!-- END .quantum-settings-inner -->
            </div>  <!-- END .quantum-settings-outer -->
            
            <!--     BEGIN TEAM MEMBERS   -->
              <div class="menu-section-outer team-account-outer">

                <div class="menu-section-inner team-account-inner">
                  <span class="menu-section-header">Team Members </span>

                    <!-- BEGIN .menu-team-account Instance -->
                    <div class="menu-team-account-outer"> 
                      <div class="menu-team-account-inner"> 

                          <img src="{{ asset('public/')}}/ui-images/icons/02-profile.svg" class="ui-icon watermark-rotate10" />

                          <div class="global-team-profile-header"> 
                          <div class="global-profile-details">
                              <div class="global-profile-name">
                              <a href="#">
                                  {{ $main_user->name }}</a>
                              </div>  <!-- END .global-profile-name -->
                              <div class="global-profile-subdata">
                              <span class="global-profile-email"> 
                                  <a href="">
                                  {{ $main_user->email }}</a></span>
                              </div>  <!-- END .global-post-date-wrap -->
                          </div>  <!-- END .global-team-profile-details -->
                          </div>  <!-- END .global-team-profile-header -->

                          <div class="menu-social-account-options">
                          <span class="menu-qaccount-default" tool-tip="Set default account." default="active"></span>
                          <span class="menu-account-icons">
                              <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg" class="ui-icon" title="Drafts" data-toggle="tooltip"/>
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon" title="Delete" data-toggle="tooltip" />
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
                              <span class="menu-account-default" data-url="{{ route("save-settings") }}" data-twitterid="{{ $acct->twitter_id }}" id="{{ $acct->twitter_id }}" data-toggle="tooltip" title="Set default account." default="{{ isset($selected_user) ? ($selected_user->twitter_id === $acct->twitter_id ? 'active' : '') : '' }}"></span>
                              <span class="menu-account-icons">
                              <img src="{{ asset('public/')}}/ui-images/icons/00j-twitter-settings.svg" class="ui-icon ui-icon-width" title="Settings" id="twitter-settings" data-icon="twitter-settings" data-toggle="tooltip" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" data-url="{{ route("twitter.remove") }}" data-twitterid="{{ $acct->twitter_id }}" id="{{ $acct->twitter_id }}"  class="ui-icon delete-account" title="Delete" data-toggle="tooltip" />
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


            <div data-form-url="{{ route('save-settings') }}" data-userid="{{ Auth::id() }}" id="general-settings"></div>
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
                            <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="copy-text-break"  {{ $generalSettings && count($generalSettings) > 0 && $generalSettings[0]->meta_value > 0 ? "checked" : "" }}>
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
                            <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="press-enter-3-times"  {{ $generalSettings && count($generalSettings) > 0 && $generalSettings[1]->meta_value > 0 ? "checked" : "" }}>
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
                            <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="email-when-queue-empty"  {{ $generalSettings && count($generalSettings) > 0 && $generalSettings[2]->meta_value > 0 ? "checked" : "" }}>
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
                            <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="refresh-cmd-add-queue"  {{ $generalSettings && count($generalSettings) > 0 && $generalSettings[3]->meta_value > 0 ? "checked" : "" }}>
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
                            <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="random-post-times"  {{ $generalSettings && count($generalSettings) > 0 && $generalSettings[4]->meta_value > 0 ? "checked" : "" }}>
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

        @include('help')

        @include('twittersettings')

        

      </div>  <!-- END .main-settings-background -->
      <!-- BEGIN COMMAND MODULE -->

      @include('modals.commandmodule')

      <!-- END COMMAND MODULE -->
  </div>  <!-- END .main-settings-anchor -->

<style>
.general-settings-outer, .twitter-settings-outer, .help-page-outer {display: none;}
</style>

@section('scripts')
<script type='text/javascript' src="{{asset('public/js/generalSettings.js')}}"></script>
@endsection