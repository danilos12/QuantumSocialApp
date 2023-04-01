  // Get all the data from server          
  $(document).ready(function() {
    
    $.ajax({
        type: 'GET',
        url: APP_URL + '/get-tag-groups/' + TWITTER_ID, // Use the URL of your server-side script here
        success: function(response) {
            // Add the existing tag groups to the page
            if (response.length > 0) {
                $.each(response, function(index, k, value) {
                    
                    // console.log(this)
                    var template = tagGrptemplateItem(this.tag_group_mvalue, this.tag_group_mkey);
                    $('#tag-groups-content').append(template);
                })
            } else {
                $('.tag-groups-column-wrap').html('<div>No twitter accounts linked</div>')
            }
        },
        error: function(xhr, status, error) {
            console.log('An error occurred while fetching the existing tag groups: ' + error);
        }
    });

   $('#tag-groups-content').on('click', '.tag-group-controller', function() {
        $('.tag-container').empty()
        var tag_id = $(this).find('.tag-option-title').attr('id');
        $.ajax({
            type: 'GET',
            url: APP_URL + '/get-tag-items/' , // Use the URL of your server-side script here
            data: {
                twitter_id: TWITTER_ID,
                tag_id
            },
            success: function(response) {
                // Add the existing tag groups to the page       
                if (response.length > 0) {
                    $.each(response, function(index, k, value) {
                        $('.tag-groups-right-column').removeClass('section-hide').find('input').attr('data-id', tag_id);
                        var template = addNewTagTemplateItem(this.tag_meta_value)
                        $('.tag-container').append(template);
                    })
                    console.log(response)
                } else {
                    $('.tag-groups-right-column').removeClass('section-hide').find('input').attr('data-id', tag_id);
                }        
                
            },
            error: function(xhr, status, error) {
                console.log('An error occurred while fetching the existing tag groups: ' + error);
            }
        });
    });    

    // Add hashtags in the input fields
    var input, container, hashtagArray, t;
    
    addTagForm = $('#addTagForm');
    input = $('#addTagForm_tags');
    container = $('.tag-container');
    hashtagArray = [];
    

    input.on('keypress', function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();

            // submitForm;
            $.ajax({
                type: "POST",
                url: APP_URL + '/add_tag_item',            
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    hashtag: this.value,
                    twitter_id: TWITTER_ID,
                    tag_id: this.getAttribute('data-id')
                },
                success: function(response) {
                    console.log(response)
                    var span = addNewTagTemplateItem(response.hashtag);
                    container.append(span);
                    response.value = '';                        
                }
            })                      
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
    $('#addNewTagGrp').submit(function(event) {
        event.preventDefault(); // Prevent the default form submit behavior

        // Get input value
        var inputValue = $(".group-title-input").val();

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: APP_URL + '/add_tag',            
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { 
                myInput: inputValue, 
                twitter_id : TWITTER_ID 
            },
            success: function(response) {
                // Handle successful response
                // alert("Value saved to database!");
                console.log(response)
                var template = tagGrptemplateItem(response.value, response.key );
                $(template).appendTo('#tag-groups-content');
                // $('#tag-groups-content').load(APP_URL + '/get-tag-items');

            },
            error: function(xhr, status, error) {
                console.log('An error occurred while submitting the form: ' + error);
            }
        
        });
    });

    
    function tagGrptemplateItem(v, k) {
        return $template = `<div class="tag-group-controller" >
                                <div class"tag-group-option">
                                    <span class="tag-option-title-wrap">
                                        <img src="${APP_URL}/public/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon tag-option-icon" />
                                        <span class="tag-option-title" id="${k}">${v}</span>
                                    </span> 
                                </div> 
                            </div> `;                
    }

    function addNewTagTemplateItem(hashtag) {
        return $template = `<span class="existing-tag"><i class="xtag">X</i>${hashtag}</span>`        
    }
});

 



    
      
  
