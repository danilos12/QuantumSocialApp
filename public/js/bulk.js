$(document).ready(function(){
    $('#uploadCsv').on('click', function() {
        var fileInput = $('#csvFileInput')[0].files[0];

        if (!fileInput) {
            alert('Please select a CSV file.');
            return;
        }

        console.log(fileInput);

        var formData = new FormData();
        formData.append('csv_file', fileInput, fileInput.name);
        formData.append('twitter_id', TWITTER_ID);

        console.log(formData)
    

        $.ajax({
            url: APP_URL + '/bulk/upload', // Replace with your actual endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                alert(data.message);

                window.location.href = APP_URL + '/bulk-queue';
                // Handle the response as needed
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });

    
});
