/***********************  add more education  *************************/
jQuery( document ).ready(function() {
	jQuery("#profile_setting_form").on("submit", function(){
		return false;
	});
});
function jobbank_education_more2() {
	jQuery( "#educationsection" ).clone().appendTo( "#addmoreedu" ).show('slow');	
}

jQuery(document).on("click", ".buttonremove", function() {
	jQuery(this).closest(".body-box-admin").fadeOut( "slow", function() {
      // After animation completed:
       jQuery(this).closest(".body-box-admin").remove();
	});
});
/***********************  add more experience  *************************/

function jobbank_exp_more2() {
	jQuery( "#expsection" ).clone().appendTo( "#addmoreexp" ).show('slow');
}
jQuery(document).on("click", ".buttonremove2", function() {
	jQuery(this).closest(".body-box-admin").fadeOut( "slow", function() {
      // After animation completed:
       jQuery(this).closest(".body-box-admin").remove();
	});
});

/***********************  add more awards and honors  *************************/

function jobbank_award_more2() {
	jQuery( "#awardsection" ).clone().appendTo( "#addmoreaward" ).show('slow');
}
jQuery(document).on("click", ".buttonremove3", function() {
	jQuery(this).closest(".body-box-admin").fadeOut( "slow", function() {
      // After animation completed:
       jQuery(this).closest(".body-box-admin").remove();
	});
});


/***********************  SKill  *************************/

