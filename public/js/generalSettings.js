$(document).ready(function() {
  
  
  // add team member modal
  $addTeamIcon = $(".add-team");
  $addTeamModal = $(".add-team-member-inner");
    
  $addTeamIcon.click(function () {
    if ( $addTeamModal.first().is( ":hidden" ) ) {
        $addTeamModal.toggle( "slide", { direction: "up"  }, 800 );
    } else {
        $addTeamModal.toggle( "slide", { direction: "up"  }, 400 );
    }
  });
  
  
  // modal slider
  // $(document).ready(function() {
  $('input[name="general-settings[]"]').change(function(event) {
    console.log(event.target.id)
    var isChecked = $(this).is(':checked');
    console.log(isChecked)
  
    $.ajax({
      url: $('div#general-settings').data('form-url'),
      method: 'POST',
      data: {
        meta_key: event.target.id,
        meta_value: isChecked === true ? 1 : 0,
        user_id: $('div#general-settings').data('userid'),
        id: $('div#general-settings')[0].id
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // Handle success
        console.log(response)
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(textStatus)
      }
    });
  });
  // });
  
  $('#membership').change(function(event) {
    var selectedValue = $(this).val();
    console.log("Selected value changed to: " + selectedValue);
  
    $.ajax({
      url: $('div#quantum-general-settings').data('form-url'),
      method: 'POST',
      data: {
        subscription: selectedValue,
        user_id: $('div#quantum-general-settings').data('userid'),
        id: "quantum-general-settings"
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // Handle success
        console.log(response);         
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(jqXHR, textStatus, errorThrown)
      }, 
      complete: function() {
          var str = response.data[0];
          var capitalized = str.charAt(0).toUpperCase() + str.slice(1);
          $('.subscription-text').text(capitalized + ' Plan');
      }
    });
  });
  
  $('#timezone-offset').change(function(event) {
    var selectedValue = $(this).val();
    console.log("Selected value changed to: " + selectedValue);
  
    $.ajax({
      url: $('div#quantum-general-settings').data('form-url'),
      method: 'POST',
      data: {
        timezone: selectedValue,
        user_id: $('div#quantum-general-settings').data('userid'),
        id: 'timezone'
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // Handle success
        console.log(response);
  
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(jqXHR, textStatus, errorThrown)
      }
    });
  });
  
  // Check if there's a stored active button in local storage
  var activeButtonId = localStorage.getItem('activeButtonId');
  if (activeButtonId) {
    // Activate the stored button
    $('.my-button[data-id="' + activeButtonId + '"]').addClass('active');
  }
  
  
  // $('.menu-account-default').click(function(event) {
  //   console.log(event);  
  //   var selectedValue = $(this).val();
  //   console.log("Selected value changed to: " + selectedValue, $(this).data('url'));
  
      
  //   $.ajax({
  //     url: $(this).data('url'),
  //     method: 'POST',
  //     data: {
  //       selected: 1,
  //       twitter_id: $(this).data('twitterid'),
  //       id: 'select-account'
  //     },
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     success: function(response) {
  //       // Handle success
  //       $('.menu-account-default').attr('default', '');
  //       $('span#' + response.twitter_id).attr('default', 'active');
  //       console.log(response.twitter_id);      
  
  //     },
  //     error: function(jqXHR, textStatus, errorThrown) {
  //       // Handle error
  //       console.log(jqXHR, textStatus, errorThrown)
  //     }, 
  //     complete: function() {
  //       location.reload();
  //     }
  //   });
  // });
  
  
  $('.delete-account').click(function(event) {
    console.log($(this).data('twitterid'));
  
    $.ajax({
      url: $(this).data('url'),
      method: 'POST',
      data: {      
        twitter_id: $(this).data('twitterid'),
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // Handle success
        if (response.deleted === 1) {
          location.reload();
        } else {
          console.log('error')
        }
  
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(jqXHR, textStatus, errorThrown)
      }
    });
  })
  
  $('img.ui-icon[data-icon="twitter-settings"]').on('click',function(event) {

    $('.general-settings-outer').hide();
    // $('.general-settings-outer').toggle( "slide", { direction: "up"  }, 350 );
    // setTimeout(function() {
      //   $(".modal-large-anchor").fadeOut("slow");
    // $('.general-settings-outer').parent(".modal-large-backdrop").fadeOut("slow");
      // }, 175);
    $('.twitter-settings-outer').show();
  })
  
  
  $('.profile-twitter-account-item').click(function() {
    var url = $(this).data('url');
    var hasClass= $(this).hasClass('active');

    if (hasClass) {
      $(this).attr('data-toggle', 'popover')
        .attr('data-placement', 'top')
        .attr('data-trigger', 'focus')
        .popover({
            html: true,
            content: '<span class="selected-popover">Twitter account is selected</span>'
        })
        .popover('show');        
          
    } else {

      console.log(url);
  
      // Extract the last parameter from the URL
      var twitter_id = url.substring(url.lastIndexOf('?') + 1);
  
      $.ajax({
        url: url,
        method: 'POST',
        data: twitter_id,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          // Handle success
          // console.log(response)
          $('.twitter-account-select-bar').removeClass('active');
          $('.twitter-account-select-bar[data-twitter="twitter-' + twitter_id + '"]').addClass('active');          

          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Handle error
          console.log(jqXHR, textStatus, errorThrown)
        },        
      })
    }

    function loadContent(url) {
      var spinner = `<div class="queued-single-post">                      
                      <div class="queued-single-start">                        
                        <span class="queued-post-data" style="color: white; text-weight: bold">
                          Loading...
                        </span>
                      </div>  <!-- END .queue-single-start -->                      

                    </div>`;
      $('.content-inner').html(spinner); // show a spinner while the content is loading

      setTimeout(function(){
        $('.queued-single-post').fadeOut('slow');
      }, 3000);

      $.ajax({
        url: url,
        method: 'GET',
        dataType: 'html',        
        success: function(response) {
          // $('.content-section').html(response); // update the content section with the loaded content
          // console.log(response)
          // $data = json_decode($response, true)
          var parse = JSON.parse(response)          
          $('.content-inner').html(parse.html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $('.content-section').html('<div class="error-message">Error loading content.</div>'); // show an error message if the content fails to load
        }
      });
    }
  

  })
  
  $.fn.hasAttr = function(name) {
    return this.attr(name) !== undefined;
  };
})