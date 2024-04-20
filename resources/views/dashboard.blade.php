<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

@if($layout)
    @extends($layout)
@endif


<style>

    .content-inner {
        max-height: 100vh!important;
    }
</style>
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="card">
            <!-- <div class="card-header">{{ ('Dashboard') }}</div>   -->

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <div class="first-row-container">
                    <div class="card75">
                        <div class="queued-single-post-wrapper queue-type-promo" status="active" queue-type="promo">
                            <div class="queued-single-post">

                            <img src="http://app.quantumsocial.local/public/ui-images/icons/planet.svg" class="planet">

                            <div class="queued-single-start">
                                <span class="greeting">Hi,</span>
                                <span class="name">{{ $user ? $user->email : 'Guest' }}</span>
                            </div>  <!-- END .queue-single-start -->

                            <div class="queued-single-end">

                            </div>  <!-- END .queued-single-end -->

                            </div>  <!-- END .queued-single-post -->
                        </div>
                        <div class="card-below">
                            <div class="card-item-50">
                                <div class="a">
                                    {{-- <svg width="200" height="200" viewBox="-31.25 -31.25 312.5 312.5" version="1.1" xmlns="http://www.w3.org/2000/svg" style="transform:rotate(-90deg)">
                                        <circle r="115" cx="125" cy="125" fill="transparent" stroke="#C8C8C8" stroke-width="10" stroke-dasharray="722.2px" stroke-dashoffset="0"></circle>
                                        <circle r="115" cx="125" cy="125" stroke="#43EBF1" stroke-width="10" stroke-linecap="butt" stroke-dashoffset="419px" fill="transparent" stroke-dasharray="722.2px"></circle>
                                        <text x="102px" y="140px" fill="#fafafa" font-family="Montserrat" font-size="48px" font-weight="bold" style="transform:rotate(90deg) translate(0px, -246px)">42</text>
                                    </svg>         --}}
                                    <span class="actual">{{ $countPosts}}</span>
									@if( $plan )
                                    <span class="total">out of {{ $plan->mo_post_credits }} </span>
									@else
									 <span class="total">Contact you administrator </span>
									@endif
                                </div>
                                <div class="b">
                                    Monthly post credits
                                </div>
                            </div>
                            <div class="card-item-50">
                                <div class="a">
                                    <span class="actual">{{ $countHashtagGroups }}</span>
									@if( !empty($plan) )
                                    <span class="total">out of {{ $plan->hashtag_group }}
									@else
									 <span class="total">Contact you administrator </span>
									@endif

                                    </span>
                                </div>
                                <div class="b">
                                    Hashtag <br> Groups
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card25">
                        <div class="queued-single-post-wrapper queue-type-promo" style="    width: 100%;
                        height: 100%;">
                            <div class="queued-single-post">

                            <img src="http://app.quantumsocial.local/public/ui-images/icons/planet.svg" class="planet" style="width: 133px height: 145px">

                            <div class="queued-single-start" style="flex-direction: column; width: 100%;">
                               <span class="current-label">You are currently</span>
							   	@if( !empty($plan) )
								  <span class="current-plan">{{ ucfirst($plan->subscription_name) }} </span>
								@else
								  <span class="current-plan">Contact you administrator </span>
								@endif



                               <span class="current-uplabel">need more features?</span>
                               <button id="upgrade-now" class="current-upgrade">Upgrade</button>

                            </div>  <!-- END .queue-single-start -->

                            <div class="queued-single-end">

                            </div>  <!-- END .queued-single-end -->

                            </div>  <!-- END .queued-single-post -->
                        </div>
                    </div>
                </div>
                <div class="second-row-container">
                    <div class="card-item-25">
                        <div class="a card-col-a">
                            <span class="actual">{{ $countXaccts }}</span>
                        </div>
                        <div class="b card-col-b">
							 	@if( !empty($plan) )
								 <span class="card-description1">out of {{ $plan->member_count }} </span>
								@else
								  <span class="card-description1">Contact you administrator </span>
								@endif

                            <span class="card-description2">X accounts </span>
                        </div>
                    </div>
                    <div class="card-item-25">
                        <div class="a card-col-a">
                            <span class="actual">{{ $countAdmin }}</span>
                        </div>
                        <div class="b card-col-b">
								@if( !empty($plan) )
								  <span class="card-description1">out of {{ $plan->admin_count  }} </span>
								@else
								  <span class="card-description1">Contact you administrator </span>
								@endif

                            <span class="card-description2">Admin </span>
                        </div>
                    </div>
                    <div class="card-item-25">
                        <div class="a card-col-a">
                            <span class="actual">{{ $countTeamMembers}}</span>
                        </div>
                        <div class="b card-col-b">
								@if( !empty($plan) )
								   <span class="card-description1">out of {{ $plan->tm_count }} </span>
								@else
								    <span class="card-description1">Contact you administrator </span>
								@endif

                            <span class="card-description2">Team Members </span>
                        </div>
                    </div>
                    <div class="card-item-25">
                        <div class="a card-col-a">
                            <span class="actual">{{ $countTrial }}</span>
                        </div>
                        <div class="b card-col-b">
							@if( !empty($plan) )
							    <span class="card-description1">out of {{ $plan->trial_counter }} </span>
							@else
								<span class="card-description1">Contact you administrator </span>
							@endif

                            <span class="card-description2">Trial </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

