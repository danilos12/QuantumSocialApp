$(document).ready(function(){
    $(document).on('click', '#uploadCsv1',  async function(e) {
        e.preventDefault();
        var fileInput = $('#csvFileInput')[0].files[0];

        if (!fileInput) {
            alert('Please select a CSV file.');
            return;
        }


        var formData = new FormData();
        formData.append('csv_file', fileInput, fileInput.name);
        formData.append('twitter_id', TWITTER_ID);

    
        try {
            // Clear the error container
            $('#errorContainer').empty();

            const response = await fetch(APP_URL + '/bulk/upload', {
                method: 'POST',           
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
                },
                body: formData,
            });
            const responseData = await response.json();    
                
            if (responseData.status === 200) {
                alert(responseData.message);
    
                window.location.href = APP_URL + '/bulk-queue';
            } else if (responseData.status === 402) {
                
                let errorsHtml = ''; // Variable to store the HTML content
                $.each(responseData.errors, function(rowNumber, errors) {
                    errorsHtml += "<p>Errors in Row " + rowNumber + ":</p>"; // Construct row number heading
                    $.each(errors, function(index, error) {
                        errorsHtml += "<p>- " + error + "</p>"; // Construct error message
                    });
                });
                 $('#errorContainer').addClass("alert alert-danger").html(errorsHtml); // Append errors to the div with id "errorContainer"
                

                // to be back
                setTimeout(function () {
                    location.reload();
                }, 3000); // Reload after 5 seconds (adjust the delay as needed)
                
            } else if (responseData.status === 500) {
                alert(responseData.message);                                
            } else {
                openUpgradeModal(responseData);
            }
           
        } catch (err) {
            console.log(err)
        }


    });

    
});
