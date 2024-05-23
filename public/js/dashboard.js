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

    async function checkOnboardDone() {
        const response = await fetch(APP_URL + '/checkOnboard');
        const responseData = await response.json(); 
    
        if (responseData.status === 200) {
            onboardingModal(responseData);
        }
    
    }

    checkOnboardDone();

    $(document).on('click', '.close-onboard-page', function(e) {
        e.preventDefault();

        // Hide the modal
        $('.onboard').css('z-index', 0);
        $('.modal-large-anchor-onboard').css('display', 'none');

        // Make an AJAX request to set the session variable for "Show me later"
        $.ajax({
            url: '/onboard?action=later',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                data: 'onboard_later'
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Session variable set for later successfully');
                }
            }
        });
    });

    $(document).on('click', '.done-onboard-page', function(e) {
        e.preventDefault();

        // Hide the modal
        $('.onboard').css('z-index', 0);
        $('.modal-large-anchor-onboard').css('display', 'none');

        // Make an AJAX request to set the session variable for "DONE"
        $.ajax({
            url: '/onboard?action=done',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                data: 'onboard_done'
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Session variable set for done successfully');
                }
            }
        });
    });


});
