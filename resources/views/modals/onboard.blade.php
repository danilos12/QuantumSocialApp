<style>
    .upgrade {
        z-index: 1500;
    }

    .modal-large-anchor-onboard {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 79;
    }

    .modal-large-backdrop-onboard {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 100%;
        height: 100vh;
        backdrop-filter: blur(1px);
        z-index: 100;
        background-color: var(--color-cosmic-purple-60);
    }

    .onboard-page-outer {
        background: radial-gradient(93.21% 93.21% at 50% 50%, #721A66 80%, rgba(65, 30, 76, 0) 100%);
        width: 50%;
        font-family: Montserrat;
        position: absolute;
        height: auto;
    }

    .modal-large-outer-onboard
    {
        display: flex;
        flex-direction: column;
        /* background: var(--frost-background); */
        color: var(--body-text);
        /* width: 70%; */
        /* height: 80vh; */
        padding: 2.5em 3em 2.5em;
        border-radius: 10px;
        box-sizing: border-box;
    }

    .main-container h1,
    .main-container a,
    .main-container h3 {
        color: #ffffff;
        text-align: center;
    }
    
    .main-container a {
        font-size: 18px;
        text-decoration: underline;
    }
    .account-settings-header-wrap {
        display: none;
    }

    .content-footer {
        position: fixed;
        bottom: 1em;
        right: 1em;
    }

    .done, .show-later {
        background-color: transparent;
        border: 1px solid white;
        font-size: 20px;                
    }

</style>

<div class="modal-large-anchor-onboard">
    <div class="modal-large-backdrop-onboard">
        <div class="modal-large-outer-onboard  onboard-page-outer frosted">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-onboard-page"/>

            <div class="account-settings-header-wrap">
                <img src="{{ asset('public/')}}/ui-images/logo/quantum-logo-white-lg.png" width="auto" height="50">
            </div>  <!-- END .account-settings-header-wrap -->
            {{-- <div data-form-url="{{ route('save-settings') }}" data-twitterid=" {{ isset($user) ? $user->twitter_id : " " }}" id="help-settings"></div> --}}

            <div class="main-container">
                <h1>Welcome to QuantumSocial!</h1>
                <h3> We’re glad you’re here!</h3>
                <h3>There is one thing that needs to be done.  You have access to use Quantum, but in order to use X you will need to sign up for their API.</h3>
                <br>
                <h3>Don’t worry! It’s super easy!</h3>
                <br>
                <h3>Here’s a tutorial on how to do that:
                    <a href="https://quantumsocial.io/tutorial/how-to-sign-up-for-the-x-api-a-step-by-step-guide/" target="new">Check it here!</a>
                </h3>
                <br>
            </div>

            <div class="content-footer">
                <button class="done done-onboard-page">Done</button>
                <button class="show-later close-onboard-page">Show me later</button>
            </div>
        </div>  <!-- END .twitter-settings-outer -->
    </div>
</div>

<script>
    $(document).ready(function() {
       
    });
</script>