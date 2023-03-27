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
 {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}	
</head>
<body class="{{ Route::has('login') ? 'darkmode' : '' }}">
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
                  <img src="{{ asset('public/temp-images/imgpsh_fullsize_anim (1).png') }}" class="twitter-profile-image" />
                  <span class="twitter-profile-name">
                    {{ $selected_user->twitter_name ?? 'Quantum User' }}
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

                    @if ($acct_twitter_count > 0) 
                      <div class="twitter-stat-bar">
                        <div class="twitter-stat">
                          <img src="{{ asset('public/ui-images/icons/00g-following.svg') }}" class="menu-icon" />
                          <span class="stat-title">Following</span>
                          <span class="stat-count count-following">{{ isset($user) ? $user->twitter_followersCount : 0  }}</span></div>

                        <div class="twitter-stat twitter-stat-center">
                          <img src="{{ asset('public/ui-images/icons/00h-followers.svg') }} " class="menu-icon" />
                          <span class="stat-title">Followers</span>
                          <span class="stat-count count-followers">{{ isset($user) ? $user->twitter_followingCount : 0  }}</span></div>

                        <div class="twitter-stat">
                          <img src="{{ asset('public/ui-images/icons/00i-unfollows.svg') }}" class="menu-icon" />
                          <span class="stat-title">Unfollows</span>
                          <span class="stat-count count-unfollows">240</span></div>
                      </div>  <!-- END .twitter-stat-bar -->

              
                      <span class="account-select-title">Select An Account</span>

                      @foreach($twitter_accts as $twitter)
                      <div class="twitter-account-select-bar {{ $selected_user->twitter_id === $twitter->twitter_id ? "active" : "" }}" data-url="{{ route("twitter.switchUser", ['twitter_id', $twitter->twitter_id ]) }}" data-id="twitter-{{ $twitter->twitter_id }}" data-content="{{ route('getTweets', ['id' => $twitter->twitter_id]) }}">
                        <div class="twitter-account-item ">                                                                       
                          <div class="twitter-bar-profile-info">
                            <img src="{{ $twitter->twitter_photo }}" />
                            @ {{ $twitter->twitter_username}}
                          </div>
                          <img src="{{ asset('public/ui-images/icons/00j-twitter-settings.svg') }} "class="menu-icon twitter-bar-settings-icon" /></a>
                        </div>  <!-- END .twitter-account-item -->                                            
                      </div>  <!-- END .twitter-account-select-bar -->                    
                      @endforeach
                    @else 
                    <span class="account-select-title">You have {{$acct_twitter_count}} account.</span>
                    @endif
                  </div>  <!-- END .twitter-dropdown-menu-inner -->
                </div>  <!-- END .twitter-dropdown-menu-outer -->

              </div>  <!-- END .twitter-dropdown-wrap -->
            </div>  <!-- END .banner-twitter-profile-wrap -->
          @else
          <div style="display:flex;align-items:center">
            <a href="{{ route('register') }}">
            Register
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
                  @include('main-menu')
                </ul>
                                  
                <div class="settings-bar-outer">
                  <div class="settings-bar-inner">
                      <img src = "{{ asset('public/ui-images/icons/00b-gear.svg') }}" class="menu-icon launch-general-settings" data-id="modal" id="general-settings"/>
                      <img src = "{{ asset('public/ui-images/icons/00c-help.svg') }}" class="menu-icon launch-help-page" data-id="modal" id="help-page" />
                      <img src = "{{ asset('public/ui-images/icons/00d-compass.svg') }}" class="menu-icon" />
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
          @include('newSlot')  

        </div>  <!-- END .new-slot-overlay -->
      </div>  <!-- END .new-slot-anchor -->
		
      @endif	
  @else
    @endauth
  @endif	
    </div>  <!-- END .new-slot-overlay -->
  </div>  <!-- END .new-slot-anchor -->

	@if (Route::has('login'))
    @auth	
	  @include('account-menu')				
  @else
    @endauth 
  @endif	
  @yield('scripts')
  <script type='text/javascript' src="{{asset('public/js/quantum2.js')}}"></script>
  <script type='text/javascript' src="{{asset('public/js/core.js')}}"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Alert
      var alert = $('.alert ');

      if(alert.length == 1) {
        setTimeout(function(){
          alert.fadeOut('slow');
        }, 5000);
      }

      $('.sub-menu').css('display', 'none');
      $('.menu-item').click(function(e) {
        var menuId = e.target.dataset.target;
        $(`${menuId}`).toggle();
      })

      // Sub Menu 

      var uri =  "{{  basename($_SERVER['REQUEST_URI']) }}";

      $('.sub-menu').each(function(e, i) {
        var slug = $(this).text().toLowerCase();

        $(this).find('li').each(function(index, value) {
        
          if (value.id === $.trim(uri)) {
            $(this).closest('ul.sub-menu').toggle();
            console.log(3)
          } 
          var li = $(this).find('li');
        });
        
      })
    });
  </script>

</body>
</html>
