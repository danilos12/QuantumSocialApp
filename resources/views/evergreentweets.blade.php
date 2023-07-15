@extends('layouts.app')

@section('content')
<div class="page-outer evergreen-outer">
  <div class="page-inner evergreen-inner" data-sched-method="evergreen" >

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          Evergreen Tweets</span>
        <div class="toggle-wrapper">
          <label class="toggleSwitch large" onclick="">
            <input type="checkbox" id="post-status" {{ $toggle > 0 ? 'checked' : '' }} />
            <span>
                <span>INACTIVE</span>
                <span>ACTIVE</span>
            </span>
            <a></a>
          </label>
        </div>  <!-- END .toggle-wrapper -->
      </div>  <!-- END .head-left-wrap -->
      {{-- <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon paste-evergreen-tweet" /> --}}
      <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon new-evergreen-cmdmod" />
    </div>  <!-- END .page-head-n-sort -->

    <div class="paste-evergreen-tweet-modal-wrap">
      <div class="paste-evergreen-tweet-modal frosted">

        <div class="global-twitter-profile-header">
          <a href="#">
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png"
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

        <div class="paste-evergreen-link">
          <input type="text" placeholder="Paste Tweet URL here...">
        </div>

      </div>  <!-- END .paste-evergreen-tweet-modal -->
    </div>  <!-- END .paste-evergreen-tweet-modal-wrap -->


    <div class="profile-posts-outer">
      <div class="profile-posts-inner" id="evergreen">        
      </div>  <!-- END .profile-posts-inner -->
    </div>  <!-- END .profile-posts-outer -->

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->


@endsection

@section('scripts')
<script type='text/javascript' src="{{asset('public/js/posting.js')}}"></script>
@endsection