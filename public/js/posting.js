$(document).ready(function() {
    var method = $(".queue-inner").attr("data-sched-method");

    $.ajax({
        type: "GET",
        url: APP_URL + "/cmd/" + TWITTER_ID + "/post-type/" + method, // Use the URL of your server-side script here        
        success: function (response) {
            if (response.length > 0) {                
                // var details = fetchTwitterDetails(TWITTER_ID);

                $.each(response, function (index, k) {
                    var postType = getPostType(k.post_type);
                    var wrapper = postWrapper(k, postType, index);                    

                    $('.queue-day-wrapper').append(wrapper);
                });
            } else {
                $(".queue-day-wrapper").html("<div>No post found</div>");
            }
        },
        error: function (xhr, status, error) {
            console.log(
                "An error occurred while fetching the existing tag groups: " + error
            );
        },
    });

    $.get(APP_URL + '/post/getmonth?id=' + TWITTER_ID, function(response) {               
        $.each(response.data, function(index, month) {
            var li = $('<li>');                
            
            if (month !== null) {                
                var updatedId = month.toLowerCase().replace(' ', '-');
                li.attr('id', updatedId);
                li.html(`<img src="${APP_URL}/public/ui-images/icons/07-schedule.svg" class="ui-icon" />${month}`)
                $('.queue-months-dropdown').append(li);
            }            
        })         
    }).fail(function(xhr, error) {
        console.log(
            "An error occurred while fetching the existing tag groups: " + error
        );
    });   

    $('.queue-months-dropdown').on('click', 'li', function(e) {
        $month = e.target.id;
        var url = APP_URL + '/post/sortbymonth?id=' + TWITTER_ID + '&month=' + $month

        // history.pushState(null, null, url);
        
        $.get(url, function(response) {
            $('.queue-day-wrapper').empty();
            if (response.data.length > 0) {                
                // var details = fetchTwitterDetails(TWITTER_ID);
                $.each(response.data, function (index, k) {
                    var postType = getPostType(k.post_type);
                    var wrapper = postWrapper(k, postType, index);                    

                    $('.queue-day-wrapper').append(wrapper);
                });
            } else {
                $(".queue-day-wrapper").html("<div>No post found</div>");
            } 
        }).fail(function(xhr, error) {
            console.log(
                "An error occurred while posts: " + error
            );
        }); 
    })
  
    $('ul.queue-page-dd').on('click', 'li', function(e) {
        var type = this.id;
        var url = APP_URL + '/post/sortbytype?id=' + TWITTER_ID + '&type=' + type;

        $.get(url, function(response) {
            // console.log(response.data)
            $('.queue-day-wrapper').empty();
            if (response.data.length > 0) {                
                // var details = fetchTwitterDetails(TWITTER_ID);

                $.each(response.data, function (index, k) {
                    var postType = getPostType(k.post_type);
                    var wrapper = postWrapper(k, postType, index);                    

                    $('.queue-day-wrapper').append(wrapper);
                });
            } else {
                $(".queue-day-wrapper").html("<div>No post found</div>");
            }

        }).fail(function(xhr, status, error) {
            console.log("Failed to delele data");
        })
    }) 

    $('.queue-day-wrapper').on("click", 'img.queued-icon', async function(e) {
        var id = e.target.id;
        var rmId = id.split('-');
        console.log(rmId);

        if (rmId[0] === "edit" ) {
            console.log('edit')
            getCmdModule(rmId[1])           

        } 
        else if (rmId[0] === "delete")
        {
            $.post(APP_URL + '/post/delete', {id : id, _token : $('meta[name="csrf-token"]').attr("content")}, function(response) {
                console.log(response)
                // Handle the response
                if (response.success) {
                    // Display the flash message
                    alert('Record deleted successfully!');
                    
                    // Optionally, you can reload the page or perform any other action
                    location.reload();
                }
            }).fail(function() {
                console.log("Failed to delele data");
            })
        } else if (rmId[0] === "more") {

            $addTeamModal = $(".view-" + rmId[1]);           
            openViewMore($addTeamModal);

            $addTeamModal.on('click', 'span', function(e) {
                $spanId = e.target.id; 
                $spanIdsplit = $spanId.split('-');

                if ($spanIdsplit[0] === 'post') {
                    console.log($spanIdsplit);
                    postTweetNow($spanId);
                } else if ($spanIdsplit[0] === 'duplicate') {
                    duplicatePostNow($spanId)
                } else if ($spanIdsplit[0] === 'move') {
                    console.log(1)
                }
            })
        }

        // var func = e.target.dataset.func;        
        // openModal(func);
        // getCmdModule(id);          
    })
   
    function postTweetNow(id) {        
        $.post({
            url: APP_URL + '/cmd/post/tweet-now/' + id + '?twitter_id=' + TWITTER_ID, 
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                console.log(response)
                if (response.success === true) {
                    alert(response.message);
                    location.reload();
                }
                
            }        
        });
    }
    
    function duplicatePostNow(id) {        
        $.post({
            url: APP_URL + '/cmd/post/duplicate-now/' + id + '?twitter_id=' + TWITTER_ID, 
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                console.log(response)
                if (response.success === true) {
                    alert(response.message);                    
                    location.reload();
                }
                
            }        
        });
    }
    
    function openViewMore(element) {
        if (element.first().is( ":hidden" ) ) {
            element.toggle( "slide", { direction: "up"  }, 800 );
        } else {
            element.toggle( "slide", { direction: "up"  }, 400 );
        }
    }

    function getCmdModule(id) {        
        $('#mode').val('edit');        
        $('#item-id').val(id);

        $.get(APP_URL + '/queue/edit/' + id, function(response) {
            console.log(response.data)

            $.each(response.data, function(index, x) {
                console.log(index, x)
                $('.primary-post-area-wrap textarea').val(x.post_description);
                $(".scheduling-options option[value='" + x.sched_method + "']").prop("selected", true);
            })

            $('.command-module-outer').attr('style', 'display:block');
            $('.modal-large-anchor').attr('style', 'display:block');
        });        
    }

    let currentModal = null; 
    // Open modal
    function openModal(modalId) {  
        $(`.${currentModal}-outer`).toggle( "slide", { direction: "up"  }, 350 );

        $modalLargeAnchor.show();
        // Open the requested modal
        const modal = document.getElementById(modalId);
        modal.style.display = 'block';

        setTimeout(function() {
            $modalLargeBackdrop.fadeIn("slow");
        }, 20);
        setTimeout(function() {
            $(`.${modalId}-outer`).toggle( "slide", { direction: "up"  }, 700 );
        }, 225);
        
        // Keep track of the current modal
        currentModal = modalId;
    }


    function postWrapper(info, post_type, index) {        
        const dateTimeString = info.sched_time;
        const dateTime = new Date(dateTimeString);
        const month = dateTime.toLocaleString('default', { month: 'short' });
        const day = dateTime.getDate();
        const year = dateTime.getFullYear();
        const timeString = dateTime.toLocaleTimeString();
        const fullDate = month + " " + day + ", " + year;

        // var data = fetchTwitterDetails(info.twitter_id);        
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
                        <img src="${APP_URL}/public/ui-images/icons/pg-dots.svg" class="ui-icon queued-icon queued-options-icon queued-icon-ee" id="more-${info.id}" title="More" data-toggle="tooltip" />
                        <img src="${APP_URL}/public/ui-images/icons/pg-view.svg" class="ui-icon queued-icon queued-view-icon queued-icon-ee" id="view-${info.id}" title="View" data-toggle="tooltip" />
                        <img src="${APP_URL}/public/ui-images/icons/05-drafts.svg" class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-func="command-module" id="edit-${info.id}" title="Drafts" data-toggle="tooltip" />                        
                        <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon queued-icon queued-trash-icon queued-icon-imp" id="delete-${info.id}" title="Delete" data-toggle="tooltip" />
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
                                <img src="${APP_URL}/public/ui-images/icons/pg-time.svg" class="ui-icon" />
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
                            <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                class="mosaic-post-image" />
                            </div>  <!-- END .mosaic-post-data -->

                        </div>  <!-- END .mosaic-posts-inner -->
                        </div>  <!-- END .mosaic-watermark-wrap -->
                    </div>  <!-- END .mosaic-posts-outer -->
                    <!-- END Queued Preview Instance -->

                </div>  <!-- END .queued-preview-wrapper -->

                <div class="queued-options-wrapper frosted view-more view-${info.id}">
                    <div class="queued-options-inner view-more-inner">
                        <span class="queued-option-item" id="post-now-${info.id}">Post Now</span>
                        <span class="queued-option-item" id="duplicate-now-${info.id}">Duplicate Post</span>
                        <span class="queued-option-item" id="move-top-${info.id}">Move to Top</span>
                    </div>  <!-- END .queued-options-inner -->
                </div>  <!-- END .queued-options-wrapper -->
                <!-- END Custom Queued Post Instance -->                                    
        `
    }       
 
    function getPostType(type) {
        var postType;

        switch(type) {
            case "regular-tweets":
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
            default: 
                postType = "custom";
                break;            
        }

        return postType;
    }

})