$(document).ready(function() {
  $('input[name="twitter-settings[]"]').change(function(event) {
    console.log(event.target.id)
    var isChecked = $(this).is(':checked');
    console.log(isChecked)

    $.ajax({
      url: $('div#twitter-settings').data('form-url'),
      method: 'POST',
      data: {
        meta_key: event.target.id,
        meta_value: isChecked === true ? 1 : 0,
        twitter_id: $('div#twitter-settings').data('twitterid'),
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
});