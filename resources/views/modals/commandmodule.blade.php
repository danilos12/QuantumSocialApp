<style>
.tweets-hide {
  display: none;
}
div[data-schedule="none"] {
  display: none;
}
</style>
<div class="modal-large-outer posting-tool-outer command-module-outer">
  <div class="modal-large-inner posting-tool-inner">

    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close posting-tool-close" id="command-module"/>

    <div class="posting-tool-banner">
      <div class="global-twitter-profile-header">
        <a href="#">
          <img src="{{ $twitter_photo ?: asset('public//temp-images/imgpsh_fullsize_anim (1).png') }}"
            class="global-profile-image" /></a>
        <div class="global-profile-details">
          <div class="global-profile-name">
            <a href="#">{{ $twitter_name ?: 'Quantum User' }}</a>
          </div>  <!-- END .global-author-name -->
          <div class="global-profile-subdata">
            <span class="global-profile-handle">
              @<a href="">{{ $twitter_usn ?? "" }}</a>
            </span>
          </div>  <!-- END .global-post-date-wrap -->
        </div>  <!-- END .global-author-details -->
      </div>  <!-- END .global-twitter-profile-header -->
    </div>  <!-- END .posting-tool-banner -->

    <form id="posting-tool-form-001" class="posting-tool-form" enctype="multipart/form-data" method="post">
      <div class="posting-tool-columns">
        <div class="posting-tool-col posting-tool-left-col">

          <div class="new-post-wrap primary-post-wrap">

            <div class="post-area-left primary-post-left">
              <div class="post-area-wrap primary-post-area-wrap">
                <img src="{{ asset('public/')}}/ui-images/icons/pg-x.svg" class="ui-icon post-type-indicator indicator-active" data-src="twitter-tweets"/>
                <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon post-type-indicator" data-src="evergreen-tweets"/>
                <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator" data-src="promos-tweets" />
                <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator" data-src="tweet-storm-tweets"/>
                <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" data-src="retweet-tweets"/>
                <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator" data-src="comments-tweets"/>
                <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen-storm.svg" class="ui-icon post-type-indicator" data-src="evergreen-storm-tweets"/>
                <img src="{{ asset('public/')}}/ui-images/icons/17-promos-storm.svg" class="ui-icon post-type-indicator" data-src="promos-storm-tweets" />
                {{-- <div>
                  <div  class="post-textarea primary-post-area" name="tweet_text_area" id="emojionearea"  contentEditable="true">
                    <span>
                      <img id="image-preview" src="#" alt="Image Preview" style="display:none" />  
                    </span>                              
                  </div>
                </div> --}}
                <textarea class="post-textarea primary-post-area" id="emojionearea"></textarea>  <!-- END .primary-post-area -->      
              </div>  <!-- END .primary-post-area-wrap -->
              <div class="post-bottom-buttons primary-post-bottom-buttons">
                <span class="post-type-buttons primary-post-type-buttons">
                  <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" data-select="0" data-type="evergreen-tweets" id="select-evergreen-icon" class="ui-icon post-tool-icon post-type-icon" />
                  <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" data-select="0" data-type="promos-tweets" id="select-promo-icon" class="ui-icon post-tool-icon promo-type-icon post-type-icon" />
                  <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" data-select="0" data-type="tweet-storm-tweets" id="select-tweet-storm-icon" class="ui-icon post-tool-icon tweet-storm-type-icon post-type-icon" />
                  <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" data-select="0" data-type="retweet-tweets" id="select-retweet-icon" class="ui-icon post-tool-icon retweet-type-icon post-type-icon" />
                  <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" data-select="0" data-type="comments-tweets" id="select-comments-icon" class="ui-icon post-tool-icon comment-type-icon post-type-icon" />
                </span>  <!-- END .primary-post-type-buttons -->
                <span class="post-option-buttons primary-post-option-buttons">
                  {{-- <img src="{{ asset('public/')}}/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon post-tool-icon hashtags-option-icon" /> --}}
                  {{-- <img src="{{ asset('public/')}}/ui-images/icons/pg-envelope.svg" class="ui-icon post-tool-icon dm-option-icon" /> --}}
                  {{-- <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet-timer.svg" data-select="0" data-type="retweet-timer-tweets" class="ui-icon post-tool-icon retweet-timer-icon" />  --}}
                  <span class="post-counter">1/1</span>
                </span>  <!-- END .primary-post-option-buttons -->


                <div class="post-tool-modal tag-group-modal-outer frosted">
                  <div class="tag-group-modal-inner">
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon post-tool-modal-close tag-group-modal-close" />
                    <select id="tag-groups">
                      <option disabled selected class="modal-select-tag-group">Select a Tag Group:</option>                                            
                    </select>
                    <div class="modal-tag-group-display">                                            
                    </div>  <!-- END .modal-tag-group-display -->
                    <div class="tags-submit">
                      Add Tags
                    </div>  <!-- END .tags-submit -->
                  </div>  <!-- END .tag-group-modal-inner -->
                </div>  <!-- END .tag-group-modal-outer -->                                                                          
              </div>  <!-- END .primary-post-bottom-buttons -->
            </div>  <!-- END .primary-post-left -->


            <div class="post-area-right primary-post-right">
              <div class="post-right-buttons primary-post-right-buttons">
                <img src="{{ asset('public/')}}/ui-images/icons/pg-image.svg" data-clicked="0" class="ui-icon post-tool-icon add-image-icon" /><br />
                {{-- <img src="{{ asset('public/')}}/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon" /><br /> --}}
                {{-- <img src="{{ asset('public/')}}/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon emojionearea-button" data-emoji-open="0" /><br /> --}}
              </div>  <!-- END .primary-post-right-buttons -->
              <input id="image-upload-input" type="file" accept="image/*" style="display: none;">
            </div>  <!-- END .primary-post-right -->

          </div>  <!-- END .primary-post-wrap -->

          <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" data-select="0" class="ui-icon add-tweet-icon add-tweet-initial" />

          <div class="more-tweets-roster">     
                                        
          </div>  <!-- END .more-tweets-roster -->
        </div>  <!-- END .posting-tool-left-col -->
        

        <div class="posting-tool-col posting-tool-right-col right-section">
          <input type="hidden" name="post_type_tweets" value="regular-tweets" id="post_type_tweets" class="post_type_tweets">

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
            <select class="promo-campaign-select" name="promo-tweets-cmp">
              <option disabled selected>Select a Promo Campaign...</option>
              <option value="cmp1">Promo Campaign #1</option>
              <option value="cmp2">Promo Campaign #2</option>
              <option value="cmp3">Promo Campaign #3</option>
            </select>
          </div>  <!-- END .promo-alert -->

          <div id="post_tweet_storms" data-post="tweet-storm-tweets" class="post-alert tweet-storm-alert tweets-hide">
            <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon alert-icon" />
            <span>
              Adding to Tweet Storms
            </span>
          </div>  <!-- END .promo-alert -->

          <div id="post_regular_retweet" data-post="retweet-tweets" class="post-alert retweet-alert tweets-hide">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon alert-icon" />
            <span>
              Tweet to Retweet:
            </span>
            <input type="text" name="retweet-link-input" placeholder="...paste tweet link here..." class="retweet-link-input" />
              <!-- CARLO - Just have this grab the tweet in the URL when it is pasted. -->
          </div>  <!-- END .comment-alert -->

          <div id="post_comment" data-post="comments-tweets" class="post-alert comment-alert tweets-hide">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon alert-icon" />
            <span>
              Tweet to Comment On:
            </span>
            <input type="text" name="comment-link-input" placeholder="...paste tweet link here..." class="comment-link-input" />
              <!-- CARLO - Just have this grab the tweet in the URL when it is pasted. -->
          </div>  <!-- END .comment-alert -->


          <div id="post_retweet_timer" data-post="retweet-timer-tweets" data-retweet="post_regular_retweet" class="post-alert retweet-timer-alert tweets-hide">
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
                  @php 
                    $times = ['seconds', 'minutes', 'hours', 'days']
                  @endphp

                  @foreach($times as $time) 
                  <option value="{{ $time }}"> {{ $time }}</option>                                          
                  @endforeach
              </select>
              for
              <select id="iterations-custom-cm" name="iterations-custom-cm"  class="retweet-timer-select">
              @for ($i = 1; $i <= 7; $i++)
                <option value="{{  $i }}"> {{  $i }}</option>
              @endfor
              </select>
              iterations.
            </div>  <!-- END .retweet-timer-settings -->
          </div>  <!-- END .retweet-alert -->

          <div class="cross-tweet-profiles-outer">
            <div class="cross-tweet-header">
              Cross-Tweet On:</div>
            <div class="cross-tweet-profiles-inner cmd">                                  
            </div>  <!-- END .cross-tweet-profiles-inner -->
          </div>  <!-- END .cross-tweet-profiles-outer -->

        </div>  <!-- END .posting-tool-right-col -->
      </div>  <!-- END .posting-tool-columns -->


      <div class="posting-tool-submit-wrap">
        <div class="post-tool-submit-left">
          <select id="scheduling-options" name="scheduling-options" class="scheduling-options">
            <option disabled selected value="save-draft" id="mainselect">Select a scheduling method...</option>
            <!-- <option value="add-queue">Add to Queue (default)</option> -->
            @if ($hasRegularTweetsInQueue)
            <option value="add-queue">Add to Queue (default)</option>
            @endif
            <option value="send-now">Tweet Now</option>
            <option value="set-countdown">Set Countdown</option>
            <option value="custom-time">Custom Time</option>
            @if ($hasCustomSlot)
              <option value="custom-slot">Custom Slot</option>
            @endif
            <option value="save-draft">Save As Draft</option>
            @if ($hasRegularTweetsInQueue)
                <option value="rush-queue">Rush In Queue</option>
            @endif
          </select>
          <div class="scheduling-details">
            <div class="scheduling-details-countdown sop" id="scheduling-method-set-countdown" data-schedule="none" data-name="set-countdown" name="scheduling-method">                                                                                                                                                                                                      
            </div>  <!-- END .scheduling-details-countdown -->
            <div class="scheduling-details-custom-time sop" id="scheduling-method-custom-time" data-schedule="none" data-name="custom-time" name="scheduling-method">              
            </div>  <!-- END .scheduling-details-date-picker -->
            <div class="scheduling-details-custom-slot sop" id="scheduling-method-custom-slot" data-schedule="none" data-name="custom-slot" name="scheduling-method">                                                                      
            </div>  <!-- END .scheduling-details-custom-slot -->
          </div>  <!-- END .scheduling-details -->
        </div>  <!-- END .post-tool-submit-left -->
        <input type="hidden" id="mode" name="mode" value="">
        <input type="hidden" id="item-id" name="id" value="">
        <input type="submit" class="posting-tool-submit" value="Beam me up Scotty" id="beam-btn" {{ $twitter_id === 0 ? 'disabled' : "" }} />
      </div>  <!-- END .posting-tool-submit-wrap -->
    </form>  <!-- END .posting-tool-form -->

  </div>  <!-- END .posting-tool-inner -->
</div>  <!-- END .posting-tool-outer -->
<style>
  .scheduling-details {
    display: none;
  }  
</style>