/**
 * Authors: Faith Hidalgo
 *
 */
// $(function ($) {
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

    /** emoji */
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

    /** Pull tags */
    // $.ajax({
    //     type: "GET",
    //     url: APP_URL + "/cmd/get-tag-groups/" + TWITTER_ID, // Use the URL of your server-side script here
    //     success: function (response) {
    //         console.log(response);
    //         $.each(response, function (index, k) {
    //             var option = $("<option>")
    //                 .addClass("modal-select-tag-group")
    //                 .attr("value", k.tag_group_mkey)
    //                 .text(k.tag_group_mvalue);
    //             $(option).appendTo($("select#tag-groups"));
    //         });
    //     },
    //     error: function (xhr, status, error) {
    //         console.log(
    //             "An error occurred while fetching the existing tag groups: " +
    //                 error
    //         );
    //     },
    // });
  

    /** Pull selected twitter account */
    $.ajax({
        type: "GET",
        url: APP_URL + "/cmd/unselected", // Use the URL of your server-side script here
        data: {
            twitter_id: TWITTER_ID,
        },
        success: function(response) {

            // console.log(response)
            // Add the existing tag groups to the page
            if (response.length > 0) {
                $.each(response, function(index, k) {
                    var img = $("<img>")
                        .addClass("cross-tweet-profile-image")
                        .attr("src", k.twitter_photo)
                        .attr("id", "twitterId-" + k.twitter_id)
                        .attr("name", 'cross_tweet_acct[]')

                    $(img).appendTo($(".cross-tweet-profiles-inner.cmd"));
                });
            } else {
                $(".posting-tool-columns")
                    .find(".cross-tweet-profiles-outer")
                    .append("<div>No other X accounts linked</div>");
            }
        },
        error: function(xhr, status, error) {
            console.log(
                "An error occurred while fetching the existing tag groups: " +
                error
            );
        },
    });

    /** Post type and BgIcon */
    const $postPanels = $("div[data-post]");
    const $postIcon = $("img[data-type]");
    let $lastButtonClicked = null;
    $(".post-type-buttons img").on("click", function (e) {
        console.log(e.currentTarget);
        var type = $(this).data("type");

        $("#post_type_tweets").val(type);

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

                    $postPanels
                        .filter(`div[data-post=${type}]`)
                        .addClass("tweets-hide");
                } else {
                    // Remove active class from other regular icons and add to clicked icon
                    $("#post_type_tweets").val(type);
                    $(
                        ".post-type-buttons img[data-type!='tweet-storm-tweets']"
                    ).removeClass("icon-active");
                    $(this).addClass("icon-active");

                    var dtype =
                        type === "evergreen-tweets"
                            ? "evergreen-storm-tweets"
                            : type === "retweet-tweets"
                            ? "retweet-tweets"
                            : "promos-storm-tweets";

                    $(`.primary-post-area-wrap`)
                        .find(`img.post-type-indicator`)
                        .removeClass("indicator-active");
                    $(`.primary-post-area-wrap`)
                        .find(`img.post-type-indicator[data-src="${dtype}"]`)
                        .addClass("indicator-active");

                    if ($(".more-tweets-roster .add-tweet-outer").length > 0) {
                        $(".new-post-area-wrap")
                            .find("img.post-type-indicator")
                            .removeClass("indicator-active");
                        $(
                            `.new-post-area-wrap img.post-type-indicator[data-src="${dtype}"]`
                        ).addClass("indicator-active");
                    }

                    // hide panel from previous clicked icon except tst, add panel for the clicked icon
                    $postPanels
                        .filter(`div[data-post!='tweet-storm-tweets']`)
                        .addClass("tweets-hide");
                    $postPanels
                        .filter(`div[data-post=${type}]`)
                        .removeClass("tweets-hide");

                    if (type === "comments-tweets") {
                        // originalState();
                        $postIcon
                            .filter("img.post-tool-icon")
                            .removeClass("icon-active"); // d
                        $(this).data("select", 1).addClass("icon-active");
                        $(".cross-tweet-profiles-outer").addClass(
                            "tweets-hide"
                        );

                        $postIcon
                            .filter("img.post-tool-icon")
                            .addClass("disabled"); // disable all the icons
                        $postIcon
                            .filter('img[data-type="comments-tweets"]')
                            .removeClass("disabled"); // enable the comment icon
                        // $postIcon.filter('img[data-type="comments-tweets"]').addClass("icon-active"); // disable all the icons

                        $(`.primary-post-area-wrap`)
                            .find(`img.post-type-indicator`)
                            .removeClass("indicator-active");
                        $(`.primary-post-area-wrap`)
                            .find(
                                `img.post-type-indicator[data-src="comments-tweet"]`
                            )
                            .addClass("indicator-active");

                        $postPanels
                            .filter("div.post-alert")
                            .addClass("tweets-hide");
                        $("span.primary-post-option-buttons")
                            .find("img.retweet-timer-icon")
                            .addClass("tweets-hide");
                        $("img[data-type='tweet-storm-tweets']").data(
                            "select",
                            0
                        );
                        $(".more-tweets-roster").empty();
                    }
                }
            } else {
                if ($(this).hasClass("icon-active")) {
                    // Remove active class from clicked icon
                    $("#post_type_tweets").val("regular_tweets");
                    $(this).removeClass("icon-active");
                    $("span.primary-post-option-buttons")
                        .find("img.retweet-timer-icon")
                        .removeClass("tweets-hide");

                    // $postPanels.find(`[data-post="${type}"]`).addClass('tweets-hide')
                    $postPanels.addClass("tweets-hide");
                    $postPanels
                        .find(`div[data-post=${type}]`)
                        .removeClass("tweets-hide");

                    disableWatermark("twitter-tweets", "");

                    if (type === "comments-tweets") {
                        $(".cross-tweet-profiles-outer").removeClass(
                            "tweets-hide"
                        );
                        $postIcon
                            .filter("img.post-tool-icon")
                            .removeClass("disabled"); // disable all the icons
                    }

                    if (type === "tweet-storm-tweets") {
                        console.log(12);
                        confirmation(type);
                    }
                } else {
                    // If tweetstorm is not active, remove active class from other regular icons and add to clicked icon
                    $(
                        ".post-type-buttons img[data-type!='tweet-storm-tweets']"
                    ).removeClass("icon-active");
                    $(this).addClass("icon-active");

                    // $postPanels.find("[data-post!='tweet-storm-tweets']").addClass("tweets-hide");
                    $postPanels
                        .filter("[data-post!='tweet-storm-tweets']")
                        .addClass("tweets-hide");
                    $("span.primary-post-option-buttons")
                        .find("img.retweet-timer-icon")
                        .addClass("tweets-hide");

                    disableWatermark(
                        type,
                        $(".add-tweet-outer").length > 0 ? type : ""
                    );

                    if (type === "retweet-tweets") {
                        $("span.primary-post-option-buttons")
                            .find("img.retweet-timer-icon")
                            .removeClass("tweets-hide");
                    }

                    if (type === "comments-tweets") {
                        $(".cross-tweet-profiles-outer").addClass(
                            "tweets-hide"
                        );
                        $postIcon
                            .filter("img.post-tool-icon")
                            .addClass("disabled"); // disable all the icons
                        $postIcon
                            .filter('img[data-type="comments-tweets"]')
                            .removeClass("disabled"); // enable the comment icon
                        $(".more-tweets-roster").empty();
                    }
                }
            }
        } else {
            // If clicked icon is tweetstorm, toggle active class
            $(this).toggleClass("icon-active");

            if (
                $(
                    ".post-type-buttons img[data-type!='tweet-storm-tweets']"
                ).hasClass("icon-active")
            ) {
                var combo = $(
                    "img[data-type!='tweet-storm-tweets'].icon-active"
                ).attr("data-type");
                disableWatermark(type, combo);

                $("#post_type_tweets").val(combo);
            } else {
                disableWatermark(type);
            }

            if ($(".more-tweets-roster .add-tweet-outer").length > 0) {
                confirmation("tweet-storm-tweets");
            } else {
                var combod = $(
                    "img[data-type!='tweet-storm-tweets'].icon-active"
                ).attr("data-type");
                addTweetTextArea(
                    type,
                    $("img[data-type!='tweet-storm-tweets'].icon-active")
                        .length > 0
                        ? combod
                        : "",
                    "posting-tool-form-001", 'add-tweet-initial', ''
                );
            }
        }

        // Toggle select data attribute on clicked icon
        $(this).data("select", $(this).hasClass("icon-active") ? 1 : 0);
        $(this).hasClass("icon-active")
            ? $postPanels
                  .filter(`[data-post=${type}]`)
                  .removeClass("tweets-hide")
            : $postPanels.filter(`[data-post=${type}]`).addClass("tweets-hide");
    });

    /** selecting the hashtag */
    $("select#tag-groups").on("click", function (e) {
        $(".modal-tag-group-display").empty();
        $.ajax({
            type: "GET",
            url: APP_URL + "/cmd/get-tag-items/", // Use the URL of your server-side script here
            data: {
                twitter_id: TWITTER_ID,
                tag_id: this.value,
            },
            success: function (response) {
                // Add the existing tag groups to the page
                if (response.length > 0) {
                    $.each(response, function (index, k) {
                        // console.log(k);
                        var span = $("<span>")
                            .addClass("modal-tag-instance")
                            .text(k.tag_meta_value);
                        $(span).appendTo($(".modal-tag-group-display"));
                    });
                }

                // add active in hashtag instance
                $(".modal-tag-instance").click(function (e) {
                    $(this).attr("status", "active");
                });

                // console.log(response);
            },
            error: function (xhr, status, error) {
                console.log(
                    "An error occurred while fetching the existing tag groups: " +
                        error
                );
            },
        });
    });

    /** send tags to textarea */
    $(".tags-submit").on("click", function () {
        const activeTags = $(".modal-tag-instance[status='active']");
        const activeTagTexts = activeTags
            .map(function () {
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

    /** retweet toggle the section (open) */
    $("img.retweet-timer-icon").on("click", function () {
        var id = $(this).attr("data-type");

        $(this).toggleClass("icon-active");
        $postPanels.filter(`[data-post="${id}"]`).toggleClass("tweets-hide");
    });

    /** add post counter/pagination */
    $(".primary-post-option-buttons").on(
        "click",
        "span.post-counter",
        function () {
            postCounter();
        }
    );

    function postCounter() {
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

        // text area
        $(".primary-post-area-wrap")
            .find('[name="tweet_text_area"]')
            .val(textWithPagination);

        // div
        // $(".primary-post-area-wrap")
        //     .find('[name="tweet_text_area"]')
        //     .text(textWithPagination);

        if ($(".add-tweet-outer").length > 0) {
            $(".add-tweet-outer").each(function (e) {
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

    /** add new text area instance */
    $(".posting-tool-col").on("click", ".add-tweet-initial", function (e) {
        parentForm = $(this).parent().parent().parent().attr("id");
        $('input[id="post_type_tweets"]').val("tweet-storm-tweets");

        var type = null;
        var combo = null;

        if (
            $(
                ".post-type-buttons img[data-type!='tweet-storm-tweets']"
            ).hasClass("icon-active")
        ) {
            type = $(
                ".post-type-buttons img[data-type!='tweet-storm-tweets'].icon-active"
            ).attr("data-type");
            combo = $(
                ".post-type-buttons img[data-type!='tweet-storm-tweets'].icon-active"
            ).attr("data-type");
        } else {
            type = "tweet-storm-tweets";
        }

        if ($(this).hasClass('add-tweet-again-button')) {
            // Get the ID of the textarea associated with this button
            var textareaId = e.target.parentElement.id;
            addTweetTextArea(type, combo, parentForm, 'add-tweet-initial-button', textareaId);
        }
        else {            
            addTweetTextArea(type, combo, parentForm, 'add-tweet-initial', '');
        }

        $postIcon
            .filter('img[data-type="tweet-storm-tweets"]')
            .addClass("icon-active");
        $postPanels
            .filter('div[data-post="tweet-storm-tweets"]')
            .removeClass("tweets-hide");
    });    

    /** remove new tweet instance */
    $(document).on("click", ".remove-new-tweet", function () {
        var removedBlock = $(this).closest(".add-tweet-outer");
        // var indexToRemove = removedBlock.attr("id", "textbox-");

        removedBlock.remove();
        // console.log(indexToRemove);

        var totalItems = $(".add-tweet-outer").length + 1;
        $(".add-tweet-outer").each(function (i, k) {
            var newId = "textbox-" + i;
            $(this).attr("id", newId).attr("name", newId);
            $(this)
                .find("span.post-counter")
                .text(`${i + 2}/${totalItems}`);
        });
        $(".primary-post-option-buttons span").text(`1/${totalItems}`);
    });

    /** image upload */
    // $(document).on("click", ".add-image-icon", function() {
    //     // programmatically click the hidden file input field
    //     $("#image-upload-input").trigger("click");
    // });
    // $("#image-upload-input").on("change", function(e) {
    //     var file = e.target.files[0];
    //     if (file) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             $('#image-preview').attr('style', '')
    //             $("#image-preview").attr("src", e.target.result);
    //         };
    //         reader.readAsDataURL(file);
    //     }
    // });

    /** custom time */
    $(".custom-dhms").on("change", function () {
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

        if ($(this).val() == "minutes") {
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

    /** scheduling method */
    $('select[name="scheduling-options"]').on("change", function (e) {
        var option = $(this).val();
        var div = $("#scheduling-method-" + option);
        var sopp = "";
        console.log(option);
        $(".scheduling-details").html();        

        // $('div[name="scheduling-method"]').filter('div[data-name!="' + option + '"]').attr("data-schedule", "none");
        // $(".date-picker-wrapper").empty()

        // $("#scheduling-cdn").removeAttr("data-info name");
        // $("#scheduling-cdmins").removeAttr("data-check name");

        switch (option) {
            case "set-countdown":
                $(".scheduling-details").css('display', 'block');
                div.attr("data-schedule", option);
                var dropdown = customSetCountdown();
                $(".scheduling-details").html(dropdown);

                $("#scheduling-cdn").attr({
                    "data-info": option,
                    name: "c-" + option,
                });
                $("#scheduling-cdmins").attr({
                    "data-check": option,
                    name: "ct-" + option,
                });
                $("#scheduling-cdn").html("");

                for (let i = 1; i <= 59; i++) {
                    sopp += '<option value="' + i + '">' + i + "</option>";
                }

                $("#scheduling-cdn").append(sopp);
                break;

            case "custom-time":
                $(".scheduling-details").css('display', 'block');
                div.attr("data-schedule", option);
                var dropdown = customTimedropdown();
                $(".scheduling-details").html(dropdown);

                $("img.sched-custom-time").on("click", function (e) {
                    var datepicker = $("<input>")
                        .attr("type", "text")
                        .attr("id", "datepicker")
                        .attr("name", "ct-time-date");

                    // Append the datepicker element to the container
                    $(".date-picker-wrapper").empty().append(datepicker);
                    $("#scheduling-method-custom-time").attr(
                        "style",
                        "display: flex"
                    );
                    $(
                        "#scheduling-method-custom-time .date-picker-wrapper input"
                    ).attr(
                        "style",
                        "font-family: inherit;font-size: inherit;line-height: inherit;margin: 0;padding: 0.5em 1em; color: white"
                    );
                    $("#scheduling-method-custom-time select").attr(
                        "style",
                        "margin: 0 0.2em"
                    );

                    // Initialize the datepicker with the specified options
                    datepicker.datepicker({
                        dateFormat: "dd-mm-yy",
                        duration: "fast",
                    });

                    // Show the datepicker
                    datepicker.datepicker("show");
                });
                break;

            case "custom-slot":
                $(".scheduling-details").css('display', 'block');
                div.attr("data-schedule", option);
                // var dropdown = customSlotdropdown();
                // $('.scheduling-details').html(dropdown)

                var icon = $(".primary-post-type-buttons")
                    .find("img.icon-active")
                    .data("type");
                $("#scheduling-method-custom-slot .inner").attr(
                    "style",
                    "display: flex"
                );
                $(
                    "#scheduling-method-custom-slot .inner .new-slot-time-wrapper1"
                ).attr("style", "margin-left: 0.3em");
                var post_type =
                    typeof icon === "undefined" ? "regular-tweets" : icon;

                getCustomSlot(post_type);
                break;

            default:
                $(".scheduling-details").empty();
                break;
        }
    });

    /** check if buttons don't have class */
    var element = $(".post-type-buttons img");
    element.on("click", function (e) {
        if ($(e.currentTarget).hasClass("icon-active")) {
            // The current target has the class 'icon-active'
            console.log(
                'Current target has the class "icon-active"',
                e.currentTarget.dataset.type
            );
            if (
                e.currentTarget.dataset.type === "evergreen-tweets" ||
                e.currentTarget.dataset.type === "promos-tweets"
            ) {
                $('#scheduling-options option[value="send-now"]').prop(
                    "disabled",
                    true
                );
                $('#scheduling-options option[value="set-countdown"]').prop(
                    "disabled",
                    true
                );
                $('#scheduling-options option[value="custom-time"]').prop(
                    "disabled",
                    true
                );
                $('#scheduling-options option[value="custom-slot"]').prop(
                    "disabled",
                    true
                );
            } else {
                $("#scheduling-options option").removeAttr("disabled");
                $('#scheduling-options option[id="mainselect"]').prop(
                    "disable",
                    true
                );
            }
        } else {
            $("#scheduling-options option").removeAttr("disabled");
            $('#scheduling-options option[id="mainselect"]').prop(
                "disable",
                true
            );
            // The current target does not have the class 'icon-active'
            console.log('Current target does not have the class "icon-active"');
        }

        var cSlot = $("#scheduling-options option:selected").val();

        if (cSlot === "custom-slot") {
            if (element.hasClass("icon-active")) {
                // The element has the specified class
                console.log("Element has the class");
                var type = e.target.dataset.type;
                console.log(type);
                getCustomSlot(type);
            } else {
                // The element does not have the specified class
                console.log("Element does not have the class");
                getCustomSlot("regular-tweets");
            }
        } else {
            console.log("do nothing");
        }
    });

    /** select tweet profiles cross tweet */
    $(".cross-tweet-profiles-inner").on(
        "click",
        "img.cross-tweet-profile-image",
        function (e) {
            // e.preventDefault();
            console.log(e);
            if ($(this).attr("status") === "active") {
                $(this).attr("status", ""); // remove the active when it was active
            } else {
                $(this).attr("status", "active");
            }
        }
    );

    async function getCustomSlot(post_type) {
        console.log(post_type);
        try {
            const response = await fetch(
                APP_URL + "/cmd/get-custom-slot?post_type=" + post_type
            );
            const responseData = await response.json();

            console.log(responseData);

            if (responseData.length > 0) {
                var dropdown = customSlotdropdown();
                $(".scheduling-details").html(dropdown);

                console.log(responseData);
                $.each(responseData, function (k, item) {
                    var str = item.slot_day;
                    var day = str.charAt(0).toUpperCase() + str.substring(1);
                    var time =
                        item.hour + ":" + item.minute_at + " " + item.ampm;
                    var opt = $("<option>")
                        .val(day + " " + time)
                        .text(day + " " + time);
                    console.log(item);

                    $('select[name="custom-slot-datetime"]').append(opt);
                });
            }
        } catch (err) {
            console.log(err);
        }

        // $.get(APP_URL + '/custom-slot?post_type=' + post_type, function(data) {
        //     // success code here
        //     // var option = $('<option>').val(data.slot_day).text(data.slot_day.toUpperCase());
        //     console.log(data)
        //     if (data.length > 0) {
        //         var dropdown = customSlotdropdown();
        //         $('.scheduling-details').html(dropdown)

        //         data.forEach(function(item) {
        //             var str = item.slot_day;
        //             var day = str.charAt(0).toUpperCase() + str.substring(1);
        //             var time = item.hour + ":" + item.minute_at + " " + item.ampm;
        //             var opt = $('<option>').val(day + " " + time).text(day + " " + time);

        //             $('select[name="custom-slot-datetime"]').append(opt)
        //         })
        //     } else {
        //         var p = $('<p>').text('Please add slot in the slot scheduler page.');
        //         $('.scheduling-details').html(p);
        //     }
        // })
        // .fail(function(xhr, status, error) {
        // // error code here
        //     console.log(xhr)
        // });
    }

    function customSetCountdown() {
        var measure = ["minute/s", "hour/s", "day/s"];
        var html = `<select id="scheduling-cdn" class="scheduling-options-dd scheduling-countdown-number">`;
        for (var i = 1; i <= 12; i++) {
            html += `<option value="${i}">${i}</option>`;
        }
        html += `</select> <select id="scheduling-cdmins" name="scheduling-cdmins" class="custom-dhms scheduling-countdown-minutes scheduling-options-dd">`;

        for (const value of measure) {
            html += `<option value="${value}">${value}</option>`;
        }
        html += `</select>`;

        return html;
    }

    function customSlotdropdown() {
        var html = `<select name="custom-slot-datetime" class="scheduling-options-dd">1</select>`;
        return html;
    }

    function customTimedropdown() {
        var html = `<div class="date-picker-wrapper"></div>
        <select id="post-time-hour" name="ct-hour" class="post-time-hour scheduling-options-dd">
          <option disabled selected>Hour</option>`;

        for (var i = 1; i <= 12; i++) {
            html += `<option value="${i}">${i}</option>`;
        }

        html += `</select>
        <select class="post-time-minute scheduling-options-dd" name="ct-min">
          <option disabled selected>Minute</option>`;

        for (var i = 0; i <= 59; i++) {
            // Add leading zero for single-digit numbers
            var formattedMinute = i < 10 ? `0${i}` : i;

            html += `<option value="${formattedMinute}">${formattedMinute}</option>`;
        }

        html += `</select>
        <select id="post-time-am-pm" name="ct-am-pm" class="post-time-am-pm scheduling-options-dd">
          <option disabled selected>AM / PM</option>
          <option value="AM">AM</option>
          <option value="PM">PM</option>
        </select>
        <img src="${APP_URL}/public/ui-images/icons/calendar.svg" class="sched-custom-time">`;

        return html;
    }

    /** Retweet Timer Settings */
    // $retweetTimerModalClose = $(".retweet-modal-close");

    // $retweetTimerModal = $(".schedule-retweet-modal-outer");
    // $retweetTimerIcon = $(".sched-custom-time");

    // $retweetTimerIcon.click( function() {
    // if ( $retweetTimerModal.first().is( ":hidden" ) ) {
    //     $retweetTimerModal.toggle( "slide", { direction: "up"  }, 400 );
    // } else {
    //     $retweetTimerModal.toggle( "slide", { direction: "up"  }, 300 );
    // }
    // });

    // $retweetTimerModalClose.click( function (){
    // $retweetTimerModal.toggle( "slide", { direction: "up"  }, 300 );
    // });

    /** Form submit */
    $("#posting-tool-form-001").on("submit", async function (e) {
        e.preventDefault();
        // console.log(e)
        const form = $(this);

        var crossTweet = [];
        $(".cross-tweet-profiles-inner.cmd img").each(function () {
            if ($(this).attr("status")) {
                crossTweet.push(this.id);
            }
        });

        var textArea = [];
        $(".post-textarea").each(function () {
            textArea.push(this.value);
        });

        const $form = $(form).serializeArray();

        var formData = {};
        $.each($form, function (index, field) {
            formData[field.name] = field.value;
        });

        formData["crosstweet"] = crossTweet;
        formData["textarea"] = textArea;
        formData["twitter_id"] = TWITTER_ID;
        formData["social_media"] = 'twitter'

        form.find('input[type="submit"]').prop("disabled", true);
        form.find('input[type="submit"]').val("Please wait..");

        try {
            const response = await fetch(APP_URL + "/cmd/save", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify({ formData }),
            });

            const responseData = await response.json();
            
            if (responseData.status == 403) {
                openUpgradeModal(responseData);
            } else if (responseData.status === 500) {
                toastr[responseData.stat](
                    `Warning! ${responseData.message}`
                );

                  // Wait for toastr to fade out and then reload the page
                setTimeout(function() {
                    location.reload();
                }, 3000); // Adjust the time according to toastr fadeOut duration
                
            } else if (responseData.status === 200) {
                toastr[responseData.stat](
                    `Success! ${responseData.message}`
                );
                
                

                // Wait for toastr to fade out and then reload the page
                setTimeout(function() {
                    $getPostType = responseData.tweet.post_type        
                
                    if ($getPostType.includes('regular')) {
                        window.location.href = APP_URL + '/queue';
                    } else if ($getPostType.includes('evergreen')) {
                        window.location.href = APP_URL + '/evergreen';
                    } else if ($getPostType.includes('promos')) {
                        window.location.href = APP_URL + '/promo';
                    }
                    // location.reload();
                }, 3000); // Adjust the time according to toastr fadeOut duration
            } else {
                // Handle the server response here
                form.find('input[type="submit"]').val("Data Saved!");
                form.find('input[type="submit"]').prop("disabled", true);

                if (responseData.tweet.post_type === "regular-tweets") {
                    var wrapper = postWrapper(
                        responseData.tweet,
                        responseData.tweet.post_type
                    );
                    $(".queue-day-wrapper").append(wrapper);
                }

                if (responseData.tweet.post_type === "evergreen-tweets") {
                    var evergreenWrapper = postWrapperEvergreen(
                        responseData.tweet
                    );
                    $(".profile-posts-inner").append(evergreenWrapper);
                }

                if (responseData.tweet.post_type === "promos-tweets") {
                    var promoWrapper = postWrapperPromo(responseData);
                    $(".profile-posts-inner").append(promoWrapper);
                }

                // loop through each input field in the form
                for (let i = 0; i < form[0].elements.length; i++) {
                    // console.log(form[0].elements.length)
                    const element = form[0].elements[i];
                    // console.log(element)

                    // check if the element is an input field
                    if (
                        // element.nodeName === "INPUT" ||
                        element.nodeName === "SELECT" ||
                        element.nodeName === "TEXTAREA"
                    ) {
                        // clear the value of the input field
                        element.value = "";
                        // console.log(element.nodeName)
                        // console.log(element.value)
                    }
                }

                form.find('input[type="submit"]').val("Beam me up scotty!");
            }
           
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    });

    /** alert confirmation */
    function confirmation(type) {
        if (confirm("Do you want to cancel all your changes?")) {
            // User clicked "Yes"
            $(".cross-tweet-profiles-inner.cmd img").attr("status", "");
            $(".more-tweets-roster").empty();

            if ($("img.post-tool-icon").hasClass("icon-active") > 0) {
                var src = $("img.post-tool-icon.icon-active").data("type");
                $(".primary-post-area-wrap")
                    .find("img.post-type-indicator")
                    .removeClass("indicator-active");
                $(
                    `.primary-post-area-wrap img.post-type-indicator[data-src="${src}"]`
                ).addClass("indicator-active");
            } else {
                $(".primary-post-area-wrap")
                    .find("img.post-type-indicator")
                    .removeClass("indicator-active");
                $(
                    `.primary-post-area-wrap img.post-type-indicator[data-src="twitter-tweets"]`
                ).addClass("indicator-active");
            }
        }
    }
});

/** watermark logo */
function disableWatermark(src, combo = null) {
    var source =
        combo === "evergreen-tweets"
            ? "evergreen-storm-tweets"
            : combo === "retweet"
            ? "retweet-tweets"
            : combo === "promos-tweets"
            ? "promos-storm-tweets"
            : src === "add-tweet-initial"
            ? src
            : src;

    $(".primary-post-area-wrap")
        .find("img.post-type-indicator")
        .removeClass("indicator-active");
    $(
        `.primary-post-area-wrap img.post-type-indicator[data-src="${source}"]`
    ).addClass("indicator-active");

    if (combo) {
        $(".new-post-area-wrap")
            .find("img.post-type-indicator")
            .removeClass("indicator-active");
        $(
            `.new-post-area-wrap img.post-type-indicator[data-src="${source}"]`
        ).addClass("indicator-active");
    } else {
        $(".new-post-area-wrap")
            .find("img.post-type-indicator")
            .removeClass("indicator-active");
        $(".new-post-area-wrap")
            .find('img.post-type-indicator[data-src="tweet-storm-tweets"]')
            .addClass("indicator-active");
    }
}

/** add new etxtInstance and update existing */
var itemsPerPage = 10;
var $items = 1;
var itemText = 0;
function addTweetTextArea(entryPoint, combo, action, clss, textareaId) {
    console.log(entryPoint, combo, action, clss, textareaId);
    var newTextbox = tweetInstance($items );   

    // Append the new textbox to the container
    if (clss === 'add-tweet-initial') {
        $("#" + action)
            .find(".more-tweets-roster")
            .prepend(newTextbox);
    } else {
        $('#' + textareaId).after(newTextbox);
    }

    // Increment the number of items and pages
    $items++;
    numPages = Math.ceil($items / itemsPerPage);

    disableWatermark(entryPoint, combo, action);

    itemText = $('.more-tweets-roster').children().length + 1;
    // updateTextareaIds(itemText)
    // console.log(action)
    updateItemInfo(action, clss)
}


/** Update page counter */
function updateItemInfo(action, clss) {
    // Update current page based on current item count and items per page
    var currentPage = Math.ceil($(".add-tweet-outer").length / itemsPerPage);
    var totalItems = $(".add-tweet-outer").length + 1;
    var startIndex = (currentPage - 1) * itemsPerPage + 1;
    var endIndex = Math.min(currentPage * itemsPerPage, totalItems);
    // console.log(currentPage, totalItems, startIndex, endIndex);

    // if (clss === 'add-tweet-initial')
    $(".add-tweet-outer").each(function (index) {
        // get the textbox element
        var textbox = $(this);
        console.log(textbox, index);

        // update the page info for this textbox
        var newId = "textbox-" + (index + 1);
        textbox.attr("id", newId).attr("name", newId);
        textbox
            .find("span.post-counter")
            .text(`${currentPage + index + 1}/${totalItems}`);
    });

    $(".primary-post-option-buttons span").text(`${startIndex}/${totalItems}`);
}

/** new tweet instance template */
function tweetInstance(items) {
    // console.log(items)
    var times = ["mins", "hours", "days"];
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
                            <img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" data-src="retweet-tweets"/>
                            <img src="${APP_URL}/public/ui-images/icons/17-promos-storm.svg" class="ui-icon post-type-indicator" data-src="promos-storm-tweets" />
                            <textarea class="post-textarea new-post-area" id="tweet_text_area_${items}" ></textarea>  <!-- END .primary-post-area -->
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
                            <!-- <img src="${APP_URL}/public/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon" /><br /> -->
                            <!-- <img src="${APP_URL}/public/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon" /><br />  -->
                            <!-- <img src="${APP_URL}/public/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon" /><br />  -->
                        </div>  <!-- END .post-right-buttons -->
                    </div>  <!-- END .post-area-right -->
                </div>  <!-- END .new-post-wrap -->
            </div>  <!-- END .add-tweet-inner -->
            <img src="${APP_URL}/public/ui-images/icons/add-post.svg" class="ui-icon add-tweet-icon add-tweet-initial add-tweet-again-button" />
        </div>
            `;

    return $template;
}

function postWrapper(info, post_type) {
    const dateTimeString = info.sched_time;
    const dateTime = new Date(dateTimeString);
    const month = dateTime.toLocaleString("default", { month: "short" });
    const day = dateTime.getDate();
    const year = dateTime.getFullYear();
    const timeString = dateTime.toLocaleTimeString();
    const fullDate = month + " " + day + ", " + year;

    // var data = fetchTwitterDetails(info.twitter_id);
    return ($template = `
            <!-- BEGIN Custom Queued Post Instance (CUSTOM) -->
            <div class="queued-single-post-wrapper queue-type-${post_type}" status="${
        info.active === 0 ? "inactive" : "active"
    }" queue-type="${post_type}">
                <div class="queued-single-post">

                <img src="${APP_URL}/public/ui-images/icon2/pg-${
        post_type === "regular-tweets" ? "custom" : post_type
    }.svg" class="queued-watermark" />

                <div class="queued-single-start">
                    <span class="queued-post-time">
                    ${fullDate + " " + timeString}
                    </span>
                    <span class="queued-post-data">
                    ${info.post_description}
                    <!--info.post_description.substring(0, 17) + "..." -->
                    </span>
                </div>  <!-- END .queue-single-start -->

                
                ${info.sched_method !== 'send-now' ? 
                `<div class="queued-single-end">
                    <img src="${APP_URL}/public/ui-images/icons/pg-dots.svg" class="ui-icon queued-icon queued-options-icon queued-icon-ee" id="more-${
                    info.id
                }" title="More" data-toggle="tooltip" />
                                <img src="${APP_URL}/public/ui-images/icons/pg-view.svg" class="ui-icon queued-icon queued-view-icon queued-icon-ee" id="view-${
                    info.id
                }" title="View" data-toggle="tooltip" />
                                <img src="${APP_URL}/public/ui-images/icons/05-drafts.svg" class="ui-icon queued-icon queued-edit-icon queued-icon-imp" data-icon="edit-post" id="edit-modal-${
                    info.id
                }" title="Edit" data-toggle="tooltip" />
                                <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon queued-icon queued-trash-icon queued-icon-imp" id="delete-${
                    info.id
                }" title="Delete" data-toggle="tooltip" />
                        
                            </div>  <!-- END .queued-single-end -->
                ` : 
                '' }



            </div>  <!-- END .queued-single-post -->

            <div class="queued-preview-wrapper">
                <!-- BEGIN Queued Preview Instance -->
                <div class="mosaic-posts-outer">
                    <div class="mosaic-watermark-wrap frosted">
                    {{-- // image depends on post type --}}
                    <img src="${APP_URL}/public/ui-images/icons/pg-x.svg" class="mosaic-watermark" />
                    <div class="mosaic-posts-inner">

                        <div class="global-twitter-profile-header">
                        <a href="#">
                            {{-- // tweet image --}}
                            <img src="${APP_URL}/public/temp-images/imgpsh_fullsize_anim (1).png"
                            class="global-profile-image" /></a>
                        <div class="global-profile-details">
                            <div class="global-profile-name">
                            <a href="#">
                                {{-- tweet nmame --}}
                                William Wallace
                            </a>
                            </div>  <!-- END .global-author-name -->
                            <div class="global-profile-subdata">
                            <img src="${APP_URL}/public/ui-images/icons/pg-time.svg" class="ui-icon" />
                            <span class="global-post-date">
                                <a href="">
                                {{-- tweet created and time --}}
                                Dec. 16, 2022 @ 5:20 p.m.</a></span>
                            </div>  <!-- END .global-post-date-wrap -->
                        </div>  <!-- END .global-author-details -->
                        </div>  <!-- END .global-twitter-profile-header -->

                        <div class="mosaic-post-data">
                        <div class="mosaic-post-text">
                            {{-- tweet descrioption --}}
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                        </div>  <!-- END .mosaic-post-text -->
                        <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                            class="mosaic-post-image" />
                        </div>  <!-- END .mosaic-post-data -->

                    </div>  <!-- END .mosaic-posts-inner -->
                    </div>  <!-- END .mosaic-watermark-wrap -->
                </div>  <!-- END .mosaic-posts-outer -->
                <!-- END Queued Preview Instance -->

            </div>  <!-- END .queued-preview-wrapper -->

            <div class="queued-options-wrapper frosted view-more view-${
                info.id
            }">
                <div class="queued-options-inner view-more-inner">
                    <span class="queued-option-item" id="postNow-${
                        info.id
                    }">Post Now</span>
                    <span class="queued-option-item" id="duplicateNow-${
                        info.id
                    }">Duplicate Post</span>
                    <span class="queued-option-item" id="move-top-${
                        info.id
                    }">Move to Top</span>
                </div>  <!-- END .queued-options-inner -->
            </div>  <!-- END .queued-options-wrapper -->
            <!-- END Custom Queued Post Instance -->
    `);
}

function postWrapperReserve(info) {
    const dateTimeString = info.sched_time;
    const dateTime = new Date(dateTimeString);
    const month = dateTime.toLocaleString("default", { month: "short" });
    const day = dateTime.getDate();
    const year = dateTime.getFullYear();
    const timeString = dateTime.toLocaleTimeString();
    const fullDate = month + " " + day + ", " + year;

    var post_type =
        info.post_type === "evergreen-tweets" ? "evergreen" : "promo";
    return ($template = `
    <div class="queued-single-post-wrapper queue-type-${post_type}" status="active" queue-type="${post_type}">
        <div class="queued-single-post">

        <img src="${APP_URL}/public/ui-images/icons/pg-${post_type}.svg" class="queued-watermark">

        <div class="queued-single-start">
            <span class="queued-post-time">${fullDate + " " + timeString}</span>
            <span class="queued-post-data">
            Reserved for ${post_type.toUpperCase()}
            </span>
        </div>  <!-- END .queue-single-start -->

        <div class="queued-single-end">

        </div>  <!-- END .queued-single-end -->

        </div>  <!-- END .queued-single-post -->
    </div>
    `);
}

function postWrapperEvergreen(info) {
    const dateTimeString = info.sched_time;
    const dateTime = new Date(dateTimeString);
    const month = dateTime.toLocaleString("default", { month: "short" });
    const day = dateTime.getDate();
    const year = dateTime.getFullYear();
    const timeString = dateTime.toLocaleTimeString();
    const fullDate = month + " " + day + ", " + year;

    return ($template = `
<div class="mosaic-posts-outer evergreen-mosaic" status="${
        info.active > 0 ? "active" : "inactive"
    }">
    <div class="mosaic-watermark-wrap frosted">
    <img src="${APP_URL}/public/ui-images/icons/pg-evergreen.svg" class="mosaic-watermark evergreen-watermark" />
    <div class="mosaic-posts-inner">

        <div class="mosaic-post-controls">
                <span class="mosaic-control-icon">
                    <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon" id="delete-${
        info.id
    }" title="Delete" name="delete" />
                </span>
                </div>  <!-- END .mosaic-post-controls -->

        <div class="global-twitter-profile-header">
        <a href="#">
            <img src="${TWITTER_PHOTO}"
            class="global-profile-image" /></a>
        <div class="global-profile-details">
            <div class="global-profile-name">
            <a href="#">
            ${TWITTER_NAME}</a>
            </div>  <!-- END .global-author-name -->
            <div class="global-profile-subdata">
                <!-- <img src="${APP_URL}/public/ui-images/icons/pg-time.svg" class="ui-icon" />
                <span class="global-post-date">
                <a href="">
                ${fullDate + " " + timeString}</a>
                </span> -->
            </div>  <!-- END .global-post-date-wrap -->
        </div>  <!-- END .global-author-details -->
        </div>  <!-- END .global-post-author -->

        <div class="mosaic-post-data">
        <div class="mosaic-post-text">
            ${info.post_description}
        </div>  <!-- END .mosaic-post-text -->
        <!-- <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
            class="mosaic-post-image" /> -->
        </div>  <!-- END .mosaic-post-data -->

        <div class="mosaic-post-scheduling">

        <!-- <div class="mosaic-scheduling mosaic-scheduling-future">

            <span class="mosaic-label mosaic-future-label">
                <img src="${APP_URL}/public/ui-images/icons/04-queue.svg" class="ui-icon" />
                Schedule
            </span>
            <span class="mosaic-sched-buttons mosaic-future-buttons">
                <img src="${APP_URL}/public/ui-images/icons/pg-comment.svg" class="ui-icon evergreen-icon" id="ev-comment-${
        info.id
    }"/>
                <img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon evergreen-icon" id="ev-retweet-${
        info.id
    }"/>
                <img src="${APP_URL}/public/ui-images/icons/16-evergreen.svg" class="ui-icon evergreen-icon" id="ev-evergreen-${
        info.id
    }"/>
            </span>

        </div>  END .mosaic-scheduling-future -->

        <!--
        <div class="mosaic-scheduling mosaic-post-analytics">

            <span class="mosaic-label mosaic-analytics-label">
            <img src="${APP_URL}/public/ui-images/icons/pg-analytics.svg" class="ui-icon" />
            Analytics
            </span>
            <span class="mosaic-sched-buttons mosaic-analytics-buttons">
            <img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            <span class="mosaic-stat stat-retweets">2.20</span>
            <img src="${APP_URL}/public/ui-images/icons/pg-heart.svg" class="ui-icon" />
            <span class="mosaic-stat stat-hearts">2010</span>
            </span>

        </div>
        </div> -->

    </div>  <!-- END .mosaic-posts-inner -->
    </div>  <!-- END .mosaic-watermark-wrap -->
</div>  <!-- END .mosaic-posts-outer -->
`);
}

function postWrapperPromo(info) {
    const dateTimeString = info.sched_time;
    const dateTime = new Date(dateTimeString);
    const month = dateTime.toLocaleString("default", { month: "short" });
    const day = dateTime.getDate();
    const year = dateTime.getFullYear();
    const timeString = dateTime.toLocaleTimeString();
    const fullDate = month + " " + day + ", " + year;

    return ($template = `<div class="mosaic-posts-outer promos-mosaic" status="${
        info.active > 0 ? "active" : "inactive"
    }">
    <div class="mosaic-watermark-wrap frosted">
        <img src="${APP_URL}/public/ui-images/icons/17-promos.svg" class="mosaic-watermark promo-watermark" />
        <div class="mosaic-posts-inner">

        <div class="mosaic-post-controls">
            <span class="mosaic-control-icon">
                <!-- <img src="${APP_URL}/public/ui-images/icons/pg-add.svg" class="ui-icon"/> -->
            </span>

            <span class="mosaic-control-icon">
                <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon" id="delete-${
        info.id
    }" title="Delete" name="delete"/>
            </span>
        </div>  <!-- END .mosaic-post-controls -->

        <div class="global-twitter-profile-header">
            <a href="#">
                <img src="${TWITTER_PHOTO}" class="global-profile-image" />
            </a>
            <div class="global-profile-details">
                <div class="global-profile-name">
                <a href="#">
                    ${TWITTER_NAME}
                </a>
                </div>  <!-- END .global-author-name -->
            <div class="global-profile-subdata">
                <!--  <img src="${APP_URL}/public/ui-images/icons/pg-time.svg" class="ui-icon" />
                    <span class="global-post-date">
                    <a href="">
                    ${fullDate + " " + timeString}</a>
                    </span> -->
                </div>  <!-- END .global-post-date-wrap -->
            </div>  <!-- END .global-author-details -->
        </div>  <!-- END .global-post-author -->

        <div class="mosaic-post-data">
            <div class="mosaic-post-text">
            ${info.post_description}
            </div>  <!-- END .mosaic-post-text -->
            <!-- <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
            class="mosaic-post-image" /> -->
        </div>  <!-- END .mosaic-post-data -->

        </div>  <!-- END .mosaic-posts-inner -->
    </div>  <!-- END .mosaic-watermark-wrap -->
    </div>  <!-- END .mosaic-posts-outer -->
    <!-- END Single Post Instance -->
`);
}

function postWrapperBulk(info) {
    const dateTimeString = info.sched_time;
    const dateTime = new Date(dateTimeString);
    const month = dateTime.toLocaleString("default", { month: "short" });
    const day = dateTime.getDate();
    const year = dateTime.getFullYear();
    const timeString = dateTime.toLocaleTimeString();
    const fullDate = month + " " + day + ", " + year;

    return ($template = `<div class="queued-single-post-wrapper queue-type-custom" status="active" queue-type="custom">
            <div class="queued-single-post-bulk" >
                <img src="${APP_URL}/public/ui-images/icons/pg-x.svg" class="queued-watermark">

                <div class="queued-single-start-column">
                <span class="mt-3">
                    <img src="${
                        info.xphoto
                    }" class=" queued-icon queued-edit-icon">
                    ${info.xname}
                </span>
                <span>
                    <img src="${APP_URL}/public/ui-images/icons/pg-time.svg" class="ui-icon queued-icon queued-view-icon" >
                    ${timeString}
                </span>
                <span>
                    <img src="${APP_URL}/public/ui-images/icons/calendar.svg" class="ui-icon queued-icon queued-options-icon">
                    ${month + " " + day + ", " + year}
                </span>
                ${
                    info.image_url
                        ? `<span>
                        <img src="${APP_URL}/public/ui-images/icons/pg-links.svg" class="ui-icon queued-icon queued-trash-icon">
                        Photo
                    </span>`
                        : ""
                }
                ${
                    info.link_url
                        ? `<span>
                        <img src="${APP_URL}/public/ui-images/icons/pg-links.svg" class="ui-icon queued-icon queued-trash-icon">
                        Links
                    </span>`
                        : ""
                }
            </div>

            <div class="queued-single-mid-column">
                <span class="queued-post-time">
                    ${info.post_description}
                </span>

                ${
                    info.link_url
                        ? `<span class="queued-post-data">
                        <div class="card" style="width: 350px; border: 1px solid var(--frost-background); margin-top: 2em;border-radius: 1em; position: relative;
                        display: inline-block;
                        overflow: hidden;">
                            <img class="card-img-top" src="${info.meta_image}" alt="Card image cap" style="width: 100%; height: 200px;     border-top-right-radius: 1em; border-top-left-radius: 1em;">
                            <img src="${APP_URL}/public/ui-images/icons/pg-links.svg" title="Reload meta" name="reload-meta" alt="Reload meta" style="position: absolute; right: 5px; bottom: 50%;" data-url="${info.link_url}">
                            <div class="card-body" style="padding: 1em">
                                <h4 class="card-title" style="font-weight:bold">${info.meta_title}</h4>
                                <p class="card-text">${info.meta_description}</p>
                                <a href="${info.link_url}" class="card-url" target="_blank" style="text-decoration: none; color: black"> <img src="${APP_URL}/public/ui-images/icons/pg-links.svg" style="width:15px; height: 15px; margin-right: 5px"> ${info.link_url}</a>
                            </div>
                        </div>
                    </span>
                    `
                        : ""
                }

                ${
                    info.image_url
                        ? `<span class="queued-post-data">
                        <img class="card-img-top" src="${info.image_url}" alt="Card image cap" style="width: auto; height: 200px;border-top-right-radius: 1em;">
                    </span>
                    `
                        : ""
                }

            </div>

            <div class="queued-single-end-column">
                <!-- <img src="${APP_URL}/public/ui-images/icons/pg-dots.svg" class="ui-icon queued-icon queued-options-icon" > -->
                <img src="${APP_URL}/public/ui-images/icons/pg-clone.svg" class="ui-icon queued-icon queued-view-icon" name="duplicate" title="Duplicate" id="duplicateBulk-${
        info.id
    }" >
                <img src="${APP_URL}/public/ui-images/icons/05-drafts.svg" class="ui-icon queued-icon queued-edit-icon" name="edit" data-id="modal" title="Edit" id="editBulk-${
        info.id
    }" >
                <img src="${APP_URL}/public/ui-images/icons/pg-trash.svg" class="ui-icon queued-icon queued-trash-icon" name="delete" title="Delete" id="deleteBulk-${
        info.id
    }" >
            </div>

        </div>
    </div>
    `);
}
