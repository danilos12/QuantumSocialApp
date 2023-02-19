<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	@if (Route::has('login'))
	 @auth	
    <title>{{ $title }}</title>
    @else
	 <title>{{ __('Login') }}</title>	
	@endauth
	@endif	
	
    <!-- Scripts -->
	<script type='text/javascript' src="{{ asset('public/js/jquery-3.6.1.min.js') }}"></script>
	<script type='text/javascript' src="{{ asset('public/js/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	
	<link rel="stylesheet" href="{{ asset('public/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('public/js/jquery-ui/jquery-ui.min.css') }}">
	
	
</head>
<body>
  <canvas></canvas>
  <div class="interface-outer">
    <div class="interface-inner">
		<div class="banner-outer">
        <div class="banner-inner">

          <span class="image-placeholder">Quantum Social</span>
			 <!-- Authentication Links -->
            @if (Route::has('login')) 
			@auth	
          <div class="banner-twitter-profile-wrap">
            <a href="#">
              <div class="banner-twitter-profile-inner">
                <img src="{{ asset('public/temp-images/william-wallace.jpg') }}" class="twitter-profile-image" />
                <span class="twitter-profile-name">
                  {{ Auth::user()->name }}
                </span>
              </div>  <!-- END .banner-twitter-profile-inner -->
            </a>
            <div class="banner-twitter-settings">
              <img src="{{ asset('public/ui-images/icons/00j-twitter-settings.svg') }}"
              class="menu-icon launch-twitter-settings" /></div>

            <div class="twitter-dropdown-wrap">
              <img src = "{{ asset('public/ui-images/icons/00-hamburger.svg') }}" class="menu-icon hamburger" />

              <div class="twitter-dropdown-menu-outer">
                <div class="twitter-dropdown-menu-inner frosted">

                  <div class="twitter-stat-bar">

                    <div class="twitter-stat">
                      <img src="{{ asset('public/ui-images/icons/00g-following.svg') }}" class="menu-icon" />
                      <span class="stat-title">Following</span>
                      <span class="stat-count count-following">1,520</span></div>

                    <div class="twitter-stat twitter-stat-center">
                      <img src="{{ asset('public/ui-images/icons/00h-followers.svg') }} " class="menu-icon" />
                      <span class="stat-title">Followers</span>
                      <span class="stat-count count-followers">52,498</span></div>

                    <div class="twitter-stat">
                      <img src="{{ asset('public/ui-images/icons/00i-unfollows.svg') }}" class="menu-icon" />
                      <span class="stat-title">Unfollows</span>
                      <span class="stat-count count-unfollows">240</span></div>

                  </div>  <!-- END .twitter-stat-bar -->

                  <span class="account-select-title">
                    Select An Account</span>

                  <div class="twitter-account-select-bar">

                    <div class="twitter-account-item">
                      <a href="#">
                      <div class="twitter-bar-profile-info">
                        <img src="{{ asset('public/temp-images/william-wallace.jpg') }}" />
                      @wimbleyJimbley</div></a>
                      <a href="#">
                      <img src="{{ asset('public/ui-images/icons/00j-twitter-settings.svg') }} "
                            class="menu-icon twitter-bar-settings-icon" /></a>
                    </div>  <!-- END .twitter-account-item -->

                                    <div class="twitter-account-item">
                                      <a href="#">
                                      <div class="twitter-bar-profile-info">
                                        <img src="{{ asset('public/temp-images/william-wallace.jpg') }}" />
                                      @wimbleyJimbley</div></a>
                                      <a href="#">
                                      <img src="{{ asset('public/ui-images/icons/00j-twitter-settings.svg') }}"
                                            class="menu-icon twitter-bar-settings-icon" /></a>
                                    </div>  <!-- END .twitter-account-item -->


                  </div>  <!-- END .twitter-account-select-bar -->

                </div>  <!-- END .twitter-dropdown-menu-inner -->
              </div>  <!-- END .twitter-dropdown-menu-outer -->

            </div>  <!-- END .twitter-dropdown-wrap -->
          </div>  <!-- END .banner-twitter-profile-wrap -->
			 @else
			<div>
			<a href="{{ route('login') }}">
			Login
			</a>
			</div>
			@endauth
			@endif 	 
			 
			 
			@if (Route::has('login'))
				@auth		
			  <span class="toggle-wrap">
				<img src = "{{ asset('public/ui-images/icons/00f-moon.svg') }}"
				  class="menu-icon dark-mode-toggle"
				  id="dark-mode-toggle" />
			  </span>
			 @else
				@endauth				 
			@endif 
        </div>  <!-- END .banner-inner -->
      </div>  <!-- END .banner-outer -->
		 <div class="lower-area-outer">
        <div class="lower-area-inner">
		 
          <div class="menu-outer">
            <div class="menu-inner">

              <div class="main-menu">

                <ul>
				    @if (Route::has('login'))
					@auth		
                  <li class="menu-item menu-margin">
				  <a href="{{ route('dashboard') }}">
                    <img src = "{{ asset('public/ui-images/icons/01-dashboard.svg') }}" class="menu-icon" />
                    Dashboard
					</a>
					</li>
                  <li class="menu-item menu-margin launch-command-module">
                    <img src = "{{ asset('public/ui-images/icons/pg-command.svg') }}" class="menu-icon" />
                    Command Module</li>
                  <li class="menu-item menu-margin">
				 <a href="{{ route('profiles') }}">
                    <img src = "{{ asset('public/ui-images/icons/02-profile.svg') }}" class="menu-icon" />
                    Profile</a></li>
					
                  <li class="menu-item">
				   <a href="{{ route('queue') }}">
                    <img src = "{{ asset('public/ui-images/icons/03-posting.svg') }}" class="menu-icon" />
                    Posting
					</a>
					</li>
                    <ul class="sub-menu menu-margin">

                      <li>
                        <a href="{{ route('queue') }}"><img src = "{{asset('public/ui-images/icons/04-queue.svg')}} " class="menu-icon" />
                        Queue</a></li>
						
                      <li>
                        <a href="{{ route('drafts') }}"><img src = " {{asset('public/ui-images/icons/05-drafts.svg')}} " class="menu-icon" />
                        Drafts</a></li>
						
                      <li><a href="{{ route('posted') }}">
                        <img src = "{{asset('public/ui-images/icons/06-posted.svg')}} " class="menu-icon" />
                        Posted</a></li>
					
                      <li>	<a href="{{ route('slot-scheduler') }}">
                        <img src = "{{asset('public/ui-images/icons/07-schedule.svg')}} " class="menu-icon" />
                        Slot Scheduler</a></li>
					
                      <li>	<a href="{{ route('tweet-stormer') }}">
                        <img src = "{{asset('public/ui-images/icons/08-tweet-storm.svg')}} " class="menu-icon" />
                        Tweet Stormer</a></li>
						
                      <li><a href="{{ route('bulk-uploader') }}">
                        <img src = " {{asset('public/ui-images/icons/09-bulk-upload.svg')}} " class="menu-icon" />
                        Bulk Uploader</a></li>
                    </ul>
                  <li class="menu-item">
                    <a href="{{ route('social-engage') }}">
					<img src = "{{ asset('public/ui-images/icons/10-engagement.svg')}}" class="menu-icon" />
                    Engagement
					</a>
					</li>
                    <ul class="sub-menu menu-margin">
                      <li>
					  <a href="{{ route('social-engage') }}">
                        <img src = "{{asset('public/ui-images/icons/11-engage.svg')}} " class="menu-icon" />
                        Engage</a></li>
                      <li>
                        <a href="{{ route('social-mentions') }}"><img src = " {{asset('public/ui-images/icons/12-mentions.svg')}}" class="menu-icon" />
                        Mentions</a></li>
                      <li>
                        <a href="{{ route('social-user-feeds') }}"><img src = " {{asset('public/ui-images/icons/13-user-feeds.svg')}} " class="menu-icon" />
                        User Feeds</a></li>
                      <li>
                        <a href="{{ route('social-user-lists') }}"><img src = " {{asset('public/ui-images/icons/pg-list.svg')}} " class="menu-icon" />
                        User Lists</a></li>
                      <li>
                        <a href="{{ route('social-hashtag-feeds') }}"><img src = "{{asset('public/ui-images/icons/14-hashtag-feeds.svg')}}" class="menu-icon" />
                        Hashtag Feeds</a></li>
                    </ul>
                  <li class="menu-item">
				   <a href="{{ route('promo-tweets') }}">
                    <img src = "{{asset('public/ui-images/icons/15-campaigns.svg')}} " class="menu-icon" />
                    Campaigns
					</a>
					</li>
                    <ul class="sub-menu menu-margin">
                      <li> <a href="{{ route('promo-tweets') }}">
                        <img src = "{{asset('public/ui-images/icons/17-promos.svg')}} " class="menu-icon" />
                        Promo Tweets</a></li>
                      <li>
                        <a href="{{ route('evergreen-tweets') }}"><img src = "{{asset('public/ui-images/icons/16-evergreen.svg')}} " class="menu-icon" />
                        Evergreen Tweets</a></li>
                      <li>
                       <a href="{{ route('tweet-storms') }}"> <img src = "{{asset('public/ui-images/icons/pg-storms.svg')}} " class="menu-icon" />
                        Tweet Storms</a></li>
                      <li>
                         <a href="{{ route('tag-groups') }}"> <img src = "{{asset('public/ui-images/icons/18-tag-groups.svg')}} " class="menu-icon" />
                        Tag Groups</a></li>
                    </ul>
                  <li class="menu-item">
				   <a href="{{ route('trending-topics') }}">
                    <img src = "{{asset('public/ui-images/icons/19-trending.svg')}} " class="menu-icon" />
                    Trending Topics</a></li>
						</ul>
						<div class="settings-bar-outer">
						  <div class="settings-bar-inner">
							<img src = "{{ asset('public/ui-images/icons/00b-gear.svg') }}" class="menu-icon launch-general-settings" />
							<img src = "{{ asset('public/ui-images/icons/00c-help.svg') }}" class="menu-icon" />
							<img src = "{{ asset('public/ui-images/icons/00d-compass.svg') }}" class="menu-icon" />
							<a class="dropdown-item" href="{{ route('logout') }}"
					   onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							<img src = "{{ asset('public/ui-images/icons/00e-logout.svg') }}" class="menu-icon" />
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
							
						  </div>  <!-- END .settings-bar-inner -->
						</div>  <!-- END .settings-bar-outer -->
					
					
					@else
						
						 @endauth
					@endif
							
              </div>  <!-- END .main-menu -->

            </div>  <!-- END .menu-inner -->
          </div>  <!-- END .menu-outer -->
	
	

		<div class="content-outer">
			<div class="content-inner">
				@yield('content')
				</div>
		</div>
    </div>  <!-- END .interface-inner -->
  </div>  <!-- END .interface-outer -->
		@if (Route::has('login'))
	 @auth	
