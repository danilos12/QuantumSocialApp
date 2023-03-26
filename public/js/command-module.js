/**
 * Authors: Carlo Ariel Sandig
 * 
*/

jQuery(function($) {
	
	// bgIcon changes
	jQuery('.post-type-icon').click(function(){
		var id = jQuery(this).attr('id');
		var ggg = jQuery(this).attr('data-select');
		var ttt = jQuery(this).attr('data-type');
		
		jQuery('input[name="post_type_tweets"]').val('regular_tweets');
		
		// for first 3 icons
		if (ttt === "evergreen-tweets" || ttt === "promos-tweets" || ttt === "tweet-storms-tweets") {
			jQuery('.post-type-icon').each(function(){			
				var ccc = jQuery(this).attr('data-type');
				jQuery(this).attr('data-select', 0);
				jQuery(this).removeAttr('style');
				jQuery('div[data-post="'+ccc+'"]').addClass('tweets-hide');
			});
			
			if(ggg === 0) {
				jQuery('#'+id).attr('data-select', 1);
				jQuery('#'+id).attr('style','opacity: 1;min-width: 25px;max-width: 25px;max-height: 25px;');
				jQuery('input[name="post_type_tweets"]').val(ttt);
				jQuery('div[data-post="'+ttt+'"]').removeClass('tweets-hide');
			}
		}
			
		// last 2 icons
		jQuery('.primary-post-area-wrap').find('img.post-type-indicator').removeClass('indicator-active');
		var bgIcon = jQuery('.primary-post-area-wrap').find('img.post-type-indicator[data-src="'+ttt+'"').addClass('indicator-active');
		
		console.log('post type');
	});	
	
	jQuery('.custom-dhms').change(function(){
		var bgg = jQuery(this).attr('data-check');
		
		var txx = jQuery('select[data-info="'+bgg+'"]');
		var opp = '';
		
		txx.html('');
		
		if(jQuery(this).val() == 'hours') {
			for (let i = 1; i < 24; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		if(jQuery(this).val() == 'days') {
			for (let i = 1; i <= 90; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		if(jQuery(this).val() == 'mins') {
			for (let i = 1; i <= 59; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		if(jQuery(this).val() == 'seconds') {
			for (let i = 1; i <= 59; i++) {
			  opp += '<option value="'+i+'">'+i+'</option>';
			}
		}
		
		
		txx.append(opp);
		console.log('iterations');
		
	});	
	
	jQuery('select[name="scheduling-options"]').change(function(){
		var fvv = jQuery('#scheduling-method-xxx');
		var svv = jQuery(this).val();
		var sopp = '';
		
		fvv.attr('data-schedule', 'none');
		
		
		jQuery('#scheduling-cdn').removeAttr('data-info name');
		jQuery('#scheduling-cdmins').removeAttr('data-check name');
		
		if(svv == 'set-countdown') {
			fvv.attr('data-schedule', svv);
			
			jQuery('#scheduling-cdn').attr({"data-info":svv, "name":"c-"+svv});
			jQuery('#scheduling-cdmins').attr({"data-check":svv, "name":"ct-"+svv});
			
			jQuery('#scheduling-cdn').html('');
			
			for (let i = 1; i <= 59; i++) {
			  sopp += '<option value="'+i+'">'+i+'</option>';
			}
			
			jQuery('#scheduling-cdn').append(sopp);
		}
		if(svv == 'custom-time') {
			
			fvv.attr('data-schedule', svv);
			jQuery('#scheduling-cdn').attr({"data-info":svv, "name":"c-"+svv});
			jQuery('#scheduling-cdmins').attr({"data-check":svv, "name":"ct-"+svv});
			
			jQuery('#scheduling-cdn').html('');
			
			for (let i = 1; i <= 59; i++) {
			  sopp += '<option value="'+i+'">'+i+'</option>';
			}
			
			jQuery('#scheduling-cdn').append(sopp);
			
		}
		
		console.log('scheduling');
		
	});	
	
	
	$('#posting-tool-form-001').submit(function(e){
		console.log(e);
		e.preventDefault();
		// const form = document.querySelector('#posting-tool-form-001');
		const form = $('#posting-tool-form-001');
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
					console.log(form[0].elements.length)
					const element = form[0].elements[i];
					console.log(element)


					// check if the element is an input field
					if (element.nodeName === "INPUT" || element.nodeName === "SELECT" || element.nodeName === "TEXTAREA") {
						// clear the value of the input field
						element.value = "";
						console.log(element.nodeName)
						console.log(element.value)
						
					}
				}

				form.find('input[type="submit"]').val('Beam me up scotty!');

			}		
		});
	});

	$('.tags-submit').on('click', function() {
		const activeTags = $(".modal-tag-instance[status='active']");
		const activeTagTexts = activeTags.map(function() {
			return $(this).text().trim();
		}).get();

		console.log(activeTagTexts);
		var textArea = $('.post-textarea');
		var textInside = textArea.val();

		var withTags = textInside + ' ' + activeTagTexts.join(' ');
		
		textArea.val(withTags)
	})
	// $('#beam-btn').on('click', function() {
	// 	// get the button element
	// 	var $myButton = $(this);

	// 	// check if validation passes
	// 	if (validationPasses) {
	// 	// enable the button and remove the tooltip
	// 	$myButton.prop('disabled', false).removeAttr('title');
	// 	} else {
	// 	// disable the button and show the tooltip
	// 	$myButton.prop('disabled', true).attr('title', 'Please add a Twitter account first');
	// 	}
	// })

	jQuery('.add-tweet-initial').on("click", function() {
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
	
});