@extends('layouts.app')

@section('content')


<div class="login-outer">
    <div class="login-inner">

        <h1 class="login-heading mb-3" >{{ __('Register') }} </h1>

        <div class="form p-135">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .content-outer {
        justify-content: center;
    }
    
.login-outer {

    justify-content: center;
    display: flex;

}

.p-135 {
    padding: 1em;
}

.login-inner form {

    display: flex;
    flex-direction: column;
    width: 100%;

}

.login-heading {
        text-align: center;
    color: white;
}

.login-inner {
    width: 90%;
    max-width: 500px;
    padding: 2em;
    background: rgba(255,255,255,.5);
    border-radius: 10px;
}



.login-inner input[type="email"], .login-inner input[type="password"] {
	padding-top: 10px;
	padding-left: 10px;
	padding-bottom: 10px;
	padding-right: 0px;
    margin-bottom: .75em;
    border-radius: 5px;
    font-size: .9em;
    border: none;
    color: #8843db;
	width: 100%;

}

.login-inner button {
	padding: 10px;
    background: #8843db;
    color: #fff;
	margin-bottom: .75em;
    border-radius: 5px;
    font-size: .9em;
    border: none;;
	width: 100%;
}

.content-outer { 
    justify-item: center;
    margin-left: 0!important;
    /* text-color: #ffffff */
}
</style>