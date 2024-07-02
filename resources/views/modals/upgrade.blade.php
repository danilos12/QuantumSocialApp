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
        display: flex;
        text-align: justify;
        flex-direction: column;
        justify-content: center;
        margin: 0 auto;
        padding: 2em 2em;
    }
    .feature-item{

        display: flex;
        /* justify-content: center; */
        width:100%;
        padding: 0.5em;

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
@php
use App\Http\Controllers\EncryptionDecryption;


@endphp
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
                    @foreach ($plans as $subscriptionId => $features)

                    <div class="card">
                        @php
                            $product_name = '';
                            $plan_price = '';
                        @endphp
                        @foreach ($features as $feature)
                            @if ($feature->meta_key === 'product_name')
                                @php $product_name = $feature->meta_value @endphp
                            @endif
                            @if ($feature->meta_key === 'product_price')
                                @php $plan_price = $feature->meta_value @endphp
                            @endif
                        @endforeach
                        <div class="card-header">{{ $product_name }}</div>
                        <div class="card-price-description">
                            <div class="price-text">{{ $plan_price }}</div>
                        </div>
                         <div class="card-features flex justify-center">
                            @foreach ($features as $f)
                                @if (strpos($f->meta_key, 'feature_') === 0)
                                    <div class="feature-item">
                                        <div class="">
                                            <div class="flex items-center ">
                                                <div class="w-8">
                                                    <img src="/public/ui-images/icons/check.svg" alt="">
                                                </div>
                                                <div class="flex justify-center">
                                                    <span class="ml-4 text-center">{{ $f->meta_value }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        @if (Auth::guard('web')->check())
                            @php
                                $encrypted = EncryptionDecryption::encrypt((string)Auth::id());
                                $value = null;
                                $pr_name = '';
                                switch ($feature->subscription_id) {
                                    case 1:
                                        $value=59;
                                        $pr_name = 'solar';
                                        break;
                                    case 2:
                                        $value=61;
                                        $pr_name = 'galactic';
                                        break;
                                    case 3:
                                        $value = 66;
                                        $pr_name = 'astral';
                                        break;


                                }
                                $encryptedproduct =EncryptionDecryption::encrypt($value);
                                $encryptprname =EncryptionDecryption::encrypt($pr_name);
                            @endphp
                        <form action="http://quantumsocial.io/wp-json/plan/update/items" method="post">
                            @csrf
                            <input type="hidden" name="prdt" value={{ $encryptedproduct }}>
                            <input type="hidden" name="klase" value={{ $encryptprname }}>
                            <input type="hidden" name="awsg" value={{$encrypted}}>
                            <!-- Other form fields -->
                            <input type="submit" class="card-cta" value="{{ ($product_id === $feature->subscription_id) ? "Your Plan" : "Upgrade Now" }}" {{ ($product_id === $feature->subscription_id) ? 'disabled' : "" }} >
                          </form>

                        @endif
                    </div>
                    @endforeach

                </div>
            </div>
        </div>  <!-- END .twitter-settings-outer -->
    </div>
</div>

<script>
    $(document).ready(function(e) {
        // $('upgrade-outer-page').closest('.modal-large-outer').attr('style', '')


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
