<style>
.tweets-hide {
	display: none;
}
div[data-schedule="none"] {
	display: none;
}
</style>
<div class="modal-large-outer posting-tool-outer">
<div class="modal-large-inner posting-tool-inner">

    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close posting-tool-close" />

    <div class="posting-tool-banner">
    <div class="global-twitter-profile-header">
        <a href="#">
        <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png"
            class="global-profile-image" /></a>
        <div class="global-profile-details">
        <div class="global-profile-name">
            <a href="#">
            William Wallace</a>
        </div>  <!-- END .global-author-name -->
        <div class="global-profile-subdata">
            <span class="global-profile-handle">
            <a href="">
                @WilliamWallace</a></span>
        </div>  <!-- END .global-post-date-wrap -->
        </div>  <!-- END .global-author-details -->
    </div>  <!-- END .global-twitter-profile-header -->
    </div>  <!-- END .posting-tool-banner -->

    <form id="posting-tool-form-001" class="posting-tool-form">
    <div class="posting-tool-columns">
        <div class="posting-tool-col posting-tool-left-col">

        <div class="new-post-wrap primary-post-wrap">

            <div class="post-area-left primary-post-left">
            <div class="post-area-wrap primary-post-area-wrap">
                <img src="{{ asset('public/')}}/ui-images/icons/pg-x.svg" class="ui-icon post-type-indicator indicator-active" />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator" />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="ui-icon post-type-indicator" />
                <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator" />
                <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator" />
                <textarea class="post-textarea primary-post-area"></textarea>  <!-- END .primary-post-area -->
            </div>  <!-- END .primary-post-area-wrap -->
            <div class="post-bottom-buttons primary-post-bottom-buttons">
                <span class="post-type-buttons primary-post-type-buttons">
                <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" data-select="0" data-type="evergreen-tweets" id="select-evergreen-icon" class="ui-icon post-tool-icon post-type-icon" />
                <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" data-select="0" data-type="promos-tweets" id="select-promo-icon" class="ui-icon post-tool-icon promo-type-icon post-type-icon" />
                <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" data-select="0" data-type="tweet-storm-tweets" id="select-tweet-storm-icon" class="ui-icon post-tool-icon tweet-storm-type-icon post-type-icon" />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-tool-icon retweet-type-icon" />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-tool-icon comment-type-icon" />
                </span>  <!-- END .primary-post-type-buttons -->
                <span class="post-option-buttons primary-post-option-buttons">
                <img src="{{ asset('public/')}}/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon post-tool-icon hashtags-option-icon" />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-envelope.svg" class="ui-icon post-tool-icon dm-option-icon" />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet-timer.svg" class="ui-icon post-tool-icon retweet-timer-icon" />
                <span class="post-counter">1/2</span>
                </span>  <!-- END .primary-post-option-buttons -->


                <div class="post-tool-modal tag-group-modal-outer frosted">
                <div class="tag-group-modal-inner">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon post-tool-modal-close tag-group-modal-close" />
                    <select>
                    <option disabled selected class="modal-select-tag-group">Select a Tag Group:</option>
                        <option class="modal-select-tag-group">Group #1</option>
                        <option class="modal-select-tag-group">Group #2</option>
                        <option class="modal-select-tag-group">Group #3</option>
                    </select>
                    <div class="modal-tag-group-display">
                    <span class="modal-tag-instance" status="active">
                        #marketing
                    </span>
                    <span class="modal-tag-instance">
                        #business
                    </span>
                    <span class="modal-tag-instance" status="active">
                        #onlineBusiness
                    </span>
                    <span class="modal-tag-instance" status="active">
                        #entrepreneurs
                    </span>
                    <span class="modal-tag-instance">
                        #entrepreneurGrind
                    </span>
                    <span class="modal-tag-instance">
                        #businessIntegrity
                    </span>
                    <span class="modal-tag-instance" status="active">
                        #businessValues
                    </span>
                    </div>  <!-- END .modal-tag-group-display -->
                    <div class="tags-submit">
                    Add Tags
                    </div>  <!-- END .tags-submit -->
                </div>  <!-- END .tag-group-modal-inner -->
                </div>  <!-- END .tag-group-modal-outer -->


                <div class="post-tool-modal schedule-retweet-modal-outer frosted">
                <div class="schedule-retweet-modal-inner">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon post-tool-modal-close retweet-modal-close" />
                    Select A Post Time:
                    <div class="schedule-time-selectors">
                    <select id="post-time-hour" name="post-time-hour" class="post-time-hour">
                        <option disabled selected>Hour</option>
                        @for ($i = 1; $i <= 12; $i++)
                        <option value="{{  $i }}"> {{  $i }}</option>
                    @endfor
                    </select>
                    <select class="post-time-minute">
                        <option disabled selected>Minute</option>
                        @for ($i = 0; $i <= 59; $i++)
                        <option value="{{  $i }}"> {{  $i }}</option>
                    @endfor
                    </select>
                    <select id="post-time-am-pm" name="post-time-am-pm" class="post-time-am-pm">
                        <option disabled selected>AM / PM</option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    </div>  <!-- END .schedule-time-selectors -->
                    <div class="date-picker-wrapper">
                        <input type="text" id="datepicker" autocomplete="off">
                    </div>  <!-- END .date-picker-wrapper -->
                </div>  <!-- END .schedule-retweet-modal-inner -->
                </div>  <!-- END .schedule-retweet-modal-outer -->
            </div>  <!-- END .primary-post-bottom-buttons -->
            </div>  <!-- END .primary-post-left -->


            <div class="post-area-right primary-post-right">
            <div class="post-right-buttons primary-post-right-buttons">
                <img src="{{ asset('public/')}}/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon" /><br />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon" /><br />
                <img src="{{ asset('public/')}}/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon" /><br />
            </div>  <!-- END .primary-post-right-buttons -->
            </div>  <!-- END .primary-post-right -->

        </div>  <!-- END .primary-post-wrap -->

        <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon add-tweet-icon add-tweet-initial" />

        <div class="more-tweets-roster">

            <!-- CARLO - All subsequent tweet additions go here. -->

            <!-- BEGIN NEW TWEET INSTANCE -->
            <div class="add-tweet-outer">
            <div class="add-tweet-inner">
                <div class="wait-to-tweet-col">
                <span class="wait-title">Wait</span>
                <select id="wait-number" name="wait-number" data-info="wait-timer" class="wait-number">
                    @for ($i = 0; $i <= 59; $i++)
                        <option value="{{  $i }}"> {{  $i }}</option>
                    @endfor
                </select>
                <select id="wait-duration" name="wait-duration" data-check="wait-timer" class="custom-dhms wait-duration">
                    <option value="seconds">Seconds</option>
                    <option value="mins">Minutes</option>
                    <option value="hours">Hours</option>
                    <option value="days">Days</option>
                </select>
                </div>  <!-- END .wait-to-tweet-col -->
                <div class="new-post-wrap add-tweet-col">
                <div class="post-area-left new-post-left">
                    <div class="post-area-wrap new-post-area-wrap">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-x.svg" class="ui-icon post-type-indicator indicator-active" />
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" />
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator" />
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="ui-icon post-type-indicator" />
                    <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator" />
                    <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator" />
                    <textarea class="post-textarea new-post-area"></textarea>  <!-- END .primary-post-area -->
                    </div>  <!-- END .post-area-wrap -->
                    <div class="post-bottom-buttons new-post-bottom-buttons">
                    <span class="post-type-buttons new-post-type-buttons">
                        <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon post-tool-icon evergreen-type-icon" />
                        <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-tool-icon promo-type-icon" />
                        <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-tool-icon tweet-storm-type-icon" />
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-tool-icon retweet-type-icon" />
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-tool-icon comment-type-icon" />
                    </span>  <!-- END .post-type-buttons -->
                    <span class="post-option-buttons new-post-option-buttons">
                        <img src="{{ asset('public/')}}/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon post-tool-icon hashtags-option-icon" />
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-envelope.svg" class="ui-icon post-tool-icon dm-option-icon" />
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon post-tool-icon send-timer-icon" />
                        <span class="post-counter">2/2</span>
                    </span>  <!-- END .post-option-buttons -->
                    </div>  <!-- END .post-bottom-buttons -->
                </div>  <!-- END .post-area-left -->

                <div class="post-area-right new-post-right">
                    <div class="post-right-buttons new-post-right-buttons">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon post-tool-icon remove-new-tweet" /><br />
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon" /><br />
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon" /><br />
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon" /><br />
                    </div>  <!-- END .post-right-buttons -->
                </div>  <!-- END .post-area-right -->
                </div>  <!-- END .new-post-wrap -->
            </div>  <!-- END .add-tweet-inner -->
            <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon add-tweet-icon add-tweet-again-button" />
            </div>  <!-- END .add-tweet-outer -->
            <!-- END NEW TWEET INSTANCE -->


        </div>  <!-- END .more-tweets-roster -->
        </div>  <!-- END .posting-tool-left-col -->


        <div class="posting-tool-col posting-tool-right-col">
        <input type="hidden" name="post_type_tweets" value="regular_tweets" id="post_type_tweets" class="post_type_tweets">
        <div id="post_evergreen" data-post="evergreen-tweets" class="post-alert evergreen-alert tweets-hide">
            <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon alert-icon" />
            <span>
            Adding to Evergreen Tweets
            </span>
        </div>  <!-- END .evergreen-alert -->

        <div id="post_promo" data-post="promos-tweets" class="post-alert promo-alert tweets-hide">
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon alert-icon" />
            <span>
            Adding to Promo Tweets
            </span>
            <select class="promo-campaign-select">
            <option disabled selected>Select a Promo Campaign...</option>
            <option>Promo Campaign #1</option>
            <option>Promo Campaign #2</option>
            <option>Promo Campaign #3</option>
            </select>
        </div>  <!-- END .promo-alert -->

        <div id="post_tweet_storms" data-post="tweet-storm-tweets" class="post-alert tweet-storm-alert tweets-hide">
            <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon alert-icon" />
            <span>
            Adding to Tweet Storms
            </span>
        </div>  <!-- END .promo-alert -->

        <div id="post_regular_retweet" class="post-alert retweet-alert tweets-hide">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon alert-icon" />
            <span>
            Tweet to Retweet:
            </span>
            <input type="text" placeholder="...paste tweet link here..." class="retweet-link-input" />
            <!-- CARLO - Just have this grab the tweet in the URL when it is pasted. -->
        </div>  <!-- END .comment-alert -->

        <div class="post-alert comment-alert">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon alert-icon" />
            <span>
            Tweet to Comment On:
            </span>
            <input type="text" placeholder="...paste tweet link here..." class="comment-link-input" />
            <!-- CARLO - Just have this grab the tweet in the URL when it is pasted. -->
        </div>  <!-- END .comment-alert -->


        <div class="post-alert retweet-timer-alert">
            <div class="retweet-timer-alert-heading">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet-timer.svg" class="ui-icon alert-icon" />
            <span>
                Retweet every:
            </span>
            </div>
            <div class="retweet-timer-settings">
            <select id="num-custom-cm" name="num-custom-cm"  data-info="retweet-timer" class="retweet-timer-select">
                @for ($i = 0; $i <= 59; $i++)
                    <option value="{{  $i }}"> {{  $i }}</option>
                @endfor
            </select>
            <select id="time-custom-cm" name="time-custom-cm" data-check="retweet-timer" class="custom-dhms retweet-timer-select time-custom-cm">
                <option value="mins" selected>minutes</option>
                <option value="hours">hours</option>
                <option value="days">days</option>
            </select>
            for
            <select id="iterations-custom-cm" name="iterations-custom-cm"  class="retweet-timer-select">
                @for ($i = 1; $i <= 7; $i++)
                    <option value="{{  $i }}"> {{  $i }}</option>
                @endfor
            </select>
            iterations.
            </div>  <!-- END .retweet-timer-settings -->
        </div>  <!-- END .promo-alert -->

        <div class="cross-tweet-profiles-outer">
            <div class="cross-tweet-header">
            Cross-Tweet On:</div>
            <div class="cross-tweet-profiles-inner">
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" />
            <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png" class="cross-tweet-profile-image" status="active" />
            </div>  <!-- END .cross-tweet-profiles-inner -->
        </div>  <!-- END .cross-tweet-profiles-outer -->

        </div>  <!-- END .posting-tool-right-col -->
    </div>  <!-- END .posting-tool-columns -->


    <div class="posting-tool-submit-wrap">
        <div class="post-tool-submit-left">
        <select id="scheduling-options" name="scheduling-options" class="scheduling-options">
            <option disabled selected>Select a scheduling method...</option>
            <option value="add-queue">Add to Queue (default)</option>
            <option value="send-now">Send Now</option>
            <option value="set-countdown">Set Countdown</option>
            <option value="custom-time">Custom Time</option>
            <option value="custom-slot">Custom Slot</option>
            <option value="save-draft">Save As Draft</option>
            <option value="rush-queue">Rush In Queue</option>
        </select>
        <div class="scheduling-details">



