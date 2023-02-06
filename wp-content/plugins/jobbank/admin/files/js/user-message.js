"use strict";
var ajaxurl = jobbank_data_message.ajaxurl;
var loader_image =jobbank_data_message.loading_image;
function jobbank_user_message(){
	var formc = jQuery("#message-pop");

		if (jQuery.trim(jQuery("#email_address",formc).val()) == "" || jQuery.trim(jQuery("#message-content",formc).val()) == "") {
				alert(jobbank_data_message.Please_put_your_message);
		} else {
		var ajaxurl = jobbank_data_message.ajaxurl;
		var loader_image =jobbank_data_message.loading_image;
		jQuery('#update_message_popup').html(loader_image);
		var search_params={
			"action"  : 	"jobbank_message_send",
			"form_data":	jQuery("#message-pop").serialize(),
			"_wpnonce":  	jobbank_data_message.contact,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery('#update_message_popup').html(response.msg );
				jQuery("#message-pop").trigger('reset');
			}
		});
	}
}