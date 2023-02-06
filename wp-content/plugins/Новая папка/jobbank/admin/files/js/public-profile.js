 "use strict";
jQuery(document).ready(function(){
	 jQuery('#candidatebookmark').on('click', function(e){  
	   var isLogged =jobbank1.current_user_id;
	   var p_id =jQuery("#profileID").val();
	   
		if (isLogged=="0") {
			alert(jobbank1.Please_login);
		} else {
			  if(jQuery('#candidatebookmark').hasClass('btn btn-big')){
				var search_params={
						"action" 	: 	"jobbank_profile_bookmark_delete",
						"data"	 	: 	"id="+p_id,
						"_wpnonce"	: jobbank1.dirwpnonce,
					};
					jQuery.ajax({
						url : jobbank1.ajaxurl,
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){						
							if (response.msg=="success") {
								jQuery("#candidatebookmark").removeClass('btn btn-big').addClass('btn btn-border');
								jQuery('#candidatebookmark').prop('title', jobbank1.Add_to_Boobmark);		
							}
						}
					});
							
			  }else if(jQuery('#candidatebookmark').hasClass('btn btn-border')){			
							
					var search_params={
						"action" 	: 	"jobbank_profile_bookmark",
						"data"	 	: 	"id="+p_id,
						"_wpnonce"	: jobbank1.dirwpnonce,
					};
					jQuery.ajax({
						url : jobbank1.ajaxurl,
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){						
							if (response.msg=="success") {
								jQuery("#candidatebookmark").removeClass('btn btn-border').addClass('btn btn-big');
								jQuery('#candidatebookmark').prop('title', jobbank1.Added_to_Boobmark);		
							}
						}
					});
			  } 
	  
		}
	 });
	 jQuery('#employerbookmark').on('click', function(e){ 
	   var isLogged =jobbank1.current_user_id;
	   var p_id =jQuery("#profileID").val();
	   
		if (isLogged=="0") {
			alert(jobbank1.Please_login);
		} else {
			  if(jQuery('#employerbookmark').hasClass('btn btn-big')){
				var search_params={
						"action" 	: 	"jobbank_employer_bookmark_delete",
						"data"	 	: 	"id="+p_id,
						"_wpnonce"	: jobbank1.dirwpnonce,
					};
					jQuery.ajax({
						url : jobbank1.ajaxurl,
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){						
							if (response.msg=="success") {
								jQuery("#employerbookmark").removeClass('btn btn-big').addClass('btn btn-border');
								jQuery('#employerbookmark').prop('title', jobbank1.Add_to_Boobmark);		
							}
						}
					});
							
			  }else if(jQuery('#employerbookmark').hasClass('btn btn-border')){			
						
					var search_params={
						"action" 	: 	"jobbank_employer_bookmark",
						"data"	 	: 	"id="+p_id,
						"_wpnonce"	: jobbank1.dirwpnonce,
					};
					jQuery.ajax({
						url : jobbank1.ajaxurl,
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){						
							if (response.msg=="success") {
								jQuery("#employerbookmark").removeClass('btn btn-border').addClass('btn btn-big');
								jQuery('#employerbookmark').prop('title', jobbank1.Added_to_Boobmark);		
							}
						}
					});
			  } 
	  
		}
	 });
	  
	 
	 

 });
 function jobbank_contact_close(){
		jQuery.colorbox.close();
} 
function jobbank_candidate_email_popup(user_id){	
		var contactform =jobbank1.ajaxurl+'?action=jobbank_candidate_email_popup&user_id='+user_id;
		jQuery.colorbox({href: contactform,opacity:"0.70",closeButton:false,});
}

