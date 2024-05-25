  // Get all the data from server          
  $(document).ready(function() {    

    async function getTagGroups() {
        try {
            const response = await fetch(APP_URL + "/cmd/get-tag-groups/" + TWITTER_ID);
            const responseData = await response.json(); 
            console.log(responseData);

            if (responseData.status === 500) {
                $('.content-inner').html(`<div class="alert alert-${responseData.stat}" role="alert">
                ${responseData.message}
              </div>`)
            }
            if (responseData.tagGroups.length > 0) {
            
                $.each(responseData.tagGroups, function (index, k, value) {
                    var template = tagGrptemplateItem(this);
                    $("#tag-groups-content").append(template);
                });
            } else {
                $(".tag-groups-column-wrap").html(
                    "<div>No tags for this account. Create new!</div>"
                );
            }

        } catch (error) {
            console.log(
                "An error occurred while fetching the existing tag groups: " +
                    error
            );
        }
    }
    getTagGroups();

   $(document).on('click', '.tag-group-controller', async function() {
        $('.tag-container').empty()
        const tag_id = $(this).find('span.tag-option-title').attr('id');
        console.log(tag_id)
        $('.copyButton').attr('data-tag-id', tag_id)

        try {
            const response = await fetch(`${APP_URL}/cmd/get-tag-items?twitter_id=${TWITTER_ID}&tag_id=${tag_id}`);
            const responseData = await response.json();

            if (responseData.length > 0) {
                $.each(responseData, function (index, k, value) {
                    $(".tag-groups-right-column")
                        .removeClass("section-hide")
                        .find("input")
                        .attr("data-id", tag_id);
                    var template = addNewTagTemplateItem(
                        this
                    );
                    $(".tag-container").append(template);
                });
            } else {
                $(".tag-groups-right-column")
                    .removeClass("section-hide")
                    .find("input")
                    .attr("data-id", tag_id);
            }
        } catch (err) {
            console.error(err)
        }
    });    

    $(document).on('click', '.copyButton', async function(e) {

        try {
            const response = await fetch(APP_URL + "/cmd/get-tag-items?copy=true&twitter_id=" + TWITTER_ID + '&tag_id=' + e.target.dataset.tagId);
            const responseData = await response.json();
            // console.log(responseData)

            if (responseData.status === 200) {
                // Create a temporary textarea element to hold the text to copy
                var tempTextArea = $("<textarea>");
                tempTextArea.val(responseData.tags);

                // Append the textarea to the DOM
                $("body").append(tempTextArea);

                // Select the text within the textarea
                tempTextArea.select();

                // Copy the selected text to clipboard
                document.execCommand("copy");

                // Remove the temporary textarea
                tempTextArea.remove();

                toastr[responseData.stat](
                    `${responseData.message}`
                );
            } else {

                toastr[responseData.stat](
                    `${responseData.message}`
                );
            }

        } catch (err) {
            console.error(err)
        }


        // Get the count of span elements within the .tag-container
        // var spanCount = $('.tag-container span').length;

        // // Check if the count is greater than 1
        // if (spanCount > 1) {
           
        //     $('.tag-container span').each(function(e, i) {
        //         console.log(i.textContent);
        //         tags += '#' + i.textContent + ' ';
        //     });

        //     // Create a temporary textarea element to hold the text to copy
        //     var tempTextArea = $("<textarea>");
        //     tempTextArea.val(tags);

        //     // Append the textarea to the DOM
        //     $("body").append(tempTextArea);

        //     // Select the text within the textarea
        //     tempTextArea.select();

        //     // Copy the selected text to clipboard
        //     document.execCommand("copy");

        //     // Remove the temporary textarea
        //     tempTextArea.remove();

        //     // Alert the user
        //     alert("Tags are copied to clipboard!");
        // } else {
        //     alert("No tags available to copy");
        // }
      });      

    // Add hashtags in the input fields
    var input, container, hashtagArray, t;
    
    addTagForm = $('#addTagForm');
    input = 
    container = $('.tag-container');
    hashtagArray = [];
    

    $('#addTagForm_tags').on('keypress', async (event) => {
        if (event.keyCode === 13) {
            event.preventDefault();

            try {
                const response = await fetch(APP_URL + '/cmd/add-tag-item', {     
                    method: 'POST',                           
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        hashtag: event.target.value,
                        twitter_id: TWITTER_ID,
                        tag_id: event.target.dataset.id
                    })
                });
                const responseData = await response.json();
                    
                if (responseData.status === 200) {
                    var span = addNewTagTemplateItem(responseData.hashtag);
                    container.append(span);
                    $('#addTagForm_tags').val('');
                } else {
                    throw new Error('Request failed');
                }
                
            } catch(err) {
                console.error(err)
            }                  
        }
    });

    function removeTag() {
        let deleteTags = $('.xtag');
        
        console.log(deleteTags)
        deleteTags.each(function(el, k) {               
            console.log(k)
            $(this).click(function() {
                $(this)[0].parentElement.remove();
            })
        })
    }



    // Add new tagGroup to DB
    $('#addNewTagGrp').submit(async function(event) {
        event.preventDefault(); // Prevent the default form submit behavior

        // Get input value
        var inputValue = $(".group-title-input").val();

        try {
            const response = await fetch(APP_URL + '/cmd/add-tag', {                
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({ // Convert the data to JSON string
                    myInput: inputValue, 
                    twitter_id: TWITTER_ID 
                })
            });
            const responseData = await response.json();

            console.log(responseData);

            if (responseData.status === 200) {
                var template = tagGrptemplateItem(responseData.data);
                // $(template).appendTo('#tag-groups-content');
                $('#tag-groups-content').append(template);
                toastr[responseData.stat](
                    `Success! ${responseData.message}`
                );

                setTimeout(function() {
                    location.reload();
                    }, 3000); 
            } else if (responseData.status === 500) {    

                toastr[responseData.stat](
                    `Success! ${responseData.message}`
                );
                
            }  else {
                openUpgradeModal(responseData);
            }

        } catch(err) {
            console.log('Error:', err)
        }
    });

    // remove tagGroup
    $(document).on('click', '[data-id="remove-tag"]', async function(e) {
        const tag_group_id = e.target.id.split('-')[1];

        try {
            const response = await fetch(APP_URL + "/cmd/remove-tag", {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({ // Convert the data to JSON string
                    tag_group_id, 
                    twitter_id: TWITTER_ID 
                })
            });
            const responseData = await response.json();

            
            
            toastr[responseData.stat](
                `${responseData.message}`
            );

            setTimeout(function() {
                location.reload();
                }, 3000); 

           
        } catch (err) {
            console.error(err)
        }
    })

    // remove tagItem
    $(document).on('click', '[data-id="remove-tag-item"]', async function(e) {
        const tag_group_id = e.target.id;       

        try {
            const response = await fetch(APP_URL + "/cmd/remove-tag-item", {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({ // Convert the data to JSON string
                    tag_group_id, 
                    twitter_id: TWITTER_ID 
                })
            });
            const responseData = await response.json();
            $('.tag-container').find(`img#${responseData.item_removed}`).closest('span').remove()
                    
            toastr[responseData.stat](
                `${responseData.message}`
            );

            
        } catch (err) {
            console.error(err)
        }
    })

    
    function tagGrptemplateItem(data) {
        
        return $template = `<div class=""  style="justify-content: space-between;display: flex; align-items: center; padding: 1px 1em 0 0;">
                            <div class="tag-group-controller" id="${data.id}">
                                <div class"tag-group-option" >
                                    <span class="tag-option-title-wrap">
                                        <img src="${APP_URL}/public/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon tag-option-icon" />
                                        <span class="tag-option-title" id="${data.tag_group_mkey}">${data.tag_group_mvalue}</span>
                                    </span> 
                                </div> 
                            </div>
                            <div class="remove" style="cursor: pointer">
                                <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon" tooltip="" id="removeTag-${data.id}" data-id="remove-tag" title="Delete">
                            </div> 
                            </div>
                            `;                
    }

    function addNewTagTemplateItem(hashtag) {
        return $template = `<span class="existing-tag"><i class="xtag">
            <img src="${APP_URL}/public/ui-images/icons/pg-close.svg" class="ui-icon" data-id="remove-tag-item" id="${hashtag.tag_meta_value}">
        </i>${hashtag.tag_meta_value}</span>`        
    }
});

 



    
      
  
