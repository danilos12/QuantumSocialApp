<div class="tag-group-controller">
    <div class"tag-group-option">
        <span class="tag-option-title-wrap">
            <img src="{{ asset('public/')}}/" class="ui-icon tag-option-icon" />
            <span class="tag-option-title">

            </span>
        </span> 
    </div> 
</div>  


<div class="tag-groups-column tag-groups-right-column">
    <div class="tag-group-display">

        <div class="tagset-wrap">

            <div class="add-tag-to-tagset">
            <form id="addTagForm">
                <input type="text" id="addTagForm_tags" name="addTagForm_tags" placeholder="Add a new tag here and press enter..." />
                <div class="tag-container">                                        
                </div>
            </form>
            </div>  <!-- END .add-tag-to-tagset -->                                  

        </div>  <!-- END .tagset-wrap -->

    </div>  <!-- END .tag-group-display -->
</div>  <!-- END .tag-groups-right-column -->


<div class="add-tweet-outer">
    <div class="add-tweet-inner">
        <div class="wait-to-tweet-col">
        <span class="wait-title">Wait</span>
        <select id="wait-number" name="wait-number" data-info="wait-timer" class="wait-number">
        @for ($i = 0; $i <= 59; $i++)
            <option value="{{  $i }}"> {{  $i }}</option>
        @endfor
        </select>
        <select id="wait-duration" name="wait-duration" data-check="wait-timer" class="custom-dhms wait-duration" >
            @php 
            $times = ['seconds', 'mins', 'hours', 'days']
            @endphp

            @foreach($times as $time) 
            <option value="{{ $time }}"> {{ $time }}</option>                                          
            @endforeach
        </select>
        </div>  <!-- END .wait-to-tweet-col -->
        <div class="new-post-wrap add-tweet-col">
        <div class="post-area-left new-post-left">
            <div class="post-area-wrap new-post-area-wrap">
            <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon post-type-indicator indicator-active" data-src="" />
            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" data-src="retweet-type-icon" />
            <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator" data-src="comment-type-icon"/>
            <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg"  class="ui-icon post-type-indicator" data-src="evergreen-type-icon" />
            <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator" data-src="promo-type-icon" />
            <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator" data-src="tweet-storm-type-icon" />
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


    {{-- JS --}}

    	// $('.add-tweet-initial').on('click', function() {
	// 	var innerText = `<div class="add-tweet-inner">
	// 					<div class="wait-to-tweet-col">
	// 					<span class="wait-title">Wait</span>
	// 					<select id="wait-number" name="wait-number" data-info="wait-timer" class="wait-number">
	// 						<option value="0"> 0</option>
	// 						<option value="1"> 1</option>
	// 						<option value="2"> 2</option>
	// 						<option value="3"> 3</option>
	// 						<option value="4"> 4</option>
	// 						<option value="5"> 5</option>
	// 						<option value="6"> 6</option>
	// 						<option value="7"> 7</option>
	// 						<option value="8"> 8</option>
	// 						<option value="9"> 9</option>
	// 						<option value="10"> 10</option>
	// 						<option value="11"> 11</option>
	// 						<option value="12"> 12</option>
	// 						<option value="13"> 13</option>
	// 						<option value="14"> 14</option>
	// 						<option value="15"> 15</option>
	// 						<option value="16"> 16</option>
	// 						<option value="17"> 17</option>
	// 						<option value="18"> 18</option>
	// 						<option value="19"> 19</option>
	// 						<option value="20"> 20</option>
	// 						<option value="21"> 21</option>
	// 						<option value="22"> 22</option>
	// 						<option value="23"> 23</option>
	// 						<option value="24"> 24</option>
	// 						<option value="25"> 25</option>
	// 						<option value="26"> 26</option>
	// 						<option value="27"> 27</option>
	// 						<option value="28"> 28</option>
	// 						<option value="29"> 29</option>
	// 						<option value="30"> 30</option>
	// 						<option value="31"> 31</option>
	// 						<option value="32"> 32</option>
	// 						<option value="33"> 33</option>
	// 						<option value="34"> 34</option>
	// 						<option value="35"> 35</option>
	// 						<option value="36"> 36</option>
	// 						<option value="37"> 37</option>
	// 						<option value="38"> 38</option>
	// 						<option value="39"> 39</option>
	// 						<option value="40"> 40</option>
	// 						<option value="41"> 41</option>
	// 						<option value="42"> 42</option>
	// 						<option value="43"> 43</option>
	// 						<option value="44"> 44</option>
	// 						<option value="45"> 45</option>
	// 						<option value="46"> 46</option>
	// 						<option value="47"> 47</option>
	// 						<option value="48"> 48</option>
	// 						<option value="49"> 49</option>
	// 						<option value="50"> 50</option>
	// 						<option value="51"> 51</option>
	// 						<option value="52"> 52</option>
	// 						<option value="53"> 53</option>
	// 						<option value="54"> 54</option>
	// 						<option value="55"> 55</option>
	// 						<option value="56"> 56</option>
	// 						<option value="57"> 57</option>
	// 						<option value="58"> 58</option>
	// 						<option value="59"> 59</option>
	// 					</select>
	// 					<select id="wait-duration" name="wait-duration" data-check="wait-timer" class="custom-dhms wait-duration">
							
							
	// 						<option value="seconds"> seconds</option>                                          
							
	// 						<option value="mins"> mins</option>                                          
							
	// 						<option value="hours"> hours</option>                                          
							
	// 						<option value="days"> days</option>                                          
	// 																</select>
	// 					</div>  <!-- END .wait-to-tweet-col -->
	// 					<div class="new-post-wrap add-tweet-col">
	// 					<div class="post-area-left new-post-left">
	// 						<div class="post-area-wrap new-post-area-wrap">
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-twitter.svg" class="ui-icon post-type-indicator indicator-active">
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator">
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator">
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-evergreen.svg" class="ui-icon post-type-indicator">
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator">
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator">
	// 						<textarea class="post-textarea new-post-area"></textarea>  <!-- END .primary-post-area -->
	// 						</div>  <!-- END .post-area-wrap -->
	// 						<div class="post-bottom-buttons new-post-bottom-buttons">
	// 						<span class="post-type-buttons new-post-type-buttons">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/16-evergreen.svg" class="ui-icon post-tool-icon evergreen-type-icon">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/17-promos.svg" class="ui-icon post-tool-icon promo-type-icon">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-tool-icon tweet-storm-type-icon">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-retweet.svg" class="ui-icon post-tool-icon retweet-type-icon">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-comments.svg" class="ui-icon post-tool-icon comment-type-icon">
	// 						</span>  <!-- END .post-type-buttons -->
	// 						<span class="post-option-buttons new-post-option-buttons">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon post-tool-icon hashtags-option-icon">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-envelope.svg" class="ui-icon post-tool-icon dm-option-icon">
	// 							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-time.svg" class="ui-icon post-tool-icon send-timer-icon">
	// 							<span class="post-counter">2/2</span>
	// 						</span>  <!-- END .post-option-buttons -->
	// 						</div>  <!-- END .post-bottom-buttons -->
	// 					</div>  <!-- END .post-area-left -->

	// 					<div class="post-area-right new-post-right">
	// 						<div class="post-right-buttons new-post-right-buttons">
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-close.svg" class="ui-icon post-tool-icon remove-new-tweet"><br>
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon"><br>
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon"><br>
	// 						<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon"><br>
	// 						</div>  <!-- END .post-right-buttons -->
	// 					</div>  <!-- END .post-area-right -->
	// 					</div>  <!-- END .new-post-wrap -->
	// 				</div>`
	// 	$('.add-tweet-inner').after(innerText);
	// })

							<img src="${APP_URL}/public/ui-images/icons/pg-twitter.svg" class="ui-icon post-type-indicator indicator-active" data-src="" />
						<img src="${APP_URL}/public/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" data-src="retweet-type-icon" />
						<img src="${APP_URL}/public/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator" data-src="comment-type-icon"/>
						<img src="${APP_URL}/public/ui-images/icons/16-evergreen.svg"  class="ui-icon post-type-indicator" data-src="evergreen-type-icon" />
						<img src="${APP_URL}/public/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator" data-src="promo-type-icon" />












