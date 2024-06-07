$(document).ready(function () {
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toast-top-center",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "300",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    // add team member modal
    $addTeamIcon = $(".add-team");
    $addTeamModal = $(".add-team-member-inner");
    $addTeamModal2 = $(".add-team-member-modal");
    const addButton = document.querySelector(".add-team-button");

    var $exitButton = $(".exit-button #closing");

    if (addButton == document.querySelector(".add-team-button")) {
        $addTeamIcon.click(function () {
            const actionLabel = document.getElementById("actionLabel");
            actionLabel.textContent = "ADDING";
            const labeling = document.getElementById("labeling");
            labeling.textContent = "ADD";

            $addTeamModal.css("display", "flex");
            $addTeamModal.toggle(
                "puff",
                { percent: 100, easing: "swing" },
                100
            );
            $addTeamModal2.toggle(
                "puff",
                { percent: 100, easing: "swing" },
                900
            );
        });
    }

    $exitButton.click(function () {
        $addTeamModal.fadeToggle(900);
        $addTeamModal2.fadeToggle(900);
        $.when($addTeamModal.promise(), $addTeamModal2.promise()).done(
            function () {
                $(".add-team-member-modal").hide();
                if (document.querySelector(".edit-team-button")) {
                    addButton.className = "add-team-button";
                }
                // reset all input values to default
                $(".add-team-member-inner").find("#newuser_fname").val("");
                $(".add-team-member-inner").find("#newuser_email").val("");
                $("#toggle_api").prop("checked", false);
                var emailSpan = document.getElementById("emailSpan");
                var email = document.getElementById("newuser_email");

                emailSpan.style.display = "none";
                email.style.display = "inline";
                $('input[name="fav_language"]').prop("checked", false);
            }
        );
    });

    $('img.change-pass').on('click', function(e) {
        console.log(e);
        $('.change-pass-modal').css('display', 'block')
    })

    $('#close-change-pass').on('click', function(e) {
        console.log(e);
        $('.change-pass-modal').css('display', 'none')
    })

    // change password modal
    $(document).on('submit', '#changePassForm', async function(e) {
        e.preventDefault();
        const $form = $(e.target).serializeArray();
        var formData = {};
        $.each($form, function(index, field){
            formData[field.name] = field.value;
        });

        try {
            const response = await fetch(APP_URL + '/change-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
                body: JSON.stringify(formData) // Convert the object to JSON string
            });
            const responseData = await response.json();

            var div = $(`<div class="alert alert-${responseData.stat} mt-2"> ${responseData.message} </div>`);
            $(this).after(div);


            // remove the div after 3 seconds
            setTimeout(function() {
                div.remove();
            }, 3000);
        } catch(err) {
            console.log('Error fetching the data' + err)
        }
    })

    $('#cancel-subscription').on('click', async function(e) {
        try {
            $('.cancel-subscription-modal').css('display', 'block')
            // const response = await fetch(APP_URL + '/settings/cancel');
            // const responseData = await response.json();

            // console.log(responseData);

        } catch (err) {
            console.log('Error fetching the modal' + err)
        }
    })
   
    $('#cancelSubscriptionForm').on('submit', async function(e) {
        e.preventDefault();
        console.log(e);

        const formArray = $(this).serializeArray();
        const formObject = {};
        
        $.each(formArray, function() {
          formObject[this.name] = this.value;
        });

        console.log(formObject);

        try {
            const response = await fetch(APP_URL + '/settings/cancel/subscription', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
                body: JSON.stringify(formObject) // Convert the object to JSON string
            });
            const responseData = await response.json();
            console.log(responseData);
            
            if (responseData.status === 200) {
                toastr[responseData.stat](
                    `${responseData.message}`
                );

                setTimeout(function() {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/logout';
        
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);
        
                    document.body.appendChild(form);
                    form.submit();
                }, 3000);
            }

        } catch (err) {
            console.log('Error fetching the data' + err)
        }
    })

    // toggle api secrets
    $('.secrets').on('click', function(e) {
        var input = $('input#' + e.target.id);
        var img = $(this);

        // Toggle input type between password and text
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            img.attr('src', APP_URL + '/public/ui-images/icons/eye-closed.svg');
        } else {
            input.attr('type', 'password');
            img.attr('src', APP_URL + '/public/ui-images/icons/eye-open.svg');
        }
    })

    $(document).on('submit', '#master_api_form', async function(e) {
        e.preventDefault();
        const $form = $(e.target).serializeArray();
        var id = e.currentTarget.dataset.id;
        console.log($form, id)
        var formData = {};
        $.each($form, function(index, field){
            formData[field.name] = field.value;
        });

        try {
            const response = await fetch(APP_URL + '/settings/twitter_api_creds/' + QUANTUM_ID, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                },
                body: JSON.stringify(formData) // Convert the object to JSON string
            });
            const responseData = await response.json();

            toastr[responseData.stat](
                `${responseData.message}`
            );

            setTimeout(function() {
            location.reload();
            }, 3000);
        } catch(err) {
            console.log('Error fetching the data' + err)
        }
    });

    $('div#link-twitter').on('click', async function(e) {
        try {
          const response = await fetch(APP_URL + '/twitter/redirect/' + QUANTUM_ID);
          const responseData = await response.json();

          var div = $(`<div class="alert alert-${responseData.stat} mt-2"> ${responseData.message} </div>`);
          console.log(responseData.status);
          if (responseData.status === 200) {
            window.location.href = responseData.redirect;
          } else {
            openUpgradeModal(responseData);
          }

          // remove the div after 3 seconds
          setTimeout(function() {
            div.remove();
          }, 3000);
        if(responseData.stat === 'warning'){
            toastr[responseData.stat](
                `Warning! ${responseData.message}`
            );
        }


        } catch (error) {
          console.log(error);
        }
      })


    // modal slider
    // $(document).ready(function() {
    $('input[name="general-settings[]"]').change(async function (event) {
        console.log(event.target.id);
        var isChecked = $(this).is(":checked");

        var data = {
            meta_key: event.target.id,
            meta_value: isChecked === true ? 1 : 0,
            user_id: QUANTUM_ID,
        };

        try {
            const response = await fetch(
                APP_URL + "/settings?id=general-settings",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    body: JSON.stringify(data), // Use "body" instead of "data" to send the data
                }
            );

            const responseData = await response.json();
            console.log(responseData);
            if (responseData.status === 200) {
                if (responseData.html === null) {
                    $(".twitterapi-account-outer").remove();
                } else {
                    $(".twitter-settings-inner").prepend(responseData.html);
                }
                console.log(responseData.message);
            } else {
                console.log(responseData.message);
            }
        } catch (error) {
            console.log(error);
        }
    });

    $("#membership").change(async function (event) {
        var selectedValue = $(this).val();
        console.log("Selected value changed to: " + selectedValue);

        try {
            const response = await fetch(
                APP_URL + "/settings/membership/" + QUANTUM_ID,
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    body: JSON.stringify({ subscription: selectedValue }), // Use "body" instead of "data" to send the data
                }
            );

            const responseData = await response.json();
            console.log(responseData);

            var successDiv = $(
                `<div class="alert-${responseData.stat}"> ${responseData.message} </div>`
            );
            if (responseData.status === 200) {
                var str = responseData.data;
                var capitalized = str.charAt(0).toUpperCase() + str.slice(1);
                $(".subscription-text").text(capitalized + " Plan");

                $("#quantum_acct").append(successDiv);
            } else {
                $("#quatum_acct").after(successDiv);
            }

            // remove the div after 3 seconds
            setTimeout(function () {
                successDiv.remove();
            }, 3000);
        } catch (error) {
            console.log(error);
        }
    });

    $("#timezone-offset").change(async function (event) {
        var selectedValue = $(this).val();
        console.log("Selected value changed to: " + selectedValue);

        try {
            const response = await fetch(
                APP_URL + "/settings/timezone/" + QUANTUM_ID,
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    body: JSON.stringify({ timezone: selectedValue }), // Use "body" instead of "data" to send the data
                }
            );

            const responseData = await response.json();
            console.log(responseData);

            var successDiv = $(
                `<div class="alert alert-${responseData.stat} mt-2"> ${responseData.message} </div>`
            );
            if (responseData.status === 200) {
                $("#quantum_acct").append(successDiv);
            } else {
                $("#quantum_acct").append(successDiv);
            }

            // remove the div after 3 seconds
            setTimeout(function () {
                successDiv.remove();
            }, 3000);
        } catch (error) {
            console.log(error);
        }
    });

    $(".menu-account-default").click(function (event) {
        var twitterId = event.target.dataset.twitter_id;
        switchUser(APP_URL + "/twitter/switchUser?id=" + twitterId, twitterId);
    });

    // delete twitter
    $(".delete-account").click(async function (event) {

        try {
            const response = await fetch(
                APP_URL + "/twitter/remove",
                {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
                    },
                    body: JSON.stringify({ twitter_id: $(this).data("twitterid") }), // Use "body" instead of "data" to send the data
                }
            );

            const responseData = await response.json();

            toastr[responseData.stat](
                `${responseData.message}`
            );

            setTimeout(function() {
                location.reload();
            }, 3000);

        } catch(error) {
            console.log(error);
        }
    });



    $('img.ui-icon[data-icon="twitter-settings"]').on("click",function (event) {
            $(".general-settings-outer").hide();
            $(".twitter-settings-outer").show();
        }
    );

    function switchUser(url, twitterId) {
        $(".freeze-overlay").show();
        $("body").addClass("freeze");

        $.ajax({
            url,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(response);
                // Handle success in general settings
                $(".menu-account-default").attr("default", "");
                $('span[data-twitter_id="' + response.twitter_id + '"]').attr(
                    "default",
                    "active"
                );

                // in hamburger
                $(".twitter-account-select-bar").removeClass("active");
                $(
                    '.twitter-account-select-bar[data-twitter="twitter-' +
                        response.twitter_id +
                        '"]'
                ).addClass("active");

                toastr[response.stat](
                    `Success, ${response.message}`
                );


                setTimeout(function () {
                    location.reload();
                }, 3000); // Reload after 5 seconds (adjust the delay as needed)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle error
                console.log(jqXHR, textStatus, errorThrown);
            },
            complete: function () {
                // Hide the overlay and remove freeze class when the AJAX request is complete
                $(".freeze-overlay").hide();
                $("body").removeClass("freeze");
            },
        });
    }

    $(".profile-twitter-account-item").click(function (e) {
        var $this = $(this);
        var twitterId = $this.parent().parent().data("id");
        var hasClass = $(this).hasClass("active");

        if (hasClass) {
            $(this)
                .attr("data-toggle", "popover")
                .attr("data-placement", "top")
                .attr("data-trigger", "focus")
                .popover({
                    html: true,
                    content:
                        '<span class="selected-popover">X account is selected</span>',
                })
                .popover("show");
        } else {
            switchUser(
                APP_URL + "/twitter/switchUser?id=" + twitterId,
                twitterId
            );
        }

        function loadContent(url) {
            var spinner = `<div class="queued-single-post">
                      <div class="queued-single-start">
                        <span class="queued-post-data" style="color: white; text-weight: bold">
                          Loading...
                        </span>
                      </div>  <!-- END .queue-single-start -->

                    </div>`;
            $(".content-inner").html(spinner); // show a spinner while the content is loading

            setTimeout(function () {
                $(".queued-single-post").fadeOut("slow");
            }, 3000);

            $.ajax({
                url: url,
                method: "GET",
                dataType: "html",
                success: function (response) {
                    // $('.content-section').html(response); // update the content section with the loaded content
                    // console.log(response)
                    // $data = json_decode($response, true)
                    var parse = JSON.parse(response);
                    $(".content-inner").html(parse.html);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $(".content-section").html(
                        '<div class="error-message">Error loading content.</div>'
                    ); // show an error message if the content fails to load
                },
            });
        }
    });

    $(document).on("click", ".add-team-button", async function (e) {
        e.preventDefault();
        var isChecked = $("#toggle_api").prop("checked");
        var selectedRole = $('input[name="fav_language"]:checked').val();
        var data = {
            fullname: $(".add-team-member-inner").find("#newuser_fname").val(),
            emails: $(".add-team-member-inner").find("#newuser_email").val(),
            roles: selectedRole,
            api_access: isChecked,
        };
        console.log(data);
        if(selectedRole == 'Member'){
            if(isChecked){
                $('#toggle_api').prop('checked', false);
                toastr['warning']('Warning! Members are not allowed to access API, only Admin role');
            }else{




        try {
            const response = await fetch(APP_URL + "/settings/_add_new", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify(data),
            });
            const responseData = await response.json();

            if (responseData) {
                if (responseData.stat == "success") {
                    toastr[responseData.stat](
                        `Success, ${responseData.message}`
                    );
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else if (responseData.stat == "warning") {
                    toastr[responseData.stat](
                        `Warning! ${responseData.message}`
                    );
                    openUpgradeModal(responseData);
                }
            }


        } catch (err) {
            console.log("Error fetching the data" + err);
        }
    }
    }

    if(selectedRole == 'Admin'){
        try {
            const response = await fetch(APP_URL + "/settings/_add_new", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify(data),
            });
            const responseData = await response.json();

            if (responseData) {
                if (responseData.stat == "success") {
                    toastr[responseData.stat](
                        `Success, ${responseData.message}`
                    );
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else if (responseData.stat == "warning") {
                    toastr[responseData.stat](
                        `Warning! ${responseData.message}`
                    );
                    openUpgradeModal(responseData);
                }
            }


        } catch (err) {
            console.log("Error fetching the data" + err);
        }
    }
    });

    $(document).on("click", ".edit-team-button", async function (e) {
        var isChecked = $("#toggle_api").prop("checked");
        var selectedRole = $('input[name="fav_language"]:checked').val();
        var data = {
            user_id: edit_id[1],
            fullname: $(".add-team-member-inner").find("#newuser_fname").val(),
            emails: $(".add-team-member-inner").find("#newuser_email").val(),
            roles: selectedRole,
            api_access: isChecked,
        };
        if(selectedRole == 'Member'){
            if(isChecked){
                $('#toggle_api').prop('checked', false);
                toastr['warning']('Warning! Members are not allowed to access API, only Admin role');
            }else{



        try {
            const response = await fetch(APP_URL + "/settings/members/_edit", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify(data), // Convert the object to JSON string
            });
            const responseData = await response.json();

            if (responseData.stat == "success") {
                toastr[responseData.stat](
                    `${responseData.status_m}, ${responseData.message}`
                );
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (responseData.stat == "warning") {
                toastr[responseData.stat](
                    `${responseData.status_m}, ${responseData.message}`
                );
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        } catch (err) {
            console.log("Error fetching the data" + err);
        }
    }}
    if(selectedRole == 'Admin'){

        try {
            const response = await fetch(APP_URL + "/settings/members/_edit", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify(data), // Convert the object to JSON string
            });
            const responseData = await response.json();

            if (responseData.stat == "success") {
                toastr[responseData.stat](
                    `${responseData.status_m}, ${responseData.message}`
                );
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (responseData.stat == "warning") {
                toastr[responseData.stat](
                    `${responseData.status_m}, ${responseData.message}`
                );
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        } catch (err) {
            console.log("Error fetching the data" + err);
        }

    }
    });

    // edit
    var edit_id;
    $(document).on("click", ".editing", async function (e) {
        var targetId = e.target.id;
        var id = targetId.split("-");
        edit_id = id;
        const actionLabel = document.getElementById("actionLabel");
        const labeling = document.getElementById("labeling");
        actionLabel.textContent = "EDITING";
        labeling.textContent = "UPDATE";
        $addTeamModal.css("display", "flex");
        const addButton = document.querySelector(".add-team-button");
        addButton.className = "edit-team-button";
        $addTeamModal.toggle("puff", { percent: 100, easing: "swing" }, 100);
        $addTeamModal2.toggle("puff", { percent: 100, easing: "swing" }, 900);

        var data = {
            edit_id: edit_id[1],
        };

        try {
            const response = await fetch(
                APP_URL + "/settings/members/_getedit",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    body: JSON.stringify(data), // Convert the object to JSON string
                }
            );
            const responseData = await response.json();

            if (responseData.stat == "warning") {
                console.log(responseData.server.skla);
                var fullname = document.getElementById("newuser_fname");
                var email = document.getElementById("newuser_email");
                var apiaccess = document.querySelector(
                    'input[name="grant-api"]'
                );
                var adminRadio = document.querySelector('input[value="Admin"]');
                var memberRadio = document.querySelector(
                    'input[value="Member"]'
                );
                var emailSpan = document.getElementById("emailSpansa");
                var parentspan = document.getElementById("emailSpan");
                fullname.value = responseData.server.skla;
                email.value = responseData.server.komgks;
                apiaccess.checked = responseData.server.kolaj;
                if (responseData.server.lokei === "Admin") {
                    adminRadio.checked = true;
                } else if (responseData.server.lokei === "Member") {
                    memberRadio.checked = true;
                }
                if (responseData.server.ldrof == 1) {
                    // Hide the input field
                    email.style.display = "none";

                    // Set the text content of the span
                    emailSpan.textContent = email.value; // You can set any text content here

                    // Show the span
                    parentspan.style.display = "flex";
                }
            }


        } catch (err) {
            console.log("Error fetching the data" + err);
        }
    });

    // deleting team members start

    $(document).on("click", ".deleting", async function (e) {
        var targetId = e.target.id;
        var id = targetId.split("-");

        const response = await fetch(APP_URL + "/settings/members/_delete/" + id[1], {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },

        });
        const responseData = await response.json();

        if (responseData.stat == "success") {
            toastr[responseData.stat](
                `Success! ${responseData.message}`
            );
            setTimeout(function () {
                location.reload();
            }, 1000);
        } else if (responseData.stat == "warning") {
            toastr[responseData.stat](
                `Warning! ${responseData.message}`
            );

        }
    });

    // deleting team members end

    $.fn.hasAttr = function (name) {
        return this.attr(name) !== undefined;
    };
    // api access
    $('input[name="grant-api-access"]').change(async function (e) {
        var targetId = e.target.id;
        var id = targetId.split("-"); // Corrected the split method call
        var isChecked = $(this).is(":checked");
        console.log(id[1]);
        console.log(isChecked);
        var data = {
            id: id[1],
            api_access: isChecked,
        };

        const response = await fetch(APP_URL + "/settings/members/_apiaccess", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            body: JSON.stringify(data),
        });

        const responseData = await response.json();

        if (responseData.stat == 'success') {

            toastr[responseData.stat](`Success! ${responseData.message}`);
        }
        if (responseData.stat == 'warning') {
            if(isChecked){
                $('#toggle_api-' + id[1]).prop('checked', false);
            }
            if(!isChecked){
                $('#toggle_api-' + id[1]).prop('checked', true);
            }

            toastr[responseData.stat](`Warning! ${responseData.message}`);
        }
    });
    $('input[name="grant-admin-access"]').change(async function (e) {
        var targetId = e.target.id;
        var id = targetId.split("-"); // Corrected the split method call
        var isChecked = $(this).is(":checked");
        var apiaccess = $('input[name="grant-api-access"]').is(':checked');
        var data = {
            id: id[1],
            admin_access: isChecked,
        };

        const response = await fetch(
            APP_URL + "/settings/members/_adminaccess",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify(data),
            }
        );

        const responseData = await response.json();

        if (responseData.stat == 'success') {
            if(responseData.api_access == false){
                $('#toggle_api-' + id[1]).prop('checked', false);
                    console.log(apiaccess);

            }
            toastr[responseData.stat](`Success! ${responseData.message}`);
        }
        if(responseData.stat == 'warning'){
            if(isChecked){
                $('#toggle_admin-' + id[1]).prop('checked', false);
            }
            if(!isChecked){
                $('#toggle_admin-' + id[1]).prop('checked', true);
            }



            toastr[responseData.stat](`Warning! ${responseData.message}`);

        }
    });




});
