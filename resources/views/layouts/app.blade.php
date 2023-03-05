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
	<link rel="stylesheet" href="{{ asset('public/css/socialSettings.css') }}">
	<link rel="stylesheet" href="{{ asset('public/css/generalSettings.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">	
	
</head>
<body>
  <canvas></canvas>
  <div class="interface-outer">
    <div class="interface-inner">
		<div class="banner-outer">
        <div class="banner-inner">
          <img src="{{ asset('public/')}}/ui-images/logo/QuantumLogo-horiz-white-app@2x.png" class="image-placeholder" height="100%" />
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
            @if($acct_twitter_count >  0) 
            <img src="{{ asset('public/ui-images/icons/00j-twitter-settings.svg') }}" class="menu-icon launch-twitter-settings" data-id="modal" id="twitter-settings" />
            @endif
            </div>
            <div class="twitter-dropdown-wrap">
              <img src = "{{ asset('public/ui-images/icons/00-hamburger.svg') }}" class="menu-icon hamburger" />

              <div class="twitter-dropdown-menu-outer">
                <div class="twitter-dropdown-menu-inner frosted">

                  @if(isset($twitter))
                    @if ($acct_twitter_count > 0) 
                      <div class="twitter-stat-bar">
                        <div class="twitter-stat">
                          <img src="{{ asset('public/ui-images/icons/00g-following.svg') }}" class="menu-icon" />
                          <span class="stat-title">Following</span>
                          <span class="stat-count count-following">{{ $user->twitter_followersCount ? $user->twitter_followersCount : 0  }}</span></div>

                        <div class="twitter-stat twitter-stat-center">
                          <img src="{{ asset('public/ui-images/icons/00h-followers.svg') }} " class="menu-icon" />
                          <span class="stat-title">Followers</span>
                          <span class="stat-count count-followers">{{ $user->twitter_followingCount ? $user->twitter_followingCount : 0  }}</span></div>

                        <div class="twitter-stat">
                          <img src="{{ asset('public/ui-images/icons/00i-unfollows.svg') }}" class="menu-icon" />
                          <span class="stat-title">Unfollows</span>
                          <span class="stat-count count-unfollows">240</span></div>
                      </div>  <!-- END .twitter-stat-bar -->

              
                      <span class="account-select-title">Select An Account</span>

                      @foreach($twitter as $tweet)
                      <div class="twitter-account-select-bar">
                        <div class="twitter-account-item">
                          <div class="twitter-bar-profile-info">
                            <img src="{{ $tweet->twitter_photo }}" />
                            @ {{ $tweet->twitter_username}}
                          </div>
                          <a href="#">
                          <img src="{{ asset('public/ui-images/icons/00j-twitter-settings.svg') }} "class="menu-icon twitter-bar-settings-icon" /></a>
                        </div>  <!-- END .twitter-account-item -->                                            
                      </div>  <!-- END .twitter-account-select-bar -->                    
                      @endforeach
                    @endif
                  @else 
                  <span class="account-select-title">You have {{$acct_twitter_count}} account.</span>
                  @endif
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
                  <li class="menu-item menu-margin launch-command-module" data-id="modal" id="command-module">
                    <img src = "{{ asset('public/ui-images/icons/pg-command.svg') }}" class="menu-icon" />
                    Command Module</li>
                  <li class="menu-item menu-margin">
				 <a href="{{ route('profiles') }}">
                    <img src = "{{ asset('public/ui-images/icons/02-profile.svg') }}" class="menu-icon" />
                    Profile</a></li>
					
                  <li class="menu-item" data-toggle="collapse" data-target="#posting">
                    <!-- <a href="{{ route('queue') }}">
                      </a> -->
                    <img src = "{{ asset('public/ui-images/icons/03-posting.svg') }}" class="menu-icon" />
                    Posting
                    </li>
                    <ul class="sub-menu menu-margin collapse" id="posting">

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
                  <li class="menu-item" data-toggle="collapse" data-target="#engagement">
                    <!-- <a href="{{ route('social-engage') }}">
                      </a> -->
                    <img src = "{{ asset('public/ui-images/icons/10-engagement.svg')}}" class="menu-icon" />
                              Engagement
                  </li>
                    <ul class="sub-menu menu-margin collapse" id="engagement">
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
                  <li class="menu-item" data-toggle="collapse" data-target="#campaigns">
				   <!-- <a href="{{ route('promo-tweets') }}">
             </a> -->
                    <img src = "{{asset('public/ui-images/icons/15-campaigns.svg')}} " class="menu-icon" />
                    Campaigns
					</li>
                    <ul class="sub-menu menu-margin collapse" id="campaigns">
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
							<img src = "{{ asset('public/ui-images/icons/00b-gear.svg') }}" class="menu-icon launch-general-settings" data-id="modal" id="general-settings"/>
              <img src = "{{ asset('public/ui-images/icons/00c-help.svg') }}" class="menu-icon"  />
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
        @if(session()->has('alert'))
          <div class="alert alert-{{ session('alert_type', 'info') }}">
              {{ session('alert') }}
          </div>
        @endif
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
                  <option value="sunday">Sunday</option>
                  <option value="monday">Monday</option>
                  <option value="tuesday">Tuesday</option>
                  <option value="wednesday">Wednesday</option>
                  <option value="thursday">Thursday</option>
                  <option value="friday">Friday</option>
                  <option value="saturday">Saturday</option>
                  <option value="weekdays">Weekdays</option>
                  <option value="weekend">Weekend Days</option>
                  <option value="everyday">Every Day</option>
                </select>  <!-- END .days-selector -->

                <div class="new-slot-time-wrapper">

                  <select id="hour-selector" name="hour-selector" class="hour-selector">
                    <option value="">Hour</option>
					@for ($i = 0; $i <= 12; $i++)
						@if( $i < 10 ) 
							<option value="0{{  $i }}"> 0{{  $i }}</option>
						@else
							<option value="{{  $i }}"> {{  $i }}</option>
						@endif
						
					@endfor
                   
                  </select>  <!-- END .hour-selector -->

                  <select id="minute-selector" name="minute-selector" class="minute-selector">
                     <option value="">Minute</option>
					 @for ($i = 0; $i <= 59; $i++)
						@if( $i < 10 ) 
							<option value="0{{  $i }}"> 0{{  $i }}</option>
						@else
							<option value="{{  $i }}"> {{  $i }}</option>
						@endif
						
					@endfor
                  </select>  <!-- END .minute-selector -->

                  <select id="am-pm-selector" name="am-pm-selector" class="am-pm-selector">
                    <option value="am">AM</option>
                    <option value="pm">PM</option>
                  </select>  <!-- END .am-pm-selector -->

                </div>  <!-- END .new-slot-time-wrapper -->

                <div class="checkbox-wraps">
                  <input type="checkbox" id="make-promo" name="make-promo" value="promos-tweets" class="slot-type-checkbox">
                  <label for="make-promo">Reserve Slot for Promos</label>
                </div>  <!-- END .checkbox-wraps -->

                <div class="checkbox-wraps">
                  <input type="checkbox" id="make-evergreen" name="make-evergreen" value="evergreen-tweets" class="slot-type-check-label">
                  <label for="make-evergreen">Reserve Slot for Evergreen</label>
                </div>  <!-- END .checkbox-wraps -->
				 <div class="checkbox-wraps">
                  <input type="checkbox" id="make-tweetstorm" name="make-tweetstorm" value="tweet-storm-tweets" class="slot-type-check-label">
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
	 <script type='text/javascript' src="{{asset('public/js/quantum2.js')}}"></script>
	  <script type='text/javascript' src="{{asset('public/js/command-module.js')}}"></script>
	 @else
	@endauth
@endif	
 <script type='text/javascript' src="{{asset('public/js/core.js')}}"></script>
 <script type='text/javascript' src="{{asset('public/js/generalSettings.js')}}"></script>
 <script type='text/javascript' src="{{asset('public/js/twitterSettings.js')}}"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <script>
$(document).ready(function() {
  var alert = $('.alert ');

  if(alert.length == 1) {
    setTimeout(function(){
      alert.fadeOut('slow');
    }, 5000);
  }
});
</script>

</body>
</html>
