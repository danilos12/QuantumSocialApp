@if (is_array($tweets))
                    
@foreach($tweets as $tweet)      
<!-- BEGIN Single Post Instance -->
<div class="mosaic-posts-outer">
    <div class="mosaic-watermark-wrap frosted">
    <img src="{{ asset('public') }}/ui-images/icons/pg-x.svg" class="mosaic-watermark" />
    <div class="mosaic-posts-inner">

        <div class="mosaic-post-controls">
        <span class="mosaic-control-icon">
            <img src="{{ asset('public') }}/ui-images/icons/pg-x.svg" class="ui-icon" /></span>
        <span class="mosaic-control-icon">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon" /></span>
        </div>  <!-- END .mosaic-post-controls -->

        <div class="global-twitter-profile-header">
        <a href="#">
            <img src="{{ $user ? $user->twitter_photo : asset('public/temp-images/imgpsh_fullsize_anim (1).png') }}"
            class="global-profile-image" /></a>
        <div class="global-profile-details">
            <div class="global-profile-name">
            <a href="#">{{ $user ? $user->twitter_name : "Test"  }}</a>
            </div>  <!-- END .global-author-name -->
            <div class="global-profile-subdata">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon" />
            <span class="global-post-date">
                
                <a href="">{{ date('M d, Y h:i A', strtotime($tweet->created_at)) }}</a></span>
            </div>  <!-- END .global-post-date-wrap -->
        </div>  <!-- END .global-author-details -->
        </div>  <!-- END .global-twitter-profile-header -->

        <div class="mosaic-post-data">
        <div class="mosaic-post-text">
            {{ $tweet->text }}
        </div>  <!-- END .mosaic-post-text -->

        @if(isset($tweet->image))
            <img src="{{ $tweet->image}}" alt="tweet image" data-twitter-image="imgId" height="500" width="auto">
        @endif
        </div>  <!-- END .mosaic-post-data -->

        <div class="mosaic-post-scheduling">

        <div class="mosaic-scheduling mosaic-scheduling-now">

            <span class="mosaic-label mosaic-now-label">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-command.svg" class="ui-icon" />
            Now
            </span>
            <span class="mosaic-sched-buttons mosaic-now-buttons">
            <img src="{{ asset('public') }}/ui-images/icons/pg-heart.svg" class="ui-icon" />
            <img src="{{ asset('public') }}/ui-images/icons/pg-comment.svg" class="ui-icon comment-now-icon" />
            <img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            </span>

        </div>  <!-- END .mosaic-scheduling-now -->


        <div class="mosaic-scheduling mosaic-scheduling-future">

            <span class="mosaic-label mosaic-future-label">
            <img src="{{ asset('public/')}}/ui-images/icons/04-queue.svg" class="ui-icon" />
            Schedule
            </span>
            <span class="mosaic-sched-buttons mosaic-future-buttons">
            <img src="{{ asset('public') }}/ui-images/icons/pg-comment.svg" class="ui-icon" />
            <img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            <img src="{{ asset('public') }}/ui-images/icons/16-evergreen.svg" class="ui-icon" />
            </span>

        </div>  <!-- END .mosaic-scheduling-future -->


        <div class="mosaic-scheduling mosaic-post-analytics">

            <span class="mosaic-label mosaic-analytics-label">
            <img src="{{ asset('public') }}/ui-images/icons/pg-analytics.svg" class="ui-icon" />
            Analytics
            </span>
            <span class="mosaic-sched-buttons mosaic-analytics-buttons">
            <img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            <span class="mosaic-stat stat-retweets">2.20</span>
            <img src="{{ asset('public') }}/ui-images/icons/pg-heart.svg" class="ui-icon" />
            <span class="mosaic-stat stat-hearts">2010</span>
            </span>

        </div>  <!-- END .mosaic-post-analytics -->

        </div>  <!-- END .mosaic-post-scheduling -->

    </div>  <!-- END .mosaic-posts-inner -->
    </div>  <!-- END .mosaic-watermark-wrap -->


    <div class="comment-now-modal">
    <div class="comment-now-modal-inner frosted">

        <form>
        <textarea></textarea>
        <input type="submit" class="comment-now-submit" value="Comment Now" />
        </form>

    </div>  <!-- END .comment-now-modal-inner -->
    </div>  <!-- END .comment-now-modal -->

</div>  <!-- END .mosaic-posts-outer -->
<!-- END Single Post Instance -->

@endforeach

@else   
<p> No tweets found </p>
@endif