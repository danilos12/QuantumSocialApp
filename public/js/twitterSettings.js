$(document).ready(function() {
  var maxChars = 200;
  // var autoReplyCount = $('.auto-reply-count').text($('.auto-reply-text').val().length);
  $('.auto-reply-text').on('input', function() {
    var charCount = $(this).val().length;
    console.log(charCount);
    $('.auto-reply-count').text(charCount);
    if (charCount > maxChars) {
      $(this).val($(this).val().substr(0, maxChars));
      $('.auto-reply-count').text('');
      $('.auto-reply-limit').text('Maximum ' + maxChars + ' characters reached');
    } else {
      $('.auto-reply-limit').text('/200 remaining');
    }
  });

  async function getTwitterApiAccordion() {
    try {
      const response = await fetch(APP_URL + '/settings/twitter_toggle');
      const responseData = await response.json();

      if (responseData.status === 200) {
        $('.twitter-settings-inner').prepend(responseData.html);
      } else {
        console.log('Twitter API form not fetch');
      }
    } catch (error) {
      console.log(error);
    }
  }

  // Event delegation for dynamically appended toggle
  $('.twitter-settings-inner').on('change', '#toggle_10', function(e) {
    var isChecked = $(this).is(':checked');
    // Perform your actions here
    var op = (isChecked === true) ? 1 : 0;
    twitterAPIForm(op);

  });

  $('.twitter-settings-inner').on('click', '#acct_level_creds', async function(e) {
    var data = {
      api_key: $('#tapi_key').val(),
      api_secret: $('#tapi_secret').val(),
      bearer_token: $('#tbearer_token').val(),
      access_token: $('#taccess_token').val(),
      token_secret: $('#ttoken_secret').val(),
    };
    console.log(data);

    try {
      const response = await fetch(APP_URL + '/settings/twitter_api/save/' + TWITTER_ID, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
        },
        body: JSON.stringify(data), // Use "body" instead of "data" to send the data
      });

      const responseData = await response.json();

      if (responseData.status) {
        var successDiv = $(`<div class="alert-success"> ${responseData.message} </div>`);
        $('.twitter-settings-inner').find('#acct_level_creds').after(successDiv);

        // remove the div after 3 seconds
        setTimeout(function() {
          successDiv.remove();
        }, 3000);
      } else {
        var successDiv = $(`<div class="alert-error"> ${responseData.message} </div>`);
        // $(this).after(successDiv);
        $('.twitter-settings-inner').find('#acct_level_creds').after(successDiv);

        // remove the div after 3 seconds
        setTimeout(function() {
          successDiv.remove();
        }, 3000);
      }

    } catch (error) {
      console.log(error);
    }
  })


  async function twitterAPIForm(isChecked) {
    try {
      const response = await fetch(APP_URL + '/settings/twitter_form?toggle=' + isChecked);
      const responseData = await response.json();

      console.log(responseData);

      if (responseData.toggle === 1) {
        $('.twitterapi-account-inner').find('.menu-twirl-option-outer').append(responseData.html);
        $('.twitterapi-account-inner').find('.menu-twirl-option-text').text(responseData.message);
      } else {
        $('.twitterapi-account-inner').find('.menu-subTwirl-outer').remove();
        $('.twitterapi-account-inner').find('.menu-twirl-option-text').html(responseData.html);
      }
    } catch (error) {
      console.log(error);
    }
  }

  getTwitterApiAccordion();


  // $('.auto-reply-button').on('click', function(event) {

  //   var autoReplytext = $('.auto-reply-text').val();
  //   console.log(autoReplytext);

  //   $.ajax({
  //     url: $('div#twitter-settings').data('form-url'),
  //     method: 'POST',
  //     data: {
  //       meta_key: event.target.id,
  //       meta_value: isChecked === true ? 1 : 0,
  //       twitter_id: $('div#twitter-settings').data('twitterid'),
  //       id: 'twitter-settings'
  //     },
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     success: function(response) {
  //       // Handle success
  //       $('input#' + event.target.id,).attr('default', response.data === 1 ? 'active' : '');
  //     },
  //     error: function(jqXHR, textStatus, errorThrown) {
  //       // Handle error
  //       console.log(jqXHR, textStatus, errorThrown)
  //     }
  //   });
  // })

  $('input[name="twitter-settings[]"]').change(function(event) {
    var isChecked = $(this).is(':checked');
    console.log(1)

    $.ajax({
      url: APP_URL + '/settings?id=twitter-settings',
      method: 'POST',
      data: {
        meta_key: event.target.id,
        meta_value: isChecked === true ? 1 : 0,
        twitter_id: TWITTER_ID,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // Handle success
        console.log(response)
        $('input#' + event.target.id,).attr('default', response.data === 1 ? 'active' : '');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(jqXHR, textStatus, errorThrown)
      }
    });
  });

   // buttons saves
  $('.subTwirl-button').on('click', async function(e) {
    var id = e.target.id;
    // var ajaxData = {};

    if (id === 'auto-reply-button') {
      ajaxData = [
        {key : 'auto_reply_text', value : $('#auto_reply_text').val()}
      ]

    } else if ( id === "thread-ender-button" ) {
      ajaxData = [{
        key : 'text_draft_ender',
        value : $('#text_draft_ender').val(),
      }]

    } else if ( id === "save-evergreen-clHeRetweets" ) {
      ajaxData = [
        { key : 'eg_rt_retweets', value : $('#eg_rt_retweets').val() },
        { key: 'eg_rt_likes', value: $('#eg_rt_likes').val() }
      ];

    } else if ( id === "save-evergreen-rtHeRetweets" ) {
      ajaxData = [
        { key : 'he_rt_retweets', value : $('#he_rt_retweets').val() },
        { key : 'he_rt_likes', value: $('#he_rt_likes').val() },
      ]

    } else if ( id === "save-autoRt" ) {
      ajaxData = [
        { key: 'rt_auto_time' , value : $('#rt_auto_time').val() },
        { key: 'rt_auto_frame' , value : $('#rt_auto_frame').val() },
        { key: 'rt_auto_ite' , value : $('#rt_auto_ite').val() }
      ]

    } else if ( id === "save-rtRm" ) {
      ajaxData = [
        { key : 'rt_auto_rm_time', value : $('#rt_auto_rm_time').val() },
        { key : 'rt_auto_rm_frame', value : $('#rt_auto_rm_frame').val() }
      ]

    } else if ( id === "save-viral-autocm" ) {
      ajaxData = [
        { key: 'text_comment_offer', value : $('#text_comment_offer').val() }
      ]

    } else if ( id === "save-autodm" ) {
      ajaxData = [
        { key : 'text_ender_dm', value : $('#text_ender_dm').val() }
      ]
    }

    try {
      const response = await fetch(APP_URL + '/settings/twitter_meta/' + TWITTER_ID + '?id=' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
        },
        body: JSON.stringify(ajaxData), // Use "body" instead of "data" to send the data
      })

      const responseData = await response.json();

      var successDiv = $(`<div class="alert-${responseData.stat}"> ${responseData.message} </div>`);
      if (responseData.status === 200) {
        $(this).after(successDiv);
      } else {
        $(this).after(successDiv);
      }

       // remove the div after 3 seconds
       setTimeout(function() {
        successDiv.remove();
      }, 3000);
    } catch (error) {
      console.log(error);
    }
  })

  function individualApiForm() {
    var template = `

    <!-- START auto-reply -->
    <div class="menu-subTwirl-outer">
        <div class="subTwirl-header-wrap">
            <span class="subTwirl-header">API Key:</span>
        </div>  <!-- END .subTwirl-header-wrap -->
        <div class="menu-subTwirl-inner">
            <input type="text" class="input-field" id="api_key" value="{{ isset($twitterApi) ? $twitterApi->api_key : ''  }}"/>
        </div>  <!-- END .menu-subTwirl-inner -->
        <div class="subTwirl-header-wrap">
            <span class="subTwirl-header">API Secret:</span>
        </div>  <!-- END .subTwirl-header-wrap -->
        <div class="menu-subTwirl-inner">
            <input type="text" class="input-field" id="api_secret" value="{{ isset($twitterApi) ? $twitterApi->api_secret : ''  }}"/>
        </div>  <!-- END .auto-reply-button -->
        <div class="subTwirl-header-wrap">
            <span class="subTwirl-header">Bearer Token:</span>
        </div>  <!-- END .subTwirl-header-wrap -->
        <div class="menu-subTwirl-inner">
            <input type="text" class="input-field" id="bearer_token" value="{{ isset($twitterApi) ? $twitterApi->bearer_token : ''  }}"/>
        </div>
        <div class="subTwirl-header-wrap">
            <span class="subTwirl-header">OAuth 2.0 Client ID</span>
        </div>  <!-- END .subTwirl-header-wrap -->
        <div class="menu-subTwirl-inner">
            <input type="text" class="input-field" id="oauth_id" value="{{ isset($twitterApi) ? $twitterApi->oauth_id : ''  }}"/>
        </div>
        <div class="subTwirl-header-wrap">
            <span class="subTwirl-header">OAuth 2.0 Client Secret</span>
        </div>  <!-- END .subTwirl-header-wrap -->
        <div class="menu-subTwirl-inner">
            <input type="text" class="input-field" id="oauth_secret" value="{{ isset($twitterApi) ? $twitterApi->oauth_secret : ''  }}"/>

        <div class="subTwirl-button" id="auto-reply-button" style="margin-top: 0.5em; border: transparent">
            Save Auto-reply
        </div>  <!-- END .auto-reply-button -->
    </div>  <!-- END .menu-subTwirl-inner -->
    <!-- END auto-reply -->
    `;

    return template;

  }


// twitter toggle access
  $('input[name="grant-x-access"]').change(async function (e) {
    var targetId = e.target.id;
    var id = targetId.split("-"); // Corrected the split method call
    var isChecked = $(this).is(":checked");
    var t_id = $(this).attr('data-twitter-id');
    var h_id = $(this).attr('datas-xant');
    var trid = $(this).attr('data-trid');

    var data = {
        mid: id[1],
        xaccess: isChecked,
        twitter_id: t_id,
        user_id:h_id,
        twitterids:trid
    };
console.log(data);
    const response = await fetch(
        APP_URL + "/twitter/assignmember",
        {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            body: JSON.stringify(data),
        }
    );

    const responseData = await response.json();

    if (responseData.stat == 'success') {

        toastr[responseData.stat](`Success! ${responseData.message}`);
    }
    if(responseData.stat == 'warning'){
        if(isChecked){
            $('#toggle_x-' + id[1]).prop('checked', false);
        }
        if(!isChecked){
            $('#toggle_x-' + id[1]).prop('checked', true);
        }



        toastr[responseData.stat](`Warning! ${responseData.message}`);

    }
});

});