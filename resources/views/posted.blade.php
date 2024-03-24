<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

@if($layout)
    @extends($layout)
@endif


@section('content')
<div class="page-outer queue-outer">
  <div class="page-inner queue-inner" data-sched-method="posted">

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          Posted</span>
      </div>  <!-- END .head-left-wrap -->
      <div class="head-right-wrap">
        <img src="{{ asset('public/')}}/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
      </div>  <!-- END .head-icon-wrap -->
    </div>  <!-- END .page-head-n-sort -->

    <div class="filter-controls">
      <div class="drop-button-wrap filter-wrap queue-source-wrap">
        <span class="white-select-button profile-filter-select">
          <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon" />
          Sort by Source:
          <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
        </span>
        <ul class="page-filters-dropdown profile-filter-dropdown frosted">
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/04-queue.svg" class="ui-icon" />
            All (0)
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" />
            Non-Campaign (0)
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="ui-icon" />
            Evergreen
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            Retweets
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon" />
            Promo Campaign 01
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon" />
            Promo Campaign 02
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon" />
            Promo Campaign 03
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon" />
            Promo Campaign 04
          </li>
          <li>
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon" />
            Promo Campaign 05
          </li>
        </ul>
      </div>  <!-- END .filter-wrap -->
      <div class="drop-button-wrap sort-wrap">
        <span class="white-select-button profile-sort-select">
          <img src="{{ asset('public/')}}/ui-images/icons/pg-sort.svg" class="ui-icon" />
          Month:
          <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
        </span>
        <ul class="page-filters-dropdown profile-sort-dropdown queue-months-dropdown frosted">
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            December 2022</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            January 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            February 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            March 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            April 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            May 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            June 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            July 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            August 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            September 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            October 2023</li>
          <li><img src="{{ asset('public/')}}/ui-images/icons/07-schedule.svg" class="ui-icon" />
            November 2023</li>
        </ul>
      </div>  <!-- END .sort-wrap -->
    </div>  <!-- END .filter-controls -->

    <div class="posted-posts-outer">
      <div class="posted-posts-inner">

        <div class="queue-day-wrapper">
          <span class="queue-date-heading">Today</span>

        </div>  <!-- END .queue-day-wrapper" -->
        <!-- END TweetStorm Queued Post Instance -->

      </div>  <!-- END .queue-posts-inner -->
    </div>  <!-- END .queue-posts-outer -->

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->
@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/posting.js')}}"></script>
@endsection
