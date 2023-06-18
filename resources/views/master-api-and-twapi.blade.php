<div class="menu-section-outer twitterapi-account-outer">
    <div class="menu-section-inner twitterapi-account-inner">
        <div class="menu-section-twirl-header-outer">
            <div class="menu-section-twirl-header-inner">

                <span class="menu-section-header">
                Twitter API</span>

                <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon menu-section-twirl-icon menu-section-command-twirl" data-toggle="collapse" data-target="#twitter-api-command-twirl" />

            </div>  <!-- END .menu-section-twirl-header-inner -->
        </div>  <!-- END .menu-section-twirl-header-outer -->

        <div class="menu-section-twirl-section-outer collapse in" id="twitter-api-command-twirl">
            <div class="menu-section-twirl-section-inner">

                <div class="menu-twirl-option-outer">
                    <div class="menu-twirl-option-inner">
                        <div class="menu-twirl-left">
                            <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon menu-twirl-option-icon" />
                            <span class="menu-twirl-option-text">
                                You are currently using Master API Credentials.<br> 
                                <span style="font-weight: 200; font-style=italic">(Turn this on to add account level credentials form).</span> 
                            </span>
                        </div>  <!-- END .menu-twirl-left -->
                        <div class="menu-twirl-right"><input type="checkbox" class="menu-twirl-toggle" name="twitter-settings[]" id="toggle_10" {{ isset($twitterSetting) ? ($twitterSetting->toggle_10 === 1) ? 'checked' : '' : ''}}>
                        </div>  <!-- END .menu-twirl-right -->
                    </div>  <!-- END .menu-twirl-option-inner -->

                    @if ($twitterSetting->toggle_10 === 1) 
                        @include('twitterapi-form')
                    @endif 
                </div>  <!-- END .menu-twirl-option-outer -->
                                        
 
            </div>  <!-- END .menu-section-twirl-section-inner -->
        </div>  <!-- END .menu-section-twirl-section-outer -->
    </div>  <!-- END .command-module-inner -->
</div>  <!-- END .command-module-outer -->