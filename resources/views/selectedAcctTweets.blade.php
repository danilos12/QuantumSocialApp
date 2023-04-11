<div class="page-inner profile-inner">

    <div class="page-head-n-sort">
    <span class="profile-heading">
        Reschedule Your Own Posts</span>
    <img src="{{ asset('public/')}}/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
    </div>  <!-- END .page-head-n-sort -->

    <div class="filter-controls">
    <div class="drop-button-wrap filter-wrap">
        <span class="white-select-button profile-filter-select">
        <img src="{{ asset('public/')}}/ui-images/icons/pg-filter.svg" class="ui-icon" />
        Filter by:
        <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
        </span>
        <ul class="page-filters-dropdown profile-filter-dropdown frosted">
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            All Tweets</li>
        <li><img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
            Retweets Only</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-quote.svg" class="ui-icon" />
            Quoted Tweets Only</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon" />
            Comments Only</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-no-replies.svg" class="ui-icon" />
            Exclude Retweets & Comments</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-image.svg" class="ui-icon" />
            Tweets w/Media Only</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-links.svg" class="ui-icon" />
            Tweets w/Links Only</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-no-links.svg" class="ui-icon" />
            Tweets w/o Links</li>
        </ul>
    </div>  <!-- END .filter-wrap -->
    <div class="drop-button-wrap sort-wrap">
        <span class="white-select-button profile-sort-select">
        <img src="{{ asset('public/')}}/ui-images/icons/pg-sort.svg" class="ui-icon" />
        Sort by:
        <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
        </span>
        <ul class="page-filters-dropdown profile-sort-dropdown frosted">
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon" />
            Chronology</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon" />
            Retweets</li>
        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
            Favorites</li>
        </ul>
    </div>  <!-- END .sort-wrap -->
    </div>  <!-- END .filter-controls -->
    
    <div class="tweetSection">
        <!-- BEGIN Single Post Instance -->
       
        <!-- END Single Post Instance -->

        <div class="profile-posts-inner" id="primaryPostTemplate">   

        </div>  <!-- END .profile-posts-inner -->
    </div>

</div>  <!-- END .pr-->

<style>

    .mosaic-post-data {
        height: auto
    }

    .tweetSection {
        margin-bottom: 10em
    }
</style>

