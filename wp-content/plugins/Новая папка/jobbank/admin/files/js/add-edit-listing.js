"use strict";
jQuery( document ).ready(function() { 
	if (jQuery(".epinputdate")[0]){	
		jQuery( ".epinputdate" ).datepicker( );
	}
});
jQuery(function() {		
	if (jQuery("#deadline")[0]){ 
		jQuery( "#deadline" ).datepicker({ dateFormat: 'dd-mm-yy' });
	}
	
});


jQuery(document).ready(function(){
    jQuery("#toggle-btn").on("click", function(){
      jQuery("#toggle-example").collapse('toggle'); // toggle collapse
    });
});

jQuery( document ).ready(function() { 		
	setTimeout(function(){			
			jQuery(".leaflet-locationiq-input").attr("placeholder", realpro_data.save_address);
			
		},500); 
});
	
jQuery( document ).ready(function() {
				
	// Initialize an empty map without layers (invisible map)
	var map = L.map('map', {
		center: [40.7259, -73.9805], // Map loads with this location as center
		zoom: 12,
		scrollWheelZoom: true,
		zoomControl: false,
		attributionControl: false,
		
	});
   
	//Geocoder options
	var geocoderControlOptions = {
		bounds: false,          //To not send viewbox
		markers: false,         //To not add markers when we geocoder
		attribution: null,      //No need of attribution since we are not using maps
		expanded: true,         //The geocoder search box will be initialized in expanded mode
		panToPoint: false,       //Since no maps, no need to pan the map to the geocoded-selected location
		params: {               //Set dedupe parameter to remove duplicate results from Autocomplete
				dedupe: 1,
			}
	}

	//Initialize the geocoder
	var geocoderControl = new L.control.geocoder('pk.87f2d9fcb4fdd8da1d647b46a997c727', geocoderControlOptions).addTo(map).on('select', function (e) {
		console.log(e);
		
		jQuery('#address').val(e.feature.feature.display_name);
		jQuery('#country').val(e.feature.feature.address.country);
		jQuery('#postcode').val(e.feature.feature.address.postcode);
		jQuery('#state').val(e.feature.feature.address.state);
		jQuery('#city').val(e.feature.feature.address.city);
		jQuery('#longitude').val(e.latlng.lng);
		jQuery('#latitude').val(e.latlng.lat);
					
		
	});

	//Get the "search-box" div
	var searchBoxControl = document.getElementById("search-box");
	//Get the geocoder container from the leaflet map
	var geocoderContainer = geocoderControl.getContainer();
	//Append the geocoder container to the "search-box" div
	searchBoxControl.appendChild(geocoderContainer);        
	

});

jQuery( document ).ready(function() { 
	jQuery(document).on('click', '.jobbankcats-fields', function(){
			var listID = jQuery('#user_post_id').val();		
			var searchIDs = jQuery("#jobbankcats-container input:checkbox:checked").map(function(){
			  return jQuery(this).val();
			}).get(); 
		
			
			if (searchIDs != undefined && searchIDs != '') {
				console.log(searchIDs);
				var loader_image = realpro_data.loading_image;
				jQuery('#jobbank_fields').html(loader_image);
				var search_params={
					"action"  : "jobbank_load_categories_fields_wpadmin",	
					'term_id': searchIDs,
					'post_id': listID,
					'datatype': 'slug',
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.msg=='success'){
								jQuery('#jobbank_fields').html(response.field_data);								
								if (jQuery(".epinputdate")[0]){	
									jQuery( ".epinputdate" ).datepicker( );
								}

						}
					
						
					}
				});
		}
		
	});	
});	

// For dashboard add listing
jQuery( document ).ready(function() { 
	jQuery(document).on('click', '.editor-post-taxonomies__hierarchical-terms-list[aria-label="Categories"] input', function(){ 
			
	   var termID = [];   
       var termIDs='';
	   var listID = jQuery('#post_ID').val();
		jQuery('.editor-post-taxonomies__hierarchical-terms-list[aria-label="Categories"] input:checked').each(function( index ) {
		   termIDs = jQuery(this).parent().next('label').text();
			termID.push(termIDs);
		});
		
		if (termID != undefined && termID != '') {
				console.log(termID);
				var loader_image = realpro_data.loading_image;
				
				jQuery('#jobbank_fields').html(loader_image);
				var search_params={
					"action"  : "jobbank_load_categories_fields_wpadmin",	
					'term_id': termID,
					'post_id': listID,
					'datatype': 'text',
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.msg=='success'){
								jQuery('#jobbank_fields').html(response.field_data);								
								if (jQuery(".epinputdate")[0]){	
									jQuery( ".epinputdate" ).datepicker( );
								}

						}
					
						
					}
				});
		}
		
	});	
});	
	
		
function jobbank_update_post(){
	tinyMCE.triggerSave();	
	var ajaxurl = realpro_data.ajaxurl;
	var loader_image = realpro_data.loading_image;
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"jobbank_update_wp_post",	
					"form_data":	jQuery("#new_post").serialize(), 
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = realpro_data.permalink+"?&profile=all-post"; 						
								jQuery(location).attr('href',url);	
						}
					
						
					}
				});
	
	}

