/**
 * Authors: Carlo Ariel Sandig
 * 
*/

$(function($) {
	// emoji-picker
	$("#emojionearea").emojioneArea({
      // container: "#primary_post_text_area", // by selector
      pickerPosition: "left",
      filtersPosition: "bottom",
      tonesStyle: "square",
      recentEmojis: false,
	  search: false,
	  tones: false
    });
  
    $('.primary-post-right-buttons .add-emoji-icon').on('click', function () {
		var isOpen = $(this).data('emoji-open');

		if (isOpen == 0) {
			$(this).data('emoji-open', 1);
			$('.emojionearea-button').addClass('active');
			$('.emojionearea-picker.emojionearea-picker-position-left.emojionearea-filters-position-bottom.emojionearea-search-position-top').removeClass('hidden');
		} else {
			$(this).data('emoji-open', 0);
			$('.emojionearea-button').removeClass('active');
			$('.emojionearea-picker.emojionearea-picker-position-left.emojionearea-filters-position-bottom.emojionearea-search-position-top').addClass('hidden');

		}
    })
	
	// pull hashtags from database
	$.ajax({
        type: 'GET',
        url: APP_URL + '/get-tag-groups/' + TWITTER_ID, // Use the URL of your server-side script here
        success: function(response) {
            // Add the existing tag groups to the page
            
			console.log(response)
            $.each(response, function(index, k) {
				console.log(k);
                
				var option = $('<option>').addClass('modal-select-tag-group').attr('value', k.tag_group_mkey).text(k.tag_group_mvalue)                
                $(option).appendTo($('select#tag-groups'));
            })
            
        },
        error: function(xhr, status, error) {
            console.log('An error occurred while fetching the existing tag groups: ' + error);
        }
    });

    // selecting the hashtag
   	$('select#tag-groups').on('click', function(e) {
		$('.modal-tag-group-display').empty()
        $.ajax({
            type: 'GET',
            url: APP_URL + '/get-tag-items/' , // Use the URL of your server-side script here
            data: {
                twitter_id: TWITTER_ID,
                tag_id : this.value
            },
            success: function(response) {
                // Add the existing tag groups to the page       
                if (response.length > 0) {
                    $.each(response, function(index, k) {
                        console.log(k)
						var span = $('<span>').addClass('modal-tag-instance').text(k.tag_meta_value);       
						$(span).appendTo($('.modal-tag-group-display'))         
                    })
                }       

				// add active in hashtag instance 
				$(".modal-tag-instance").click(function(e) {
					$(this).attr('status', 'active')
				})

				console.log(response)
            },
            error: function(xhr, status, error) {
                console.log('An error occurred while fetching the existing tag groups: ' + error);
            }
        });
    });   
	
	
	// bgIcon changes and post-alert
	$('.post-type-icon').on('click', function(){
		var id = $(this).attr('id');
		var selected = $(this).attr('data-select');
		var type = $(this).attr('data-type');
		
		// add value for non special
		$('input[name="post_type_tweets"]').val('regular_tweets');
		
		
		// loop all icons
		$('.post-type-icon').each(function(){			
			var indType = $(this).attr('data-type');			

			// set select to hide
			$(this).attr('data-select', 0);
			
			// $('img[data-type="retweet-timer-tweets"').attr('style','opacity: 0.75;min-width: 20px;max-width: 20px;max-height: 20px;');

			// remove the style
			$(this).removeAttr('style');					
			$(this).parent('.img-icon-btn').removeAttr('style'); // add styles

			// if the data type is retweet open the timer
			if (type === 'retweet-tweets') {
				$('span.primary-post-option-buttons').find('img.retweet-timer-icon').removeClass('tweets-hide');	
				$('img[data-type="retweet-timer-tweets"').attr('data-select', 0);			
				// $('span.primary-post-option-buttons').find('img.retweet-timer-icon').attr('data-select', '1');				
				// $('span.primary-post-option-buttons').find('img.retweet-timer-icon').attr('style','opacity: 1;min-width: 25px;max-width: 25px;max-height: 25px;');				
			} else {
				// $('span.primary-post-option-buttons').find('img.retweet-timer-icon').attr('style','opacity: 0.75;min-width: 20px;max-width: 20px;max-height: 20px;');
				$('span.primary-post-option-buttons').find('img.retweet-timer-icon').addClass('tweets-hide');				
				// $('div[data-post="retweet-timer-tweets"]').addClass('tweets-hide');
			}
			
			// hide all section panels
			$('div[data-post="'+indType+'"]').addClass('tweets-hide');
		});
			
		// update the data to 1 to activate the icon
		if(selected == 0) {			
			$('#'+id).attr('data-select', 1); // select as enabled
			$('#'+id).attr('style','opacity: 1;min-width: 25px;max-width: 25px;max-height: 25px;'); // add styles
			// $('#'+id).parent('.img-icon-btn').attr('style','background:#43EBF1'); // add styles
			$('input[name="post_type_tweets"]').val(type); // add the post_type for database
			$('div[data-post="'+type+'"]').removeClass('tweets-hide'); // open the panel to activate			
			if (type === 'retweet-tweets') {
				$('span.primary-post-option-buttons').find('img.retweet-timer-icon').removeClass('tweets-hide');	
			}
			$('div[data-post="retweet-timer-tweets"]').addClass('tweets-hide');
			
			// last 2 icons
			$('.primary-post-area-wrap').find('img.post-type-indicator').removeClass('indicator-active'); // remove active in all icons
			$('.primary-post-area-wrap').find('img.post-type-indicator[data-src="'+type+'"]').addClass('indicator-active'); // activate the clicked icon
		} else {			
			// $('span.primary-post-option-buttons').find('img.retweet-timer-icon').addClass('tweets-hide');	// hide the timer
			$('#'+id).attr('style','opacity: .75;min-width: 20px;max-width: 20px;max-height: 20px;'); // add styles
			$('span.primary-post-option-buttons').find('img.retweet-timer-icon').attr('style','opacity: 0.75;min-width: 20px;max-width: 20px;max-height: 20px;');
			$('.primary-post-area-wrap').find('img.post-type-indicator').removeClass('indicator-active'); // remove active in all icons
			$('.primary-post-area-wrap img.post-type-indicator[data-src="twitter-tweets"]').addClass('indicator-active'); // logo to default state		
			$('span.primary-post-option-buttons').find('img.retweet-timer-icon').removeClass('tweets-hide');	// hide the timer
		}				
	});		

	// retweet toggle the section (open)
	$('img.retweet-timer-icon').on('click',function() {
		var ggg = $(this).attr('data-select');
		var id = $(this).attr('data-type');
		// $(this).attr('data-select', 0);

		console.log(ggg, id)

		if(ggg == 1) {			
			$(this).attr('data-select', 0);
			$(this).attr('style','opacity: 0.75;min-width: 20px;max-width: 20px;max-height: 20px;');
			$('div[data-post="' + id + '"]').addClass('tweets-hide');
		} else {
			$(this).attr('data-select', 1);
			$(this).attr('style','opacity: 1;min-width: 25px;max-width: 25px;max-height: 25px;');
			$('div[data-post="' + id + '"]').removeClass('tweets-hide');
			// $('#' + id).removeClass('tweets-hide');
		}
	})
	
	// time
	$('.custom-dhms').on('change', function(){
		var bgg = $(this).attr('data-check');
		
		var txx = $('select[data-info="'+bgg+'"]');
		var opp = '';
		
		txx.html('');
		
		if($(this).val() == 'hours') {
			for (let i = 1; i < 24; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		if($(this).val() == 'days') {
			for (let i = 1; i <= 90; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		if($(this).val() == 'mins') {
			for (let i = 1; i <= 59; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		if($(this).val() == 'seconds') {
			for (let i = 1; i <= 59; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		
		txx.append(opp);
		console.log('iterations');
		
	});	
	
	// schedule
	$('select[name="scheduling-options"]').on('change', function(){
		var fvv = $('#scheduling-method-xxx');
		var svv = $(this).val();
		var sopp = '';
		
		fvv.attr('data-schedule', 'none');
		
		
		$('#scheduling-cdn').removeAttr('data-info name');
		$('#scheduling-cdmins').removeAttr('data-check name');
		
		if(svv == 'set-countdown') {
			fvv.attr('data-schedule', svv);
			
			$('#scheduling-cdn').attr({"data-info":svv, "name":"c-"+svv});
			$('#scheduling-cdmins').attr({"data-check":svv, "name":"ct-"+svv});
			
			$('#scheduling-cdn').html('');
			
			for (let i = 1; i <= 59; i++) {
			  sopp += '<option value="'+i+'">'+i+'</option>';
			}
			
			$('#scheduling-cdn').append(sopp);
		}
		if(svv == 'custom-time') {
			
			fvv.attr('data-schedule', svv);
			$('#scheduling-cdn').attr({"data-info":svv, "name":"c-"+svv});
			$('#scheduling-cdmins').attr({"data-check":svv, "name":"ct-"+svv});
			
			$('#scheduling-cdn').html('');
			
			for (let i = 1; i <= 59; i++) {
			  sopp += '<option value="'+i+'">'+i+'</option>';
			}
			
			$('#scheduling-cdn').append(sopp);
			
		}
		
		console.log('scheduling');
		
	});	
	
	// form submit
	const form = $('#posting-tool-form-001');
	$('#posting-tool-form-001').on('submit', function(e){
		e.preventDefault();

		console.log(e);
		// const form = document.querySelector('#posting-tool-form-001');
		const formData = new FormData(form[0]);
		
		console.log(formData)


		form.find('input[type="submit"]').prop('disabled', true);
		form.find('input[type="submit"]').val('Please wait..');

		// Make an AJAX request to submit the form data to the server
		$.ajax({
			url: $(this).data('url'),
			method: "POST",
			data: formData,
			contentType: false,
			processData: false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response){
				// Handle the server response here
				console.log(response)
				form.find('input[type="submit"]').prop('disabled', false);
				form.find('input[type="submit"]').val('Data Saved!');
			},
			error: function(jqXHR, textStatus, errorThrown){
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
					if (element.nodeName === "INPUT" || element.nodeName === "SELECT" || element.nodeName === "TEXTAREA") {
						// clear the value of the input field
						element.value = "";
						// console.log(element.nodeName)
						// console.log(element.value)
						
					}
				}

				form.find('input[type="submit"]').val('Beam me up scotty!');

			}		
		});		
	});

	// send tags to textarea
	$('.tags-submit').on('click', function() {
		const activeTags = $(".modal-tag-instance[status='active']");
		const activeTagTexts = activeTags.map(function() {
			return $(this).text().trim();
		}).get();

		console.log(activeTagTexts);
		var textArea = $('#emojionearea');
		var textAreaMoji = $('.emojionearea-editor');
		var textInside = textArea.val();
		var textInsideMoji = textAreaMoji.html();

		var withTags = textInside + ' ' + activeTagTexts.join(' ');
		var withTagsMoji = textInsideMoji + ' ' + activeTagTexts.join(' ');
		
		textArea.val(withTags)
		textAreaMoji.html(withTagsMoji)
	})
	

	$('.add-tweet-initial').on('click', function() {
		var innerText = `<div class="add-tweet-inner">
						<div class="wait-to-tweet-col">
						<span class="wait-title">Wait</span>
						<select id="wait-number" name="wait-number" data-info="wait-timer" class="wait-number">
							<option value="0"> 0</option>
							<option value="1"> 1</option>
							<option value="2"> 2</option>
							<option value="3"> 3</option>
							<option value="4"> 4</option>
							<option value="5"> 5</option>
							<option value="6"> 6</option>
							<option value="7"> 7</option>
							<option value="8"> 8</option>
							<option value="9"> 9</option>
							<option value="10"> 10</option>
							<option value="11"> 11</option>
							<option value="12"> 12</option>
							<option value="13"> 13</option>
							<option value="14"> 14</option>
							<option value="15"> 15</option>
							<option value="16"> 16</option>
							<option value="17"> 17</option>
							<option value="18"> 18</option>
							<option value="19"> 19</option>
							<option value="20"> 20</option>
							<option value="21"> 21</option>
							<option value="22"> 22</option>
							<option value="23"> 23</option>
							<option value="24"> 24</option>
							<option value="25"> 25</option>
							<option value="26"> 26</option>
							<option value="27"> 27</option>
							<option value="28"> 28</option>
							<option value="29"> 29</option>
							<option value="30"> 30</option>
							<option value="31"> 31</option>
							<option value="32"> 32</option>
							<option value="33"> 33</option>
							<option value="34"> 34</option>
							<option value="35"> 35</option>
							<option value="36"> 36</option>
							<option value="37"> 37</option>
							<option value="38"> 38</option>
							<option value="39"> 39</option>
							<option value="40"> 40</option>
							<option value="41"> 41</option>
							<option value="42"> 42</option>
							<option value="43"> 43</option>
							<option value="44"> 44</option>
							<option value="45"> 45</option>
							<option value="46"> 46</option>
							<option value="47"> 47</option>
							<option value="48"> 48</option>
							<option value="49"> 49</option>
							<option value="50"> 50</option>
							<option value="51"> 51</option>
							<option value="52"> 52</option>
							<option value="53"> 53</option>
							<option value="54"> 54</option>
							<option value="55"> 55</option>
							<option value="56"> 56</option>
							<option value="57"> 57</option>
							<option value="58"> 58</option>
							<option value="59"> 59</option>
						</select>
						<select id="wait-duration" name="wait-duration" data-check="wait-timer" class="custom-dhms wait-duration">
							
							
							<option value="seconds"> seconds</option>                                          
							
							<option value="mins"> mins</option>                                          
							
							<option value="hours"> hours</option>                                          
							
							<option value="days"> days</option>                                          
																	</select>
						</div>  <!-- END .wait-to-tweet-col -->
						<div class="new-post-wrap add-tweet-col">
						<div class="post-area-left new-post-left">
							<div class="post-area-wrap new-post-area-wrap">
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-twitter.svg" class="ui-icon post-type-indicator indicator-active">
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator">
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator">
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-evergreen.svg" class="ui-icon post-type-indicator">
							<img src="http://www.quantumsocial.local/public/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator">
							<img src="http://www.quantumsocial.local/public/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator">
							<textarea class="post-textarea new-post-area"></textarea>  <!-- END .primary-post-area -->
							</div>  <!-- END .post-area-wrap -->
							<div class="post-bottom-buttons new-post-bottom-buttons">
							<span class="post-type-buttons new-post-type-buttons">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/16-evergreen.svg" class="ui-icon post-tool-icon evergreen-type-icon">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/17-promos.svg" class="ui-icon post-tool-icon promo-type-icon">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-tool-icon tweet-storm-type-icon">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-retweet.svg" class="ui-icon post-tool-icon retweet-type-icon">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-comments.svg" class="ui-icon post-tool-icon comment-type-icon">
							</span>  <!-- END .post-type-buttons -->
							<span class="post-option-buttons new-post-option-buttons">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon post-tool-icon hashtags-option-icon">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-envelope.svg" class="ui-icon post-tool-icon dm-option-icon">
								<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-time.svg" class="ui-icon post-tool-icon send-timer-icon">
								<span class="post-counter">2/2</span>
							</span>  <!-- END .post-option-buttons -->
							</div>  <!-- END .post-bottom-buttons -->
						</div>  <!-- END .post-area-left -->

						<div class="post-area-right new-post-right">
							<div class="post-right-buttons new-post-right-buttons">
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-close.svg" class="ui-icon post-tool-icon remove-new-tweet"><br>
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon"><br>
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon"><br>
							<img src="http://www.quantumsocial.local/public/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon"><br>
							</div>  <!-- END .post-right-buttons -->
						</div>  <!-- END .post-area-right -->
						</div>  <!-- END .new-post-wrap -->
					</div>`
		$('.add-tweet-inner').after(innerText);
	})
	

	$('.cross-tweet-profile-image').on('click', function() {
		$(this).attr('status', 'active');
	})

	// add new tweet instance
	
});