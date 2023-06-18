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
  
  $('div#link-twitter').on('click', async function(e) {
    
    try {
      const response = await fetch(APP_URL + '/twitter/redirect/' + QUANTUM_ID);
      const responseData = await response.json();

      console.log(responseData);

      var successDiv = $(`<div class="alert-${responseData.stat}" style="margin-top:0.2em"> ${responseData.message} </div>`);
      if (responseData.status === 200) {
        window.location.href = responseData.redirect;
      } else {
        $(this).parent().after(successDiv);        
        console.log(1);
      } 
    
      // remove the div after 3 seconds
      setTimeout(function() {
        successDiv.remove();
      }, 3000);
    } catch (error) {
      console.log(error);
    }
  })
  
  // modal slider
  // $(document).ready(function() {
  $('input[name="general-settings[]"]').change(async function(event) {
    console.log(event.target.id)
    var isChecked = $(this).is(':checked');
     
    var data = {
      meta_key: event.target.id,
      meta_value: isChecked === true ? 1 : 0,
      user_id: QUANTUM_ID,        
    };

    try {
      const response = await fetch(APP_URL + '/settings?id=general-settings', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
        },
        body: JSON.stringify(data), // Use "body" instead of "data" to send the data
      });

      const responseData = await response.json();
      console.log(responseData);
      if (responseData.status === 200) {

        if (responseData.html === null) {
          $('.twitterapi-account-outer').remove();
        } else {
          $('.twitter-settings-inner').prepend(responseData.html);
        }
        console.log(responseData.message)
      } else {
        console.log(responseData.message)        
      }
    } catch (error) {
      console.log(error)
    }
  });
  // });

  // get general settings twitter
  // $.get(APP_URL + '/twitter/accts', function(response) {
  //   console.log(response);
  //   if (response.length > 0) {
  //     $.each(response, function(index, acct) {
  //       console.log(acct)
  //       twitterLongCard(acct)
  //     })
  //   }
  // })


  $('#twitter_api_saving').on("click", async function(e) {
    e.preventDefault(); // Prevent form submission

    var creds = {
      'api_key' : $('#api_key').val(),
      'api_secret' : $('#api_secret').val(),
      'bearer_token' : $('#bearer_token').val(),
      'oauth_id' : $('#oauth_id').val(),
      'oauth_secret' : $('#oauth_secret').val(),
    }
    
    try {
      const response = await fetch(APP_URL + '/settings/twitter_api_creds/' + QUANTUM_ID, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
          },
          body: JSON.stringify(creds), // Use "body" instead of "data" to send the data
      });
      
      const responseData = await response.json();
      console.log(responseData);

      if (responseData.status) {
        var successDiv = $(`<div class="alert-success"> ${responseData.message} </div>`);
        $(this).after(successDiv);

        // remove the div after 3 seconds
        setTimeout(function() {
          successDiv.remove();
        }, 3000);
      } else {
        var successDiv = $(`<div class="alert-error"> ${responseData.message} </div>`);
        $(this).after(successDiv);

        // remove the div after 3 seconds
        setTimeout(function() {
          successDiv.remove();
        }, 3000);
      }
    } catch (error) {
      console.log(error);
    }
  })
  
  $('#membership').change(async function(event) {
    var selectedValue = $(this).val();
    console.log("Selected value changed to: " + selectedValue);

    try {
      const response = await fetch(APP_URL + '/settings/membership/' + QUANTUM_ID, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
        },
        body: JSON.stringify({ subscription: selectedValue }), // Use "body" instead of "data" to send the data      
      });

      const responseData = await response.json();
      console.log(responseData);

      var successDiv = $(`<div class="alert-${responseData.stat}"> ${responseData.message} </div>`);
      if (responseData.status === 200) {
        var str = responseData.data;
        var capitalized = str.charAt(0).toUpperCase() + str.slice(1);
        $('.subscription-text').text(capitalized + ' Plan');

        $('#quantum_acct').append(successDiv);        
      } else {
        $('#quatum_acct').after(successDiv);
      }
    
      // remove the div after 3 seconds
      setTimeout(function() {
        successDiv.remove();
      }, 3000);
    } catch(error) {
      console.log(error)
    }
  });
  
  $('#timezone-offset').change(async function(event) {
    var selectedValue = $(this).val();
    console.log("Selected value changed to: " + selectedValue);
    
    try {
      const response = await fetch(APP_URL + '/settings/timezone/' + QUANTUM_ID, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
        },
        body: JSON.stringify({ timezone: selectedValue }), // Use "body" instead of "data" to send the data      
      });

      const responseData = await response.json();
      console.log(responseData);
      
      var successDiv = $(`<div class="alert-${responseData.stat}"> ${responseData.message} </div>`);
      if (responseData.status === 200) {
        $('#quantum_acct').append(successDiv);        
      } else {
        $('#quantum_acct').append(successDiv);
      }

      // remove the div after 3 seconds
      setTimeout(function() {
        successDiv.remove();
      }, 3000);
    } catch(error) {
      console.log(error)
    }    
  });
  // Check if there's a stored active button in local storage
  // var activeButtonId = localStorage.getItem('activeButtonId');
  // if (activeButtonId) {
  //   // Activate the stored button
  //   $('.my-button[data-id="' + activeButtonId + '"]').addClass('active');
  // }
  
  
  $('.menu-account-default').click(function(event) {
    var twitterId = event.target.dataset.twitter_id;          
    switchUser(APP_URL + '/twitter/switchUser?id=' + twitterId, twitterId)      
  });
  
  
  $('.delete-account').click(function(event) {  
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
    $('.twitter-settings-outer').show();
  })
  
  function switchUser(url, twitterId) {
    $('.freeze-overlay').show();
    $('body').addClass('freeze');

    $.ajax({
      url,
      method: 'POST',      
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        console.log(response)
        // Handle success in general settings
        $('.menu-account-default').attr('default', '');
        $('span[data-twitter_id="'+ response.twitter_id + '"]').attr('default', 'active');

        // in hamburger
        $('.twitter-account-select-bar').removeClass('active');
        $('.twitter-account-select-bar[data-twitter="twitter-' + response.twitter_id + '"]').addClass('active');          

        setTimeout(function() {
          location.reload();
        }, 3000); // Reload after 5 seconds (adjust the delay as needed)
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle error
        console.log(jqXHR, textStatus, errorThrown)
      },
      complete: function() {
        // Hide the overlay and remove freeze class when the AJAX request is complete
        $('.freeze-overlay').hide();
        $('body').removeClass('freeze');
      }      
    });
  }

  
  $('.profile-twitter-account-item').click(function(e) {
    var $this = $(this)
    var twitterId = $this.parent().parent().data('id');
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
      switchUser(APP_URL + '/twitter/switchUser?id=' + twitterId, twitterId)      
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

   // function twitterLongCard(response) {
  //   return $html = `
  //   <div class="menu-social-account-outer">
  //       <div class="menu-social-account-inner">

  //       <img src="${APP_URL}/public/ui-images/icons/pg-twitter.svg" class="ui-icon menu-account-type-icon" />

  //         <div class="global-twitter-profile-header">
  //           <a href="#">
  //           <img src="${response.twitter_photo}" lass="global-profile-image" /></a>
  //           <div class="global-profile-details">
  //             <div class="global-profile-name">
  //               <a href="#"> ${response.twitter_name} </a>
  //             </div>  <!-- END .global-author-name -->
  //             <div class="global-profile-subdata">
  //               <span class="global-profile-handle">@<a href="">${response.twitter_username}</a>
  //               </span>
  //             </div>  <!-- END .global-post-date-wrap -->
  //           </div>  <!-- END .global-author-details -->
  //         </div>  <!-- END .global-twitter-profile-header -->

  //         <div class="menu-social-account-options">
  //           <span class="menu-account-default" data-twitter_id="${response.twitter_id}" data-toggle="tooltip" title="Set default account." default="${response}"></span>
  //           <span class="menu-account-icons">
  //           <img src="{{ asset('public/')}}/ui-images/icons/00j-twitter-settings.svg" class="ui-icon ui-icon-width" title="Settings" id="twitter-settings" data-icon="twitter-settings" data-toggle="tooltip" />
  //           <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" data-url="{{ route("twitter.remove") }}" data-twitter_id="${response}" id="{{ $acct->twitter_id }}"  class="ui-icon delete-account" title="Delete" data-toggle="tooltip" />
  //           </span>
  //         </div>  <!-- END .menu-social-account-options -->

  //       </div>  <!-- END .menu-social-account-inner -->
  //     </div>  <!-- END .menu-social-account-outer -->
  //     <!-- END .menu-social-account Instance -->     
  //   `
  // }
  
  $.fn.hasAttr = function(name) {
    return this.attr(name) !== undefined;
  };
})