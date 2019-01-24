function ai_post_react_check_blocks(value)
{
	var check_value=jQuery.trim(value);
	if(jQuery(value).length)
	{
		return true;
	}
	else
	{
		return false;
	}
}
 
function ai_post_react_empty_check(msg)
{
	var check_value=jQuery.trim(msg);  if(check_value==0 || check_value===null || check_value=="undefined" || check_value===undefined || typeof check_value === "undefined" || check_value === "NaN") {  return true; } else {  return false; }
}
jQuery(document).on('touchstart click', '.ai_guest_data', function(e){
		e.preventDefault();
		jQuery(document).find(".vex-dialog-message").html("<div class='ai_reaction_loader_post'><span class='ai_reaction_loader_inner_post'></span></div>");
		var main_url=jQuery('.web_url').val();
		var type="guest";
		var activity_id=jQuery(this).attr("id");
		
		var postData = {
			action: 'ai_get_activity_reactions_list_post',
			activity_id:activity_id,
			type:type
		}
		jQuery.ajax({
			method:"POST",
			url:main_url,
			data:postData,
			dataType:'json',
		 })	
		  .done(function( msg ) {
			jQuery(document).find(".vex-dialog-message").html(msg['html']);
			ai_post_react_active_tab(".ai_guest_data");
		  });	
});
jQuery(document).on('touchstart click', '.ai_registered_data', function(e){
		e.preventDefault();
		jQuery(document).find(".vex-dialog-message").html("<div class='ai_reaction_loader_post'><span class='ai_reaction_loader_inner_post'></span></div>");
		var main_url=jQuery('.web_url').val();
		var activity_id=jQuery(this).attr("id");
		
		var type="registered";
		var postData = {
			action: 'ai_get_activity_reactions_list_post',
			activity_id:activity_id,
			type:type
		}
		jQuery.ajax({
			method:"POST",
			url:main_url,
			data:postData,
			dataType:'json',
		 })	
		  .done(function( msg ) {
			jQuery(document).find(".vex-dialog-message").html(msg['html']);
			ai_post_react_active_tab(".ai_registered_data");
		  });	
});
jQuery(document).on('touchstart click', '.ai_wp_counter', function(e){
		e.preventDefault();
		vex.defaultOptions.className = 'vex-theme-flat-attack';
		vex.dialog.alert("<div class='ai_reaction_loader_post'><span class='ai_reaction_loader_inner_post'></span></div>");
		var main_url=jQuery('.web_url').val();
		var activity_id = jQuery(this).parents('#ai_post_reaction_main').attr("main_id");
		var postData = {
			action: 'ai_get_activity_reactions_list_post',
			activity_id:activity_id
		}
		jQuery.ajax({
			method:"POST",
			url:main_url,
			data:postData,
			dataType:'json',
		 })	
		  .done(function( msg ) {
			jQuery(document).find(".vex-dialog-message").html(msg['html']);
			
		  });	
});	
jQuery(document).on('tap click', '.ai_post_reactions_default', function(e){
	e.preventDefault();
	var $this = jQuery(this);
	if (e.type == "tap")
	{
		if(jQuery(this).parents('#ai_post_reaction_main').find('.ai_main_smiley_div').css('display') == 'none')
		{
			jQuery(this).parents('#ai_post_reaction_main').find('.ai_main_smiley_div').stop().fadeIn();
		}
		else
		{
			jQuery(this).parents('#ai_post_reaction_main').find('.ai_main_smiley_div').stop().fadeOut();		
		}
	}
	else
	{	
		ai_post_reactions_manage_actions($this,"default");
	}	
});
jQuery(document).on('touchstart click', '.ai_wp_post_reactions', function(e){
	e.preventDefault();
	var $this = jQuery(this);
	ai_post_reactions_manage_actions($this,"all");
});

jQuery(document).on('touchstart click', '.ai_post_reactions_overcome_img', function(e){
	e.preventDefault();
});

