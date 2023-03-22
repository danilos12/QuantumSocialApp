@extends('layouts.app')

@section('content')
<div class="login-outer">
    <div class="login-inner">

        <div class="logo-center">
            <img src="{{ asset('public/')}}/ui-images/logo/quantum-logo-white-lg.png" class="image-placeholder" width="300" />
        </div>

        <div class="form p-135">
            <form method="POST" action="{{ route('login') }}">
                @csrf
    
                <div class="row mb-3">
                    
                    <div class="col-md-12">
                        <input placeholder="Email Address" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    
                    <div class="col-md-12">
                        <input placeholder="{{ __('Password') }}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-12 offset-md-4">
                        <div class="form-check p_05">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-12">
                    
                    <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">
                            {{ __('Connect') }}
                        </button>
                    </div>
                </div>
    
                <div class>                  
                    <div class="d-flex justify-space-between">
                        <div class="p-2">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="ml-auto p-2">
                            @if (Route::has('register'))
                                <a class="btn btn-link p-0" href="{{ route('register') }}">
                                    {{ __('Sign up') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>

.login-outer {

    justify-content: center;
    display: flex;

}

.p-135 {
    padding: 1em 3.5em;
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
    margin-left: 0;
    /* text-color: #ffffff */
}

.banner-outer {
    display: none;
}

.logo-center {
    display:flex;
    justify-content: center;
}

.d-flex {
    display: flex;
}

.justify-space-between {
    justify-content: space-between
}

.p-0 {
    padding: 0;
}

.p_05 {
    padding: 0.5em 0;
}

</style>
@endsection