///////////////////////////////////////////////////


        	// if (type === "comments-tweets") {
        	// 	$('.cross-tweet-profiles-outer').addClass('tweets-hide'); // hides the cross tweet 
        	// 	$postIcon.filter('img.post-tool-icon').addClass('disabled'); // disable all the icons
        	// 	$postIcon.filter('img[data-type="comments-tweets"]').removeClass('disabled'); // enable the comment icon
        	// } 			
			// else if (type === "evergreen-tweets") {
            //     console.log($lastButtonClicked, 'A');
            //     if ($lastButtonClicked === "tweet-storm-tweets") {
            //         $postIcon
            //             .filter(`[data-type="${$lastButtonClicked}"]`)
            //             .addClass("icon-active");
            //         $postPanels
            //             .filter(`[data-post="${$lastButtonClicked}"]`)
            //             .removeClass("tweets-hide");
            //     } else {
            //         console.log($lastButtonClicked);
            //     }   
            // }
			// else if (type === "promos-tweets") {    
            //     console.log($lastButtonClicked, 'B');
            //     if ($lastButtonClicked === "tweet-storm-tweets") {
			// 		$postIcon.filter(`[data-type="${$lastButtonClicked}"]`).addClass('icon-active')		
			// 		$postPanels.filter(`[data-post="${$lastButtonClicked}"]`).removeClass("tweets-hide");
			// 	} else {
            //         console.log($lastButtonClicked);
            //     }
            // }
			// else if (type === "retweet-tweets") {                
            //     console.log($lastButtonClicked, 'C');
			// 	if ($lastButtonClicked === "tweet-storm-tweets") {
            //         $postIcon.filter(`[data-type="${$lastButtonClicked}"]`).addClass("icon-active");
            //         $postPanels.filter(`[data-post="${$lastButtonClicked}"]`).removeClass("tweets-hide");
            //     } else {
            //         console.log($lastButtonClicked);
            //         $postIcon.filter(`[data-type="${$lastButtonClicked}"]`).removeClass("icon-active");
            //         $postPanels.filter(`[data-post="${$lastButtonClicked}"]`).addClass("tweets-hide");                                                            
            //     }   
                                
            //     $retweetTimerIcon.removeClass("tweets-hide"); // shows the icon
            // } 