jQuery(document).ready(function() {
	if(ai_post_react_check_blocks('.ai_wp_post_reactions')==true)
	{
		 jQuery('.ai_wp_post_reactions').tipsy({
			live: true,
			gravity: 's'
		});
	}
	if(ai_post_react_check_blocks('.ai_post_reactions_overcome_img')==true)
	{
		jQuery('.ai_post_reactions_overcome_img').tipsy({
			live: true,
			gravity: 's'
		});
	}
	if(ai_post_react_check_blocks('.ai_wp_counter')==true)
	{
		 jQuery('.ai_wp_counter').tipsy({
			live: true,
			gravity: 's',
			html: true
		});
	}
	
});

/*******main function for reactions******/

function ai_post_reactions_manage_actions(selector,module)
{	
	var reaction_id=selector.find("img").attr('smiley_id');
	var activity_id=selector.parents('#ai_post_reaction_main').attr("main_id");
	
		selector.parents('.ai_main_container_reactions').find('.ai_main_smiley_div').hide();
		selector.parents('#ai_post_reaction_main').find('.ai_icon_loader').css('display','inline');
		selector.parents('.ai_main_container_reactions').find(".ai_post_counter").hide();	
			var main_url=jQuery('.web_url').val();
			var postData = {
				action: 'ai_wp_save_smiley',
				id:reaction_id,
				activity_id:activity_id,
			}
			jQuery.ajax({
				method:"POST",
				url:main_url,
				data:postData,
				dataType:'json',
			 }).done(function( msg ) {
					var user = msg['username'];
					var user_id = msg['user_id'];

					var reaction_count = msg['reaction_count'];

							var reaction_img = msg['reaction_img'];		
							var reaction_return_id = msg['reaction_id'];
							var reaction_name = msg['reaction_name'];	
							var main_reaction_count=jQuery.trim(reaction_count);
	
					selector.parents('.ai_main_container_reactions').find(".ai_post_reactions_default img").attr("src",reaction_img);	
					selector.parents('.ai_main_container_reactions').find(".ai_post_reactions_default img").attr("smiley_id",reaction_return_id);
					selector.parents('.ai_main_container_reactions').find(".ai_post_reactions_default span").text(reaction_name);
					selector.parents('.ai_main_container_reactions').find(".ai_post_counter").text(main_reaction_count);
					selector.parents('.ai_main_container_reactions').find(".ai_post_counter").show();
					selector.parents('.ai_main_container_reactions').find('.ai_icon_loader').hide();

			  });
}

jQuery(document).on({
    mouseenter: function(){
       jQuery(this).parents('#ai_post_reaction_main').find('.ai_main_smiley_div').stop().fadeIn();
    },
    mouseleave: function(){
        jQuery(this).parents('#ai_post_reaction_main').find('.ai_main_smiley_div').stop().fadeOut();
    }
}, '.ai_post_reactions_default,.ai_main_smiley_div');

function ai_post_react_active_tab(specific)
{
	jQuery(".ai_post_react_tabs ul li a").removeClass("ai_post_react_tabs_active");
	jQuery(specific).addClass("ai_post_react_tabs_active");
}

jQuery(document).on('touchstart click', '.ai_front_wp_post', function(){
	jQuery('.ai_front_wp_post').attr('disabled',true);
	var $this = jQuery(this);
	var id = jQuery(this).attr("ai_id");
	var check_value = jQuery(this).val();
	var main_url=jQuery('.web_url').val();
		var postData = {
			action: 'ai_wp_post_front_smiley',
			id:id,
			check_value:check_value
		}
		jQuery.ajax({
			method:"POST",
			url:ajaxurl,
			data:postData,
		 })	
		 .done(function( msg ) {
			 jQuery('.ai_front_wp_post').removeAttr('disabled',true);
			 if(check_value == 1)
			 {
				  $this.val('0');
			 }
			else
			{
				 $this.val('1');
			}
		 });
});