@if ($title == 'Slot Scheduler')
	<div class="new-slot-anchor">
        <div class="new-slot-overlay">
          <div class="new-slot-outer">

            <img src="{{ asset('public') }}/ui-images/icons/pg-close.svg" class="slot-popup-close" />

            <div class="new-slot-inner frosted">

              <span class="new-slot-title">
                Schedule A Slot</span>

              <form class="new-slot-form">
				@csrf
                <select id="days-selector" name="days-selector" class="days-selector">
				  <option value="">Choose days</option>
                  <option value="7">Sunday</option>
                  <option value="1">Monday</option>
                  <option value="2">Tuesday</option>
                  <option value="3">Wednesday</option>
                  <option value="4">Thursday</option>
                  <option value="5">Friday</option>
                  <option value="6">Saturday</option>
                  <option value="weekdays">Weekdays</option>
                  <option value="weekend">Weekend Days</option>
                  <option value="everyday">Every Day</option>
                </select>  <!-- END .days-selector -->

                <div class="new-slot-time-wrapper">

                  <select id="hour-selector" name="hour-selector" class="hour-selector">
                    <option value="">Hour</option>
					@for ($i = 1; $i <= 12; $i++)
						
						<option value="{{  $i }}"> {{  $i }}</option>
					@endfor
                   
                  </select>  <!-- END .hour-selector -->

                  <select id="minute-selector" name="minute-selector" class="minute-selector">
                     <option value="">Minute</option>
					 @for ($i = 1; $i <= 59; $i++)
						<option value="{{  $i }}"> {{  $i }}</option>
					@endfor
                  </select>  <!-- END .minute-selector -->

                  <select id="am-pm-selector" name="am-pm-selector" class="am-pm-selector">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                  </select>  <!-- END .am-pm-selector -->

                </div>  <!-- END .new-slot-time-wrapper -->

                <div class="checkbox-wraps">
                  <input type="checkbox" id="make-promo" name="make-promo" value="promo-slot" class="slot-type-checkbox">
                  <label for="make-promo">Reserve Slot for Promos</label>
                </div>  <!-- END .checkbox-wraps -->

                <div class="checkbox-wraps">
                  <input type="checkbox" id="make-evergreen" name="make-evergreen" value="evergreen-slot" class="slot-type-check-label">
                  <label for="make-evergreen">Reserve Slot for Evergreen</label>
                </div>  <!-- END .checkbox-wraps -->
				 <div class="checkbox-wraps">
                  <input type="checkbox" id="make-tweetstorm" name="make-tweetstorm" value="tweetstorm-slot" class="slot-type-check-label">
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
		
	@endif	
    @else
	
	@endauth
	@endif	
</div>
	</div>	
	@if (Route::has('login'))
	 @auth	
	@include('account-menu')
		 <style>
	.general-settings-outer, .twitter-settings-outer {display: none;}
	</style>
		@if ($title == 'Slot Scheduler')
		<script type='text/javascript' src="{{asset('public/js/schedule.js')}}"></script>
		@endif
	 <script type='text/javascript' src="{{asset('public/js/quantum.js')}}"></script>
	  <script type='text/javascript' src="{{asset('public/js/command-module.js')}}"></script>
	 @else
	@endauth
@endif	
 
</body>
</html>
