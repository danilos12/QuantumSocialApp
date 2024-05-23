<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

@if($layout)
    @extends($layout)
@endif


@section('content')
<div class="page-outer profile-outer">
      <div id="spinner" style="display: none; color: white">
        Getting the posts for you...
      </div>
      <div class="profileSection" style="display:none">
        <div id="getting-tweets" style="display: none; color: white">
          Getting posts...
        </div>

        @include('selectedAcctTweets')
    </div>
</div>  <!-- END .profile-outer -->
@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/profile.js')}}"></script>
@endsection

<style>
  .profile-posts-inner {
    display: grid;
    width: 100%;
    height: 100%;
    grid-gap: 24px;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    row-gap: 32px;
  }
</style>
