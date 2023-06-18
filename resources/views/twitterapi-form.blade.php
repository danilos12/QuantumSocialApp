<div class="menu-subTwirl-outer">
    <div class="subTwirl-header-wrap">
        <span class="subTwirl-header">Twitter API Key:</span>
    </div>  <!-- END .subTwirl-header-wrap -->
    <div class="menu-subTwirl-inner">
        <input type="text" class="input-field" id="tapi_key" value="{{ isset($individualTwitterApi) ? $individualTwitterApi->api_key : ''  }}"/>                                                                                     
    </div>  <!-- END .menu-subTwirl-inner -->
    <div class="subTwirl-header-wrap">
        <span class="subTwirl-header">Twitter API Secret:</span>
    </div>  <!-- END .subTwirl-header-wrap -->
    <div class="menu-subTwirl-inner">
        <input type="text" class="input-field" id="tapi_secret" value="{{ isset($individualTwitterApi) ? $individualTwitterApi->api_secret  : ''  }}"/>                                                                                      
    </div>  <!-- END .auto-reply-button -->
    <div class="subTwirl-header-wrap">
        <span class="subTwirl-header">Twitter Bearer Token:</span>
    </div>  <!-- END .subTwirl-header-wrap -->
    <div class="menu-subTwirl-inner">
        <input type="text" class="input-field" id="tbearer_token" value="{{ isset($individualTwitterApi) ? $individualTwitterApi->bearer_token : ''  }}"/> 
    </div>                     
    <div class="subTwirl-header-wrap">
        <span class="subTwirl-header">Twitter Access Token</span>
    </div>  <!-- END .subTwirl-header-wrap -->
    <div class="menu-subTwirl-inner">
        <input type="text" class="input-field" id="taccess_token" value="{{ isset($individualTwitterApi) ? $individualTwitterApi->access_token  : ''  }}"/>                      
    </div>
    <div class="subTwirl-header-wrap">
        <span class="subTwirl-header">Twitter Access Secret</span>
    </div>  <!-- END .subTwirl-header-wrap -->
    <div class="menu-subTwirl-inner">
        <input type="text" class="input-field" id="ttoken_secret" value="{{ isset($individualTwitterApi) ? $individualTwitterApi->token_secret  : ''  }}"/>                      
    
    <div class="subTwirl-button" id="acct_level_creds" style="margin-top: 0.5em; border: transparent">
        Save Account Level API
    </div>  <!-- END .auto-reply-button -->
</div>  <!-- END .menu-subTwirl-inner -->