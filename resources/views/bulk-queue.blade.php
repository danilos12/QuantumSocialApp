@if(Auth::guard('web')->check())
@extends('layouts.app')
@elseif(Auth::guard('member')->check())
@extends('layouts.membersdashboard')
@endif

@section('content')
<div class="page-outer queue-outer">
  <div class="page-inner queue-inner" data-sched-method="bulk-queue">

    <div class="page-head-n-sort">
      <div class="head-left-wrap">
        <span class="profile-heading">
          Bulk Queue
        </span>
      </div>  <!-- END .head-left-wrap -->

    </div>  <!-- END .page-head-n-sort -->


    <div id="spinner" style="display: none;">
      Loading
    </div>
    <div id="error" style="display: none;">

    <div class="queued-posts-outer" id="queuePage" >
      <div class="queued-posts-inner">
        <div class="queue-day-wrapper page-wrapper">

        </div>
      </div>
    </div>

  </div>  <!-- END .profile-inner -->
</div>  <!-- END .profile-outer -->

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
