<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (Route::has('tomemberauth'))
         @auth
        <title>{{ $title }}</title>
        @else
         <title>{{ __('Member') }}</title>
        @endauth
        @endif

        <!-- Scripts -->
      {{-- <script type='text/javascript' src="{{ asset('public/js/jquery-3.6.1.min.js') }}"></script> --}}
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      {{-- <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
      <script type='text/javascript' src="{{ asset('public/js/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Montserrat&display=swap" rel="stylesheet">
    <!-- Add Toastr.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">




        <link rel="stylesheet" href="{{ asset('public/css/core.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/socialSettings.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/generalSettings.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/command-module.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

      {{-- <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css"> --}}
      {{-- <link rel="stylesheet" href="{{ asset('public/js/emojionearea-master/dist/emojionearea.css') }}"> --}}


      <script> var APP_URL = `{{ url('/') }}`; </script>
      @if (Route::has('tomemberauth'))
      @auth('member')
      <script> var TWITTER_ID = `{{ $twitter_id }}`; </script>
      <script> var TWITTER_NAME = `{{ $twitter_name }}`; </script>
      <script> var TWITTER_PHOTO = `{{ $twitter_photo }}`; </script>
      <script> var TWITTER_USN = `{{ $twitter_usn }}`; </script>
      <script> var QUANTUM_ID = `{{ $user_id }}`; </script>
      @endauth
      @endif

    </head>
<body class="{{ Route::has('tomemberauth') ? 'darkmode' : '' }}">
  <canvas></canvas>
  <div class="interface-outer">
    <div class="interface-inner">
		  <div class="banner-outer">
        <div class="banner-inner">
          <img src="{{ asset('public/')}}/ui-images/logo/QuantumLogo-Horizontal-white.svg" class="image-placeholder" height="100%" />

          <!-- Authentication Links -->
          @if (Route::has('tomemberauth'))
            @auth('member')
            <div class="banner-twitter-profile-wrap">
              <a href="#">
                <div class="banner-twitter-profile-inner">
                  <img src="{{ $twitter_photo ?: asset('public/temp-images/imgpsh_fullsize_anim (1).png') }}" class="twitter-profile-image" />
                  <span class="twitter-profile-name">
                    {{ $selected_user && $selected_user->twitter_name ? $selected_user->twitter_name : 'No twitter assigned' }}
                  </span>
                </div>  <!-- END .banner-twitter-profile-inner -->
              </a>
              <div class="banner-twitter-settings">
                @if (Auth::guard('member')->user()->role == 'Admin')
                  @if($acct_twitter_count >  0)
                  <img src="{{ asset('public/ui-images/icons/00j-x-settings.svg') }}" class="menu-icon launch-twitter-settings" data-id="modal" id="twitter-settings" />
                  @endif
                  @else

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
                          <span class="stat-count count-following">{{ $selected_user ? $selected_user->twitter_followingCount : 0 }}</span></div>

                        <div class="twitter-stat twitter-stat-center">
                          <img src="{{ asset('public/ui-images/icons/00h-followers.svg') }} " class="menu-icon" />
                          <span class="stat-title">Followers</span>
                          <span class="stat-count count-followers">{{ $selected_user ? $selected_user->twitter_followersCount  : 0 }}</span></div>

                        <div class="twitter-stat">
                          <img src="{{ asset('public/ui-images/icons/00i-unfollows.svg') }}" class="menu-icon" />
                          <span class="stat-title">Unfollows</span>
                          <span class="stat-count count-unfollows">{{ 0 }}</span></div>
                      </div>  <!-- END .twitter-stat-bar -->


                      <span class="account-select-title">Select An Account</span>

                      @foreach($memberaccts as $twitter)
                      {{-- <div class="twitter-account-select-bar {{ $twitter->twitter_id === $twitter_id ? "active" : "" }}" data-url="{{ route("twitter.switchUser", ['twitter_id', $twitter->twitter_id ]) }}" data-id="twitter-{{ $twitter->twitter_id }}"> --}}
                      <div class="twitter-account-select-bar {{ $twitter->twitter_id == $twitter_id ? "active" : "" }}" data-id="twitter-{{ $twitter->twitter_id }}">
                        <div class="twitter-account-item ">
                          <div class="profile-twitter-account-item">
                            <div class="twitter-bar-profile-info">
                              <img src="{{ $twitter->twitter_photo }}" />
                              {{ '@' . $twitter->twitter_username}}
                            </div>
                          </div>
                          <img src="{{ asset('public/ui-images/icons/00j-x-settings.svg') }} "class="menu-icon twitter-bar-settings-icon" id="twitter-settings"/></a>
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
            @auth('member')
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
                  @auth('member')
                  @include('main-menu')
                </ul>

                <div class="settings-bar-outer">
                  <div class="settings-bar-inner">
                    @if (Auth::guard('member')->user()->role == 'Admin')
                    @auth('member')
                    <img src = "{{ asset('public/ui-images/icons/00b-gear.svg') }}" class="menu-icon launch-general-settings" data-id="modal" id="general-settings"/>
                    @endauth
                    @else

                      @endif
                      <a href="https://quantumsocial.io/help/" target="new">
                        <img src = "{{ asset('public/ui-images/icons/00c-help.svg') }}" class="menu-icon launch-help-page" />
                      </a>
                      {{-- <img src = "{{ asset('public/ui-images/icons/00c-help.svg') }}" class="menu-icon launch-upgrade-page" data-id="modal" id="upgrade-page" /> --}}
                      <a href="https://quantumsocial.io/roadmap/" target="new">
                        <img src = "{{ asset('public/ui-images/icons/00d-compass.svg') }}" class="menu-icon" />
                      </a>
                      <a class="dropdown-item" href="{{ route('memberlogout') }}" onclick="event.preventDefault(); document.getElementById('logout-formx').submit();">
                          <img src = "{{ asset('public/ui-images/icons/00e-logout.svg') }}" class="menu-icon" />
                      </a>
                      <form id="logout-formx" action="{{ route('memberlogout') }}" method="POST" class="d-none">
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
            @auth('member')


            @yield('content')
            @endauth
          </div>
        </div>
    </div>  <!-- END .interface-inner -->
  </div>  <!-- END .interface-outer -->
	@if (Route::has('login'))
	  @auth('member')
      @if ($title == 'Slot Scheduler')
      <div class="new-slot-anchor">
        <div class="new-slot-overlay">
          @include('newSlot')

        </div>  <!-- END .new-slot-overlay -->
      </div>  <!-- END .new-slot-anchor -->

      @endif
      <div class="upgrade">
        @if(isset($modalContent))
            <!-- Render the modal content -->
            {!! $modalContent !!}
        @endif
      </div>
    @else
      @endauth
    @endif
    </div>  <!-- END .new-slot-overlay -->
  </div>  <!-- END .new-slot-anchor -->

	@if (Route::has('login'))
    @auth('member')
	  @include('account-menu')
  @else
    @endauth
  @endif

  <script type='text/javascript' src="{{asset('public/js/quantum2.js')}}"></script>
  <script type='text/javascript' src="{{asset('public/js/generalSettings.js')}}"></script>
  <script type='text/javascript' src="{{asset('public/js/command-module.js')}}"></script>
  <script type='text/javascript' src="{{asset('public/js/dashboard.js')}}"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  {{-- <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script> --}}
  {{-- <script type='text/javascript' src="{{asset('public/js/emojionearea-master/dist/emojionearea.js')}}"></script>   --}}

  @yield('scripts')

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
        // console.log(menuId)
        if (menuId) {
        // If menuId is defined, toggle its visibility
            $(`${menuId}`).toggle();
            console.log($(`ul:not(${menuId})`)) //.css('display', 'none')
        } else {
            // If menuId is not defined or falsy, close all menus
            // $(`ul:not(${menuId})`).hide();
            // $(`li:not(${menuId})`).attr('aria-expanded', false);
          // Replace 'your-menu-selector' with the appropriate selector for your menus
        }
      })

      // Sub Menu
      var uri =  "{{  basename($_SERVER['REQUEST_URI']) }}";

      $('.sub-menu').each(function(e, i) {
        var slug = $(this).text().toLowerCase();

        $(this).find('li').each(function(index, value) {
          if (value.id === $.trim(uri)) {
            $(this).closest('ul.sub-menu').toggle();
          }
          var li = $(this).find('li');
        });
      })

    });
  </script>
</body>
</html>
