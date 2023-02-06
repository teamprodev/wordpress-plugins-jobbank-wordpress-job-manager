"use strict";
var ajaxurl = profile_data.ajaxurl;
var loader_image = profile_data.loading_image;

jQuery(window).on('load',function(){
		if (jQuery("#all_fieldsdatatable")[0]){	
		jQuery('#all_fieldsdatatable').show();
		
		var oTable = jQuery('#all_fieldsdatatable').dataTable({			
			"pageLength": 25,			
			"language": {
				"sProcessing": 		profile_data.sProcessing ,
				"sSearch": 			'',
				"searchPlaceholder" : profile_data.sSearch,
				"lengthMenu":		profile_data.lengthMenu ,
				"zeroRecords": 		profile_data.zeroRecords,
				"info": 			profile_data.info,
				"infoEmpty": 		profile_data.infoEmpty,
				"infoFiltered":		profile_data.infoFiltered ,
				
				"oPaginate": {
					"sFirst":   	profile_data.sFirst,
					"sLast":    	profile_data.sLast,
					"sNext":   		profile_data.sNext ,
					"sPrevious":	profile_data.sPrevious,
				},
			},
			
			responsive: true,
			}
		);
		
	}
	if (jQuery("#listing_fieldsdatatable")[0]){	
		jQuery('#listing_fieldsdatatable').show();
		var oTable = jQuery('#listing_fieldsdatatable').dataTable({
			 "ordering": false,
			"pageLength": 25,			
			"language": {
				"sProcessing": 		profile_data.sProcessing ,
				"sSearch": 			'',
				"searchPlaceholder" : profile_data.sSearch,
				"lengthMenu":		profile_data.lengthMenu ,
				"zeroRecords": 		profile_data.zeroRecords,
				"info": 			profile_data.info,
				"infoEmpty": 		profile_data.infoEmpty,
				"infoFiltered":		profile_data.infoFiltered ,
				
				"oPaginate": {
					"sFirst":   	profile_data.sFirst,
					"sLast":    	profile_data.sLast,
					"sNext":   		profile_data.sNext ,
					"sPrevious":	profile_data.sPrevious,
				},
			},
			
			responsive: true,
			
			}
		);		
	}
	
});
function jobbank_add_listingfield(){		
		var wpdatatable = jQuery('#listing_fieldsdatatable').DataTable();		
		var catall = jQuery('#fieldcat-main').html();
		var inputtypell= jQuery('#fieldtype-main').html();	
		
		wpdatatable.row.add( [
			'<div class="row mt-2">'+
				'<label class="col-md-6 col-6">'+profile_data.InputName+'</label>'+
				'<input type="text" class="form-control col-md-6 col-6" name="meta_name[]" id="meta_name[]" value="">'+ 	
			'</div>'+
			'<div class="row mt-2">'+
				'<label class="col-md-6 col-6">'+profile_data.Label+'</label>'+
				'<input type="text" class="form-control col-md-6 col-6" name="meta_label[]" id="meta_label[]" value="">'+ 	
			'</div>'+
			'<div class="row mt-2">'+
				'<label class="col-md-6 col-6">'+profile_data.Type+'</label>'+
				+inputtypell+ 	
			'</div>'+
			'<div class="row mt-2">'+
				'<label class="col-md-12 col-12">'+profile_data.Value+'</label>'+
				'<textarea class="form-control col-md-12 col-12 ml-3" rows="3" name="field_type_value[]" id="field_type_value[]" ></textarea>'+ 	
			'</div>', catall,			
			'<span onclick="return jobbank_remove_listingfield('+profile_data.pi+');" class="dashicons dashicons-trash"></span>',
        ] ).node().id = 'wpdatatablelistingfield_'+profile_data.pi;
		
		
		wpdatatable.draw(false );	
	profile_data.pi=profile_data.pi+1;	
}
function jobbank_remove_listingfield(div_id){		
		var table = jQuery('#listing_fieldsdatatable').DataTable();
		table.row("#wpdatatablelistingfield_"+div_id).remove().draw();

		//jQuery("#wpdatatablelistingfield_"+div_id).fadeOut(500, function(){ jQuery(this).remove();});
	
	
}
function jobbank_add_field(){		
		var wpdatatable = jQuery('#all_fieldsdatatable').DataTable();		
		var roleall = jQuery('#roleall_0').html();
		var inputtypell= jQuery('#inputtypell_0').html();		
		wpdatatable.row.add( [
            '<input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="profile-field'+profile_data.pi+'">',
            '<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="profile-field'+profile_data.pi+'" >',
            inputtypell,
            '<textarea class="form-control" rows="3" name="field_type_value[]" id="field_type_value[]" ></textarea>',
            roleall,
			'<label><input type="checkbox" name="signup'+profile_data.pi+'" id="signup'+profile_data.pi+'" value="yes" > Registration</label>'+
			'<label><input type="checkbox" name="srequire'+profile_data.pi+'" id="srequire'+profile_data.pi+'" value="yes"   class="text-center"> My Account/Profile</label>'+
			'<label><input type="checkbox" name="srequire'+profile_data.pi+'" id="srequire'+profile_data.pi+'" value="yes"   class="text-center"> Require </label>',
		'<button class="btn btn-danger btn-xs" onclick="return jobbank_remove_field('+profile_data.pi+');">Delete</button>',
        ] ).node().id = 'wpdatatablefield_'+profile_data.pi;
		
	wpdatatable.draw(false );	
	profile_data.pi=profile_data.pi+1	
	
	
}

function jobbank_update_profile_signup_fields(){
	var search_params = {
		"action": 		"jobbank_update_profile_signup_fields",
		"form_data":	jQuery("#profile_fields_signup").serialize(),
		"_wpnonce":  	profile_data.adminnonce,
	};
	jQuery.ajax({
		url: profile_data.ajaxurl,
		dataType: "json",
		type: "post",
		data: search_params,
		success: function(response) {              		
			jQuery('#success_message_profile').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');		   						
				
		}
	});
}

function jobbank_remove_field(div_id){		
	
	jQuery("#wpdatatablefield_"+div_id).fadeOut(500, function(){ jQuery(this).remove();});
}
function jobbank_add_menu(){	
	jQuery('#custom_menu_div').append('<div class="row form-group " id="menu_'+profile_data.pii+'"><div class=" col-sm-3"> <input type="text" class="form-control" name="menu_title[]" id="menu_title[]" value="" placeholder="Enter Menu Title "> </div>	<div  class=" col-sm-7"><input type="text" class="form-control" name="menu_link[]" id="menu_link[]" value="" placeholder="Enter Menu Link.  Example  http://www.google.com"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return jobbank_remove_menu('+profile_data.pii+');">Delete</button>');
	profile_data.pii=profile_data.pii+1;		
}
function jobbank_remove_menu(div_id){		
	jQuery("#menu_"+div_id).remove();
}	