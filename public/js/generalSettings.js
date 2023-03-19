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
      id: $('div#quantum-general-settings')[0].id
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      // Handle success
      console.log(response);
      var str = response.data[0];
      var capitalized = str.charAt(0).toUpperCase() + str.slice(1);
      console.log(capitalized);

      $('.subscription-text').text(capitalized + ' Plan');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Handle error
      console.log(jqXHR, textStatus, errorThrown)
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
  console.log(event);  
  var selectedValue = $(this).val();
  console.log("Selected value changed to: " + selectedValue, $(this).data('url'));

    
  $.ajax({
    url: $(this).data('url'),
    method: 'POST',
    data: {
      selected: 1,
      twitter_id: $(this).data('twitterid'),
      id: 'select-account'
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      // Handle success
      $('.menu-account-default').attr('default', '');
      $('span#' + response.twitter_id).attr('default', 'active');
      console.log(response.twitter_id);      

      location.reload();

    },
    error: function(jqXHR, textStatus, errorThrown) {
      // Handle error
      console.log(jqXHR, textStatus, errorThrown)
    }
  });
});


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

$('#twitter-settings-g').click(function(event) {
  
  let currentModal = null;
})


$.fn.hasAttr = function(name) {
  return this.attr(name) !== undefined;
};