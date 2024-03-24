@extends('layouts.app')

@section('content')
<div class="page-outer profile-outer">
      <div id="spinner" style="display: none; color: white">
        Page loading...
      </div>
      <div class="profileSection" style="display:none">
        <div id="getting-tweets" style="display: none; color: white">
          Getting tweets...
        </div>

        @include('selectedAcctTweets')
    </div>
</div>  <!-- END .profile-outer -->
@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/profile.js')}}"></script>
@endsection