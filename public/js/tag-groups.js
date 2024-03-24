  // Get all the data from server          
  $(document).ready(function() {    

    async function getTagGroups() {
        try {
            const response = await fetch(APP_URL + "/cmd/get-tag-groups/" + TWITTER_ID);
            const responseData = await response.json(); 
    
            if (responseData.length > 0) {
                // console.log(responseData);
                $.each(responseData, function (index, k, value) {
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

   $('#tag-groups-content').on('click', '.tag-group-controller', async function() {
        $('.tag-container').empty()
        var tag_id = $(this).find('.tag-option-title').attr('id');

        try {
            const response = await fetch(APP_URL + "/cmd/get-tag-items?twitter_id=" + TWITTER_ID + '&tag_id=' + tag_id);
            const responseData = await response.json();
            console.log(responseData)

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
                console.log(response);
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
                    console.log(responseData)
                    var span = addNewTagTemplateItem(responseData.hashtag);
                    container.append(span);
                    response.value = '';  
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

            if (responseData.status === 200) {
                var template = tagGrptemplateItem(responseData.data);
                // $(template).appendTo('#tag-groups-content');
                $('#tag-groups-content').append(template);

                alert(responseData.message);
                location.reload();
            } else {
                openUpgradeModal(responseData);
            }

        } catch(err) {
            console.log('Error:', err)
        }
    });

    
    function tagGrptemplateItem(data) {
        return $template = `<div class="tag-group-controller" >
                                <div class"tag-group-option">
                                    <span class="tag-option-title-wrap">
                                        <img src="${APP_URL}/public/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon tag-option-icon" />
                                        <span class="tag-option-title" id="${data.tag_group_mkey}">${data.tag_group_mvalue}</span>
                                    </span> 
                                </div> 
                            </div> `;                
    }

    function addNewTagTemplateItem(hashtag) {
        return $template = `<span class="existing-tag"><i class="xtag">X</i>${hashtag.tag_meta_value}</span>`        
    }
});

 



    
      
  
