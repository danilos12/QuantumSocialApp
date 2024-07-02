@extends('layouts.app')

@section('content')


<div class="login-outer">
    <div class="login-inner">

        <div class="logo-center">
            <img src="{{ asset('public/')}}/ui-images/logo/QuantumLogo-horiz-white-app@2x.png" class="image-placeholder" width="300" />
        </div>
        <div class="logo-center resetpasstext">
            RESET YOUR PASSWORD
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
           
            <div class="row mb-3" syle="margin-top: 10em">

                <div class="col-md-6">
                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('errors')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3" syle="margin-top: 10em">
                <div class="col-md-6">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>

            </div>
            <div class="row mb-3" syle="margin-top: 10em">

                <div class="col-md-6">
                    <input id="password-confirm" placeholder="Confirm Password" type="text" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
                      
            <div class="row mb-3">

                <div class="col-md-12" style="text-align: center">                
                    <button type="submit" class="btn btn-primary ">
                        {{ __('Reset Password') }}
                    </button>
                </div>           
                
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
    align-items: center;
    margin-top: 3em

}

.login-heading {
        text-align: center;
    color: white;
}

.login-inner {
    padding: 3.5em;
    width: 613px;
height: 416px;
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

.backtologin {
    color: #43EBF1!important;
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

.resetpasstext {
    color: #FFF;
    text-align: center;
    font-size: 16px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    text-transform: uppercase;
    margin-top: 2em
}


.passwordlink {
    display: flex;
    width: 338px;
    height: 41px;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    margin-top: 1.5em;
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.mb-3 {
    margin-bottom: 0.5em;
}

.input-group {
  position: relative!important;
  display: flex!important;
}

.input-group-append {
  position: absolute;
  right: 0;
  top: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  z-index: 999;
}


.input-group-text img {
  width: 20px; /* Adjust the size as needed */
  margin-right: 0.5em;
}
</style>