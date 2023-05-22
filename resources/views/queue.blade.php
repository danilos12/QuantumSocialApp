@extends('layouts.app')

@section('content')
<div class="page-outer queue-outer">
  <div class="page-inner queue-inner" data-sched-method="queue">

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          The Queue</span>
        <div class="toggle-wrapper">
          <label class="toggleSwitch large" onclick="">
            <input type="checkbox" checked />
            <span>
                <span>INACTIVE</span>
                <span>ACTIVE</span>
            </span>
            <a></a>
          </label>
        </div>  <!-- END .toggle-wrapper -->
      </div>  <!-- END .head-left-wrap -->
      <div class="head-right-wrap">
        <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon new-promo-tweet" />
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
        <ul class="page-filters-dropdown profile-filter-dropdown frosted queue-page-dd">
          <li id="all">
            <img src="{{ asset('public/')}}/ui-images/icons/04-queue.svg" class="ui-icon" />
            All (0)
          </li>
          <li id="non-campaign">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" />
            Non-Campaign (0)
          </li>
          <li id="evergreen">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="ui-icon" />
            Evergreen
          </li>
          <li id="retweet">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            Retweets
          </li>
          <li id="promos">
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon" />
            Promos
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
        </ul>
      </div>  <!-- END .sort-wrap -->
    </div>  <!-- END .filter-controls -->

    <div id="spinner" style="display: none;">
      Loading
    </div>
    <div id="error" style="display: none;">      
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="queued-posts-outer" id="queuePage" >
      <div class="queued-posts-inner">
        <div class="queue-day-wrapper">
          <span class="queue-date-heading">Today</span>
          

        </div>  <!-- END .queued-single-post-wrapper -->
        </div>  <!-- END .queue-day-wrapper" -->
      </div>  <!-- END .queue-posts-inner -->
    </div>  <!-- END .queue-posts-outer -->

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->

@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/posting.js')}}"></script>
@endsection
