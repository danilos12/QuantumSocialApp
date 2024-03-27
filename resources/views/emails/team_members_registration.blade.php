@extends('layouts.check')

@section('content')
<div class="font-white">

    <div class="login-outer">

        <div class="login-inner">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
                <span class="invalid-feedback error-message alert alert-danger" role="alert"></span>
                <span class="invalid-feedback success-message " role="alert"></span>


            <div class="logo-center">
                <img src="{{ asset('public/')}}/ui-images/logo/QuantumLogo-horiz-white-app@2x.png" class="image-placeholder" width="300" />
            </div>



            <form >

                @csrf



                @php
                $fullname = request()->query('fullname');
                $token = request()->query('token');
            @endphp
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="fullname" value="{{ $fullname }}">


                <div class="row mb-3">
                    <div class="col-md-12 m1em">
                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                </div>



                <div class="row mb-3">
                    <div class="col-md-12 m1em">
                        <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="col-md-12 m1em" style="text-align: center">
                    <button type="submit" class="btn btn-primary register">
                        Register
                    </button>
                </div>

            </form>
            <div class="form p-135">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('form').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("tocontroller") }}',
                type: 'POST',
                data: formData,
                success: function(response) {

                        if(response.stat=='success'){
                            $('.success-message').text(response.message).css('display', 'flex');
                            setTimeout(function() {
                                $('.success-message').fadeOut('slow');
                                window.location.href = "{{ route('forauth') }}";
                            }, 3000);

                        }else if(response.stat=='warning'){
                            $('.error-message').text(response.message).css('display', 'flex');
                            setTimeout(function() {
                                $('.error-message').fadeOut('slow');
                                window.location.href = "{{ route('forauth') }}";
                            }, 3000);

                        }





                },
                error: function(xhr, status, error) {

                    var response = xhr.responseJSON;

                    if (response && response.errors) {
                        // Extract error messages from the 'errors' object
                        var errorMessages = Object.values(response.errors).flat();
                        if (errorMessages && errorMessages.length > 0) {
                            // Display error messages to the user
                            $('.error-message').text(errorMessages.join(' ')).css('display', 'flex');
                            setTimeout(function() {
                                $('.error-message').fadeOut('slow');
                            }, 3000);
                        }
                    } else if (response && response.token_matched === false) {
                        $('.error-message').text(response.error).css('display', 'flex');
                        setTimeout(function() {
                            $('.error-message').fadeOut('slow');
                            window.location.href = "{{ route('session-login') }}";
                        }, 3000);
                    }
                }
            });
        });
    });
</script>

@endsection

<style>

    .error-message {
    display: none;
    justify-content: center;
    padding: 15px;
    text-align: center;
    background: red;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;

}
    .success-message {
    display: none;
    justify-content: center;
    padding: 15px;
    text-align: center;
    background: rgb(4 255 0 / 50%);
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;

}
.fadeIns{
    animation: fadeIn 2s;
}
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
    display: flex;
    flex-direction: column;
    justify-content: center;
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