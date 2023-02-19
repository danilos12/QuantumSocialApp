/**
 * Authors: Carlo Ariel Sandig
 * 
*/

jQuery(function($) {
	
	jQuery('.new-slot-form').submit(function(idt){
		idt.preventDefault();
		console.log('schedule');
		
		var fm = jQuery(this);
		var er = 0;
		
		fmData = fm.serialize();
		fm.find('.some-messages').removeClass('active').html('');
		fm.find('input[type="submit"]').hide();
		
		fm.find('input, select').each(function(i){
			var vl = jQuery(this).val();
			var id = jQuery(this).attr('id');
			if ( vl == '' ) {
				jQuery(this).addClass('idt_error_field');
				er += 1;
			}
		});
		if ( er > 0 ) {
			fm.find('.some-messages').addClass('active').html('Some fields are required, please fill up them then try again.');
			fm.find('input[type="submit"]').show();
			return false;
		}
		
		
		jQuery.ajax({
			type:'POST', dataType:'json', url:'https://app.quantumsocial.io/add-new-slot', data:fmData,
			beforeSend: function() {
				fm.find('.some-messages').addClass('active').html('<img style="width: 30px;height: 30px;" src="'+window.location.protocol + '//' + window.location.hostname +'/public/ui-images/spinner-icon-gif-21.gif">');
			},
			error: function (err) {
				fm.find('.some-messages').addClass('active').html('Please contact the owner.');
				console.log('~some 1 server error~');
			}
		}).done(function( data ) {
			if ( data.status === 'error' ){
				console.log(data);
				fm.find('.some-messages').removeClass('active').html('Successfully Added.');
			
			} else if ( data.status === 'success' ) {
				// reset
				
				fm.find('.redirectLink').attr('style', 'display: block;');
				fm.find('.some-messages').removeClass('active').html('Successfully Added.');
				
				var ptime = 2;
				var finterval = setInterval(function(){
					$('#saved-countdown').text(ptime);
					ptime = ptime - 1;
					if(ptime == 0){
						clearInterval(finterval);
						location.assign(window.location.protocol + '//' + window.location.hostname + '/schedule/');
					}
				}, 1000);
				
				
			}
		});
		
		
		
		
	});	
	
});