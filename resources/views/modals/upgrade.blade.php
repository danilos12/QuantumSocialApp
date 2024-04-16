<style>
    .upgrade {
        z-index: 1500;
    }

    .modal-large-anchor-upgrade {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 79;
    }

    .modal-large-backdrop-upgrade {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 100%;
        height: 100vh;
        backdrop-filter: blur(50px);
        z-index: 100;
        background-color: var(--color-cosmic-purple-60);
    }

    .upgrade-page-outer {
        background: radial-gradient(93.21% 93.21% at 50% 50%, #721A66 80%, rgba(65, 30, 76, 0) 100%);
        width: 90%;
        font-family: Montserrat;
        position: absolute;
        height: 90vh
        /* z-index: 1500; */
    }

    .openup {
        backdrop-filter: blur(50px);
    }

    .main-container {
        text-align: center;
        font-family: Montserrat
    }

    .main-container .header {
        text-transform: uppercase;
    }

    .upgrade-page-outer .card-container {
        display: flex;
        justify-content: space-between;
        padding: 0 10em; /* Adjust this value to increase or decrease the space */
        margin-top: 3.5em;

    }

    .upgrade-page-outer .card {
        width: 345px;
        height: 450px;
        background: #3B1D3B;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-family: Montserrat;
    }

    .upgrade-page-outer .card:first-child,
    .upgrade-page-outer .card:last-child {
        color: #5B1C55;
        height: 430px;
        margin-top: 3em;
        background: #ffffff;
    }

    .upgrade-page-outer .card:first-child .card-header,
    .upgrade-page-outer .card:last-child .card-header {
        text-align: center;
        color:#5B1C55;
        text-transform: uppercase;
        padding: 1em 0;
    }

    .upgrade-page-outer .card:first-child .card-cta,
    .upgrade-page-outer .card:last-child .card-cta {
        background: #701B65;
        color: #ffffff;

    }

    .upgrade-page-outer .card-header {
        font-family: Montserrat;
        font-size: 25px;
        font-weight: 800;
        line-height: 32px;
        letter-spacing: 0em;
        text-align: center;
        padding: 1em 0;
        background-image: linear-gradient(87.98deg, #C108FE 16.3%, #6A78F2 57.98%, #02FFE2 100.37%);
        background-clip: text;
        color: transparent;
        text-transform: uppercase
    }

    .upgrade-page-outer .card-price-description .price-text {
        font-size: 25px;
        font-weight: 800;
        line-height: 32px;
        letter-spacing: 0em;
        text-align: center;
    }

    .upgrade-page-outer .sub-description {
        padding: 1em 0;
    }

    .upgrade-page-outer .card-cta  {
        margin: 1em 0;
        border: none;
        padding: 10px;
        width: 150px;
        border-radius: 10px;
        border: 1.5px solid;
        /* border-image-source: linear-gradient(90.11deg, #C23BFF -19.09%, #7F69FC 49.71%, #1EA9F7 80.95%); */
        color: #701B65;
        text-transform: uppercase;
        font-weight: 600
    }

    .modal-large-outer-upgrade
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
    .card-features{
        width:100%;
    }
    .feature-item{

        display: flex;
        justify-content: center;
        width:100%;

    }
    .text-grey{
        color:#9F9F9F;
    }
    .bg-red{
        background-color: red;
    }
    .bg-blue{
        background-color: blue;
    }
    .bg-green{
        background-color: green;
    }
    .flex{
        display: flex;
    }
    .space-x-4{
        margin-left: 1rem;
    }
    .space-y-3{
        margin-top: 0.75rem;
    }
    .justify-center{
        justify-content: center;
    }
    .items-center{
        align-items: center;
    }
    .w-25{
        width: 25%;
    }
    .w-50{
        width: 55%;
    }
    .w-auto{
        widows: auto;
    }
    .w-100{
        widows: 100%;
    }
    .w-8{
        width: 2rem;
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .ml-4{
        margin-left: 1rem;
    }
</style>

<div class="modal-large-anchor-upgrade">
    <div class="modal-large-backdrop-upgrade">
        <div class="modal-large-outer-upgrade  upgrade-page-outer frosted">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close settings-close close-upgrade-page"/>

            <div class="account-settings-header-wrap">
                <img src="{{ asset('public/')}}/ui-images/logo/quantum-logo-white-lg.png" width="auto" height="50">
            </div>  <!-- END .account-settings-header-wrap -->
            {{-- <div data-form-url="{{ route('save-settings') }}" data-twitterid=" {{ isset($user) ? $user->twitter_id : " " }}" id="help-settings"></div> --}}

            <div class="main-container">
                @if (Auth::guard('web')->check())
                <h1 class="header">Account owner</h1>
                <p>Effective content management is essential for success in the digital age, allowing you to build credibility, engage your audience, and stay ahead of the competition</p>
                @else
                <h1 class="header">Member</h1>
                <p>Effective content management is essential for success in the digital age, allowing you to build credibility, engage your audience, and stay ahead of the competition</p>
                @endif


                <div class="card-container">
                    <div class="card">
                        <div class="card-header">SOLAR</div>
                        <div class="card-price-description">
                            <div class="price-text">$49</div>
                            per user participant
                        </div>
                        <div class="sub-description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </div>
                        <div class="card-features">
                            <div class="feature-item">
                                <div class="">
                                <div class="flex items-center ">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4 text-center">7 days trial</span>
                                </div>
                                <div class="flex items-cente space-y-3">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can add 1 Administrator</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can add 0 Members</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8 ">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can link 3 X accounts</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8 ">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4 ">Monthly Post Credits 200</span>
                                </div>
                            </div>
                            </div>





                        </div>
                        @if (Auth::guard('web')->check())
                        <input type="button" class="card-cta" value="{{ ($product_id === 61) ? "Your Plan" : "Upgrade Now" }}" data-product-id="61" {{ ($product_id === 61) ? 'disabled' : "" }} >
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-header">ASTRAL</div>
                        <div class="card-price-description">
                            <div class="price-text">$89</div>
                            per user participant
                        </div>
                        <div class="sub-description text-grey">For large organization that wants to post thousands of contents on multiple accounts </div>
                        <div class="card-features">
                            <div class="feature-item">
                                <div class="">
                                <div class="flex items-center ">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4 text-center">7 days trial</span>
                                </div>
                                <div class="flex items-cente space-y-3">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can add 5 Administrator</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can add 10 Members</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8 ">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can link 25 X accounts</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8 ">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4 ">Monthly Post Credits Unlimited</span>
                                </div>
                            </div>
                            </div>

                        </div>
                        @if (Auth::guard('web')->check())
                        <input type="button" class="card-cta" value="{{ ($product_id === 62) ? "Your Plan" : "Upgrade Now" }}" data-product-id="62" {{ ($product_id === 62) ? 'disabled' : "" }} >
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-header">GALACTIC</div>
                        <div class="card-price-description">
                            <div class="price-text">$119</div>
                            per user participant
                        </div>
                        <div class="sub-description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </div>
                        <div class="card-features">
                            <div class="feature-item">
                                <div class="">
                                <div class="flex items-center ">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <div class="flex justify-center">
                                    <span class="ml-4 text-center">7 days trial</span>
                                    </div>
                                </div>
                                <div class="flex items-cente space-y-3">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can add 3 Administrator</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can add 5 Members</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8 ">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4">Can link 15 X accounts</span>
                                </div>
                                <div class="flex items-center space-y-3">
                                    <div class="w-8 ">
                                        <img src="/public/ui-images/icons/check.svg" alt="">
                                    </div>
                                    <span class="ml-4 ">Monthly Post Credits 2500</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        @if (Auth::guard('web')->check())
                        <input type="button" class="card-cta" value="{{ ($product_id === 63) ? "Your Plan" : "Upgrade Now" }}" data-product-id="63" {{ ($product_id === 63) ? 'disabled' : "" }} >
                        @endif
                    </div>
                </div>
            </div>


        </div>  <!-- END .twitter-settings-outer -->
    </div>
</div>

<script>
    $(document).ready(function(e) {
        // $('upgrade-outer-page').closest('.modal-large-outer').attr('style', '')
        $('.card-cta').on('click', function(e) {
            const prod_id = e.target.dataset.productId;
            console.log(prod_id);

            window.location.href = "https://quantumsocial.io/wp-json/plan/login/subscription";
        })

        $('.close-upgrade-page').on('click', function(e) {
            // Sub Menu
            var uri =  "{{  basename($_SERVER['REQUEST_URI']) }}";

            $('.upgrade').attr('style', 'z-index:0');
            $('.modal-large-anchor-upgrade').attr('style', 'display: none');

            if (uri === "bulk-queue" || uri === "bulk") {
                @if (Auth::guard('web')->check())
                var redirectUrl = "{{ route('dashboard') }}";
                @endif
                @if (Auth::guard('member')->check())
                var redirectUrl = "{{ route('memberhome') }}";
                @endif

                if(redirectUrl){
                    window.location.href = redirectUrl;
                }

            }
        })
    })
</script>
