// Fetch the existing tag groups when the page loads
$(document).ready(function() {    
    $.ajax({
        type: 'GET',
        url: APP_URL + '/twitter/getTweets/' + TWITTER_ID, // Use the URL of your server-side script here
        beforeSend: function() {
            $('#spinner').show();
        },
        success: renderTweets,
        error: function(xhr, status, error) {
            console.log('An error occurred while fetching the tweets: ' + error);
        },
        complete: function() {
            $('#spinner').hide();
        }
    });
});


function renderTweets(response) {
    $('.profileSection').show();  

    if (response.data.length > 0) {
        var cardSection = $('.profile-posts-inner');
        var $template = $('.mosaic-posts-outer:first').clone();

        $template.remove();
        console.log($('.mosaic-posts-outer:first'))

        $.each(response.data, function(index, value) {
            var $cloneTemplate = $template.clone();
            // $('.mosaic-posts-outer#template').remove();
            
            $cloneTemplate.attr('id', 'template-' + index);
            $cloneTemplate.find('.global-profile-name').text(TWITTER_NAME);                    
            $cloneTemplate.find('.global-post-date').text(value.created_at);
            $cloneTemplate.find('.mosaic-post-text').append(value.text);

            if (value.image) {
                var image = `<img src="${value.image}" alt="tweet image" data-twitter-image="imgId" height="500" width="auto">`;
                $cloneTemplate.find('.mosaic-post-data').append(image)
            }
            
            cardSection.append($cloneTemplate)
        });                                
    }
}