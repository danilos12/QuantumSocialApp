<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : redirect()->route('memberhome'));
?>

@if(is_string($layout))
    @extends($layout)
@else
    {{ $layout->send() }}
@endif

@section('content')
<div class="page-outer trending-outer">
                <div class="page-inner trending-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Trending</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->


                  <div class="trending-tool-outer">
                    <div class="trending-tool-inner">

                      <span class="trending-tag">
                        marketing
                      </span>

                                    <span class="trending-tag">
                                      business
                                    </span>

                                    <span class="trending-tag">
                                      eggo waffles
                                    </span>

                                    <span class="trending-tag">
                                      syrup
                                    </span>

                                    <span class="trending-tag">
                                      cars with muscles
                                    </span>

                                    <span class="trending-tag">
                                      squirrel suit madness
                                    </span>

                                    <span class="trending-tag">
                                      wimbly jimbly
                                    </span>

                                    <span class="trending-tag">
                                      frodo baggins
                                    </span>

                                    <span class="trending-tag">
                                      the shire
                                    </span>

                                    <span class="trending-tag">
                                      MY PRECIOUS!
                                    </span>


                    </div>  <!-- END .trending-tool-inner -->
                  </div>  <!-- END .trending-tool-outer -->

                </div>  <!-- END .trending-inner -->
              </div>  <!-- END .trending-outer -->
@endsection
