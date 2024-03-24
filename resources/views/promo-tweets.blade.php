<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

@if($layout)
    @extends($layout)
@endif

@section('content')

<div class="page-outer promos-outer">
  <div class="page-inner promos-inner" data-sched-method="promo">

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          Promo Tweets</span>
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
      <div class="head-right-wrap">
        {{-- <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon new-promo-tweet" /> --}}
        <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon new-promos-cmdmod" />
        <img src="{{ asset('public/')}}/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
      </div>  <!-- END .head-icon-wrap -->
    </div>  <!-- END .page-head-n-sort -->

    <div class="filter-controls">
      <div class="drop-button-wrap filter-wrap user-list-wrap">
        <span class="white-select-button profile-filter-select">
          <img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
          Campaigns:
          <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
        </span>
        <ul class="page-filters-dropdown profile-filter-dropdown frosted">
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #1</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #2</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #3</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #4</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #5</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #6</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #7</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #8</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #9</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #10</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #11</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #12</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #13</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #14</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Campaign #15</li>
        </ul>
      </div>  <!-- END .filter-wrap -->



      <div class=""><!--drop-button-wrap filter-wrap user-list-wrap-->
        <span class="white-select-button-small"> <!--profile-filter-select -->
          <img src="{{ asset('public/')}}/ui-images/icons/pg-plus.svg" class="ui-icon" />
        </span>
      </div>  <!-- END .filter-wrap -->
    </div>  <!-- END .filter-controls -->


    <div class="profile-posts-outer" >
      <div class="queued-posts-inner" id="promo">
      </div>  <!-- END .profile-posts-inner -->
    </div>  <!-- END .queued-posts-outer -->

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->


@endsection

@section('scripts')
<script type='text/javascript' src="{{asset('public/js/posting.js')}}"></script>
@endsection