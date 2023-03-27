
        <li class="menu-item menu-margin">
            <a href="{{ route('dashboard') }}">
                <img src = "{{ asset('public/ui-images/icons/01-dashboard.svg') }}" class="menu-icon" />Dashboard
            </a>                  
        </li>
        <li class="menu-item menu-margin launch-command-module" data-id="modal" id="command-module">
            <img src = "{{ asset('public/ui-images/icons/pg-command.svg') }}" class="menu-icon" />
            Command Module
        </li>
        <li class="menu-item menu-margin">
            <a href="{{ route('profiles') }}">
                <img src = "{{ asset('public/ui-images/icons/02-profile.svg') }}" class="menu-icon" />Profile
            </a>
        </li>
        
        <li class="menu-item" data-toggle="collapse" data-target="#posting" aria-expanded="false">                    
            <img src = "{{ asset('public/ui-images/icons/03-posting.svg') }}" class="menu-icon" />Posting
        </li>
        <ul class="sub-menu menu-margin" id="posting" aria-expanded="false">
            <li id="queue">
                <a href="{{ route('queue') }}"><img src = "{{asset('public/ui-images/icons/04-queue.svg')}} " class="menu-icon" />
                    Queue
                </a>
            </li>

            <li id="drafts">
                <a href="{{ route('drafts') }}"><img src = " {{asset('public/ui-images/icons/05-drafts.svg')}} " class="menu-icon" />
                    Drafts
                </a>
            </li>

            <li id="posted">
                <a href="{{ route('posted') }}">
                    <img src = "{{asset('public/ui-images/icons/06-posted.svg')}} " class="menu-icon" />
                    Posted
                </a>
            </li>

            <li id="slot-scheduler">	
                <a href="{{ route('slot-scheduler') }}">
                    <img src = "{{asset('public/ui-images/icons/07-schedule.svg')}} " class="menu-icon" />
                    Slot Scheduler
                </a>
            </li>

            <li id="tweet-stormer">	
                <a href="{{ route('tweet-stormer') }}">
                    <img src = "{{asset('public/ui-images/icons/08-tweet-storm.svg')}} " class="menu-icon" />
                    Tweet Stormer
                </a>
            </li>

            <li id="bulk-uploader">
                <a href="{{ route('bulk-uploader') }}">
                    <img src = " {{asset('public/ui-images/icons/09-bulk-upload.svg')}} " class="menu-icon" />
                    Bulk Uploader
                </a>
            </li>
        </ul>

        <li class="menu-item" data-toggle="collapse" data-target="#engagement">
        <!-- <a href="{{ route('social-engage') }}"></a> -->
            <img src = "{{ asset('public/ui-images/icons/10-engagement.svg')}}" class="menu-icon" />Engagement
        </li>
        <ul  class="sub-menu menu-margin" id="engagement">
            <li id="engage">
                <a href="{{ route('social-engage') }}">
                    <img src = "{{asset('public/ui-images/icons/11-engage.svg')}} " class="menu-icon" />
                    Engage
                </a>
            </li>
            <li id="mentions">
                <a href="{{ route('social-mentions') }}"><img src = " {{asset('public/ui-images/icons/12-mentions.svg')}}" class="menu-icon" />
                    Mentions
                </a>
            </li>
            <li id="user-feeds">
                <a href="{{ route('social-user-feeds') }}"><img src = " {{asset('public/ui-images/icons/13-user-feeds.svg')}} " class="menu-icon" />
                    User Feeds
                </a>
            </li>
            <li id="user-lists">
                <a href="{{ route('social-user-lists') }}"><img src = " {{asset('public/ui-images/icons/pg-list.svg')}} " class="menu-icon" />
                    User Lists
                </a>
            </li>
            <li id="hashtag-feeds">
                <a href="{{ route('social-hashtag-feeds') }}"><img src = "{{asset('public/ui-images/icons/14-hashtag-feeds.svg')}}" class="menu-icon" />
                    Hashtag Feeds
                </a>
            </li>
        </ul>

        <li class="menu-item" data-toggle="collapse" data-target="#campaigns">
        <!-- <a href="{{ route('promo-tweets') }}"></a> -->
            <img src = "{{asset('public/ui-images/icons/15-campaigns.svg')}} " class="menu-icon" />
                Campaigns
        </li>
        <ul class="sub-menu menu-margin" id="campaigns">
            <li id="promo"> 
                <a href="{{ route('promo-tweets') }}">
                    <img src = "{{asset('public/ui-images/icons/17-promos.svg')}} " class="menu-icon" />
                    Promo Tweets
                </a>
            </li>
            <li id="evergreen">
                <a href="{{ route('evergreen-tweets') }}">
                    <img src = "{{asset('public/ui-images/icons/16-evergreen.svg')}} " class="menu-icon" />
                    Evergreen Tweets
                </a>
            </li>
            <li id="tweet-storms">
                <a href="{{ route('tweet-storms') }}"> 
                    <img src = "{{asset('public/ui-images/icons/pg-storms.svg')}} " class="menu-icon" />
                    Tweet Storms
                </a>
            </li>
            <li id="tag-groups">
                <a href="{{ route('tag-groups') }}"> 
                    <img src = "{{asset('public/ui-images/icons/18-tag-groups.svg')}} " class="menu-icon" />
                    Tag Groups
                </a>
            </li>
        </ul>

        <li class="menu-item">
            <a href="{{ route('trending-topics') }}">
                <img src = "{{asset('public/ui-images/icons/19-trending.svg')}} " class="menu-icon" />Trending Topics
            </a>
        </li>
  