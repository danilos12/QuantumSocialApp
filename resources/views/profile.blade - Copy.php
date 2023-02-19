@extends('layouts.app')

@section('content')
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
					<!---Edit Password--->
					<div ><a href="{{ route('edit-password') }}">Edit Password</a></div>
					<!---Edit Password--->
					<!---Log out--->
					<div >
					<a class="dropdown-item" href="{{ route('logout') }}"
					   onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
					</div>
					<!---Log out--->
                </div>
            </div>
        </div>
		
		
		
    </div>
</div>
@endsection
