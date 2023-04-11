// Fetch the existing tag groups when the page loads
$(document).ready(function() {    
    $.ajax({
        type: "GET",
        url: APP_URL + "/tweets/" + TWITTER_ID, // Use the URL of your server-side script here
        beforeSend: function () {
            $("#spinner").show();
        },
        success: function (response) {
            console.log(response.data);
            $(".profileSection").show();
            
            if (response.data.length > 0) {
                var cardSection = $(".profile-posts-inner");
                var numItems = response.data.length;
                 
                $.each(response.data, function (index, value) {     
                    renderProfileCards(cardSection, index, value, numItems);                                  
                });        
            }
        },
        error: function (xhr, status, error) {
            console.log(
                "An error occurred while fetching the tweets: " + error
            );
        },
        complete: function () {
            $("#spinner").hide();
        },
    });
});


function renderProfileCards(cardSection, index, value, numItems) {
    var $cloneTemplate = tweetInstance(numItems);
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

    $cloneTemplate.attr("id", "template-" + index);
    $cloneTemplate.find(".global-profile-name").text(TWITTER_NAME);
    $cloneTemplate.find(".global-post-date").text(formattedDate);
    $cloneTemplate.find(".mosaic-post-text").append(value.text);

    if (value.image) {
        var image = `<img src="${value.image}" alt="tweet image" data-twitter-image="imgId" height="300" width="auto">`;
        $cloneTemplate.find(".mosaic-post-data").append(image);
    }

    cardSection.append($cloneTemplate);
}

function tweetInstance(numItems) {
    var profileImg = (TWITTER_PHOTO !== "") ? TWITTER_PHOTO : APP_URL + "/public/temp-images/imgpsh_fullsize_anim (1).png";    
    return ($template = `
         <div class="mosaic-posts-outer template">
            <div class="mosaic-watermark-wrap frosted">
            <img src="${APP_URL}/public/ui-images/icons/pg-twitter.svg" class="mosaic-watermark" />
            <div class="mosaic-posts-inner">

                <div class="mosaic-post-controls">
                <span class="mosaic-control-icon">
                    <img src="${APP_URL}/public/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
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
                    <div class="mosaic-scheduling mosaic-scheduling-now">

                        <span class="mosaic-label mosaic-now-label">
                        <img src="${APP_URL}/public/ui-images/icons/pg-command.svg" class="ui-icon" />
                        Now
                        </span>
                        <span class="mosaic-sched-buttons mosaic-now-buttons">
                        <img src="${APP_URL}/public/ui-images/icons/pg-heart.svg" class="ui-icon" />
                        <img src="${APP_URL}/public/ui-images/icons/pg-comment.svg" class="ui-icon comment-now-icon" />
                        <img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                        </span>

                    </div>  <!-- END .mosaic-scheduling-now -->

                    <div class="mosaic-scheduling mosaic-scheduling-future">

                        <span class="mosaic-label mosaic-future-label">
                        <img src="${APP_URL}/public/ui-images/icons/04-queue.svg" class="ui-icon" />
                        Schedule
                        </span>
                        <span class="mosaic-sched-buttons mosaic-future-buttons">
                        <img src="${APP_URL}/public/ui-images/icons/pg-comment.svg" class="ui-icon" />
                        <img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                        <img src="${APP_URL}/public/ui-images/icons/16-evergreen.svg" class="ui-icon" />
                        </span>

                    </div>  <!-- END .mosaic-scheduling-future -->

                    <div class="mosaic-scheduling mosaic-post-analytics">

                        <span class="mosaic-label mosaic-analytics-label">
                        <img src="${APP_URL}/ui-images/icons/pg-analytics.svg" class="ui-icon" />
                        Analytics
                        </span>
                        <span class="mosaic-sched-buttons mosaic-analytics-buttons">
                        <img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                        <span class="mosaic-stat stat-retweets">2.20</span>
                        <img src="${APP_URL}/public/ui-images/icons/pg-heart.svg" class="ui-icon" />
                        <span class="mosaic-stat stat-hearts">2010</span>
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
}