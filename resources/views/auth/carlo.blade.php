@extends('layouts.app')

@section('content')


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
    /* width: 90%;
    max-width: 500px; */
    padding: 3.5em;
    border-radius: 25px;
    background: rgba(143, 116, 188, 0.40);
    width: 434px;
    height: 356px;
    flex-shrink: 0;
}



.login-inner input[type="email"], .login-inner input[type="password"] {
    width: 338px;
    height: 41px;
    flex-shrink: 0;
    border-radius: 5px;
    background: #FFF;

}

.login-inner input::placeholder {
    color: #929292;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    font-family: 'Montserrat', sans-serif;
}

.login-inner button {
	width: 338px;
    height: 41px;
    flex-shrink: 0;
}

.form-check-input {
    width: 24px;
    height: 24px;
    flex-shrink: 0;
}
.form-check-label {
    margin-top: 10px;
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.form-check-input {
    margin-right: 10px!important;
}

.checkbox-wrapper {
  display: flex;
  align-items: center;
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

.forgotpass {
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.signup {
    color: #43EBF1;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.btnlogin {
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-family: Montserrat;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.m1em {
    margin-top: 1em
}

#wp_message01 {
  margin: 20px 0px;
}
.form_quantum_v87 button {
  width: auto !important;
}
.quantum_s11 {
  margin-bottom: 20px;
  width: 100%;
}
</style>


<div class="logo-center">
    <img src="{{ asset('public/')}}/ui-images/logo/quantum-logo-white-lg.png" class="image-placeholder" width="500" style="width: 434px;
    height: 98.957px;
    flex-shrink: 0;" />
</div>
<div class="login-outer" style="margin-top:4em">
    <div class="login-inner">
        <form id="customRegister">
            @csrf

            <div class="row mb-3">

                <div class="col-md-12">
                    <input placeholder="Email Address" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
             <div class="row mb-3">

                <div class="btn-group btn-group-toggle  m1em ">
                    <label class="btn btn-light {{ old('access_level') === 'Free' ? 'active' : '' }}">
                      <input type="radio" name="access_level" id="access_free_v1"  value="Free" autocomplete="off" checked> Free
                    </label>
                    <label class="btn btn-light {{ old('access_level') === '66' ? 'active' : '' }}">
                      <input type="radio" name="access_level" id="access_free_v2" value="66" autocomplete="off"> Premium
                    </label>


                  </div>

            </div>

            <div class="row mb-12">

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btnlogin" >
                        {{ __('Sign Up') }}
                    </button>
                </div>
            </div>

        </form>
		<div id="wp_form_v1_quantum" class="quantum_form_v4" style="display: none;"></div>
		 <div id="wp_message01" class="alert alert-danger" style="display: none;"></div>	
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>

<script>
jQuery(function($) {
		jQuery('#customRegister').submit( function(e) {
			e.preventDefault();
			var fidt = jQuery(this);
			fmDatac = fidt.serialize();
			
			jQuery.ajax({
				type:'POST', dataType:'json', url:window.location.protocol + '//' + window.location.hostname+'/custom-vr', data:fmDatac, 
				beforeSend: function() {
					jQuery('#wp_message01').removeAttr('style').html('please wait, while processing!');
				},
				error: function (err) {
					jQuery('#wp_message01').html('server error');
				}
			}).done(function(data){
				if(data.status === 'success') {
					jQuery('#customRegister').remove();
					jQuery('.quantum_form_v4').removeAttr('style').html(data.form_v1);
					jQuery('#wp_message01').html(data.message);
				} else {
					jQuery('#wp_message01').html(data.message);
				}
				
			});
			
		});
});
</script>

@endsection
