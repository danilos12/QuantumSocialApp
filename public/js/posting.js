// Function to get URL parameters as an object
function getUrlParameters() {
    const urlParams = new URLSearchParams(window.location.search);
    const params = {};

    urlParams.forEach((value, key) => {
    params[key] = value;
    });

    return params;
}

$(document).ready(function() {     
    // Parse the query string of the URL
    var method = $(".page-inner").attr("data-sched-method");          
    var data = []; // Initialize an empty array to store all the posts
    var currentPage = 1; // Start with the first page
    var postsPerPage = 40; // Number of posts to retrieve per scroll event
    var initialDataLoaded = false; // Flag to track if the initial data has been loaded

    const params = getUrlParameters();
    async function fetchData() {
        try {   
            
            var param = (Object.keys(params).length > 0) 
                            ? (params.category === 'type' ) 
                                ? '?id=' + TWITTER_ID + '&category=' + params.category + '&type=' + params.type  // source
                                :  '?id=' + TWITTER_ID + '&category=' + params.category +  '&type=' + params.type // month
                            : '?' ;

                            console.log(params)

            const response = await fetch(APP_URL + '/cmd/' + TWITTER_ID + '/post-type/' + method + param);
            const responseData = await response.json();    


            switch (method) {
                case 'queue':          
                                
                    // Assuming the response data is an array of posts
                    data = responseData; // Add the new posts to the existing array

                    if (data.length > 0) {
                        // Check if the initial data has been loaded
                        if (!initialDataLoaded) {
                            // Call the function to append the initial set of posts
                            appendPosts(0, postsPerPage);
                            initialDataLoaded = true; // Set the flag to indicate initial data is loaded
                        }
                    } else {
                        $(".queue-day-wrapper").html("<div>No post found</div>");
                    }

                    break; 

                case 'evergreen':                    
                    if (responseData.length > 0) {
                        $.each(responseData, (index, k) => {
                            const wrapper = postWrapperEvergreen(k);
    
                            $('.queued-posts-inner').append(wrapper)                            
                        })   
                    } else {
                        $('.queued-posts-inner').append("<div> No evergreen posts found.</div>")
                    }
                    break

                case 'promo': 
                    if (responseData.length > 0) {
                        $.each(responseData, (index, k) => {
                            const wrapper = postWrapperPromo(k);

                            $('.queued-posts-inner').append(wrapper)                       
                        })   
                    } else {
                        $('.queued-posts-inner').append("<div> No promo posts found.</div>")
                    }
                    break;
                
                case 'posted' :
                    if (responseData.length > 0) {
                        $.each(responseData, (index, k) => {
                            const postType = getPostType(k.post_type);
                            const wrapper = postWrapper(k, postType);

                            $('.queue-day-wrapper').append(wrapper);                  
                        })   
                    } else {
                        $(".queue-day-wrapper").html("<div>No post were posted yet</div>");
                    }
                    break;
                case 'save-draft': 
                    if (responseData.length > 0) {
                        $.each(responseData, (index, k) => {
                            const postType = getPostType(k.post_type);
                            const wrapper = postWrapper(k, postType);

                            $('.queue-day-wrapper').append(wrapper);                  
                        })   
                    } else {
                        $(".queue-day-wrapper").html("<div>No post were posted yet</div>");
                    }  
                    break;
                case 'bulk-queue': 
                
                    if (responseData.length > 0) {

                        // Group cards by date
                        var groupedCards = responseData.reduce(function (acc, card) {
                            acc[card.sched_time] = acc[card.sched_time] || [];
                            acc[card.sched_time].push(card);
                            return acc;
                        }, {});
                        

                        for (var date in groupedCards) {
                            if (groupedCards.hasOwnProperty(date)) {
                                var petsa = new Date(date);
                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                var formattedDate = petsa.toLocaleDateString('en-US', options);
                                
                                $('.queue-day-wrapper').append('<span class="queue-date-heading">'+ formattedDate +'</span>'); 
                                groupedCards[date].forEach(function (card) {
                                    const postType = getPostType('bulk-queue');
                                    const wrapper = postWrapperBulk(card);
                                    $('.queue-day-wrapper').append(wrapper);                          
                                });
                            }
                        }

                                            
                    } else {
                        $(".queue-day-wrapper").html("<div>No post were posted yet</div>");
                    }  
                break;
            }            
        
        } catch (error) {
            console.log("An error occurred while fetching the data: " + error);
        }
    }      
    fetchData();
    

    // Function to append new posts to the container
    function appendPosts(startIndex, endIndex) {
        // console.log(startIndex, endIndex)
        for (var i = startIndex; i < endIndex; i++) {
            if (i < data.length) {
                var k = data[i];
                var currentDate = new Date();
                var dataDate = new Date(k.sched_time);
                // Create the post element and append it to the container
                if (dataDate > currentDate) {

                    if (k.sched_method === 'slot_sched') {
                        if (k.post_type === 'evergreen-tweets' || k.post_type === 'promos-tweets') {
                            const wrapper = postWrapperReserve(k);
                            $('.queue-day-wrapper').append(wrapper);
                        }
                    } else {
                        const postType = getPostType(k.post_type);
                        const wrapper = postWrapper(k, postType);
                        $('.queue-day-wrapper').append(wrapper);
                    }
                }
            }
        }
    }

    

    // Attach scroll event listener to the window
    $('.lower-area-inner').scroll(function() {
        // Check if the user has reached the bottom of the page
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            // Increment the current page variable
            currentPage++;

            // Calculate the start and end index of the next set of posts to retrieve
            var startIndex = (currentPage - 1) * postsPerPage;
            var endIndex = currentPage * postsPerPage;

            // Call the function to append the next set of posts
            appendPosts(startIndex, endIndex);

            // If there are no more posts to retrieve, you can remove the scroll event listener
            // to prevent unnecessary AJAX requests
            if (endIndex >= data.length) {
                $(window).off('scroll');
            }
        }
    });
      

   
    async function fetchDataByMonth() {
        try {
          const response = await fetch(APP_URL + '/post/getmonth?id=' + TWITTER_ID);
          const responseData = await response.json();

            $.each(responseData.data, function (i, month) {
            var li = $('<li>');       
        
                if (month !== null) {                
                    const date = new Date(month);
                    const abbreviatedMonth = date.toLocaleString('en-us', { month: 'short' });
                    const year = date.getFullYear();

                    // Combine the abbreviated month and year
                    const formattedDate = `${abbreviatedMonth.toLowerCase()}-${year}`;
                    
                    li.attr('id', formattedDate);
                    li.html(`<img src="${APP_URL}/public/ui-images/icons/07-schedule.svg" class="ui-icon" />${month}`)
                    $('.queue-months-dropdown').append(li);
                }   
            })                     
        } catch (error) {
          console.log("An error occurred while fetching the data: " + error);
        }
    }
    fetchDataByMonth();
    
    // close modal
    $(document).on('click', 'img#edit-commandmodule', function(event) {
        $target = event.target.dataset.id;  
        closeModal($target);
        $('.modal-large-anchor div.edit-commandmodule-outer').remove();
        $('.ui-effects-placeholder').remove();
    })    
    
    // close modal
    $(document).on('click', 'img#edit-bulk', function(event) {
        $target = event.target.dataset.id;  
        closeModal($target);
        $('.modal-large-anchor div.edit-bulk-outer').remove();
        $('.ui-effects-placeholder').remove();
    })    
      

    $('.queue-months-dropdown').on('click', 'li', async function(e) {
        var month = this.id;

        if (month === 'all') {
            window.location.href = '/queue';
        } 

        const newUrl = `${window.location.pathname}?category=month&id=${TWITTER_ID}&type=${month}`;
        window.history.pushState({ category: month }, "", newUrl);
        location.reload();
    })
  
    $('ul.queue-page-dd').on('click', 'li', async function(e) {
        var type = this.id;

        if (type === 'all') {
            window.location.href = '/queue';
        } else {
            const newUrl = `${window.location.pathname}?category=type&id=${TWITTER_ID}&type=${type}`;
            window.history.pushState({ category: type }, "", newUrl);
            location.reload();
        }

    });
    
    function sortBySourceAll() {
        window.location.href = '/queue';
    }
   
    
    $('.queue-day-wrapper').on("click", 'img.queued-icon', async function(e) {
        var id = e.target.id;
        var rmId = id.split('-');
    
        switch (rmId[0]) {
            case "edit":
                $('#mode').val('edit');        
                $('#item-id').val(id);
                
                try {
                    const response = await fetch(APP_URL + '/post/edit/' + id);
                    const responseData = await response.json();              

                    // render the modal
                    $('.modal-large-backdrop').append(responseData.html);
                                        
                    $('.edit-commandmodule-outer').addClass('edit-commandmodule-' + responseData.data[0]['id'] + '-outer')
                    $('.edit-commandmodule-outer').find('.modal-large-close').attr('data-id','edit-commandmodule-' + responseData.data[0]['id'])
                    // $('.edit-commandmodule-outer').find('.modal-large-close').attr('edit-commandmodule-')
                    if (responseData.data[0]['post_type'] === "regular-tweets") {
                        $('.edit-commandmodule-outer').find(`#posting-tool-form-002 img.ui-icon[data-src="twitter-tweets"]`).addClass('indicator-active');
                    } else {
                        $('.edit-commandmodule-outer').find(`#posting-tool-form-002 img.ui-icon[data-src="${responseData.data[0]['post_type']}"]`).addClass('indicator-active');
                    }    
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002 textarea`).text(responseData.data[0]['post_description']);
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002 span>img.ui-icon[data-type="${responseData.data[0]['post_type']}"]`).addClass('icon-active');
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002 select#scheduling-options option[value="${responseData.data[0]['sched_method']}"]`).attr('selected', true);
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002 div[data-post="${responseData.data[0]['post_type']}"]`).removeClass('tweets-hide')
                    $('.edit-commandmodule-outer').find(`#posting-tool-form-002`).attr('data-id', responseData.data[0]['id'])

                    if (responseData.data.length > 1) {
                        addTweetTextArea("tweet-storm-tweets", 'regular-tweets', 'posting-tool-form-002');   
                    }

                    // crosstweets
                    if (responseData.data[0]['crosstweets_accts'] === null) {
                        $('.edit-commandmodule-outer').find('.cross-tweet-profiles-outer').append('<div>No other twitter accounts are cross linked to this post</div>');                    
                    }

                    // postpanels
                    if (responseData.data[0]['post_type'] === "retweet-tweets") {
                        $('.edit-commandmodule-outer').find('.retweet-link-input').val(responseData.data[0].tweetlink);                    
                    }
                    
                    openModal("edit-commandmodule-" + responseData.data[0]['id']);
                } catch (error) {
                    console.log(error);
                }
                break;
            
            case "delete":
                try {
                    deletePost(id);                        
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
                        case 'postNow':
                            postTweetNow($spanId);
                            break;
                        
                        case 'duplicateNow':
                            duplicatePostNow($spanId);
                            break;
                        
                        case 'move':
                            console.log($spanId);
                            movePostToTop($spanId)
                            break;                                                
                    }
                });
                break;
            
            case "editBulk" : 
                
                const response = await fetch(APP_URL + '/post/bulk_edit/' + rmId[1]);
                const responseData = await response.json();              

                const dateTimeString = responseData.data['sched_time'];
                const dateTime = new Date(dateTimeString);
                const month = dateTime.toLocaleString('default', { month: 'short' });
                const day = dateTime.getDate();
                const year = dateTime.getFullYear();
                const timeString = dateTime.toLocaleTimeString();
                const fullDate = year + " " + month + ". " + day;
                        
                const getTimeFormat = timeString.split(' ');
                const splitTime = timeString.split(':');
                // console.log(getTimeFormat, splitTime);
                
                // render the modal
                $('.modal-large-backdrop').append(responseData.html);

                // $('.edit-bulk-outer').addClass('edit-bulk-' + responseData.data['id'] + '-outer')
                $('.edit-bulk-outer').find('.bulk-form').attr('data-id','edit-bulk-' + responseData.data['id'])
                $('#bulkpost_description').val(responseData.data['post_description']);
                $('#datepicker').val(fullDate);
                $('.edit-bulk-outer').find(`.bulk-form select[name="ct-hour"] option[value=${splitTime[0]}]`).attr('selected', true);
                $('.edit-bulk-outer').find(`.bulk-form select[name="ct-min"] option[value=${splitTime[1]}]`).attr('selected', true);
                $('.edit-bulk-outer').find(`.bulk-form select[name="ct-format"] option[value=${getTimeFormat[1]}]`).attr('selected', true);
                $('#bulkimage_url').val(responseData.data['image_url'])
                $('#bulklink_url').val(responseData.data['link_url'])


                openModal("edit-bulk-" + responseData.data['id']);
                break;
            case "duplicateBulk": 
                duplicatePost(id);         
                break;
            case "deleteBulk": 
                deletePost(id);
            default:
                break;
        }
    });

    $(document).on('click', 'img[name="reload-meta"]', async function(e) {
        const url = e.currentTarget.dataset.url;        
        try {
            
            const response = await fetch(APP_URL + '/reload-meta/scrape', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
                },
                body: JSON.stringify({ url : url}),
            });
            const responseData = await response.json();
            if (responseData.status === 200) {
                alert(responseData.message);
                location.reload();
            } else {
                $('.queued-posts-outer').before(div);        
            } 
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    });
    
    async function duplicatePost(id) {        
        const response = await fetch(APP_URL + '/post/duplicate/' + id , {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
            },
            body: JSON.stringify({ id: id }),
        });

        const responseData= await response.json();                    
        var div = $(`<div class="alert alert-${responseData.stat}"> ${responseData.message} </div>`);
        
        if (responseData.status === 200) {
            alert(responseData.message);
            location.reload();
        } else {
            $('.queued-posts-outer').before(div);        
        } 
        
        // remove the div after 3 seconds
        setTimeout(function() {
            div.remove();
        }, 3000);
    }
     
    
    async function deletePost(id) {        
        const response = await fetch(APP_URL + '/post/delete/' + id , {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
            },
            body: JSON.stringify({ id: id }),
        });

        const responseData= await response.json();                    
        

        toastr[responseData.stat](
            ` ${responseData.message}`
        );


        // remove the div after 3 seconds
        setTimeout(function() {
            location.reload();
        }, 3000);
    }

    // var initialFormData = {};
    $(document).on('submit', '#posting-tool-form-002', async function(e) {
        e.preventDefault();
        const form = $(this);
        var id = e.currentTarget.dataset.id;
        const $form = $(form).serializeArray();

        var textArea = [];
        $('#posting-tool-form-002').find(".post-textarea").each(function() {
            textArea.push(this.value)
        });

        var formData = {};
        $.each($form, function(index, field){
            formData[field.name] = field.value;         
        });

        formData['textarea'] = textArea
       

        try {
            const response = await fetch(APP_URL + '/post/update/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
                body: JSON.stringify(formData) // Convert the object to JSON string           
            });
            // console.log(response);
            const responseData = await response.json();

            if (responseData.status === 200) {
                alert(responseData.message);                
            } else {
                alert(responseData.message)
            }

            setTimeout(function() {
            location.reload();
            }, 3000); // Reload after 5 seconds (adjust the delay as needed)
        } catch(err) {
            console.log('Error fetching the data' + err)
        }
      });


    // edit bulk form
    $(document).on('submit', '.bulk-form', async function(e) {        
        e.preventDefault();
        const $form = $(e.target).serializeArray();
        var id = e.currentTarget.dataset.id;

        var formData = {};
        $.each($form, function(index, field){
            formData[field.name] = field.value;         
        });

        try {
            const response = await fetch(APP_URL + '/post/bulk_edit/' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
                body: JSON.stringify(formData) // Convert the object to JSON string           
            });
            // console.log(response);
            const responseData = await response.json();

            if (responseData.status === 200) {
                alert(responseData.message);                
            } else {
                alert(responseData.message)
            }

            setTimeout(function() {
            location.reload();
            }, 2000); // Reload after 5 seconds (adjust the delay as needed)
        } catch(err) {
            console.log('Error fetching the data: ' + err);
        }
    })  

      
    // switch
    $('#post-status').on('click', async function(e) {
        var isChecked = $(this).is(':checked');
        var url = APP_URL + '/post/status/' + ((isChecked) ? 'active' : 'inactive') + '/' + TWITTER_ID + '?method=' + method;

        try {                        
            const response = await fetch(url,  {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            const responseData = await response.json();
            
            if (responseData.status === 200) {
                window.location.reload();
            } else {
                
                window.location.reload();
            }

        } catch (error) {
            console.log("Failed to fetch data:", error);
        }
    })   

    $('.profile-posts-inner').on('click', 'img.evergreen-icon' , async function(e) {        
        var id = e.currentTarget.id;
        var arr = id.split('-');

        try {
            switch (arr[1]) {
                case 'comment' :
                    openCmdModalwithComment(arr[2]);
                break;

                case 'retweet' :
                    openCmdModalwithRetweet(arr[2])
                break;
                
                case 'evergreen' :
                break;

            }
        } catch (err) {
            console.log('error in fetching data', err)
        }
    })


    async function movePostToTop(id) {
        try {
            const response = await fetch(APP_URL + '/post/move-to-top/' + id + '?twitter_id=' + TWITTER_ID, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            const responseData = await response.json();
    
            toastr[responseData.stat](
                ` ${responseData.message}`
            );

            // remove the div after 3 seconds
            setTimeout(function() {
                location.reload();
            }, 3000);
           
        } catch (error) {
            console.log(error);
        }
    }
   
    async function postTweetNow(id) {        
        try {
            const response = await fetch(APP_URL + '/cmd/post/tweet-now?post=' + id + '&twitter_id=' + TWITTER_ID, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },                
            });
    
            const responseData = await response.json();
           
            toastr[responseData.stat](
                ` ${responseData.message}`
            );

            // remove the div after 3 seconds
            setTimeout(function() {
                location.reload();
            }, 3000);
        } catch (error) {
            console.log(error);
        }
    }
    
    async function duplicatePostNow(id) {
        try {
            const response = await fetch(APP_URL + '/post/duplicate/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
            });
    
            const responseData = await response.json();           
    
            toastr[responseData.stat](
                ` ${responseData.message}`
            );

               // remove the div after 3 seconds
            setTimeout(function() {
                location.reload();
            }, 3000);
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

    
    async function openCmdModalwithComment(id) {        
        $('span.post-type-buttons img.post-tool-icon').removeClass('icon-active');  // remove active icons
        $("div[data-post]").filter(`.post-alert`).addClass("tweets-hide"); // hide tweet panels
        
        $('span.post-type-buttons img').addClass('disabled');                
        $('span.post-type-buttons img[data-type="comments-tweets"]').removeClass('disabled');                
        $('span.post-type-buttons img[data-type="comments-tweets"]').addClass('icon-active');                
        $(".cross-tweet-profiles-outer").addClass("tweets-hide");
        $("div[data-post]").filter(`[data-post="comments-tweets"]`).removeClass("tweets-hide");

        try {
            const response = await fetch(APP_URL + '/post/evergreen/retrieve/' + id + '?post_action=comment');
            const responseData = await response.json(); 

            $('#posting-tool-form-001').find('.primary-post-area').text(responseData.data.post_description);

        } catch(err) {
            console.log('error in fetching data', err)
        }
        
        openModal('command-module');
    }

    async function openCmdModalwithRetweet(id) {        
        $('span.post-type-buttons img.post-tool-icon').removeClass('icon-active');    //remove active icons
        $('span.post-type-buttons img').removeClass('disabled');  // remove disabled 
        $("div[data-post]").filter(`.post-alert`).addClass("tweets-hide"); // hide tweet panels
            
        $('span.post-type-buttons img[data-type="retweet-tweets"]').addClass('icon-active');                
        $(".cross-tweet-profiles-outer").addClass("tweets-hide");
        $("div[data-post]").filter(`[data-post="retweet-tweets"]`).removeClass("tweets-hide");
        
        try {
            const response = await fetch(APP_URL + '/post/evergreen/retrieve/' + id + '?post_action=retweet');
            const responseData = await response.json(); 

            $('#posting-tool-form-001').find('.primary-post-area').text(responseData.data.post_description);

        } catch(err) {
            console.log('error in fetching data', err)
        }

        openModal('command-module');        
    }

    $('.new-queue-cmdmod').on('click', function() {
        $('span.post-type-buttons img.post-tool-icon').removeClass('icon-active');    //remove active icons
        $('span.post-type-buttons img').removeClass('disabled');  // remove disabled 
        $('div[data-post]').filter(`.post-alert`).addClass("tweets-hide"); // hide tweet panels
        $('.cross-tweet-profiles-outer').removeClass("tweets-hide");
        $('#post_type_tweets').val("regular-tweets");             

        openModal('command-module');
    });

    $('.new-evergreen-cmdmod').on('click', function() {
        $('span.post-type-buttons img.post-tool-icon').removeClass('icon-active');    //remove active icons
        $('span.post-type-buttons img').addClass('disabled');  // remove disabled 
        $('div[data-post]').filter(`.post-alert`).addClass("tweets-hide"); // hide tweet panels
        $('.cross-tweet-profiles-outer').removeClass("tweets-hide");
        $('#posting-tool-form-001 img.post-type-indicator').removeClass('indicator-active')
            
        $('span.post-type-buttons img[data-type="evergreen-tweets"]').removeClass('disabled');  // remove disabled 
        $('span.post-type-buttons img[data-type="evergreen-tweets"]').addClass('icon-active');                
        $('div[data-post]').filter(`[data-post="evergreen-tweets"]`).removeClass("tweets-hide");
        $('#posting-tool-form-001').find('img.post-type-indicator[data-src="evergreen-tweets"]').addClass('indicator-active')
        $('#post_type_tweets').val("evergreen-tweets");

        $('#scheduling-options option[value="send-now"]').prop('disabled', true);
        $('#scheduling-options option[value="set-countdown"]').prop('disabled', true);
        $('#scheduling-options option[value="custom-time"]').prop('disabled', true);
        $('#scheduling-options option[value="custom-slot"]').prop('disabled', true);        
              
        openModal('command-module');
    });
    
    $('.new-promos-cmdmod').on('click', function() {
        $('span.post-type-buttons img.post-tool-icon').removeClass('icon-active');    //remove active icons
        $('span.post-type-buttons img').addClass('disabled');  // remove disabled 
        $('div[data-post]').filter(`.post-alert`).addClass("tweets-hide"); // hide tweet panels
        $('#posting-tool-form-001 img.post-type-indicator').removeClass('indicator-active')
        
        $('span.post-type-buttons img[data-type="promos-tweets"]').removeClass('disabled');  // remove disabled 
        $('span.post-type-buttons img[data-type="promos-tweets"]').addClass('icon-active');                
        $('.cross-tweet-profiles-outer').addClass("tweets-hide");
        $('div[data-post]').filter(`[data-post="promos-tweets"]`).removeClass("tweets-hide");
        $('#posting-tool-form-001').find('img.post-type-indicator[data-src="promos-tweets"]').addClass('indicator-active')
        $('#post_type_tweets').val("promos-tweets");

        $('#scheduling-options option[value="send-now"]').prop('disabled', true);
        $('#scheduling-options option[value="set-countdown"]').prop('disabled', true);
        $('#scheduling-options option[value="custom-time"]').prop('disabled', true);
        $('#scheduling-options option[value="custom-slot"]').prop('disabled', true);        
              
        openModal('command-module');
    });
    

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
            case "bulk-queue": 
                postType = "custom"    
            default: 
                postType = "custom";
                break;            
        }

        return postType;
    }
    
})

