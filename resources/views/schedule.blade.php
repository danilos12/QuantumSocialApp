


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

<div class="page-outer scheduler-outer">
	<div class="page-inner scheduler-inner">

		<div class="page-head-n-sort">
			<div class="head-left-wrap">
				<span class="profile-heading">
				Slot Scheduler</span>
			</div>  <!-- END .head-left-wrap -->
		</div>  <!-- END .page-head-n-sort -->

		<div id="errorMessage" class="alert alert-danger" style="display: none;">
			<!-- Error message content goes here -->
			This is an error message.
		</div>

		<div class="slot-board-outer">
			<div class="slot-board-inner">

				<!-- BEGIN Row #1 (Days) -->
				<div class="slot-row slot-row-1">

				<div class="slot-cell title-cell null-cell time-cell">
					<div class="slot-cell-inner">

					</div>
				</div>  <!-- END .slot-cell -->
				@php
					$Ndays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
				@endphp

				@for ($i = 0; $i < count($Ndays); $i++)
					<div class="slot-cell title-cell">
					<div class="slot-cell-inner colday" data-col="day-{{$i+1}}" data-text={{ strtolower($Ndays[$i])}}>
						{{ $Ndays[$i] }}
					</div>
					</div>  <!-- END .slot-cell -->
				@endfor

				</div>  <!-- END .slot-row -->
				<!-- END Column #1 (Dates) -->

				<!-- BEGIN Row #2 (12am) -->
				@for($hour = 0; $hour < 24; $hour++)
				<div class="slot-row slot-row-2">
					<div class="slot-cell title-cell time-cell">
						<div class="slot-cell-inner" >
							{{ $hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour) }} {{ $hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM') }}
						</div>
					</div>

					@for($i = 1; $i <=7; $i++)
						<div data-num="{{  $i }}" class="slot-cell slot-cards" data-fulltime="{{ $hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour) }} {{ $hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM') }}" data-day="{{ $days[$i]}}" data-time="{{ $hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour) }}" data-ampm="{{ $hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM') }}">
							<div class="c"></div>
							<div class="slot-cell-inner empty-slot" data-col="{{ $i }}" data-row="{{ $hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour) }}" data-fulltime="{{ $hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour) }} {{ $hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM') }}" data-day="{{ $days[$i]}}" data-time="{{ $hour === 0 ? '12' :(($hour > 12) ? ($hour-12) : $hour) }}" data-ampm="{{ $hour === 0 ? 'AM' : (($hour >= 12) ? 'PM' : 'AM') }}">
								<img src="{{ asset('public')}}/ui-images/icons/pg-plus.svg" />
							</div>
						</div>  <!-- END .slot-cell -->
					@endfor
				</div>  <!-- END .slot-row -->
				<!-- END Row #2 (12am) -->
				@endfor


			</div>  <!-- END .slot-board-inner -->
		</div>  <!-- END .slot-board-outer -->



	</div>  <!-- END .scheduler-inner -->
</div>  <!-- END .scheduler-outer -->

<style>
	.scheduled-slot {
		justify-content: space-between;
	}
	.scheduled-slot-item > span {
		margin: 0.50em;
	}
</style>
@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/schedule.js')}}"></script>
@endsection