<!-- INGRID - Please finish these, based on the UI of the rest of the page -->

<!-- CARLO - These options only show up if certain options are selected in the scheduling method options -->

            <div id="scheduling-method-xxx" class="scheduling-details-countdown" data-schedule="none">
            <!-- CARLO - if Countdown -->
            <select id="scheduling-cdn" class="scheduling-countdown-number">
                
            </select>
            <select id="scheduling-cdmins" name="scheduling-cdmins" class="custom-dhms scheduling-countdown-minutes">
                <option value="mins">Minutes</option>
                <option value="hours">Hours</option>
                <option value="days">Days</option>
            </select>
            </div>  <!-- END .scheduling-details-countdown -->
            <div class="scheduling-details-date-picker">
            <!-- CARLO - if Custom Time -->
            Ingrid, use RetweetTimer options
            </div>  <!-- END .scheduling-details-date-picker -->
            <div class="scheduling-details-custom-slot">
            <!-- CARLO - if Custom Slot, show available time slots -->
            <select>
                <option>Custom Time Slot List</option>
            </select>
            </div>  <!-- END .scheduling-details-custom-slot -->
        </div>  <!-- END .scheduling-details -->
        </div>  <!-- END .post-tool-submit-left -->
        <input type="submit" class="posting-tool-submit" value="Beam Me Up Scotty!" />
    </div>  <!-- END .posting-tool-submit-wrap -->
    </form>  <!-- END .posting-tool-form -->

</div>  <!-- END .posting-tool-inner -->
</div>  <!-- END .posting-tool-outer -->