/**
 * Authors: Carlo Ariel Sandig
 * 
*/

jQuery(function($) {
	
	jQuery('.post-type-icon').click(function(){
		var id = jQuery(this).attr('id');
		var ggg = jQuery(this).attr('data-select');
		var ttt = jQuery(this).attr('data-type');
		
		jQuery('input[name="post_type_tweets"]').val('regular_tweets');
		
		jQuery('.post-type-icon').each(function(){
			var ccc = jQuery(this).attr('data-type');
			jQuery(this).attr('data-select', 0);
			jQuery(this).removeAttr('style');
			jQuery('div[data-post="'+ccc+'"]').addClass('tweets-hide');
		});
		
		if(ggg == 0) {
			jQuery('#'+id).attr('data-select', 1);
			jQuery('#'+id).attr('style','opacity: 1;min-width: 25px;max-width: 25px;max-height: 25px;');
			jQuery('input[name="post_type_tweets"]').val(ttt);
			jQuery('div[data-post="'+ttt+'"]').removeClass('tweets-hide');
		}
		
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
	
	
	jQuery('#posting-tool-form-001').submit(function(carl){
		carl.preventDefault();
		console.log('carl');
		
		var fidt = jQuery(this);
		var er = 0;
		
		fmDatac = fidt.serialize();
		fidt.find('input[type="submit"]').prop('disabled', true);
		fidt.find('input[type="submit"]').val('Please wait..');
		
		
	});	
	
});