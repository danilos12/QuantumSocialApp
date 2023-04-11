/**
 * Authors: Faith Hidalgo
 * 
 */
$(function($) {
    // // emoji-picker
    // $("#emojionearea").emojioneArea({
    //     // container: "#primary_post_text_area", // by selector
    //     pickerPosition: "left",
    //     filtersPosition: "bottom",
    //     tonesStyle: "square",
    //     recentEmojis: false,
    //     search: false,
    //     tones: false,
    // });

    // $(".primary-post-right-buttons .add-emoji-icon").on("click", function () {
    //     var isOpen = $(this).data("emoji-open");

    //     if (isOpen == 0) {
    //         $(this).data("emoji-open", 1);
    //         $(".emojionearea-button").addClass("active");
    //         $(
    //             ".emojionearea-picker.emojionearea-picker-position-left.emojionearea-filters-position-bottom.emojionearea-search-position-top"
    //         ).removeClass("hidden");
    //     } else {
    //         $(this).data("emoji-open", 0);
    //         $(".emojionearea-button").removeClass("active");
    //         $(
    //             ".emojionearea-picker.emojionearea-picker-position-left.emojionearea-filters-position-bottom.emojionearea-search-position-top"
    //         ).addClass("hidden");
    //     }
    // });

    // pull hashtags from database
    $.ajax({
        type: "GET",
        url: APP_URL + "/cmd/get-tag-groups/" + TWITTER_ID, // Use the URL of your server-side script here
        success: function(response) {
            // Add the existing tag groups to the page
            $.each(response, function(index, k) {
                var option = $("<option>")
                    .addClass("modal-select-tag-group")
                    .attr("value", k.tag_group_mkey)
                    .text(k.tag_group_mvalue);
                $(option).appendTo($("select#tag-groups"));
            });
        },
        error: function(xhr, status, error) {
            console.log(
                "An error occurred while fetching the existing tag groups: " +
                error
            );
        },
    });

    // pull non selected twitter from database
    $.ajax({
        type: "GET",
        url: APP_URL + "/cmd/unselected", // Use the URL of your server-side script here
        data: {
            twitter_id: TWITTER_ID,
        },
        success: function(response) {
            // Add the existing tag groups to the page
            if (response.length > 0) {
                $.each(response, function(index, k) {
                    var img = $("<img>")
                        .addClass("cross-tweet-profile-image")
                        .attr("src", k.twitter_photo)
                        .attr("id", "twitterId-" + k.twitter_id);

                    $(img).appendTo($(".cross-tweet-profiles-inner.cmd"));
                });
            } else {
                $(".posting-tool-columns")
                    .find(".cross-tweet-profiles-outer")
                    .append("<div>No other twitter accounts linked</div>");
            }
        },
        error: function(xhr, status, error) {
            console.log(
                "An error occurred while fetching the existing tag groups: " +
                error
            );
        },
    });

    // bgIcon and post types
    const $postPanels = $("div[data-post]");
    const $postIcon = $("img[data-type]");
    let $lastButtonClicked = null;
    $(".post-type-buttons img").on("click", function() {
        var type = $(this).data("type");

        $('#post_type_tweets').val(type);

        // Check if clicked icon is a regular icon (not tweetstorm)
        if (type !== "tweet-storm-tweets") {
            // Check if tweetstorm is already active
            if ($("#select-tweet-storm-icon").data("select") === 1) {
                // Check if clicked icon is already active //deactivated
                if ($(this).hasClass("icon-active")) {
                    // Remove active class from clicked icon
                    $(this).removeClass("icon-active");
                    // $(`.primary-post-area-wrap`).find(`img.post-type-indicator`).removeClass("indicator-active");
                    // $(`.primary-post-area-wrap`).find(`img.post-type-indicator[data-src="tweet-storm-tweets"]`).addClass("indicator-active");
                    disableWatermark("tweet-storm-tweets");
                    console.log(1)

                    $postPanels.filter(`div[data-post=${type}]`).addClass('tweets-hide')
                } else {
                    // Remove active class from other regular icons and add to clicked icon
                    $("#post_type_tweets").val(type);                    
                    $(".post-type-buttons img[data-type!='tweet-storm-tweets']").removeClass("icon-active");
                    $(this).addClass("icon-active");

                    $(`.primary-post-area-wrap`).find(`img.post-type-indicator`).removeClass("indicator-active");
                    $(`.primary-post-area-wrap`).find(`img.post-type-indicator[data-src="${type === "evergreen-tweets"? "evergreen-storm-tweets" : "promos-storm-tweets"}"]`).addClass("indicator-active");
                    
                    if ($('.more-tweets-roster .add-tweet-outer').length > 0) {
                        $(".new-post-area-wrap").find("img.post-type-indicator").removeClass("indicator-active");
                        $(`.new-post-area-wrap img.post-type-indicator[data-src="${type === "evergreen-tweets"? "evergreen-storm-tweets" : "promos-storm-tweets"}"]`).addClass('indicator-active')
                    }

                    // hide panel from previous clicked icon except tst, add panel for the clicked icon
                    $postPanels.filter(`div[data-post!='tweet-storm-tweets']`).addClass('tweets-hide')
                    $postPanels.filter(`div[data-post=${type}]`).removeClass('tweets-hide')

                    if (type === "comments-tweets") {
                        originalState();
                        $(this).data('select', 1).addClass('icon-active')
                        $(".cross-tweet-profiles-outer").addClass("tweets-hide");
                        $postIcon.filter("img.post-tool-icon").addClass("disabled"); // disable all the icons
                        $postIcon.filter('img[data-type="comments-tweets"]').removeClass("disabled"); // enable the comment icon
                        $("span.primary-post-option-buttons").find("img.retweet-timer-icon").addClass("tweets-hide");
                        $("img[data-type='tweet-storm-tweets']").data('select', 0)
                    }

                    console.log(1)
                }
            } else {
                if ($(this).hasClass("icon-active")) {
                    // Remove active class from clicked icon
                    $("#post_type_tweets").val("regular_tweets");
                    $(this).removeClass("icon-active");
                    $("span.primary-post-option-buttons").find("img.retweet-timer-icon").removeClass("tweets-hide");

                    // $postPanels.find(`[data-post="${type}"]`).addClass('tweets-hide')
                    $postPanels.addClass('tweets-hide')
                    $postPanels.find(`div[data-post=${type}]`).removeClass('tweets-hide')                    

                    disableWatermark("twitter-tweets", "")


                    if (type === "comments-tweets") {
                        $(".cross-tweet-profiles-outer").removeClass("tweets-hide");
                        $postIcon.filter("img.post-tool-icon").removeClass("disabled"); // disable all the icons
                    }

                    if (type === "tweet-storm-active") {
                        confirmation(type);
                    }
                } else {
                    // If tweetstorm is not active, remove active class from other regular icons and add to clicked icon
                    $(".post-type-buttons img[data-type!='tweet-storm-tweets']").removeClass("icon-active");
                    $(this).addClass("icon-active");

                    // $postPanels.find("[data-post!='tweet-storm-tweets']").addClass("tweets-hide");
                    $postPanels.filter("[data-post!='tweet-storm-tweets']").addClass("tweets-hide"); console.log(11)
                    $("span.primary-post-option-buttons").find("img.retweet-timer-icon").addClass("tweets-hide");
                                      
                    disableWatermark(type, "")

                    if (type === "retweet-tweets") {
                        $("span.primary-post-option-buttons").find("img.retweet-timer-icon").removeClass("tweets-hide");
                    }

                    if (type === "comments-tweets") {
                        $(".cross-tweet-profiles-outer").addClass("tweets-hide");
                        $postIcon.filter("img.post-tool-icon").addClass("disabled"); // disable all the icons
                        $postIcon.filter('img[data-type="comments-tweets"]').removeClass("disabled"); // enable the comment icon
                        $(".more-tweets-roster").empty();
                    }


                }
            }
        } else {
            // If clicked icon is tweetstorm, toggle active class
            $(this).toggleClass("icon-active");
            
            if ($(".post-type-buttons img[data-type!='tweet-storm-tweets']").hasClass("icon-active")) {
                var combo = $("img[data-type!='tweet-storm-tweets'].icon-active").attr("data-type")
                disableWatermark(type, combo)            
                console.log('change icon in text area')
                
                $("#post_type_tweets").val(combo);
            } else {
                disableWatermark(type);
                console.log(12);                            
            }

            if ($(".more-tweets-roster .add-tweet-outer").length > 0) {
                confirmation("tweet-storm-tweets");
            } else {
                var combod = $("img[data-type!='tweet-storm-tweets'].icon-active").attr("data-type")
                addTweetTextArea(type, ($("img[data-type!='tweet-storm-tweets'].icon-active").length > 0) ? combod : "");
            }
        }

        // Toggle select data attribute on clicked icon
        $(this).data("select", $(this).hasClass("icon-active") ? 1 : 0);
        ($(this).hasClass("icon-active")) ?
            $postPanels.filter(`[data-post=${type}]`).removeClass("tweets-hide") :        
            $postPanels.filter(`[data-post=${type}]`).addClass("tweets-hide");
        
    });

    // selecting the hashtag
    $("select#tag-groups").on("click", function(e) {
        $(".modal-tag-group-display").empty();
        $.ajax({
            type: "GET",
            url: APP_URL + "/cmd/get-tag-items/", // Use the URL of your server-side script here
            data: {
                twitter_id: TWITTER_ID,
                tag_id: this.value,
            },
            success: function(response) {
                // Add the existing tag groups to the page
                if (response.length > 0) {
                    $.each(response, function(index, k) {
                        // console.log(k);
                        var span = $("<span>")
                            .addClass("modal-tag-instance")
                            .text(k.tag_meta_value);
                        $(span).appendTo($(".modal-tag-group-display"));
                    });
                }

                // add active in hashtag instance
                $(".modal-tag-instance").click(function(e) {
                    $(this).attr("status", "active");
                });

                // console.log(response);
            },
            error: function(xhr, status, error) {
                console.log(
                    "An error occurred while fetching the existing tag groups: " +
                    error
                );
            },
        });
    });

    // send tags to textarea
    $(".tags-submit").on("click", function() {
        const activeTags = $(".modal-tag-instance[status='active']");
        const activeTagTexts = activeTags
            .map(function() {
                return $(this).text().trim();
            })
            .get();

        // div
        // var textArea = $("#emojionearea");
        // var textInside = textArea.text();
        // var withTags = textInside + " " + activeTagTexts.join(" ");
        // console.log(withTags);
        // textArea.text(withTags);

        // textarea
        var textArea = $("#emojionearea");
        var textInside = textArea.val();
        var withTags = textInside + " " + activeTagTexts.join(" ");
        textArea.val(withTags);

        // textwithmoji
        // var textAreaMoji = $(".emojionearea-editor");
        // var textInsideMoji = textAreaMoji.html();
        // var withTagsMoji = textInsideMoji + " " + activeTagTexts.join(" ");
        // textAreaMoji.html(withTagsMoji);
    });

    // retweet toggle the section (open)
    $("img.retweet-timer-icon").on("click", function() {
        var id = $(this).attr("data-type");

        $(this).toggleClass("icon-active");
        $postPanels.filter(`[data-post="${id}"]`).toggleClass("tweets-hide");
    });

    // post counter
    $(".primary-post-option-buttons").on(
        "click",
        "span.post-counter",
        function(e) {
            // for textbox
            var mainTextBox = $(".primary-post-area-wrap")
                .find('[name="tweet_text_area"]')
                .val();

            // for div
            // var mainTextBox = $(".primary-post-area-wrap")
            //     .find('[name="tweet_text_area"]')
            //     .text();


            var getPagination = $(".primary-post-option-buttons")
                .find(".post-counter")
                .text();
            var textWithPagination = `${mainTextBox}\n${getPagination}`;
            console.log(textWithPagination);
            // text area
            $(".primary-post-area-wrap")
                .find('[name="tweet_text_area"]')
                .val(textWithPagination);

            // div   
            // $(".primary-post-area-wrap")
            //     .find('[name="tweet_text_area"]')
            //     .text(textWithPagination);

            if ($(".add-tweet-outer").length > 0) {
                $(".add-tweet-outer").each(function(e) {
                    var currentVal = $(this)
                        .find(`.new-post-area[name="tweet_text_area_${e}"]`)
                        .val();

                    var getPagination1 = $(this).find(".post-counter").text();
                    var newTextWithPagination = `${currentVal}\n${getPagination1}`;

                    $(this)
                        .find(`.new-post-area[name="tweet_text_area_${e}"]`)
                        .val(newTextWithPagination);
                });
            }
        }
    );

    // add new text area instance
    $(".posting-tool-col").on("click", ".add-tweet-initial", function() {

        var type = null;
        var combo = null;

        if ($(".post-type-buttons img[data-type!='tweet-storm-tweets']").hasClass("icon-active")) {
            type = $(".post-type-buttons img[data-type!='tweet-storm-tweets'].icon-active").attr('data-type');                        
            combo = $(".post-type-buttons img[data-type!='tweet-storm-tweets'].icon-active").attr('data-type');                        
        } else {
            type = "tweet-storm-tweets";

        }

        addTweetTextArea(type, combo);
        $postIcon.filter('img[data-type="tweet-storm-tweets"]').addClass('icon-active');
        $postPanels.filter('div[data-post="tweet-storm-tweets"]').removeClass('tweets-hide');
    });


    $(document).on("click", ".remove-new-tweet", function() {
        var removedBlock = $(this).closest(".add-tweet-outer");
        // var indexToRemove = removedBlock.attr("id", "textbox-");

        removedBlock.remove();
        // console.log(indexToRemove);

        var totalItems = $(".add-tweet-outer").length + 1;
        $(".add-tweet-outer").each(function(i, k) {
            var newId = "textbox-" + i;
            $(this).attr("id", newId).attr("name", newId);
            $(this).find("span.post-counter").text(`${i + 2}/${totalItems}`);
            console.log(i + 1)
        });
        $(".primary-post-option-buttons span").text(
            `1/${totalItems}`
        );
    });

    $(document).on("click", ".add-image-icon", function() {
        // programmatically click the hidden file input field
        $("#image-upload-input").trigger("click");

    });

    $("#image-upload-input").on("change", function(e) {
        var file = e.target.files[0];
        console.log(file)
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('style', '')
                $("#image-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // time
    $(".custom-dhms").on("change", function() {
        var bgg = $(this).attr("data-check");

        var txx = $('select[data-info="' + bgg + '"]');
        var opp = "";

        txx.html("");

        if ($(this).val() == "hours") {
            for (let i = 1; i < 24; i++) {
                opp += '<option value="' + i + '">' + i + "</option>";
            }
        }

        if ($(this).val() == "days") {
            for (let i = 1; i <= 90; i++) {
                opp += '<option value="' + i + '">' + i + "</option>";
            }
        }

        if ($(this).val() == "mins") {
            for (let i = 1; i <= 59; i++) {
                opp += '<option value="' + i + '">' + i + "</option>";
            }
        }

        if ($(this).val() == "seconds") {
            for (let i = 1; i <= 59; i++) {
                opp += '<option value="' + i + '">' + i + "</option>";
            }
        }

        txx.append(opp);
        // console.log("iterations");
    });

    // schedule
    $('select[name="scheduling-options"]').on("change", function() {
        var fvv = $("#scheduling-method-xxx");
        var svv = $(this).val();
        var sopp = "";

        fvv.attr("data-schedule", "none");

        $("#scheduling-cdn").removeAttr("data-info name");
        $("#scheduling-cdmins").removeAttr("data-check name");

        if (svv == "set-countdown") {
            fvv.attr("data-schedule", svv);

            $("#scheduling-cdn").attr({
                "data-info": svv,
                name: "c-" + svv
            });
            $("#scheduling-cdmins").attr({
                "data-check": svv,
                name: "ct-" + svv,
            });

            $("#scheduling-cdn").html("");

            for (let i = 1; i <= 59; i++) {
                sopp += '<option value="' + i + '">' + i + "</option>";
            }

            $("#scheduling-cdn").append(sopp);
        }
        if (svv == "custom-time") {
            fvv.attr("data-schedule", svv);
            $("#scheduling-cdn").attr({
                "data-info": svv,
                name: "c-" + svv
            });
            $("#scheduling-cdmins").attr({
                "data-check": svv,
                name: "ct-" + svv,
            });

            $("#scheduling-cdn").html("");

            for (let i = 1; i <= 59; i++) {
                sopp += '<option value="' + i + '">' + i + "</option>";
            }

            $("#scheduling-cdn").append(sopp);
        }

        // console.log("scheduling");
    });

    // cross tweet profiles
    $(".cross-tweet-profiles-inner").on(
        "click",
        "img.cross-tweet-profile-image",
        function(e) {
            // e.preventDefault();
            console.log(e);
            if ($(this).attr("status") === "active") {
                $(this).attr("status", ""); // remove the active when it was active
            } else {
                $(this).attr("status", "active");
            }
        }
    );


    // form submit
    $("#posting-tool-form-001").on("submit", function(e) {
        const form = $(this);
        e.preventDefault();

        var crossTweet = [];

        $(".cross-tweet-profiles-inner.cmd img").each(function() {
            if ($(this).attr("status")) {
                crossTweet.push(this.id);
            }
        });

        var crossTweetAcct = "";
        if (crossTweet.length > 0) {
            crossTweet.forEach(function(e, index) {
                console.log(e, index);
                crossTweetAcct += `&crossTweetAcct_${index}=${e.split("-")[1]}`;
            });
        }

        const $form = $(form).serialize();
        const textarea = $(".post-textarea").text();
        // const formData = `${$form}&twitter_id=${TWITTER_ID}${crossTweetAcct}&tweet_text_area=${textarea}`;
        const formData = `${$form}&twitter_id=${TWITTER_ID}${crossTweetAcct}`
        const params = {};
        formData.split("&").forEach((param) => {
            const [key, value] = param.split("=");
            params[key] = value;
        });

        // console.log(params)


        form.find('input[type="submit"]').prop("disabled", true);
        form.find('input[type="submit"]').val("Please wait..");

        $.ajax({
            url: APP_URL + "/cmd/save",
            method: "POST",
            data: params,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                // Handle the server response here
                console.log(response);
                form.find('input[type="submit"]').prop("disabled", false);
                form.find('input[type="submit"]').val("Data Saved!");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.log(jqXHR, textStatus, errorThrown);
            },
            complete: function() {
                // loop through each input field in the form
                for (let i = 0; i < form[0].elements.length; i++) {
                    // console.log(form[0].elements.length)
                    const element = form[0].elements[i];
                    // console.log(element)

                    // check if the element is an input field      
                    if (
                        element.nodeName === "INPUT" ||
                        element.nodeName === "SELECT" ||
                        element.nodeName === "TEXTAREA"
                    ) {
                        // clear the value of the input field
                        element.value = "";
                        // console.log(element.nodeName)
                        // console.log(element.value)
                    }
                }

                originalState();

                form.find('input[type="submit"]').val("Beam me up scotty!");
            },
        });
    });

    function confirmation(type) {
        if (confirm("Do you want to cancel or your changes?")) {
            // User clicked "Yes"
            originalState();
        }
    }

    function originalState() {
        // console.log(type)
        $(".cross-tweet-profiles-inner.cmd img").attr("status", "");

        disableWatermark("twitter-tweets")
        $postIcon.removeClass("icon-active");
        $postPanels.addClass("tweets-hide");
        $postPanels.find('[data-post="tweet-storm-tweets"]').addClass("tweets-hide");
        $(".more-tweets-roster").empty();
        $("#post_type_tweets").val("regular_tweets");
    }


    function disableWatermark(src, combo = null) {

        var source = (combo) ? (combo === "evergreen-tweets") ? "evergreen-storm-tweets" : "promos-storm-tweets" : (src === "add-tweet-initial") ? src: src;
        console.log(src)
        console.log(combo)
        console.log(source)

        $(".primary-post-area-wrap").find("img.post-type-indicator").removeClass("indicator-active");
        $(`.primary-post-area-wrap img.post-type-indicator[data-src="${source}"]`).addClass("indicator-active");

        if (combo) {
            $(".new-post-area-wrap").find("img.post-type-indicator").removeClass("indicator-active");
            $(`.new-post-area-wrap img.post-type-indicator[data-src="${source}"]`).addClass('indicator-active')
        } else {
            console.log("add initial")
            $(".new-post-area-wrap").find("img.post-type-indicator").removeClass("indicator-active");
            $('.new-post-area-wrap').find('img.post-type-indicator[data-src="tweet-storm-tweets"]').addClass('indicator-active')
        }
    }

    var itemsPerPage = 10;
    var numItems = $(".new-post-area").length;
    var numPages = Math.ceil(numItems / itemsPerPage);

    function addTweetTextArea(entryPoint, combo) {

        // if (entryPoint === "add-tweet-initial") {
        //     $postIcon
        //         .filter('[data-type="tweet-storm-tweets"]')
        //         .addClass("icon-active");
        //     $postPanels
        //         .filter('[data-post="tweet-storm-tweets"]')
        //         .removeClass("tweets-hide");
        //     // disableWatermark("tweet-storm-tweets", 259);
        // }
              
            
       

        var newTextbox = tweetInstance(numItems);
        newTextbox = $(newTextbox);

        // Increment the ID and name attributes of the input element
        var newId = "textbox-" + (numItems + 1);
        newTextbox
            .find(".add-tweet-outer")
            .attr("id", newId)
            .attr("name", newId);

        // Append the new textbox to the container
        $(".more-tweets-roster").append(newTextbox);

        // Increment the number of items and pages
        numItems++;
        numPages = Math.ceil(numItems / itemsPerPage);

        disableWatermark(entryPoint, combo);

        // Update page info
        updateItemInfo();
    }

    function updateItemInfo() {
        // Update current page based on current item count and items per page
        var currentPage = Math.ceil(
            $(".add-tweet-outer").length / itemsPerPage
        );
        var totalItems = $(".add-tweet-outer").length + 1;
        var startIndex = (currentPage - 1) * itemsPerPage + 1;
        var endIndex = Math.min(currentPage * itemsPerPage, totalItems);
        // console.log(currentPage, totalItems, startIndex, endIndex);

        $(".add-tweet-outer").each(function(index) {
            // get the textbox element
            var textbox = $(this);
            // console.log(textbox, index);

            // update the page info for this textbox
            var newId = "textbox-" + index;
            textbox.attr("id", newId).attr("name", newId);
            textbox
                .find("span.post-counter")
                .text(`${currentPage + index + 1}/${totalItems}`);
        });

        $(".primary-post-option-buttons span").text(
            `${startIndex}/${totalItems}`
        );
    }

    // add new tweet instance
    function tweetInstance(items) {
        var times = ["seconds", "mins", "hours", "days"];
        var option = "";
        for (var i = 0; i < 59; i++) {
            option += `<option value="${i}">${i}</option>`;
        }
        var time = times
            .map((time) => `<option value="${i}">${time}</option>`)
            .join("");
        var $template = `
			<div class="add-tweet-outer" id="${items}">
				<div class="add-tweet-inner">
					<div class="wait-to-tweet-col">
                        <span class="wait-title">Wait</span>
                        <select id="wait-number" name="wait-number_${items}" data-info="wait-timer" class="wait-number">
                            ${option}
                        </select>
                        <select id="wait-duration" name="wait-duration" data-check="wait-timer" class="custom-dhms wait-duration" >
                            ${time}
                        </select>
					</div>  <!-- END .wait-to-tweet-col -->
					<div class="new-post-wrap add-tweet-col">
                        <div class="post-area-left new-post-left">
                            <div class="post-area-wrap new-post-area-wrap">                                
                                <img src="${APP_URL}/public/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator indicator-active" data-src="tweet-storm-tweets" />
                                <img src="${APP_URL}/public/ui-images/icons/16-evergreen-storm.svg" class="ui-icon post-type-indicator" data-src="evergreen-storm-tweets"/>
                                <img src="${APP_URL}/public/ui-images/icons/17-promos-storm.svg" class="ui-icon post-type-indicator" data-src="promos-storm-tweets" />
                                <textarea class="post-textarea new-post-area" name="tweet_text_area_${items}" ></textarea>  <!-- END .primary-post-area -->
                            </div>  <!-- END .post-area-wrap -->
                            <div class="post-bottom-buttons new-post-bottom-buttons">
                                <span class="post-type-buttons new-post-type-buttons"></span>  <!-- END .post-type-buttons -->
                                <span class="post-option-buttons new-post-option-buttons">							
                                    <span class="post-counter"></span>
                                </span>  <!-- END .post-option-buttons -->
                            </div>  <!-- END .post-bottom-buttons -->
                        </div>  <!-- END .post-area-left -->

                        <div class="post-area-right new-post-right">
                            <div class="post-right-buttons new-post-right-buttons">
                                <img src="${APP_URL}/public/ui-images/icons/pg-close.svg" class="ui-icon post-tool-icon remove-new-tweet" /><br />
                                <img src="${APP_URL}/public/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon" /><br />
                                <img src="${APP_URL}/public/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon" /><br />
                                <img src="${APP_URL}/public/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon" /><br />
                            </div>  <!-- END .post-right-buttons -->
                        </div>  <!-- END .post-area-right -->
					</div>  <!-- END .new-post-wrap -->
				</div>  <!-- END .add-tweet-inner -->
				<img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon add-tweet-icon add-tweet-again-button" />
			</div> 
				`;

        return $template;
    }
});
