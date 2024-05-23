// Fetch the existing tag groups when the page loads
$(document).ready(function() {         

    async function fetchTweets() {      

        // show spinner before sending the fetch request
        $("#spinner").show();

        try {
            const response = await fetch(APP_URL + "/twitter/" + TWITTER_ID + "/filter/tweets", {
                method: 'GET',                         
            });
            const responseData = await response.json();              
            
            $(".profileSection").show();
            console.log(responseData);
            if (responseData.status === 200) {

                $("#paginationToken").val(responseData.tweets.original.next_token);
                var cardSection = $(".profile-posts-inner");
                var numItems = 0;
    
                if (responseData.tweets.data.length > 0) {
                    $.each(responseData.tweets.data, function (index, value) {
                        renderProfileCards(cardSection, index, value, numItems);
                        numItems++;
                    });
                } else {
                    $(".profile-posts-inner").text('No tweets found');
                }
            } else {
                $(".page-inner.profile-inner").css('display', 'none');
                $(".profileSection").html(responseData.html)
            }
        } catch (error) {
            console.log("An error occurred while fetching the tweets: " + error);
        } finally {
            $("#spinner").hide();
        }
    }
    
    // Call the async function
    fetchTweets();

   // Bind click event to li elements inside dropdown
    $(".profile-page-dd li").on('click', async function(e) {
        var type = $(this).attr('id');

        try {
            const response = await $.ajax({
                url: APP_URL + "/twitter/" + TWITTER_ID + "/filter/" + type,
                method: "GET", 
                beforeSend: function() {
                    $(".profile-posts-inner").empty();
                }
            });

            if (response.status === 200) {
                var cardSection = $(".profile-posts-inner");
                var numItems = 0;
    
                $.each(response.data, function (index, value) {
                    renderProfileCards(cardSection, index, value, numItems);
                    numItems++;
                });
            }
        }catch (error) {
            console.log(
                "An error occurred while fetching the tweets: " + error
            );
        }
      
    });

    $('#primaryPostTemplate').on('click', 'img.ui-icon', async function(e) {
        var func = e.target.dataset;
        var btnFnction = Object.keys(func).toString();

        switch (btnFnction) {            
            case 'now': 
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
                    }
                });
                   
                try {
                    const response = await $.post(APP_URL + '/twitter/' + TWITTER_ID + '/tweet-now?tweet=' + func.now, function(response) {
                    console.log(response)
                    })
                } catch(error) {
                    console.log(
                        "An error occurred while fetching the tweets: " + error
                    );
                }
                break;
            case 'schedule': 
                break;
            case 'analytics':
                break;        
            case 'twitterlink': 
                window.open(func.twitterlink, '_blank');
                break;
        }
    })      
    
    // $('.lower-area-inner').on('scroll', function() {
    //     var $this = $(this);

    //     // Calculate the sum of scrollTop and clientHeight
    //     var scrollBottom = $this.scrollTop() + $this.innerHeight();

    //     // Check if scrollBottom equals scrollHeight
    //     if (scrollBottom >= $this[0].scrollHeight) {
    //         // You have scrolled to the bottom
    //         console.log("Scrolled to the bottom");
    //         $('.profile-posts-inner').append('<div class="loadMore">Load more tweets...</div>');
    //         loadMoreTweets();

    //     }
    // });

    // Function to load more tweets
    async function loadMoreTweets() {
        // Get the pagination token
        var paginationToken = $('#paginationToken').val();

        try {
            const response = await fetch(APP_URL + "/twitter/" + TWITTER_ID + "/filter/tweets/get-more-tweets?paginationToken=" + paginationToken, {
                method: 'GET',                         
            });
            const responseData = await response.json();  
            $(".profileSection").show();
            // console.log(responseData);
            // console.log(responseData.more_tweets);
            
            if (responseData.status === 200) {

                $("#paginationToken").val(responseData.more_tweets.original.next_token);
                var cardSection = $(".profile-posts-inner");
                var numItems = $(".profile-posts-inner .template").length - 1;
    
                if (responseData.more_tweets.data.length > 0) {
                    console.log(responseData.more_tweets.data.length)
                    $.each(responseData.more_tweets.data, function (index, value) {
                        renderProfileCards(cardSection, index, value, numItems);
                        numItems++;
                    });

                    $('.loadMore').remove();
                } else {
                    $(".profile-posts-inner").text('No tweets found');
                }
            } else {
                $(".profile-posts-inner").text(responseData.message);
            }
        } catch(error) {
            console.error('Error loading more tweets:', error);
        }
      
    }
});


