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

    .main-container button {
        margin: 0 auto;
        display: flex;
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
    
    .api-modal {
        border: 1px solid white;
        font-size: 20px;                

    }

</style>

<div class="modal-large-anchor-onboard">
    <div class="modal-large-backdrop-onboard">

    <div class="add-api-modal" style="display:none;">
        <div class="add-api-inner frosted">
            <!-- BEGIN input copied from engage.html -->
            <div class="exit-button" >
              <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon settings-close close-add-api" id="close-add-api"/>
            </div>

            <div class="menu-header font-white">X API Credentials</div>
            <!-- START auto-reply -->
            <div class="menu-subTwirl-outer">
                <form id="master_api_form">
                <div class="subTwirl-header-wrap">
                    <span class="subTwirl-header">API Key:</span>
                </div>
                <div class="menu-subTwirl-inner">
                    <input type="text" class="input-field" id="api_key" name="api_key" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->api_key  : ''  }}"/>
                </div>
                <div class="subTwirl-header-wrap">
                    <span class="subTwirl-header">API Secret:</span>
                </div>
                <div class="menu-subTwirl-inner input-group">
                    <input type="password" class="input-field" id="api_secret" name="api_secret" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->api_secret  : ''  }}"/>
                    <div class="input-group-append">
                    <span class="input-group-text"><img src="{{ asset('public')}}/ui-images/icons/eye-open.svg" alt="password" class="secrets" id="api_secret"></span>
                    </div>
                </div>
                <div class="subTwirl-header-wrap">
                    <span class="subTwirl-header">Bearer Token:</span>
                </div>
                <div class="menu-subTwirl-inner">
                    <input type="text" class="input-field" id="bearer_token" name="bearer_token" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->bearer_token : ''  }}"/>
                </div>
                <div class="subTwirl-header-wrap">
                    <span class="subTwirl-header">OAuth 2.0 ID:</span>
                </div>
                <div class="menu-subTwirl-inner">
                    <input type="text" class="input-field" id="oauth_id" name="oauth_id" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->oauth_id : ''  }}"/>
                </div>
                <div class="subTwirl-header-wrap">
                    <span class="subTwirl-header">OAuth 2.0 Secret:</span>
                </div>
                <div class="menu-subTwirl-inner input-group">
                    <input type="password" class="input-field" id="oauth_secret" name="oauth_secret" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->oauth_secret : ''  }}"/>
                    <div class="input-group-append">
                    <span class="input-group-text"><img src="{{ asset('public')}}/ui-images/icons/eye-open.svg" alt="password" class="secrets" id="oauth_secret"></span>
                    </div>
                </div>
                <div class="subTwirl-header-wrap">
                    <span class="subTwirl-header">Callback URL</span>
                </div>
                <div class="menu-subTwirl-inner">
                    <input type="text" class="input-field" id="callback_url" name="callback_url" value="{{ isset($twitterApiMaster) ? $twitterApiMaster->callback_url : 'https://app.quantumsocial.io/twitter/oauth'  }}" readonly/>
                </div>
                <input type="hidden" name="form_recipient" value="onboard">
                <div class="menu-subTwirl-inner">
                    <input type="submit" value="Save API credentials" class="subTwirl-buttons" style="margin-top: 0.5em; border: none">
                </div>
                </form>
            </div>
            <!-- END copied from engage.html -->

        </div>  <!-- END .add-team-member-inner -->
      </div>  <!-- END .add-team-member-modal -->

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
                <button class="api-modal subTwirl-buttons" id="addApi">Add X Credentials here</button>
                <br>
                <h3>Here’s a tutorial on how to do that:
                    <a href="https://quantumsocial.io/tutorial/how-to-sign-up-for-the-x-api-a-step-by-step-guide/" target="new">Check it here!</a>
                </h3>
                <br>
            </div>

            <div class="content-footer">
                <button class="done done-onboard-page">Done</button>
                <button class="show-later close-onboard-page" id="startTour">Show me later</button>
            </div>
        </div>  <!-- END .twitter-settings-outer -->
    </div>
</div>

<style>
    .add-api-modal {
        width: 80%;
        z-index: 99;
        background: radial-gradient(93.21% 93.21% at 50% 50%, #721A66 80%, rgba(65, 30, 76, 0) 100%)
    }

    .add-api-inner {
        padding: 2em;
    }

    #close-add-api {
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function() {
        $("#startTour").click(function() {
            console.log(1);
            introJs().start();
        });

        $('.api-modal').on('click', function(e) {
            $('.add-api-modal').css('display', 'block');
            $('.modal-large-backdrop-onboard').css('backdrop-filter', 'blur(10px)')
        })
        
        $('#close-add-api').on('click', function(e) {
            console.log(e);
            $('.add-api-modal').css('display', 'none');
            $('.modal-large-backdrop-onboard').css('backdrop-filter', 'blur(1px)')
        })

    });
</script>