@extends('layouts.app')

@section('content')
<div class="page-outer queue-outer">
                <div class="page-inner queue-inner" data-sched-method="save-draft">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Drafted</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->


                  <div class="drafted-posts-outer">
                    <div class="drafted-posts-inner">
                      <div class="queue-day-wrapper">
                        <span class="queue-date-heading">Today</span>
                      </div>
                     
                    </div>  <!-- END .queue-posts-inner -->
                  </div>  <!-- END .queue-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->

@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/posting.js')}}"></script>
@endsection
