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


  $('.auto-reply-button').on('click', function(event) {

    var autoReplytext = $('.auto-reply-text').val();
    console.log(autoReplytext);

    $.ajax({
      url: $('div#twitter-settings').data('form-url'),
      method: 'POST',
      data: {
        meta_key: event.target.id,
        meta_value: isChecked === true ? 1 : 0,
        twitter_id: $('div#twitter-settings').data('twitterid'),
        id: 'twitter-settings'
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // Handle success        
        $('input#' + event.target.id,).attr('default', response.data === 1 ? 'active' : '');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(jqXHR, textStatus, errorThrown)
      }
    });
  })

  $('input[name="twitter-settings[]"]').change(function(event) {
    var isChecked = $(this).is(':checked');

    $.ajax({
      url: $('div#twitter-settings').data('form-url'),
      method: 'POST',
      data: {
        meta_key: event.target.id,
        meta_value: isChecked === true ? 1 : 0,
        twitter_id: $('div#twitter-settings').data('twitterid'),
        id: 'twitter-settings'
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // Handle success        
        $('input#' + event.target.id,).attr('default', response.data === 1 ? 'active' : '');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(jqXHR, textStatus, errorThrown)
      }
    });
  });

   // buttons saves
  $('.subTwirl-button').on('click', function(e) {
    var id = e.target.id;
    var twitterId = $('div#twitter-settings').data('twitterid');
    var ajaxData = {};

    if (id === 'auto-reply-button') {
      ajaxData = {
        value : $('#auto-reply-text').val(),
        id : id,
        twitterId : twitterId,
      }
      
    } else if ( id === "thread-ender-button" ) {
      ajaxData = {
        value : $('#text-dft-ender').val(),
        id : id,
        twitterId : twitterId,
      }
      
    } else if ( id === "save-evergreen-clHeRetweets" ) {
      ajaxData = {        
        retweet : $('#eg_rt_retweets').val(),
        likes : $('#eg_rt_likes').val(),
        id : id,
        twitterId : twitterId,
      }
      
    } else if ( id === "save-evergreen-rtHeRetweets" ) {
      ajaxData = {        
        retweet : $('#he_rt_retweets').val(),
        likes : $('#he_rt_likes').val(),
        id : id,
        twitterId : twitterId,
      }
      
    } else if ( id === "save-autoRt" ) {
      ajaxData = {        
        time : $('#rt_auto_time').val(),
        frame : $('#rt_auto_frame').val(),
        ite : $('#rt_auto_ite').val(),
        id : id,
        twitterId : twitterId,
      }
      
    } else if ( id === "save-rtRm" ) {
      ajaxData = {        
        time : $('#rt_auto_rm_time').val(),
        frame : $('#rt_auto_rm_frame').val(),        
        id : id,
        twitterId : twitterId,
      }
      
    } else if ( id === "save-viral-autocm" ) {
      ajaxData = {
        value : $('#text_comment_offer').val(),
        id : id,
        twitterId : twitterId,
      }
      
    } else if ( id === "save-autodm" ) {
      ajaxData = {
        value : $('#text_ender_dm').val(),
        id : id,
        twitterId : twitterId,
      }      
    }
    
    console.log(ajaxData);
    // make AJAX request with dynamic data
    $.ajax({
        url: $('div#twitter-settings').data('form-url'),
        method: 'POST',
        data: ajaxData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          // handle response
          var successDiv = $(`<div> ${response.data} </div>`);
          $('#' + id).after(successDiv);

          // remove the div after 3 seconds
          setTimeout(function() {
            successDiv.remove();
          }, 3000);
        },
        error: function(xhr, status, error) {
            // handle error
            console.log(xhr, status, error)
        }
    });
  })
 
});