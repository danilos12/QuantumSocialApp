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
  
  
  $('.menu-account-default').click(function(event) {
    var twitterId = event.target.dataset.twitter_id;  
    console.log(twitterId);
    // console.log(twitterId);
        
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
    // $('.general-settings-outer').toggle( "slide", { direction: "up"  }, 350 );
    // setTimeout(function() {
      //   $(".modal-large-anchor").fadeOut("slow");
    // $('.general-settings-outer').parent(".modal-large-backdrop").fadeOut("slow");
      // }, 175);
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
      // console.log(twitter_id)
      // $.ajax({
      //   url: APP_URL + '/twitter/switchUser?id=' + twitter_id,
      //   method: 'POST',
      //   headers: {
      //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   },
      //   success: function(response) {
      //     // Handle success
      //     // console.log(response)
      //     $('.twitter-account-select-bar').removeClass('active');
      //     $('.twitter-account-select-bar[data-twitter="twitter-' + twitter_id + '"]').addClass('active');          

      //     location.reload();
      //   },
      //   error: function(jqXHR, textStatus, errorThrown) {
      //     // Handle error
      //     console.log(jqXHR, textStatus, errorThrown)
      //   },        
      // })
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
  
  $.fn.hasAttr = function(name) {
    return this.attr(name) !== undefined;
  };
})