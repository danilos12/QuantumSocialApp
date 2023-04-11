$(document).ready(function() {
    var method = $(".queue-inner").attr("data-sched-method");

    $.ajax({
        type: "GET",
        url: APP_URL + "/cmd/" + TWITTER_ID + "/post-type/" + method, // Use the URL of your server-side script here        
        success: function (response) {
            // // Add the existing tag groups to the page
    
            console.log(response);
            // if (response.length > 0) {
            //     $.each(response, function (index, k) {
            //         var img = $("<img>")
            //             .addClass("cross-tweet-profile-image")
            //             .attr("src", k.twitter_photo)
            //             .attr("id", "twitterId-" + k.twitter_id);
    
            //         $(img).appendTo($(".cross-tweet-profiles-inner.cmd"));
            //     });
            // } else {
            //     $(".posting-tool-columns")
            //         .find(".cross-tweet-profiles-outer")
            //         .append("<div>No other twitter accounts linked</div>");
            // }
        },
        error: function (xhr, status, error) {
            console.log(
                "An error occurred while fetching the existing tag groups: " + error
            );
        },
    });

})