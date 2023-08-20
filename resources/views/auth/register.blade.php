@extends('layouts.app')

@section('content')


<div class="login-outer">
    <div class="login-inner">

        <div class="logo-center">
            <img src="{{ asset('public/')}}/ui-images/logo/QuantumLogo-horiz-white-app@2x.png" class="image-placeholder" width="300" />
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf           
             
        
           
            <div class="row mb-3">

                <div class="col-md-12 m1em">
                    <input id="firstname" placeholder="First Name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname">                   
                </div>
            </div>
            @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <div class="row mb-3">

                <div class="col-md-12 m1em">
                    <input id="lastname" placeholder="Last Name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname">                   
                </div>
            </div>
            @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <div class="row mb-3">

                <div class="col-md-12 m1em">
                    <input id="email" placeholder="Email Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">                   
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="row mb-3">
                <div class="col-md-12 m1em">
                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>              
            @enderror

            <div class="row mb-3">
                <div class="col-md-12 m1em">
                    <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="col-md-12 m1em" style="text-align: center">
                <button type="submit" class="btn btn-primary register">
                    {{ __('Register') }}
                </button>
            </div>
            <div class="col-md-12 m1em" style="text-align: center">
                @if (Route::has('login'))
                <a class="btn btn-link p-0 loginacct" href="{{ route('login') }}">
                    {{ __('Login to your account') }}
                </a>
            @endif
            </div>
        </form>
        <div class="form p-135">
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
    margin-bottom: 20em;

}

.p-135 {
    padding: 1em;
}

.login-inner form {

    display: flex;
    flex-direction: column;
    width: 100%;
    align-items: center

}

.login-heading {
        text-align: center;
    color: white;
}

.login-inner {
    padding: 3.5em;
    width: 613px;
height: 530px;
flex-shrink: 0;
border-radius: 25px;
background: rgba(143, 116, 188, 0.40);
}



.login-inner .form-control {
	width: 338px;
height: 41px;
flex-shrink: 0;
border-radius: 5px;
background: #FFF;
}

.login-inner .form-control::placeholder {
    color: #929292;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.content-outer { 
    justify-item: center;
    margin-left: 0!important;
    /* text-color: #ffffff */
}

.banner-outer {
    display: none!important;
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

.justify-center {
    justify-content: center
}

.p-0 {
    padding: 0!important;
}

.p_05 {
    padding: 0.5em 0;
}

.btn-link {
    align-items: center;
    display: flex;
    padding: 12px 0;
}

.m1em {
    margin-top: 1em
}

.loginacct {
    color: #fff!important;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.register {
    width: 338px;
    height: 41px;
    flex-shrink: 0;
    font-family: Montserrat;
}
</style>