<style>
.first-row-container,
.second-row-container {
    display: flex;
    /* background-color: rgba(143, 116, 188, 0.1); */
}
.card-item-75 {
    display: flex;
    /* width: 740; */
    background: rgba(143, 116, 188, 0.4)
    margin: 2px;
    border-radius: 25px;
}

.card-below {
    display: flex;
    margin-bottom: 1em;
}
.card-item-50 {
    display: flex;

    width: 50%;
    /* background: #8F74BC; */
    background: rgba(143, 116, 188, 0.4);
    margin-right: 2em;
    border-radius: 25px;
}

.card-item-35 {
    display: flex;
    background-color: rgba(143, 116, 188, 0.1);
    margin: 2px;
    width: 50%
}

.a, .b {
    padding: 1em;
    display: flex;
    flex-direction: column;
}

.a {
    width: 40%;
    text-align: center
}

.a span.actual {
    font-family: Montserrat;
    font-size: 48px;
    font-weight: bold;
    line-height: 1.2em
}
.a span.total {
    font-family: Montserrat;
    font-size: 14px;
    text-transform: uppercase;
}

.b {
    font-family: Montserrat;
    font-size: 18px;
    text-transform: uppercase  ;
    display: flex;
    justify-content: center  ;
    width: 60%;
    padding: 1em;
}

span.metrics-text {
    position: absolute;
    left: 60px;
    top: 35%;
    font-family: Montserrat;
    font-size: 48px;
    font-weight: bold;
}

.card-item-25 {
    width: 25%;

    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    position: relative;
    padding: 1em;
    border-radius: 25px;
    background: rgba(143, 116, 188, 0.4);
    overflow: hidden;
    -webkit-line-clamp: 1;
    margin-right:2em;
}

.queued-single-post-wrapper {
    overflow: hidden!important;
}

.queued-single-post {
    border-radius: 20px!important;
    margin-right:2em;
    background: rgba(143, 116, 188, 0.4)!important;
    height: 100%;
    margin-bottom: 1em;
}

.queued-single-start span.greeting {
    font-size: 12px;
    font-family: Montserrat;
    text-transform: uppercase;
}

.queued-single-start span.name {
    font-size: 20px;
    font-weight: bold;
    font-family: Montserrat;
    margin-left: 1em
}

.card75 {
  flex: 0 0 75%; /* flex-grow: 0, flex-shrink: 0, flex-basis: 75% */
  margin: 2px;
}

.card25 {
    flex: 0 0 25%; /* flex-grow: 0, flex-shrink: 0, flex-basis: 25% */
    margin: 2px;
}

.container {
    height: 100vh!important
}

.card-col-a {
    width: 35%;
}

.card-col-b {
    width: 65%;
    padding-left: 1.5em
}
.card-description1 {
    font-size: 12px;
}
.card-description2 {
    font-size: 14px;
}

.planet {
    filter: white;
    position: absolute;
    top: -20px;
    left: -12px;
    width: 80;
    height: 87px;
    rotate: 25deg;
    opacity: 0.1;
    z-index: 51;
    rotate: 0deg;
}

.current-label {
    font-size: 10px;
    text-transform: uppercase;
    font-family: Montserrat;
}

.current-plan {
    font-size: 20px;
    font-weight: light;
    font-family: Montserrat;
    margin-bottom: 2em;
    color: #43EBF1;
}

.current-uplabel {
    text-transform: uppercase;
    font-family: Montserrat;
    font-size: 10px;
    margin-bottom: 1em;
}

.current-upgrade {
    background: rgba(67, 235, 241, 0.5);
    border: none;
    text-transform: uppercase;
    width: 100%;
    padding: 1em;
    font-family: Montserrat;
    font-size: 14px;
}
</style>
