@extends('layouts.app')

@section('content')

@if ($title == 'Evergreen Tweets')
	
<h2>{{ $title }}</h2>
<p>Carlo Ariel</p>
@endif

@if ($title != 'Evergreen Tweets')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ $title }}</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						{{ __('You are logged in!') }}
					</div>
				</div>
			</div>
		</div>
	</div>
		
@endif

@endsection



