$(document).ready(function () {

    $('#upgrade-now').click(function() {
        $.ajax({
            url: '/get-upgrade-modal',
            type: 'GET',
            success: function(response) {
                if(response.stat == 'upgrade?'){
                    openUpgradeModal(response);
                }
            },
            error: function(xhr, status, error) {

                console.error(error);
            }
        });


    });



});
