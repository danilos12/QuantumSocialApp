

<div class="modal-large-anchor">
    <div class="modal-large-backdrop">


      <div class="add-team-member-modal">
        <div class="add-team-member-inner montserrat " style="color: white">
          <img src="{{ asset('public/')}}/ui-images/icon2/Edit.svg" class="editiconadd" id=""/>
          <div class="exit-button" >

            <svg id="closing" style="width: 10%;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-2 h-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>

          </div>
            <!-- BEGIN input copied from engage.html -->
            <div class="global-input-email add-team-fonts ">
              <form class="global-input-email">
                  <div class="">
                    <div class="w-full font-normal" ><label class="font-normal" for="newuser_fname" >YOU ARE CURRENLY <span id="actionLabel">ADDING</span>:</label></div>
                    <div  id="alertcontainer" style="display: flex;justify-content:center; width:100%;"></div>
                      <div class="w-full">
                        <div class="w-full " ><label class="font-normal" for="newuser_fname" >FULL NAME</label></div>

                      <input class="h-10 w-full" type="text" placeholder="Name" id="newuser_fname"/>
                      </div>
                      <div class="w-full">

                          <label class="font-normal" for="newuser_fname ">Email Address</label>
                          <div id="emailSpan" style="display: none;align-items: center;height: 50px;">
                            <div class="mr-3"><span id="emailSpansa" class="font-normal" ></span></div>

                            <div class="w-5 h-5 svgiconhover">
                              <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                              </svg>
                              <div class="tooltip-text" id="tooltipText">Verified</div>
                            </div>
                          </div>

                      <input class="h-10 w-full" type="text" placeholder="Email" id="newuser_email"/>

                      </div>
                </div>
                  <div class="conts">
                    <div class="flex w-full items-center">
                      <div class="flex justify-start items-center" >
                      <label for="toggle_api" class="font-size-base mr-3 font-normal ">GRANT API ACCESS (Allow users to...)</label>
                      <input type="checkbox" class="menu-twirl-toggle " name="grant-api" id="toggle_api" >
                    </div>

                    </div>


                    <div class="conts mb-4">
                      <div class="flex items-center w-full mb-11">
                          <div class="flex justify-center" style="height: 20px;width:30px;" >
                            <input style='scale:2.5' type="radio" id="member_role" name="fav_language" value="Member">
                          </div>
                      <label class="bits font-normal" for="javascript">Team Member (Allows user to schedule posts..)</label>
                    </div>
                    <div class="flex w-full items-center ">
                      <div class="flex justify-center" style="height: 20px;width:30px;" >
                          <input style="scale:2.5" type="radio" id="admin_role" name="fav_language" value="Admin">
                      </div>
                      <label class="bits font-normal" for="admin_role">Admin (Allows user to add other members)</label>
                    </div>

                    </div>
                  </div>




              </form>
              <div class="center-block">
                <span  class="add-team-button"><span id="labeling">Add</span></span>
              </div>
            </div>
            <!-- END copied from engage.html -->

        </div>  <!-- END .add-team-member-inner -->
      </div>  <!-- END .add-team-member-modal -->

      <div class="change-pass-modal" style="display: none">
        <div class="change-pass-inner frosted">
            <!-- BEGIN input copied from engage.html -->
            <img src="{{ asset('public/')}}/ui-images/icon2/Edit.svg" class="editiconadd" id=""/>
            <div class="exit-button" >
              <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon settings-close close-change-pass" id="close-change-pass"/>
            </div>

            <div class="menu-header font-white">Change Password</div>
            <div class="global-input-email">
              <form id="changePassForm">
                <div class="global-input-text input-text">
                  <input type="text" placeholder="Old Password" id="old_password" name="old_password"/>
                </div>

                <div class="global-input-text input-text">
                  <input type="text" placeholder="New Password" id="new_password" name="new_password"/>
                </div>

                <input type="submit" value="Change Password" class="font-white">
              </form>
            </div>
            <!-- END copied from engage.html -->

        </div>  <!-- END .add-team-member-inner -->
      </div>  <!-- END .add-team-member-modal -->

      
            
      <div class="cancel-subscription-modal" style="display: none">
        <div class="cancel-subscription-inner frosted">
            <!-- BEGIN input copied from engage.html -->
            {{-- <img src="{{ asset('public/')}}/ui-images/icon2/Edit.svg" class="editiconadd" id=""/> --}}
            <div class="exit-button" >
              <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon settings-close close-change-pass" id="close-change-pass"/>
            </div>

            <div class="menu-header font-white">Are you sure you want to cancel your subscription?</div>
            <div class="global-input-email" style="padding: 0%">
              <form id="cancelSubscriptionForm">
                <div class="global-input-text ">
                  <p style="font-weight:bold; color: white">If you are sure, please type below your quantum email</p>
                  <input type="text" placeholder="Quantum Social Email" id="quantum_social_email" name="quantum_social_email" style="width: 100%; "/>
                </div>  
                <br>              

                <input type="submit" class="subTwirl-buttons"  value="Cancel my subscription" style="border:none; color: white; background-color: red ">
                
              </form>
            </div>
            <!-- END copied from engage.html -->

        </div>  <!-- END .add-team-member-inner -->
      </div>  <!-- END .add-team-member-modal -->

      <div class="modal-large-outer main-settings-outer general-settings-outer frosted">
        <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-general-settings" id="general-settings"/>
        <div class="menu-header">General Settings</div>

        <div class="modal-large-inner main-settings-inner general-settings-inner">
          <!--     BEGIN QUANTUM ACCOUNT   -->
          
          <div class="menu-section-outer quantum-settings-outer">
            <div class="menu-section-inner quantum-settings-inner" id="quantum_acct">
              <span class="menu-section-header">
                Quantum Account</span>

                <div class="settings-item-wrap email-data-wrap">
                  <div class="settings-item-label-wrap">
                    <img src="{{ asset('public/')}}/ui-images/icons/12-mentions.svg" class="ui-icon" />
                    <span class="settings-item-label">Email Address</span>
                  </div>  <!-- END .settings-item-label -->
                  <div class="settings-item-data-wrap">
                    <span class="settings-item-data account-email">
                      @if(Auth::guard('member')->check())
                          {{ Auth::guard('member')->user()->email }}
                      @else
                          {{ Auth::user()->email }}
                      @endif
                  </span>
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-key.svg" class="ui-icon change-pass" />
                  </div>  <!-- END .settings-item-data -->
                </div>  <!-- END .email-data-wrap -->

                <div class="settings-item-wrap plan-data-wrap">
                  <div class="settings-item-label-wrap">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-planet.svg" class="ui-icon" />
                    <span class="settings-item-label">Current Plan</span>
                  </div>  <!-- END .settings-item-label -->
                  <div class="settings-item-data-wrap">
                    @php 
                      $tier = $membership ? $membership->subscription_name === 'astro' ? 'Astral Lifetime' : ucfirst($membership->subscription_name) : 'No'; 
                    @endphp 
                    <span class="settings-item-data subscription-text">{{ $tier }} Plan</span>
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
                      @if ($timezones)
                      @foreach ($timezones as $timezone)
                      <option value='{{ isset($timezone) ? $timezone->value : "" }}' {{ isset($timezone) ? ($mainUser->timezone ?? "") === $timezone->value ? "selected" : "" : "" }}>{{ isset($timezone) ? $timezone->label : "" }}</option>
                      @endforeach
                      @endif
                    </select>

                  </div>  <!-- END .settings-item-data -->
                </div>  <!-- END .plan-data-wrap -->

            </div>  <!-- END .quantum-settings-inner -->
          </div>  <!-- END .quantum-settings-outer -->
          <!--     END QUANTUM ACCOUNT   -->
          
          {{-- for admin access only --}}
          @if (Auth::guard('web')->check() || Auth::guard('member')->check())

          <!--     BEGIN TEAM MEMBERS   -->
          <div class="menu-section-outer team-account-outer">
            <div class="menu-section-inner team-account-inner">
              <span class="menu-section-header">Team Members </span>

                {{-- @if ($cntmembers > 0) --}}
                  @foreach($team_members as $member)
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
                              <p class="childs-cont-p">ADMIN ACCESS</p>

                              <div class="">


                                  <input type="checkbox" class="menu-twirl-toggle adminaccess" name="grant-admin-access" id="toggle_admin-{{$member->id}}" <?php echo $member->admin_access == 1 ? 'checked' : ''; ?>>


                                </div>
                            </div>

                            <div class="childs-cont">

                              <p class="childs-cont-p">API ACCESS</p>
                              <p class="switchtexton">On</p>
                              <p class="switchtextoff">Off</p>
                              <div class="">

                              <input  type="checkbox" class="menu-twirl-toggle forchecked apiaccess" name="grant-api-access" id="toggle_api-{{$member->id}}" <?php echo $member->api_access == 1 ? 'checked' :'';?>>
                            </div>
                            </div>


                            <span class="menu-account-icons">
                             <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg" class="ui-icon menu-account-icons-img editing" title="Edit" data-toggle="tooltip" id="_edit-{{ $member->id }}"/>
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon menu-account-icons-img deleting" title="Delete" data-toggle="tooltip" id="_delete-{{ $member->id }}" />
                            </span>
                          </div>
                            <!-- END .menu-social-account-options -->
                          @endif
                          @endauth
                          @auth('web')




                          <div class="menu-social-account-options">
                            <span class="menu-qaccount-default" tool-tip="Set default account." default="active"></span>

                            <div class="childs-cont-2">
                              <p class="childs-cont-p">ADMIN ACCESS</p>

                              <div class="">


                                  <input type="checkbox" class="menu-twirl-toggle  adminaccess" name="grant-admin-access" id="toggle_admin-{{$member->id}}" <?php echo $member->admin_access == 1 ? 'checked' : ''; ?>>


                                </div>
                            </div>

                            <div class="childs-cont">

                              <p class="childs-cont-p">API ACCESS</p>

                              <div class="">

                              <input  type="checkbox" class="menu-twirl-toggle  apiaccess" name="grant-api-access" id="toggle_api-{{$member->id}}" <?php echo $member->api_access == 1 ? 'checked' :'';?>>
                            </div>
                            </div>


                            <span class="menu-account-icons">
                             <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg" class="ui-icon menu-account-icons-img editing" title="Edit" data-toggle="tooltip" id="_edit-{{ $member->id }}"/>
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon menu-account-icons-img deleting" title="Delete" data-toggle="tooltip" id="_delete-{{ $member->id }}" />
                            </span>
                          </div>
                            <!-- END .menu-social-account-options -->

                          @endauth
                      </div>  <!-- END .menu-social-account-inner -->
                    </div>  <!-- END .menu-social-account-outer -->
                  @endforeach
                {{-- @enderror --}}

                <div class="menu-team-members-add-accounts-section">
                  <div class="add-account add-team">
                      <img src="{{ asset('public/')}}/ui-images/icons/02-profile.svg" class="ui-icon" />
                      + Add New Member
                  </div>  <!-- END .add-twitter-account -->
                </div>  <!-- END .menu-social-add-accounts-section -->

            </div>  <!-- END .social-accounts-inner -->





                                  <!-- END ADD TEAM MEMBER MODAL -->
          </div>  <!-- END .team-account-outer -->
          <!--     END TEAM MEMBERS    -->
          

          @if($membership->trial_credits > 0)
          <div id="credit-warning" class="alert alert-warning">
            <strong>Warning:</strong> You have remaining API credits. If you proceed with entering new credentials, you may lose your remaining API credits.
          </div>
          @endif

          <div class="menu-section-outer social-accounts-outer">
            <div class="menu-section-inner social-accounts-inner">
              <span class="menu-section-header">X API Credential</span>

              <div class="menu-twirl-option-outer">
                <div class="menu-twirl-option-inner">
                  <div class="menu-twirl-left">
                      <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon menu-twirl-option-icon" />
                      <span class="menu-twirl-option-text">
                        Use this Master API for every X account.</span>
                  </div>
                  <!-- END .menu-twirl-left -->
                  <div class="menu-twirl-right">

                    <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_1" {{ isset($generalSetting) ? ($generalSetting->toggle_1 === 1) ? 'checked' : '' : ''}}>
                  </div>  <!-- END .menu-twirl-right -->
                </div>  <!-- END .menu-twirl-option-inner -->

                <!-- START auto-reply -->
                <div class="menu-subTwirl-outer">
                  <form id="master_api_form">
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">API Key:</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="api_key" name="api_key" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->api_key  : ''  }}"/>
                    </div>
                    <div class="subTwirl-header-wrap">
                        <span class="subTwirl-header">API Secret:</span>
                    </div>
                    <div class="menu-subTwirl-inner input-group">
                      <input type="password" class="input-field" id="api_secret" name="api_secret" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->api_secret  : ''  }}"/>
                      <div class="input-group-append">
                        <span class="input-group-text"><img src="{{ asset('public')}}/ui-images/icons/eye-open.svg" alt="password" class="secrets" id="api_secret"></span>
                      </div>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">Bearer Token:</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="bearer_token" name="bearer_token" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->bearer_token : ''  }}"/>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">OAuth 2.0 ID:</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="oauth_id" name="oauth_id" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->oauth_id : ''  }}"/>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">OAuth 2.0 Secret:</span>
                    </div>
                    <div class="menu-subTwirl-inner input-group">
                      <input type="password" class="input-field" id="oauth_secret" name="oauth_secret" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->oauth_secret : ''  }}"/>
                      <div class="input-group-append">
                        <span class="input-group-text"><img src="{{ asset('public')}}/ui-images/icons/eye-open.svg" alt="password" class="secrets" id="oauth_secret"></span>
                      </div>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">Callback URL</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="callback_url" name="callback_url" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->callback_url : 'https://app.quantumsocial.io/twitter/oauth'  }}" readonly/>
                    </div>
                    <input type="hidden" name="form_recipient" value="general-settings">
                    <div class="menu-subTwirl-inner">
                      <input type="submit" value="Save API credentials" class="subTwirl-buttons" style="margin-top: 0.5em; border: none">
                    </div>
                  </form>
                </div>

                <div class="menu-twirl-option-inner">
                  <div class="menu-twirl-left">
                      <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon menu-twirl-option-icon" />
                      <span class="menu-twirl-option-text">
                        Allow each X account to have its own API <br>
                        <span style="font-weight: 200; font-style: italic;">(Keeping this off forces all accounts to use the Master API, but activating it will give the choice on the account level in each Twitter account's settings.)</span>
                      </span>
                  </div>  <!-- END .menu-twirl-left -->
                  <div class="menu-twirl-right"><input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_7" {{ isset($generalSetting) ? ($generalSetting->toggle_7 === 1) ? 'checked' : '' : ''}}>
                  </div>  <!-- END .menu-twirl-right -->
                </div>  <!-- END .menu-twirl-option-inner -->
              </div>  <!-- END .menu-twirl-option-outer -->

            </div>  <!-- END .social-accounts-inner -->
          </div>
          

          <!-- END .social-accounts-outer -->
          @elseif(Auth::guard('member')->user()->api_access == 1)
          @auth('member')

          <!-- TWITTER API -->
          <div class="menu-section-outer social-accounts-outer">
            <div class="menu-section-inner social-accounts-inner">
              <span class="menu-section-header">X API Credential</span>

              <div class="menu-twirl-option-outer">
                <div class="menu-twirl-option-inner">
                  <div class="menu-twirl-left">
                      <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon menu-twirl-option-icon" />
                      <span class="menu-twirl-option-text">
                        Use this Master API for every X account.</span>
                  </div>
                  <!-- END .menu-twirl-left -->
                  <div class="menu-twirl-right">

                    <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_1" {{ isset($generalSetting) ? ($generalSetting->toggle_1 === 1) ? 'checked' : '' : ''}}>
                  </div>  <!-- END .menu-twirl-right -->
                </div>  <!-- END .menu-twirl-option-inner -->

                <!-- START auto-reply -->
                <div class="menu-subTwirl-outer">
                  <form id="master_api_form">
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">API Key:</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="api_key" name="api_key" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->api_key  : ''  }}"/>
                    </div>
                    <div class="subTwirl-header-wrap">
                        <span class="subTwirl-header">API Secret:</span>
                    </div>
                    <div class="menu-subTwirl-inner input-group">
                      <input type="password" class="input-field" id="api_secret" name="api_secret" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->api_secret  : ''  }}"/>
                      <div class="input-group-append">
                        <span class="input-group-text"><img src="{{ asset('public')}}/ui-images/icons/eye-open.svg" alt="password" class="secrets" id="api_secret"></span>
                      </div>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">Bearer Token:</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="bearer_token" name="bearer_token" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->bearer_token : ''  }}"/>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">OAuth 2.0 ID:</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="oauth_id" name="oauth_id" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->oauth_id : ''  }}"/>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">OAuth 2.0 Secret:</span>
                    </div>
                    <div class="menu-subTwirl-inner input-group">
                      <input type="password" class="input-field" id="oauth_secret" name="oauth_secret" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->oauth_secret : ''  }}"/>
                      <div class="input-group-append">
                        <span class="input-group-text"><img src="{{ asset('public')}}/ui-images/icons/eye-open.svg" alt="password" class="secrets" id="oauth_secret"></span>
                      </div>
                    </div>
                    <div class="subTwirl-header-wrap">
                      <span class="subTwirl-header">Callback URL</span>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="text" class="input-field" id="callback_url" name="callback_url" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->callback_url : 'https://app.quantumsocial.io/twitter/oauth'  }}" readonly/>
                    </div>
                    <div class="menu-subTwirl-inner">
                      <input type="submit" value="Save API credentials" class="subTwirl-buttons" style="margin-top: 0.5em; border: none">
                    </div>
                  </form>
                </div>

                <div class="menu-twirl-option-inner">
                  <div class="menu-twirl-left">
                      <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon menu-twirl-option-icon" />
                      <span class="menu-twirl-option-text">
                        Allow each X account to have its own API <br>
                        <span style="font-weight: 200; font-style: italic;">(Keeping this off forces all accounts to use the Master API, but activating it will give the choice on the account level in each Twitter account's settings.)</span>
                      </span>
                  </div>  <!-- END .menu-twirl-left -->
                  <div class="menu-twirl-right"><input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_7" {{ isset($generalSetting) ? ($generalSetting->toggle_7 === 1) ? 'checked' : '' : ''}}>
                  </div>  <!-- END .menu-twirl-right -->
                </div>  <!-- END .menu-twirl-option-inner -->
              </div>  <!-- END .menu-twirl-option-outer -->

            </div>  <!-- END .social-accounts-inner -->
          </div>
          <!-- TWITTER API -->

          @endauth
          @endif


          {{-- for admin access only end --}}
          <div class="menu-section-outer social-accounts-outer">
            <div class="menu-section-inner social-accounts-inner">
              <span class="menu-section-header">Social Accounts</span>
                @if ($acct_twitter_count > 0)
                      @foreach($twitter_accts as $acct)
                      <!-- BEGIN .menu-social-account Instance -->
                      <div class="menu-social-account-outer">
                        <div class="menu-social-account-inner">

                        <img src="{{ asset('public/')}}/ui-images/icons/pg-x.svg" class="ui-icon menu-account-type-icon" />

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

                          <span class="menu-account-icons">
                            <span class="menu-account-default" data-twitter_id="{{ $acct->twitter_id }}" data-toggle="tooltip" title="Set default account. Page will reload after select" default="{{ isset($selected_user) ? ($selected_user->twitter_id === $acct->twitter_id ? 'active' : '') : '' }}"></span>
                            @if ($selected_user->twitter_id === $acct->twitter_id)
                            <img src="{{ asset('public/')}}/ui-images/icons/00j-x-settings.svg" class="ui-icon ui-icon-width" title="Twitter Settings" id="x-twitter-settings" data-icon="twitter-settings" data-toggle="tooltip" />
                            <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" data-twitterid="{{ $acct->twitter_id }}" id="{{ $acct->twitter_id }}"  class="ui-icon delete-account" title="Delete" data-toggle="tooltip" />
                            @else
                            <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" data-twitterid="{{ $acct->twitter_id }}" id="{{ $acct->twitter_id }}"  class="ui-icon delete-account" title="Delete" data-toggle="tooltip" />
                            @endif
                          </span>

                        </div>  <!-- END .menu-social-account-inner -->
                      </div>  <!-- END .menu-social-account-outer -->
                      <!-- END .menu-social-account Instance -->
                      @endforeach

                @else
                    <p>No accounts found</p>
                @endif

                {{-- @if ($checkRole->status === 1 && $checkRole->trial_counter > 0)  --}}
                <div class="menu-social-add-accounts-section">
                  <div class="add-account add-twitter-account" id="link-twitter" style="width: 15%">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-x.svg" class="ui-icon vertical-middle" />
                        <span>Add X account</span>
                  </div>  <!-- END .add-twitter-account -->
                </div>  <!-- END .menu-social-add-accounts-section -->
                {{-- @endif --}}

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
                          <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_2"  {{ isset($generalSetting) ? ($generalSetting->toggle_2 === 1) ? 'checked' : '' : '' }}>
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
                          <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_3"  {{ isset($generalSetting) ? ($generalSetting->toggle_3 === 1) ? 'checked' : '' : ''}}>
                        </div>  <!-- END .menu-twirl-right -->
                      </div>  <!-- END .menu-twirl-option-inner -->
                    </div>  <!-- END .menu-twirl-option-outer -->

                  </div>  <!-- END .menu-section-twirl-section-inner -->
                </div>  <!-- END .menu-section-twirl-section-outer -->

            </div>  <!-- END .command-module-inner -->
          </div>  <!-- END .command-module-outer -->

          @php 
            $show = 0;
          @endphp 
          @if ($show==1)
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
                          <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_4"  {{ isset($generalSetting) ? ($generalSetting->toggle_4 === 1) ? 'checked' : '' : ''}}>
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
                          <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_5"  {{ isset($generalSetting) ? ($generalSetting->toggle_5 === 1) ? 'checked' : '' : ''}}>
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
                          <input type="checkbox" class="menu-twirl-toggle" name="general-settings[]" id="toggle_6"  {{ isset($generalSetting) ? ($generalSetting->toggle_6 === 1) ? 'checked' : '' : ''}}>
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
          @endif

          <div class="menu-section-outer advanced-preferences-outer">
            <div class="menu-section-inner advanced-preferences-inner">

                <div class="menu-section-twirl-header-outer">
                  <div class="menu-section-twirl-header-inner">

                    <span class="menu-section-header">
                      Cancel your subscription</span>                                     

                      <div class="menu-subTwirl-inner">
                        <input type="button" value="Cancel your subscription" class="subTwirl-buttons" id="cancel-subscription" style="margin-top: 0.5em; border: none; background: red;">                        
                      </div>
                  </div>  <!-- END .menu-section-twirl-header-inner -->
                </div>  <!-- END .menu-section-twirl-header-outer -->                            
            </div>  <!-- END .advanced-preferences-inner -->
          </div>  <!-- END .advanced-preferences-outer -->

        </div>  <!-- END .general-settings-inner -->
      </div>  <!-- END .general-settings-outer -->



      @include('twittersettings')


      @include('modals.commandmodule')

    </div>  <!-- END .main-settings-background -->
    <!-- BEGIN COMMAND MODULE -->

    {{-- @include('modals.edit-commandmodule') --}}

    <!-- END COMMAND MODULE -->
  </div>  <!-- END .main-settings-anchor -->

  <style>
  /* .general-settings-outer, .twitter-settings-outer, .help-page-outer{display: none;} */

  .mt-2 { margin-top: 0.5em;}

  .input-group {
    position: relative;
    display: flex;
  }

  .input-group-append {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    display: flex;
    align-items: center;
  }

  .input-group-text img {
    width: 20px; /* Adjust the size as needed */
    margin-right: 0.5em;
  }

  #reveal {
    cursor: pointer;
  }

  .global-input-email {
    height: auto
  }
  </style>
