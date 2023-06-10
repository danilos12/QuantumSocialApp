$(document).ready(function() {    
    var method = $(".page-inner").attr("data-sched-method");

    $.ajax({
        type: "GET",
        url: APP_URL + "/cmd/" + TWITTER_ID + "/post-type/" + method, // Use the URL of your server-side script here        
        success: function (response) {
            console.log(response);
            if (response.length > 0) {                
                // var details = fetchTwitterDetails(TWITTER_ID);

                $.each(response, function (index, k) {
                    console.log(k)
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

    
    $(document).on('click', 'img#edit-commandmodule', function(event) {
        $target = event.target.dataset.id;  
        closeModal($target);
        $('.modal-large-anchor div.edit-commandmodule-outer').remove();
        $('.ui-effects-placeholder').remove();
    })
      

    $('.queue-months-dropdown').on('click', 'li', async function(e) {
        $month = e.target.id;
        var url = APP_URL + '/post/sortbymonth?id=' + TWITTER_ID + '&month=' + $month

        try {
            const response = await fetch(url);
            const responseData = await response.json();
    
            $('.queue-day-wrapper').empty();
            if (responseData.data.length > 0) {                
                // var details = fetchTwitterDetails(TWITTER_ID);
                $.each(response.data, function (index, k) {
                    var postType = getPostType(k.post_type);
                    var wrapper = postWrapper(k, postType, index);                    
    
                    $('.queue-day-wrapper').append(wrapper);
                });
            } else {
                $(".queue-day-wrapper").html("<div>No post found</div>");
            } 
        } catch (error) {
            console.log("Failed to fetch data:", error);
        }         
    })
  
    $('ul.queue-page-dd').on('click', 'li', async function(e) {
        var type = this.id;
        var url = APP_URL + '/post/sortbytype?id=' + TWITTER_ID + '&type=' + type;
    
        try {
            const response = await fetch(url);
            const responseData = await response.json();
    
            $('.queue-day-wrapper').empty();
            if (responseData.data.length > 0) {
                // var details = await fetchTwitterDetails(TWITTER_ID);
    
                $.each(responseData.data, function (index, k) {
                    var postType = getPostType(k.post_type);
                    var wrapper = postWrapper(k, postType, index);
    
                    $('.queue-day-wrapper').append(wrapper);
                });
            } else {
                $(".queue-day-wrapper").html("<div>No post found</div>");
            }
        } catch (error) {
            console.log("Failed to fetch data:", error);
        }
    });

    $('.queue-day-wrapper').on("click", 'img.queued-icon', async function(e) {
        var id = e.target.id;
        var rmId = id.split('-');
    
        switch (rmId[0]) {
            case "edit":
                $('#mode').val('edit');        
                $('#item-id').val(id);
                
                try {
                    const response = await fetch(APP_URL + '/post/edit/' + id);
                    const data = await response.json();

                    // watermark
                    $('.modal-large-backdrop').append(data.html);
                    
                    $('.edit-commandmodule-outer').addClass('edit-commandmodule-' + data.data.id + '-outer')
                    $('.edit-commandmodule-outer').find('.modal-large-close').attr('data-id','edit-commandmodule-' + data.data.id)
                    // $('.edit-commandmodule-outer').find('.modal-large-close').attr('edit-commandmodule-')
                    if (data.data.post_type === "regular-tweets") {
                        $('.edit-commandmodule-outer').find(`#posting-tool-form-002 img.ui-icon[data-src="twitter-tweets"]`).addClass('indicator-active');
                    } else {
                        $('.edit-commandmodule-outer').find(`#posting-tool-form-002 img.ui-icon[data-src="${data.data.post_type}"]`).addClass('indicator-active');
                    }
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002 textarea`).text(data.data.post_description);
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002 span>img.ui-icon[data-type="${data.data.post_type}"]`).addClass('icon-active');
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002 select#scheduling-options option[value="${data.data.sched_method}"]`).attr('selected', true);
                    
                    openModal("edit-commandmodule-" + data.data.id);
                } catch (error) {
                    console.log(error);
                }
                break;
            
            case "delete":
                try {
                    const response = await fetch(APP_URL + '/post/delete', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
                        },
                        body: JSON.stringify({ id: id }),
                    });
                    
                    const data = await response.json();
                    console.log(data);
                    
                    if (data.success) {
                        alert('Record deleted successfully!');
                        location.reload();
                    }
                } catch (error) {
                    console.log("Failed to delete data");
                }
                break;
            
            case "more":
                $addTeamModal = $(".view-" + rmId[1]);           
                openViewMore($addTeamModal);
                
                $addTeamModal.on('click', 'span', function(e) {
                    $spanId = e.target.id; 
                    $spanIdsplit = $spanId.split('-');
                    switch ($spanIdsplit[0]) {
                        case 'post':
                            console.log($spanIdsplit);
                            postTweetNow($spanId);
                            break;
                        
                        case 'duplicate':
                            duplicatePostNow($spanId);
                            break;
                        
                        case 'move':
                            movePostToTop($spanId)
                            break;                                                
                    }
                });
                break;
            
            default:
                break;
        }
    });
    
    $('#queue-post-status').on('click', async function(e) {
        var isChecked = $(this).is(':checked');
        var url = APP_URL + '/post/' + ((isChecked) ? 'active' : 'inactive') + '/' + TWITTER_ID;

        try {                        
            const response = await fetch(url,  {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            const responseData = await response.json();
            console.log(responseData);

            $('.queue-day-wrapper').empty();
            if (responseData.data.length > 0) {
                // var details = await fetchTwitterDetails(TWITTER_ID);
    
                $.each(responseData.data, function (index, k) {
                    var postType = getPostType(k.post_type);
                    var wrapper = postWrapper(k, postType, index);
    
                    $('.queue-day-wrapper').append(wrapper);
                });
            } else {
                $(".queue-day-wrapper").html("<div>No post found</div>");
            }
            
        } catch (error) {
            console.log("Failed to fetch data:", error);
        }
    })

    async function movePostToTop(id) {
        try {
            const response = await fetch(APP_URL + '/cmd/post/move-to-top/' + id + '?twitter_id=' + TWITTER_ID, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            const data = await response.json();
            console.log(data);
    
            if (data.status === 200) {
                alert(data.message);
                location.reload();
            }
        } catch (error) {
            console.log(error);
        }
    }
   
    async function postTweetNow(id) {
        try {
            const response = await fetch(APP_URL + '/cmd/post/tweet-now/' + id + '?twitter_id=' + TWITTER_ID, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            const data = await response.json();
            console.log(data);
    
            if (data.status === 200) {
                alert(data.message);
                location.reload();
            }
        } catch (error) {
            console.log(error);
        }
    }
    
    async function duplicatePostNow(id) {
        try {
            const response = await fetch(APP_URL + '/cmd/post/duplicate-now/' + id + '?twitter_id=' + TWITTER_ID, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            const data = await response.json();
            console.log(data);
            console.log(data.message);
            console.log(1);
    
            if (data.status === 200) {
                alert(data.message);
                location.reload();
            }
        } catch (error) {
            console.log(error);
        }
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
                        ${info.post_type_code + ": " +info.sched_method + ": " + info.post_description}
                        <!--info.post_description.substring(0, 17) + "..." -->
                        </span>
                    </div>  <!-- END .queue-single-start -->

                    <div class="queued-single-end">
                        <img src="${APP_URL}/public/ui-images/icons/pg-dots.svg" class="ui-icon queued-icon queued-options-icon queued-icon-ee" id="more-${info.id}" title="More" data-toggle="tooltip" />
                        <img src="${APP_URL}/public/ui-images/icons/pg-view.svg" class="ui-icon queued-icon queued-view-icon queued-icon-ee" id="view-${info.id}" title="View" data-toggle="tooltip" />
                        <img src="${APP_URL}/public/ui-images/icons/05-drafts.svg" class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit-modal-${info.id}" title="Drafts" data-toggle="tooltip" />                        
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