$(document).ready(function(){
    $('#uploadCsv').on('click', async function() {
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
    
        try {
            const response = await fetch(APP_URL + '/bulk/upload', {
                method: 'POST',           
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
                },
                body: formData,
            });
            const responseData = await response.json();    
            
            console.log(responseData)
    
            if (responseData.status === 200) {
                alert(responseData.message);
    
                window.location.href = APP_URL + '/bulk-queue';
            } else {
                openUpgradeModal(responseData);
            }
           
        } catch (err) {
            console.log(err)
        }


    });

    
});
