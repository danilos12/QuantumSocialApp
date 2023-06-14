$(document).ready(function() {
  var maxChars = 200;
  var autoReplyCount = $('.auto-reply-count').text($('.auto-reply-text').val().length);
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
 
});