$(document).ready(function() {
    var method = $(".queue-inner").attr("data-sched-method");

    $.ajax({
        type: "GET",
        url: APP_URL + "/cmd/" + TWITTER_ID + "/post-type/" + method, // Use the URL of your server-side script here        
        success: function (response) {
            if (response.length > 0) {                
                // var details = fetchTwitterDetails(TWITTER_ID);

                $.each(response, function (index, k) {
                    console.log(k.sched_method)
                    var postType = getPostType(k.post_type);
                    var wrapper = postWrapper(k, postType);                    

                    $('.queue-day-wrapper').append(wrapper);
                });
            } else {
                $(".queue-day-wrapper").html("<div>No other twitter accounts linked</div>");
            }
        },
        error: function (xhr, status, error) {
            console.log(
                "An error occurred while fetching the existing tag groups: " + error
            );
        },
    });

    $('.queue-page-dd li').on('click', function(e) {
        console.log($(this));
    }) 

    function postWrapper(info, post_type) {        
        const dateTimeString = info.created_at;
        const dateTime = new Date(dateTimeString);
        const month = dateTime.toLocaleString('default', { month: 'long' });
        const day = dateTime.getDate();
        const year = dateTime.getFullYear();
        const timeString = dateTime.toLocaleTimeString();
        const fullDate = month + ", " + day + " " + year;

        // var data = fetchTwitterDetails(info.twitter_id);
        // console.log(data)
        return $wrapper = `                          
                <!-- BEGIN Custom Queued Post Instance (CUSTOM) --> 
                <div class="queued-single-post-wrapper queue-type-${post_type}" status="active" queue-type="${post_type}">
                    <div class="queued-single-post"> 

                    <img src="${APP_URL}/public/ui-images/icon2/pg-${post_type}.svg" class="queued-watermark" />

                    <div class="queued-single-start">
                        <span class="queued-post-time">
                        ${fullDate + " " + timeString}
                        </span>
                        <span class="queued-post-data">
                        ${info.sched_method + ": " + info.post_description}
                        <!--info.post_description.substring(0, 17) + "..." -->
                        </span>
                    </div>  <!-- END .queue-single-start -->

                    <div class="queued-single-end">
                        <img src="${APP_URL}/public/ui-images/icons/pg-dots.svg" class="ui-icon queued-icon queued-options-icon" />
                        <img src="${APP_URL}/public/ui-images/icons/pg-view.svg" class="ui-icon queued-icon queued-view-icon" />
                        <img src="${APP_URL}/public/ui-images/icons/05-drafts.svg" class="ui-icon queued-icon queued-edit-icon" />
                        <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon queued-icon queued-trash-icon" />
                    </div>  <!-- END .queued-single-end -->

                    </div>  <!-- END .queued-single-post -->

                    <div class="queued-preview-wrapper">
                    <!-- BEGIN Queued Preview Instance -->
                    <div class="mosaic-posts-outer">
                        <div class="mosaic-watermark-wrap frosted">
                        {{-- // image depends on post type --}}
                        <img src="${APP_URL}/public/ui-images/icons/pg-twitter.svg" class="mosaic-watermark" />
                        <div class="mosaic-posts-inner">

                            <div class="global-twitter-profile-header">
                            <a href="#">
                                {{-- // tweet image --}}
                                <img src="${APP_URL}/public/temp-images/imgpsh_fullsize_anim (1).png"
                                class="global-profile-image" /></a>
                            <div class="global-profile-details">
                                <div class="global-profile-name">
                                <a href="#">
                                    {{-- tweet nmame --}}
                                    William Wallace
                                </a>
                                </div>  <!-- END .global-author-name -->
                                <div class="global-profile-subdata">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon" />
                                <span class="global-post-date">
                                    <a href="">
                                    {{-- tweet created and time --}}
                                    Dec. 16, 2022 @ 5:20 p.m.</a></span>
                                </div>  <!-- END .global-post-date-wrap -->
                            </div>  <!-- END .global-author-details -->
                            </div>  <!-- END .global-twitter-profile-header -->

                            <div class="mosaic-post-data">
                            <div class="mosaic-post-text">
                                {{-- tweet descrioption --}}
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                            </div>  <!-- END .mosaic-post-text -->
                            <img src="{{ asset('public/')}}/https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                class="mosaic-post-image" />
                            </div>  <!-- END .mosaic-post-data -->

                        </div>  <!-- END .mosaic-posts-inner -->
                        </div>  <!-- END .mosaic-watermark-wrap -->
                    </div>  <!-- END .mosaic-posts-outer -->
                    <!-- END Queued Preview Instance -->

                    </div>  <!-- END .queued-preview-wrapper -->

                    <div class="queued-options-wrapper frosted">
                    <div class="queued-options-inner">
                        <span class="queued-option-item">
                        Schedule Post</span>
                        <span class="queued-option-item">
                        Duplicate Post</span>
                        <span class="queued-option-item">
                        Post Now</span>
                    </div>  <!-- END .queued-options-inner -->
                    </div>  <!-- END .queued-options-wrapper -->

                </div>  <!-- END .queued-single-post-wrapper -->
                <!-- END Custom Queued Post Instance -->                        

            
        `
    }
 
    function fetchTwitterDetails(twitterId) {
        $.ajax({
            type: "GET",
            url: "/twitter/details/" + twitterId,
            success: function(response) {
                console.log(response);
                // process the response here
                },
            error: function(error) {
            console.log(error);
            }
        });
    };

    function getPostType(type) {
        var postType;

        switch(type) {
            case "regular_tweets":
                postType = "custom";
                break;
            case "evergreen-tweets":
                postType = "evergreen";
                break;
            case "promos-tweets":
                postType = "promo";
                break;
            case "retweet-tweets":
                postType = "retweet";
                break;
            case "comments-tweets":
                postType = "promo";
                break;
            case "tweet-storm-tweets":
                postType = "storm";
                break;
            // Add more cases as needed for other types
            default:
            postType = "empty";
        }

        return postType;
    }

})