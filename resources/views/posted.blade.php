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
    
    <div class="posted-posts-outer">
      <div class="posted-posts-inner">

        <div class="queue-day-wrapper">

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
