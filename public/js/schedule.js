/**
 * Authors: Carlo Ariel Sandig
 * 
*/

$(function() {
	
	$('form.new-slot-form').on('submit', function(event) {
		event.preventDefault();
		const form = $(this).serialize();

		$.ajax({			  
            url: APP_URL + "/schedule/save",
            method: "POST",
            data: form,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                console.log(response);
                $('.new-slot-anchor').attr('style', 'display: none');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.log(jqXHR, textStatus, errorThrown);
            }, 
            complete: function() {

            }     
                  
		})
	});


	
});
