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
    
    


    function startTour() {
        const img = `<img src="${APP_URL}/public/ui-images/icons/00j-x-settings.svg" class="menu-icon launch-twitter-settings" data-id="modal" id="twitter-settings"/>`;
        $('.banner-twitter-settings').html(img);

        const dummyTwitter = `
              <div class="twitter-dropdown-menu-outer" style="display: block;">
                <div class="twitter-dropdown-menu-inner frosted">

                  <div class="twitter-stat-bar">

                    <div class="twitter-stat">
                      <img src="${APP_URL}/public/ui-images/icons/00g-following.svg" class="menu-icon">
                      <span class="stat-title">Following</span>
                      <span class="stat-count count-following">1,520</span></div>

                    <div class="twitter-stat twitter-stat-center">
                      <img src="${APP_URL}/public/ui-images/icons/00h-followers.svg" class="menu-icon">
                      <span class="stat-title">Followers</span>
                      <span class="stat-count count-followers">52,498</span></div>

                    <div class="twitter-stat">
                      <img src="${APP_URL}/public/ui-images/icons/00i-unfollows.svg" class="menu-icon">
                      <span class="stat-title">Unfollows</span>
                      <span class="stat-count count-unfollows">240</span></div>

                  </div>  <!-- END .twitter-stat-bar -->

                  <span class="account-select-title">
                    Select An Account</span>

                  <div class="twitter-account-select-bar">

                    <div class="twitter-account-item" data-step="3" data-intro="Access this menu to view all your linked Twitter accounts. Manage and switch between them effortlessly.">
                      <a href="#">
                      <div class="twitter-bar-profile-info">
                        <img src="${APP_URL}/public/temp-images/william-wallace.jpg">
                      @wimbleyJimbley</div></a>
                      <a href="#">
                      <img src="${APP_URL}/public/ui-images/icons/00j-twitter-settings.svg" class="menu-icon twitter-bar-settings-icon"></a>
                    </div>  <!-- END .twitter-account-item -->

                  </div>  <!-- END .twitter-account-select-bar -->

                </div>  <!-- END .twitter-dropdown-menu-inner -->
              </div>
        `        
        $('.twitter-dropdown-wrap').append(dummyTwitter);
        $(`#posting`).toggle();

        var intro = introJs();
        console.log(intro);
        intro.setOptions({
            steps: [
            //     {
            //   title: 'Welcome',
            //   intro: 'Hello World! 👋'
            // },           
            {
              element: document.querySelector('#general-settings'),
              intro: 'Start by adding your Twitter API. You can also configure your account settings here to personalize your experience.'
            },
            {
              element: document.querySelector('#twitter-settings'),
              intro: 'After adding your X/Twitter API and X/Twitter Account in General Settings, you can configure your X account settings here to personalize your experience.'
            },
            {
              element: document.querySelector('.twitter-account-item'),
              intro: 'Access this menu to view all your linked Twitter accounts. Manage and switch between them effortlessly.'
            },
            {
              element: document.querySelector('#slot-scheduler'),
              intro: 'Once your account setup is completed, use the Slot Scheduler to plan your regular post times. This feature gives you the ability to post your content at optimal times.',
              position:'right',
              tooltipClass: 'custom-right'

            },
            {
              element: document.querySelector('#command-module'),
              intro: 'With your Slot Scheduler ready, move to the Command Module. Here, you can curate posts and comments, allowing you to engage with your audience effectively.',
              position:'right'
            },
            {
              element: document.querySelector('#help'),
              intro: 'For a smoother experience, check out the Help section. It offers tutorials and answers to common questions.'
            },
            {
              element: document.querySelector('#roadmap'),
              intro: 'Stay updated with the latest features and improvements by keeping an eye on the Roadmap. Look out for exciting new Quantum updates.'
            },
            ], 
            exitOnEsc: false, 
            exitOnOverlayClick: false
          }).start();

        intro.onbeforechange(function(targetElement) {
            var currentStep = this._currentStep;
            var totalSteps = this._introItems.length;
            console.log(currentStep)
            console.log(totalSteps)

            if (currentStep === totalSteps - 1) {
                console.log('This is the last step');
            }

        });

        intro.oncomplete(function() {
            console.log('Tour completed');
            $('.twitter-dropdown-menu-outer').css('display', 'none');
            $('.banner-twitter-settings').html('');
            $(`#posting`).toggle();

            // Make an AJAX request to set the session variable for "Show me later"
            $.ajax({
                url: '/onboard?action=tourDone',
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    data: 'tour_done'
                },
                success: function(response) {
                    localStorage.setItem('tourDone', 'true');
                    if (response.status === 'success') {
                        console.log('Session variable set for later successfully');
                        checkOnboardDone();
                    }
                }
            });       
        });
        
        intro.onexit(function() {
            checkOnboardDone();
            console.log('Tour exited');
        });        
    }      

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

    async function checkOnboardDone() {
        const response = await fetch(APP_URL + '/checkOnboard');
        const responseData = await response.json(); 
    
        if (responseData.status === 200) {
            onboardingModal(responseData);
        }      
    }

    async function tourStarted() {
        const response = await fetch(APP_URL + '/tourStarted');
        const responseData = await response.json(); 
    
        if (responseData.status === 200 || responseData.status === 201) {
            localStorage.setItem('tourStarted', 'true');
            startTour();
        } else {
            checkOnboardDone();
        }
    }
    tourStarted()

});
