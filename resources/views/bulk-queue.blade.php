@extends('layouts.app')

@section('content')
<div class="page-outer queue-outer">
  <div class="page-inner queue-inner" data-sched-method="bulk-queue">

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          Bulk Queue</span>
        <div class="toggle-wrapper">
          <label class="toggleSwitch large">            
            <input type="checkbox" id="post-status" {{ $toggle > 0 ? 'checked' : '' }}/>
            
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
        <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon new-queue-cmdmod" />
        <img src="{{ asset('public/')}}/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
      </div>  <!-- END .head-icon-wrap -->
    </div>  <!-- END .page-head-n-sort -->

    {{-- <div class="filter-controls">
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
          <li id="retweet">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            Retweets
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
          <li>
            <img src="{{ asset('public/') }}/ui-images/icons/07-schedule.svg" class="ui-icon" />All
          </li>                     
        </ul>
      </div>  
    </div>   --}}

    <div id="spinner" style="display: none;">
      Loading
    </div>
    <div id="error" style="display: none;">      
    </div>
    {{-- @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif --}}
    <div class="queued-posts-outer" id="queuePage" >
      <div class="queued-posts-inner">
        <div class="queue-day-wrapper page-wrapper">    
          
          
            {{-- <div>

              <div class="queued-single-start-column">       
                <span class>
                  <img src="ui-images/icons/pg-dots.svg" class="ui-icon queued-icon queued-options-icon">
                  Date
                </span> 
                <span>
                  <img src="ui-images/icons/pg-view.svg" class="ui-icon queued-icon queued-view-icon">
                  Time
                </span>        
                <span>                  
                  <img src="ui-images/icons/05-drafts.svg" class="ui-icon queued-icon queued-edit-icon">
                  Account
                </span>
                <img src="ui-images/icons/pg-trash.svg" class="ui-icon queued-icon queued-trash-icon">
              </div>  
              
              <div class="queued-single-mid-column">                
                <span class="queued-post-time">
                  10:30am</span>
                <span class="queued-post-data">
                  Sample of truncated post text #test https://...
                </span>
              </div>
  
              <div class="queued-single-end-column">
                <img src="ui-images/icons/pg-dots.svg" class="ui-icon queued-icon queued-options-icon">
                <img src="ui-images/icons/pg-view.svg" class="ui-icon queued-icon queued-view-icon">
                <img src="ui-images/icons/05-drafts.svg" class="ui-icon queued-icon queued-edit-icon">
                <img src="ui-images/icons/pg-trash.svg" class="ui-icon queued-icon queued-trash-icon">
              </div> 
            </div> --}}


            <div class="queued-preview-wrapper">
              <!-- BEGIN Queued Preview Instance -->
              <div class="mosaic-posts-outer">
                <div class="mosaic-watermark-wrap frosted">
                  <img src="ui-images/icons/pg-twitter.svg" class="mosaic-watermark">
                  <div class="mosaic-posts-inner">

                    <div class="global-twitter-profile-header">
                      <a href="#">
                        <img src="temp-images/william-wallace.jpg" class="global-profile-image"></a>
                      <div class="global-profile-details">
                        <div class="global-profile-name">
                          <a href="#">
                            William Wallace</a>
                        </div>  <!-- END .global-author-name -->
                        <div class="global-profile-subdata">
                          <img src="ui-images/icons/pg-time.svg" class="ui-icon">
                          <span class="global-post-date">
                            <a href="">
                              Dec. 16, 2022 @ 5:20 p.m.</a></span>
                        </div>  <!-- END .global-post-date-wrap -->
                      </div>  <!-- END .global-author-details -->
                    </div>  <!-- END .global-twitter-profile-header -->

                    <div class="mosaic-post-data">
                      <div class="mosaic-post-text">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                      </div>  <!-- END .mosaic-post-text -->
                      <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg" class="mosaic-post-image">
                    </div>  <!-- END .mosaic-post-data -->

                  </div>  <!-- END .mosaic-posts-inner -->
                </div>  <!-- END .mosaic-watermark-wrap -->
              </div>  <!-- END .mosaic-posts-outer -->
              <!-- END Queued Preview Instance -->

            </div>  <!-- END .queued-preview-wrapper -->

            <div class="queued-options-wrapper frosted">
              <div class="queued-options-inner">
                <span class="queued-option-item">
                  Post Now</span>
                <span class="queued-option-item">
                  Duplicate Post</span>
                <span class="queued-option-item">
                  Move to Top</span>
              </div>  <!-- END .queued-options-inner -->
            </div>  <!-- END .queued-options-wrapper -->

          </div>    
        </div>  
      </div>  
    </div> 

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->
{{-- <button id="openModalButton" style="display: none;" data-toggle="modal" data-target="#editModal"></button> --}}

<style>
  #container {
  height: 300px; /* Set a fixed height for the container */
  overflow-y: scroll; /* Enable vertical scrolling */
}

.div-item {
  /* Styling for the div items */
  margin-bottom: 10px;
  padding: 10px;
  background-color: #f0f0f0;
}
</style>
@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/posting.js')}}"></script>
@endsection