function jobbank_new_post_without_user(){
	tinyMCE.triggerSave();	
	var ajaxurl = realpro_data.ajaxurl;
	var has_access=0;
	if(realpro_data.current_user_id=='0'){
		if(jQuery('#n_user_email').val().length === 0 || jQuery('#n_password').val().length === 0){ 			
				jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');					
                jQuery('#update_message2').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');			
		}else{
			if (IsEmail(jQuery('#n_user_email').val()) == false) { 
			
				jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');					
                jQuery('#update_message2').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');
                    //return false;
			}else{
				has_access=1;
			
			}
		
		}
	}else{
	has_access=1;
	}
	
	if(has_access==1){
		var loader_image = realpro_data.loading_image;
		jQuery('#update_message').html(loader_image);
		jQuery('#update_message2').html(loader_image);
		var search_params={
			"action"  : 	"jobbank_save_post_without_user",	
			"form_data":	jQuery("#new_post").serialize(), 
			"_wpnonce":  	realpro_data.dirwpnonce,
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){ 
				if(response.code=='success'){					  						
					jQuery('#full-form-add-new').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.success_message  +' <a class="btn btn-sm" href="'+realpro_data.my_account_link+'" >My Account</a></div>');	
						
				}
				if(response.code=='error'){
					 jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
					 jQuery('#update_message2').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
					
				}
				
			}
		});
	}	
}
 function IsEmail(email) {
	var regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!regex.test(email)) {
		return false;
	}
	else {
		return true;
	}
}
function jobbank_save_post (){
	tinyMCE.triggerSave();	
	var ajaxurl = realpro_data.ajaxurl;
	var loader_image = realpro_data.loading_image;
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"jobbank_save_wp_post",	
					"form_data":	jQuery("#new_post").serialize(), 
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = realpro_data.permalink+"?&profile=all-post";    						
								jQuery(location).attr('href',url);	
						}
					
						
					}
				});
	
	}
function jobbank_add_faq_field(){
	var main_faq_div =jQuery('#faqmain').html(); 
	jQuery('#faqsall').append('<div class="clearfix"></div><hr><div class="row">'+main_faq_div+'</div>');
}
function jobbank_faq_delete(id_delete){	
	jQuery('#faq_delete_'+id_delete).remove();
}



function  jobbank_remove_post_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#feature_image_id').val(''); 
	jQuery('#post_image_edit').html('<button type="button" onclick="jobbank_edit_post_image(\'post_image_div\');"  class="btn btn-small-ar">Add</button>');  

}	
 function jobbank_edit_post_image(profile_image_id){	
				var image_gallery_frame;

             
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: realpro_data.Set_Feature_Image,
                    button: {
                        text: realpro_data.Set_Feature_Image, 
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive rounded"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#feature_image_id').val(attachment.id ); 
							jQuery('#post_image_edit').html('<button type="button" onclick="jobbank_remove_post_image(\'post_image_div\');"  class="btn btn-small-ar">X</button>');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
	}
// Banner 
function  jobbank_remove_topbanner_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#topbanner_image_id').val(''); 
	jQuery('#post_image_topbaner').html('<button type="button" onclick="jobbank_topbanner_image(\'post_image_topbaner\');"  class="btn btn-small-ar">Add</button>');  

}	
 function jobbank_topbanner_image(profile_image_id){	
		var image_gallery_frame;             
		image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
			// Set the title of the modal.
			title: realpro_data.Set_Feature_Image,
			button: {
				text: realpro_data.Set_Feature_Image, 
			},
			multiple: false,
			displayUserSettings: true,
		});                
		image_gallery_frame.on( 'select', function() {
			var selection = image_gallery_frame.state().get('selection');
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				if ( attachment.id ) {
					jQuery('#'+profile_image_id).html('<img  class="img-responsive rounded "  src="'+attachment.sizes.thumbnail.url+'">');
					jQuery('#topbanner_image_id').val(attachment.id ); 
					jQuery('#post_image_topbaner').append('<button type="button" onclick="jobbank_remove_topbanner_image(\'post_image_topbaner\');"  class="btn btn-small-ar">X</button>');  
				   
				}
			});
		   
		});               
		image_gallery_frame.open(); 
				
}
		
 function jobbank_edit_gallery_image(profile_image_id){
				
				var image_gallery_frame;
				var hidden_field_image_ids = jQuery('#gallery_image_ids').val();
              
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: realpro_data.Gallery_Images,
                    button: {
                        text: realpro_data.Gallery_Images,
                    },
                    multiple: true,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        console.log(attachment);
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).append('<div id="gallery_image_div'+attachment.id+'" class="col-md-3"><img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'"><button type="button" onclick="jobbank_remove_gallery_image(\'gallery_image_div'+attachment.id+'\', '+attachment.id+');"  class="btn btn-small-ar">X</button> </div>');
							
							hidden_field_image_ids=hidden_field_image_ids+','+attachment.id ;
							jQuery('#gallery_image_ids').val(hidden_field_image_ids); 
							
							
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 

 }			

function  jobbank_remove_gallery_image(img_remove_div,rid){	
	var hidden_field_image_ids = jQuery('#gallery_image_ids').val();	
	hidden_field_image_ids =hidden_field_image_ids.replace(rid, '');	
	jQuery('#'+img_remove_div).remove();
	jQuery('#gallery_image_ids').val(hidden_field_image_ids); 
	

}	

jQuery(document).ready(function() {
	jQuery("input[name$='contact_source']").on("click", function (){
		var rvalue = jQuery(this).val();
		
		if(rvalue=='new_value'){jQuery("#new_contact_div" ).show();}
		if(rvalue=='user_info'){jQuery("#new_contact_div" ).hide();}
		
		
	});
});	

		