function renderProfileCards(cardSection, index, value, numItems) {
    var $cloneTemplate = tweetInstance(value);
    $cloneTemplate = $($cloneTemplate);
    // $('.mosaic-posts-outer#template').remove();
    
    const date = new Date(value.created_at);

    const formattedDate = new Intl.DateTimeFormat("en-US", {
        hour: "numeric",
        minute: "numeric",
        hour12: true,
        month: "short",
        day: "numeric",
        year: "numeric",
    }).format(date);

    $cloneTemplate.attr("id", "template-" + numItems);
    $cloneTemplate.find(".global-profile-name").text(TWITTER_NAME);
    $cloneTemplate.find(".global-post-date").text(formattedDate);
    $cloneTemplate.find(".mosaic-post-text").append(value.text);

    if (value.image) {
        var image = `<img src="${value.image}" alt="tweet image" data-twitter-image="imgId" height="300" width="auto">`;
        $cloneTemplate.find(".mosaic-post-data").append(image);
    }

    cardSection.append($cloneTemplate);
}

function tweetInstance(value) {
    var profileImg = (TWITTER_PHOTO !== "") ? TWITTER_PHOTO : APP_URL + "/public/temp-images/imgpsh_fullsize_anim (1).png";    
    return ($template = `
         <div class="mosaic-posts-outer template">
            <div class="mosaic-watermark-wrap frosted">                
                <img src="${APP_URL}/public/ui-images/icons/pg-x.svg" class="mosaic-watermark"  />                
            <div class="mosaic-posts-inner">

                <div class="mosaic-post-controls">
                <span class="mosaic-control-icon">
                    <img src="${APP_URL}/public/ui-images/icons/pg-x.svg" class="ui-icon" data-twitterlink="https://twitter.com/${TWITTER_USN}/status/${value.id}" /></span>
                <span class="mosaic-control-icon">
                    <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon" /></span>
                </div>  <!-- END .mosaic-post-controls -->

                <div class="global-twitter-profile-header">
                <a href="#">
                    <img src="${profileImg}" class="global-profile-image" /></a>
                <div class="global-profile-details">
                    <div class="global-profile-name"></div>  <!-- END .global-author-name -->
                    <div class="global-profile-subdata">
                    <img src="${APP_URL}/public/ui-images/icons/pg-time.svg" class="ui-icon" />
                        <span class="global-post-date">
                            
                            <a href="" class="mosaic-post-date">
                            </a>
                        </span>
                    </div>  <!-- END .global-post-date-wrap -->
                </div>  <!-- END .global-author-details -->
                </div>  <!-- END .global-twitter-profile-header -->

                <div class="mosaic-post-data">
                    <div class="mosaic-post-text">
                    </div>  <!-- END .mosaic-post-text -->            
                </div>  <!-- END .mosaic-post-data -->

                <div class="mosaic-post-scheduling" id="cardfunctions">                    

                    <div class="mosaic-scheduling mosaic-post-analytics">
                        
                        <span class="mosaic-label mosaic-analytics-label">
                            <img src="${APP_URL}/public/ui-images/icons/pg-analytics.svg" class="ui-icon" />
                            Analytics
                        </span>
                        <span class="mosaic-sched-buttons mosaic-analytics-buttons">
                            <img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                        <span class="mosaic-stat stat-retweets">${value.public_metrics.retweet_count}</span>
                            <img src="${APP_URL}/public/ui-images/icons/pg-heart.svg" class="ui-icon"/>
                            <span class="mosaic-stat stat-hearts">${value.public_metrics.like_count}</span>
                        </span>

                    </div>  <!-- END .mosaic-post-analytics -->
                </div>  <!-- END .mosaic-post-scheduling -->

            </div>  <!-- END .mosaic-posts-inner -->
            </div>  <!-- END .mosaic-watermark-wrap -->


            <div class="comment-now-modal">
                <div class="comment-now-modal-inner frosted">

                    <form>
                    <textarea></textarea>
                    <input type="submit" class="comment-now-submit" value="Comment Now" />
                    </form>

                </div>  <!-- END .comment-now-modal-inner -->
            </div>  <!-- END .comment-now-modal --> 

        </div>  <!-- END .mosaic-posts-outer -->
        `);


        // var nextToken = null;

        // function getTweets() {
        // var url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
        // var params = {
        //     screen_name: "twitterusername",
        //     count: 10
        // };
        // if (nextToken !== null) {
        //     params.max_id = nextToken;
        // }
        // $.ajax({
        //     url: url,
        //     data: params,
        //     dataType: "json",
        //     success: function(response) {
        //     // Handle the response here
        //     console.log(response);
        //     // Save the next_token parameter for the next request
        //     nextToken = response[response.length-1].id_str;
        //     },
        //     error: function(error) {
        //     console.log(error);
        //     }
        // });
        // }

        // // Call the function to fetch the initial set of tweets
        // getTweets();

        // // Call the function again to fetch the next set of tweets
        // $("#load-more-btn").on("click", function() {
        // getTweets();
        // });        

}