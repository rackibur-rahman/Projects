<?php
function ai_wp_get_all_smileys()
{
	//Create an instance of our package class...
	$testListTable = new ai_wp_list_table_class_extend();
	//Fetch, prepare, sort, and filter our data...
	$testListTable->ai_wp_prepare_items("smiley","");	
	?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<?php global $wp_roles; ?>
			<h2>Reactions List</h2> 				
			<div class="pws_tabs_list">
				<div class="content demo_responsive">
					<div id="poststuff">
						<div id="post-body" class="metabox-holder columns-2">
							<div id="post-body-content">
								<div class="meta-box-sortables ui-sortable">
								<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
								<form id="movies-filter" method="get">
									<!-- For plugins, we also need to ensure that the form posts back to our current page -->
									<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
									<!-- Now we can render the completed list table -->
									<?php $testListTable->display() ?>
								</form>
								</div>
							</div>
						</div>
						<br class="clear">
					</div>
				</div>
			</div>	
		</div>
	<?php
}

function ai_wp_smiley_main_settings()
{
	?>
	<script>
		jQuery(document).ready(function ($) {
			 $('.arete-tabs_smiley').ai_post_reaction_tabs({
				effect: 'scale',              // You can change effects of your tabs container: scale / slideleft / slideright / slidetop / slidedown / none
				defaultTab: 1,                // The tab we want to be opened by default
				containerWidth: '100%',     // Set custom container width if not set then 100% is used
				tabsPosition: 'horizontal',   // Tabs position: horizontal / vertical
				horizontalPosition: 'top',    // Tabs horizontal position: top / bottom
				verticalPosition: 'left',     // Tabs vertical position: left / right
				responsive: true,             // Make tabs container responsive: true / false - boolean
				theme: '',
				rtl: false                    // Right to left support: true/ false
			 });
		  });
	</script>
		<div class="wrap">
			<?php screen_icon(); ?>
			<?php global $wp_roles; ?>   
			<h2>Arete Wordpress Post Reactions Settings</h2>	
		   <div class="content demo_responsive">
			  <div class="arete-tabs_smiley">
				 <div data-ai_post_reaction-tab="tab1" data-ai_post_reaction-tab-name="Location" data-ai_post_reaction-tab-icon="fa-video-camera">
					<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"> 
						<?php settings_fields( 'default' ); ?>
						<h3>Change Reactions Location</h3>
							<table class="form-table">
								<tr valign="top">
									<td>
										<input type="radio" class="enable_before" name="enable_location_ai" <?php if(ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','location')== "before") { echo "checked"; } ?> value="before" />Before Content
									</td>
								</tr>
								<tr valign="top">
									<td>
										<input type="radio" class="enable_after" name="enable_location_ai" <?php if(ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','location')== "after") { echo "checked"; } ?> value="after"  />After Content
									</td>
								</tr>
								<tr valign="top">
									<td>
										<input type="radio" class="enable_after" name="enable_location_ai" <?php if(ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','location')== "both") { echo "checked"; } ?> value="both"  />Both (After content and Before content)
									</td>
								</tr>								
							</table>
						<p class="submit">
							<input type="submit" name="smiley_location_settings" value="Save Settings" class="button button-primary" />
						</p>
					</form>	
				 </div>
				 <div data-ai_post_reaction-tab="tab2" data-ai_post_reaction-tab-name="Share Options" data-ai_post_reaction-tab-icon="fa-video-camera">
					<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"> 
						<?php settings_fields( 'default' ); ?>
						<h3>Please select options where you want to display Reactions</h3>
							<table class="form-table">
								<tr valign="top">
									<td>
										<input type="checkbox" name="custom_smileys[]" class="custom_smileys" value="post" <?php if(ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','post')== "y") { echo "checked"; } ?>>Post								
									</td>
								</tr>
								<tr valign="top">
									<td>
										<input type="checkbox" name="custom_smileys[]" class="custom_smileys" value="page" <?php if(ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','page')== "y") { echo "checked"; } ?>>Page
									</td>
								</tr>								
							</table>
						<p class="submit">
							<input type="submit" name="smiley_pages_settings" value="Save Settings" class="button button-primary" />
						</p>
					</form>	
				 </div>
				 <div data-ai_post_reaction-tab="tab3" data-ai_post_reaction-tab-name="Guest Users" data-ai_post_reaction-tab-icon="fa-video-camera">
					<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"> 
						<?php settings_fields( 'default' ); ?>
						<h3>Please select if you would like guests to react on your posts/pages.</h3>
							<table class="form-table">
								<tr valign="top">
									<td>
										<input type="radio" name="ai_guest_user" class="ai_guest_user" value="yes" <?php if(ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','guest')== "yes") { echo "checked"; } ?>>Allow								
									</td>
								</tr>
								<tr valign="top">
									<td>
										<input type="radio" name="ai_guest_user" class="ai_guest_user" value="no" <?php if (ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','guest')== "no") { echo "checked"; } ?>>Not Allow
									</td>
								</tr>								
							</table>
						<p class="submit">
							<input type="submit" name="smiley_guest_user" value="Save Settings" class="button button-primary" />
						</p>
					</form>	
				 </div>
			  </div><!-- tabset0 -->
			</div>  
		</div>		
	<?php	
}
function ai_wp_error_action_message_updated() {	
?>
    <div class="error">
        <p>please select atleast one option</p>
    </div>		
<?php
}
function ai_wp_success_action_message_updated()
{	
?>
    <div class="updated">
        <p>Options updated successfully.</p>
    </div>		
<?php
}

class ai_wp_manage_reactions_temp
{
	function ai_wp_reactions_animation_css_temp($count)
	{
		$result=array();
		$html="<style>";
		
		if($count==1)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
				-webkit-animation-duration: .7333s;
				-webkit-animation-name: head-".$count."-anim;
				-moz-animation-duration: .7333s;
				-moz-animation-name: head-".$count."-anim;
				animation-duration: .7333s;
				animation-name: head-".$count."-anim;
				}";
			$html.="@keyframes head-1-anim {
						0% {
						opacity: .3374;
						-webkit-transform: translateY(35.78px) scale(.3374, .3374);
						transform: translateY(35.78px) scale(.3374, .3374);
						-moz-transform: translateY(35.78px) scale(.3374, .3374);	
						-o-transform: translateY(35.78px) scale(.3374, .3374);
					}
					2.2727% {
						opacity: .5075;
						-webkit-transform: translateY(26.6px) scale(.5075, .5075);
						transform: translateY(26.6px) scale(.5075, .5075);
						-moz-transform: translateY(26.6px) scale(.5075, .5075);
						-o-transform: translateY(26.6px) scale(.5075, .5075);
					}
					4.5455% {
						opacity: .6569;
						-webkit-transform: translateY(18.53px) scale(.6569, .6569);
						transform: translateY(18.53px) scale(.6569, .6569);
						-moz-transform: translateY(18.53px) scale(.6569, .6569);
						-o-transform: translateY(18.53px) scale(.6569, .6569);
					}
					6.8182% {
						opacity: .7796;
						-webkit-transform: translateY(11.9px) scale(.7796, .7796);
						transform: translateY(11.9px) scale(.7796, .7796);
						-moz-transform: translateY(11.9px) scale(.7796, .7796);
						-o-transform: translateY(11.9px) scale(.7796, .7796);
					}
					9.0909% {
						opacity: .8744;
						-webkit-transform: translateY(6.78px) scale(.8744, .8744);
						transform: translateY(6.78px) scale(.8744, .8744);
						-moz-transform: translateY(6.78px) scale(.8744, .8744);
						-o-transform: translateY(6.78px) scale(.8744, .8744);
					}
					11.3636% {
						opacity: .9433;
						-webkit-transform: translateY(3.06px) scale(.9433, .9433);
						transform: translateY(3.06px) scale(.9433, .9433);
						-moz-transform: translateY(3.06px) scale(.9433, .9433);
						-o-transform: translateY(3.06px) scale(.9433, .9433);
					}
					13.6364% {
						opacity: .9901;
						-webkit-transform: translateY(.53px) scale(.9901, .9901);
						transform: translateY(.53px) scale(.9901, .9901);
						-moz-transform: translateY(.53px) scale(.9901, .9901);
						-o-transform: translateY(.53px) scale(.9901, .9901);
					}
					15.9091% {
						opacity: 1;
						-webkit-transform: translateY(-1.03px) scale(1.0191, 1.0191);
						transform: translateY(-1.03px) scale(1.0191, 1.0191);
						-moz-transform: translateY(-1.03px) scale(1.0191, 1.0191);
						-o-transform: translateY(-1.03px) scale(1.0191, 1.0191);
					}
					18.1818% {
						-webkit-transform: translateY(-1.87px) scale(1.0347, 1.0347);
						transform: translateY(-1.87px) scale(1.0347, 1.0347);
						-moz-transform: translateY(-1.87px) scale(1.0347, 1.0347);
						-o-transform: translateY(-1.87px) scale(1.0347, 1.0347);
					}
					20.4545% {
						-webkit-transform: translateY(-2.2px) scale(1.0407, 1.0407);
						transform: translateY(-2.2px) scale(1.0407, 1.0407);
						-moz-transform: translateY(-2.2px) scale(1.0407, 1.0407);
						-o-transform: translateY(-2.2px) scale(1.0407, 1.0407);
					}
					22.7273% {
						-webkit-transform: translateY(-2.18px) scale(1.0403, 1.0403);
						transform: translateY(-2.18px) scale(1.0403, 1.0403);
						-moz-transform: translateY(-2.18px) scale(1.0403, 1.0403);
						-o-transform: translateY(-2.18px) scale(1.0403, 1.0403);
					}
					25.0000% {
						-webkit-transform: translateY(-1.96px) scale(1.0362, 1.0362);
						transform: translateY(-1.96px) scale(1.0362, 1.0362);
						-moz-transform: translateY(-1.96px) scale(1.0362, 1.0362);
						-o-transform: translateY(-1.96px) scale(1.0362, 1.0362);
					}
					27.2727% {
						-webkit-transform: translateY(-1.64px) scale(1.0303, 1.0303);
						transform: translateY(-1.64px) scale(1.0303, 1.0303);
						-moz-transform: translateY(-1.64px) scale(1.0303, 1.0303);
						-o-transform: translateY(-1.64px) scale(1.0303, 1.0303);
					}
					29.5455% {
						-webkit-transform: translateY(-1.29px) scale(1.0238, 1.0238);
						transform: translateY(-1.29px) scale(1.0238, 1.0238);
						-moz-transform: translateY(-1.29px) scale(1.0238, 1.0238);
						-o-transform: translateY(-1.29px) scale(1.0238, 1.0238);
					}
					31.8182% {
						-webkit-transform: translateY(-.95px) scale(1.0176, 1.0176);
						transform: translateY(-.95px) scale(1.0176, 1.0176);
						-moz-transform: translateY(-.95px) scale(1.0176, 1.0176);
						-o-transform: translateY(-.95px) scale(1.0176, 1.0176);
					}
					34.0909% {
						-webkit-transform: translateY(-.66px) scale(1.0122, 1.0122);
						transform: translateY(-.66px) scale(1.0122, 1.0122);	
						-moz-transform: translateY(-.66px) scale(1.0122, 1.0122);
						-o-transform: translateY(-.66px) scale(1.0122, 1.0122);
					}
					36.3636% {
						-webkit-transform: translateY(-.42px) scale(1.0078, 1.0078);
						transform: translateY(-.42px) scale(1.0078, 1.0078);
						-moz-transform: translateY(-.42px) scale(1.0078, 1.0078);
						-o-transform: translateY(-.42px) scale(1.0078, 1.0078);
					}
					38.6364% {
						-webkit-transform: translateY(-.24px) scale(1.0044, 1.0044);
						transform: translateY(-.24px) scale(1.0044, 1.0044);
						-moz-transform: translateY(-.24px) scale(1.0044, 1.0044);
						-o-transform: translateY(-.24px) scale(1.0044, 1.0044);
					}
					40.9091% {
						-webkit-transform: translateY(-.1px) scale(1.0019, 1.0019);
						transform: translateY(-.1px) scale(1.0019, 1.0019);	
						-moz-transform: translateY(-.1px) scale(1.0019, 1.0019);	
						-o-transform: translateY(-.1px) scale(1.0019, 1.0019);
					}
					43.1818% {
						opacity: 1;
						-webkit-transform: translateY(-.01px) scale(1.0003, 1.0003);
						transform: translateY(-.01px) scale(1.0003, 1.0003);
						-moz-transform: translateY(-.01px) scale(1.0003, 1.0003);
						-o-transform: translateY(-.01px) scale(1.0003, 1.0003);
					}
					45.4545% {
						opacity: .9992;
						-webkit-transform: translateY(.04px) scale(.9992, .9992);
						transform: translateY(.04px) scale(.9992, .9992);
						-moz-transform: translateY(.04px) scale(.9992, .9992);
						-o-transform: translateY(.04px) scale(.9992, .9992);
					}
					47.7273% {
						opacity: .9987;
						-webkit-transform: translateY(.07px) scale(.9987, .9987);
						transform: translateY(.07px) scale(.9987, .9987);
						-moz-transform: translateY(.07px) scale(.9987, .9987);
						-o-transform: translateY(.07px) scale(.9987, .9987);
					}
					50%, 52.2727% {
						opacity: .9985;
						-webkit-transform: translateY(.08px) scale(.9985, .9985);
						transform: translateY(.08px) scale(.9985, .9985);
						-moz-transform: translateY(.08px) scale(.9985, .9985);
						-o-transform: translateY(.08px) scale(.9985, .9985);
					}
					54.5455% {
						opacity: .9987;
						-webkit-transform: translateY(.07px) scale(.9987, .9987);
						transform: translateY(.07px) scale(.9987, .9987);
						-moz-transform: translateY(.07px) scale(.9987, .9987);
						-o-transform: translateY(.07px) scale(.9987, .9987);
					}
					56.8182% {
						opacity: .9989;
						-webkit-transform: translateY(.06px) scale(.9989, .9989);
						transform: translateY(.06px) scale(.9989, .9989);
						-moz-transform: translateY(.06px) scale(.9989, .9989);
						-o-transform: translateY(.06px) scale(.9989, .9989);
					}
					59.0909% {
						opacity: .9991;
						-webkit-transform: translateY(.05px) scale(.9991, .9991);
						transform: translateY(.05px) scale(.9991, .9991);
						-moz-transform: translateY(.05px) scale(.9991, .9991);
						-o-transform: translateY(.05px) scale(.9991, .9991);
					}
					61.3636% {
						opacity: .9994;
						-webkit-transform: translateY(.03px) scale(.9994, .9994);
						transform: translateY(.03px) scale(.9994, .9994);
						-moz-transform: translateY(.03px) scale(.9994, .9994);
						-o-transform: translateY(.03px) scale(.9994, .9994);
					}
					63.6364% {
						opacity: .9996;
						-webkit-transform: translateY(.02px) scale(.9996, .9996);
						transform: translateY(.02px) scale(.9996, .9996);
						-moz-transform: translateY(.02px) scale(.9996, .9996);
						-o-transform: translateY(.02px) scale(.9996, .9996);
					}
					65.9091% {
						opacity: .9997;
						-webkit-transform: translateY(.01px) scale(.9997, .9997);
						transform: translateY(.01px) scale(.9997, .9997);
						-moz-transform: translateY(.01px) scale(.9997, .9997);
						-o-transform: translateY(.01px) scale(.9997, .9997);
					}
					68.1818% {
						opacity: .9998;
						-webkit-transform: translateY(.01px) scale(.9998, .9998);
						transform: translateY(.01px) scale(.9998, .9998);
						-moz-transform: translateY(.01px) scale(.9998, .9998);
						-o-transform: translateY(.01px) scale(.9998, .9998);
					}
					70.4545% {
						opacity: .9999;
						-webkit-transform: translateY(0) scale(.9999, .9999);
						transform: translateY(0) scale(.9999, .9999);
						-moz-transform: translateY(0) scale(.9999, .9999);
						-o-transform: translateY(0) scale(.9999, .9999);
					}
					72.7273% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1);
						transform: translateY(0) scale(1, 1);
						-moz-transform: translateY(0) scale(1, 1);
						-o-transform: translateY(0) scale(1, 1);
					}
					75.0000%, 77.2727% {
						-webkit-transform: translateY(0) scale(1, 1);
						transform: translateY(0) scale(1, 1);
						-moz-transform: translateY(0) scale(1, 1);
						-o-transform: translateY(0) scale(1, 1);
					}
					79.5455%, 81.8182% {
						-webkit-transform: translateY(0) scale(1.0001, 1.0001);
						transform: translateY(0) scale(1.0001, 1.0001);
						-moz-transform: translateY(0) scale(1.0001, 1.0001);
						-o-transform: translateY(0) scale(1.0001, 1.0001);

					}
					84.0909%, 86.3636%, 88.6364%, 90.9091%, 93.1818%, 95.4545%, 97.7273% {
						-webkit-transform: translateY(0) scale(1, 1);
						transform: translateY(0) scale(1, 1);
						-moz-transform: translateY(0) scale(1, 1);
						-o-transform: translateY(0) scale(1, 1);
					}
					100% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1) rotate(.0001deg);
						transform: translateY(0) scale(1, 1) rotate(.0001deg);
						-moz-transform: translateY(0) scale(1, 1) rotate(.0001deg);
						-o-transform: translateY(0) scale(1, 1) rotate(.0001deg);
					}}";	
		}
		if($count==2)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
				-webkit-animation-duration: .9833s;
				-webkit-animation-name: head-".$count."-anim;
				-moz-animation-duration: .9833s;
				-moz-animation-name: head-".$count."-anim;
				animation-duration: .9833s;
				animation-name: head-".$count."-anim;
				}";
			$html.="@keyframes head-2-anim {
						0% {
						opacity: .0825;
						-webkit-transform: translateY(49.54px) scale(.0825, .0825);	
						transform: translateY(49.54px) scale(.0825, .0825);	
						-moz-transform: translateY(49.54px) scale(.0825, .0825);	
						-o-transform: translateY(49.54px) scale(.0825, .0825);
					}
					1.6949% {
						opacity: .1684;
						-webkit-transform: translateY(44.91px) scale(.1684, .1684);
						transform: translateY(44.91px) scale(.1684, .1684);	
						-moz-transform: translateY(44.91px) scale(.1684, .1684);	
						-o-transform: translateY(44.91px) scale(.1684, .1684);
					}
					3.3898% {
						opacity: .2765;
						-webkit-transform: translateY(39.07px) scale(.2765, .2765);	
						transform: translateY(39.07px) scale(.2765, .2765);	
						-moz-transform: translateY(39.07px) scale(.2765, .2765);	
						-o-transform: translateY(39.07px) scale(.2765, .2765);
					}
					5.0847% {
						opacity: .3977;
						-webkit-transform: translateY(32.52px) scale(.3977, .3977);	
						transform: translateY(32.52px) scale(.3977, .3977);	
						-moz-transform: translateY(32.52px) scale(.3977, .3977);	
						-o-transform: translateY(32.52px) scale(.3977, .3977);
					}
					6.7797% {
						opacity: .5224;
						-webkit-transform: translateY(25.79px) scale(.5224, .5224);	
						transform: translateY(25.79px) scale(.5224, .5224);	
						-moz-transform: translateY(25.79px) scale(.5224, .5224);	
						-o-transform: translateY(25.79px) scale(.5224, .5224);
					}
					8.4746% {
						opacity: .6421;
						-webkit-transform: translateY(19.33px) scale(.6421, .6421);	
						transform: translateY(19.33px) scale(.6421, .6421);	
						-moz-transform: translateY(19.33px) scale(.6421, .6421);	
						-o-transform: translateY(19.33px) scale(.6421, .6421);
					}
					10.1695% {
						opacity: .7504;
						-webkit-transform: translateY(13.48px) scale(.7504, .7504);	
						transform: translateY(13.48px) scale(.7504, .7504);	
						-moz-transform: translateY(13.48px) scale(.7504, .7504);	
						-o-transform: translateY(13.48px) scale(.7504, .7504);
					}
					11.8644% {
						opacity: .8432;
						-webkit-transform: translateY(8.47px) scale(.8432, .8432);	
						transform: translateY(8.47px) scale(.8432, .8432);	
						-moz-transform: translateY(8.47px) scale(.8432, .8432);	
						-o-transform: translateY(8.47px) scale(.8432, .8432);
					}
					13.5593% {
						opacity: .9182;
						-webkit-transform: translateY(4.42px) scale(.9182, .9182);
						transform: translateY(4.42px) scale(.9182, .9182);
						-moz-transform: translateY(4.42px) scale(.9182, .9182);
						-o-transform: translateY(4.42px) scale(.9182, .9182);
					}
					15.2542% {
						opacity: .9754;
						-webkit-transform: translateY(1.33px) scale(.9754, .9754);
						transform: translateY(1.33px) scale(.9754, .9754);
						-moz-transform: translateY(1.33px) scale(.9754, .9754);
						-o-transform: translateY(1.33px) scale(.9754, .9754);
					}
					16.9492% {
						opacity: 1;
						-webkit-transform: translateY(-.86px) scale(1.0159, 1.0159);	
						transform: translateY(-.86px) scale(1.0159, 1.0159);	
						-moz-transform: translateY(-.86px) scale(1.0159, 1.0159);
						-o-transform: translateY(-.86px) scale(1.0159, 1.0159);
					}
					18.6441% {
						-webkit-transform: translateY(-2.26px) scale(1.0419, 1.0419);	
						transform: translateY(-2.26px) scale(1.0419, 1.0419);	
						-moz-transform: translateY(-2.26px) scale(1.0419, 1.0419);	
						-o-transform: translateY(-2.26px) scale(1.0419, 1.0419);
					}
					20.3390% {
						-webkit-transform: translateY(-3.02px) scale(1.0560, 1.0560);
						transform: translateY(-3.02px) scale(1.0560, 1.0560);
						-moz-transform: translateY(-3.02px) scale(1.0560, 1.0560);
						-o-transform: translateY(-3.02px) scale(1.0560, 1.0560);
					}
					22.0339% {
						-webkit-transform: translateY(-3.29px) scale(1.0609, 1.0609);
						transform: translateY(-3.29px) scale(1.0609, 1.0609);
						-moz-transform: translateY(-3.29px) scale(1.0609, 1.0609);
						-o-transform: translateY(-3.29px) scale(1.0609, 1.0609);
					}
					23.7288% {
						-webkit-transform: translateY(-3.2px) scale(1.0593, 1.0593);
						transform: translateY(-3.2px) scale(1.0593, 1.0593);
						-moz-transform: translateY(-3.2px) scale(1.0593, 1.0593);
						-o-transform: translateY(-3.2px) scale(1.0593, 1.0593);
					}
					25.4237% {
						-webkit-transform: translateY(-2.89px) scale(1.0535, 1.0535);
						transform: translateY(-2.89px) scale(1.0535, 1.0535);
						-moz-transform: translateY(-2.89px) scale(1.0535, 1.0535);
						-o-transform: translateY(-2.89px) scale(1.0535, 1.0535);
					}
					27.1186% {
						-webkit-transform: translateY(-2.44px) scale(1.0453, 1.0453);	
						transform: translateY(-2.44px) scale(1.0453, 1.0453);	
						-moz-transform: translateY(-2.44px) scale(1.0453, 1.0453);
						-o-transform: translateY(-2.44px) scale(1.0453, 1.0453);
					}
					28.8136% {
						-webkit-transform: translateY(-1.95px) scale(1.0362, 1.0362);
						transform: translateY(-1.95px) scale(1.0362, 1.0362);
						-moz-transform: translateY(-1.95px) scale(1.0362, 1.0362);
						-o-transform: translateY(-1.95px) scale(1.0362, 1.0362);
					}
					30.5085% {
						-webkit-transform: translateY(-1.47px) scale(1.0273, 1.0273);
						transform: translateY(-1.47px) scale(1.0273, 1.0273);
						-moz-transform: translateY(-1.47px) scale(1.0273, 1.0273);
						-o-transform: translateY(-1.47px) scale(1.0273, 1.0273);
					}
					32.2034% {
						-webkit-transform: translateY(-1.04px) scale(1.0193, 1.0193);	
						transform: translateY(-1.04px) scale(1.0193, 1.0193);	
						-moz-transform: translateY(-1.04px) scale(1.0193, 1.0193);
						-o-transform: translateY(-1.04px) scale(1.0193, 1.0193);
					}
					33.8983% {
						-webkit-transform: translateY(-.67px) scale(1.0124, 1.0124);
						transform: translateY(-.67px) scale(1.0124, 1.0124);
						-moz-transform: translateY(-.67px) scale(1.0124, 1.0124);
						-o-transform: translateY(-.67px) scale(1.0124, 1.0124);
					}
					35.5932% {
						-webkit-transform: translateY(-.38px) scale(1.0070, 1.0070);
						transform: translateY(-.38px) scale(1.0070, 1.0070);
						-moz-transform: translateY(-.38px) scale(1.0070, 1.0070);
						-o-transform: translateY(-.38px) scale(1.0070, 1.0070);
					}
					37.2881% {
						-webkit-transform: translateY(-.16px) scale(1.0029, 1.0029);
						transform: translateY(-.16px) scale(1.0029, 1.0029);
						-moz-transform: translateY(-.16px) scale(1.0029, 1.0029);
						-o-transform: translateY(-.16px) scale(1.0029, 1.0029);
					}
					38.9831% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1);
						transform: translateY(0) scale(1, 1);
						-moz-transform: translateY(0) scale(1, 1);
						-o-transform: translateY(0) scale(1, 1);
					}
					40.6780% {
						opacity: .9982;
						-webkit-transform: translateY(.1px) scale(.9982, .9982);
						transform: translateY(.1px) scale(.9982, .9982);
						-moz-transform: translateY(.1px) scale(.9982, .9982);
						-o-transform: translateY(.1px) scale(.9982, .9982);
					}
					42.3729% {
						opacity: .9972;
						-webkit-transform: translateY(.15px) scale(.9972, .9972);	
						transform: translateY(.15px) scale(.9972, .9972);	
						-moz-transform: translateY(.15px) scale(.9972, .9972);	
						-o-transform: translateY(.15px) scale(.9972, .9972);
					}
					44.0678% {
						opacity: .9968;
						-webkit-transform: translateY(.18px) scale(.9968, .9968);
						transform: translateY(.18px) scale(.9968, .9968);	
						-moz-transform: translateY(.18px) scale(.9968, .9968);	
						-o-transform: translateY(.18px) scale(.9968, .9968);
					}
					45.7627% {
						opacity: .9968;
						-webkit-transform: translateY(.17px) scale(.9968, .9968);
						transform: translateY(.17px) scale(.9968, .9968);
						-moz-transform: translateY(.17px) scale(.9968, .9968);
						-o-transform: translateY(.17px) scale(.9968, .9968);
					}
					47.4576% {
						opacity: .9971;
						-webkit-transform: translateY(.16px) scale(.9971, .9971);
						transform: translateY(.16px) scale(.9971, .9971);
						-moz-transform: translateY(.16px) scale(.9971, .9971);
						-o-transform: translateY(.16px) scale(.9971, .9971);
					}
					49.1525% {
						opacity: .9975;
						-webkit-transform: translateY(.13px) scale(.9975, .9975);
						transform: translateY(.13px) scale(.9975, .9975);	
						-moz-transform: translateY(.13px) scale(.9975, .9975);	
						-o-transform: translateY(.13px) scale(.9975, .9975);
					}
					50.8475% {
						opacity: .998;
						-webkit-transform: translateY(.11px) scale(.998, .998);		
						transform: translateY(.11px) scale(.998, .998);	
						-moz-transform: translateY(.11px) scale(.998, .998);	
						-o-transform: translateY(.11px) scale(.998, .998);
					}
					52.5424% {
						opacity: .9985;
						-webkit-transform: translateY(.08px) scale(.9985, .9985);		
						transform: translateY(.08px) scale(.9985, .9985);		
						-moz-transform: translateY(.08px) scale(.9985, .9985);		
						-o-transform: translateY(.08px) scale(.9985, .9985);
					}
					54.2373% {
						opacity: .9989;
						-webkit-transform: translateY(.06px) scale(.9989, .9989);	
						transform: translateY(.06px) scale(.9989, .9989);	
						-moz-transform: translateY(.06px) scale(.9989, .9989);	
						-o-transform: translateY(.06px) scale(.9989, .9989);
					}
					55.9322% {
						opacity: .9993;
						-webkit-transform: translateY(.04px) scale(.9993, .9993);		
						transform: translateY(.04px) scale(.9993, .9993);		
						-moz-transform: translateY(.04px) scale(.9993, .9993);		
						-o-transform: translateY(.04px) scale(.9993, .9993);
					}
					57.6271% {
						opacity: .9996;
						-webkit-transform: translateY(.02px) scale(.9996, .9996);
						transform: translateY(.02px) scale(.9996, .9996);
						-moz-transform: translateY(.02px) scale(.9996, .9996);
						-o-transform: translateY(.02px) scale(.9996, .9996);
					}
					59.3220% {
						opacity: .9998;
						-webkit-transform: translateY(.01px) scale(.9998, .9998);
						transform: translateY(.01px) scale(.9998, .9998);	
						-moz-transform: translateY(.01px) scale(.9998, .9998);	
						-o-transform: translateY(.01px) scale(.9998, .9998);
					}
					61.0169% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1);	
						transform: translateY(0) scale(1, 1);	
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					62.7119% {
						-webkit-transform: translateY(0) scale(1.0001, 1.0001);	
						transform: translateY(0) scale(1.0001, 1.0001);	
						-moz-transform: translateY(0) scale(1.0001, 1.0001);	
						-o-transform: translateY(0) scale(1.0001, 1.0001);
					}
					64.4068% {
						-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
					}
					66.1017%, 67.7966% {
						-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
					}
					69.4915%, 71.1864%, 72.8814% {
						-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);		
						transform: translateY(-.01px) scale(1.0001, 1.0001);		
						-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
					}
					74.5763%, 76.2712% {
						-webkit-transform: translateY(0) scale(1.0001, 1.0001);	
						transform: translateY(0) scale(1.0001, 1.0001);		
						-moz-transform: translateY(0) scale(1.0001, 1.0001);		
						-o-transform: translateY(0) scale(1.0001, 1.0001);
					}
					77.9661%, 79.6610%, 81.3559%, 83.0508%, 84.7458%, 86.4407%, 88.1356%, 89.8305%, 91.5254%, 93.2203%, 94.9153%, 96.6102%, 98.3051% {
						-webkit-transform: translateY(0) scale(1, 1);	
						transform: translateY(0) scale(1, 1);	
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					100% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1) rotate(.0001deg);			
						transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						-moz-transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						-o-transform: translateY(0) scale(1, 1) rotate(.0001deg);
					}
					}";	
		}
		if($count==3)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
					-webkit-animation-duration: 1.0833s;
					-webkit-animation-name: head-".$count."-anim;
					-moz-animation-duration: 1.0833s;
					-moz-animation-name: head-".$count."-anim;
					animation-duration: 1.0833s;
					animation-name: head-".$count."-anim;
					}";
					
			$html.="@keyframes head-3-anim {
						0% {
						opacity: .0178;
						-webkit-transform: translateY(53.04px) scale(.0178, .0178);	
						transform: translateY(53.04px) scale(.0178, .0178);	
						-moz-transform: translateY(53.04px) scale(.0178, .0178);	
						-o-transform: translateY(53.04px) scale(.0178, .0178);
					}
					1.5385% {
						opacity: .046;
						-webkit-transform: translateY(51.52px) scale(.0460, .0460);	
						transform: translateY(51.52px) scale(.0460, .0460);	
						-moz-transform: translateY(51.52px) scale(.0460, .0460);	
						-o-transform: translateY(51.52px) scale(.0460, .0460);
					}
					3.0769% {
						opacity: .092;
						-webkit-transform: translateY(49.03px) scale(.0920, .0920);		
						transform: translateY(49.03px) scale(.0920, .0920);			
						-moz-transform: translateY(49.03px) scale(.0920, .0920);			
						-o-transform: translateY(49.03px) scale(.0920, .0920);
					}
					4.6154% {
						opacity: .1569;
						-webkit-transform: translateY(45.53px) scale(.1569, .1569);		
						transform: translateY(45.53px) scale(.1569, .1569);		
						-moz-transform: translateY(45.53px) scale(.1569, .1569);		
						-o-transform: translateY(45.53px) scale(.1569, .1569);
					}
					6.1538% {
						opacity: .2389;
						-webkit-transform: translateY(41.1px) scale(.2389, .2389);	
						transform: translateY(41.1px) scale(.2389, .2389);	
						-moz-transform: translateY(41.1px) scale(.2389, .2389);	
						-o-transform: translateY(41.1px) scale(.2389, .2389);
					}
					7.6923% {
						opacity: .3347;
						-webkit-transform: translateY(35.93px) scale(.3347, .3347);		
						transform: translateY(35.93px) scale(.3347, .3347);	
						-moz-transform: translateY(35.93px) scale(.3347, .3347);		
						-o-transform: translateY(35.93px) scale(.3347, .3347);
					}
					9.2308% {
						opacity: .4391;
						-webkit-transform: translateY(30.29px) scale(.4391, .4391);		
						transform: translateY(30.29px) scale(.4391, .4391);		
						-moz-transform: translateY(30.29px) scale(.4391, .4391);		
						-o-transform: translateY(30.29px) scale(.4391, .4391);
					}
					10.7692% {
						opacity: .5466;
						-webkit-transform: translateY(24.49px) scale(.5466, .5466);			
						transform: translateY(24.49px) scale(.5466, .5466);			
						-moz-transform: translateY(24.49px) scale(.5466, .5466);			
						-o-transform: translateY(24.49px) scale(.5466, .5466);
					}
					12.3077% {
						opacity: .6516;
						-webkit-transform: translateY(18.81px) scale(.6516, .6516);				
						transform: translateY(18.81px) scale(.6516, .6516);				
						-moz-transform: translateY(18.81px) scale(.6516, .6516);			
						-o-transform: translateY(18.81px) scale(.6516, .6516);
					}
					13.8462% {
						opacity: .7495;
						-webkit-transform: translateY(13.53px) scale(.7495, .7495);			
						transform: translateY(13.53px) scale(.7495, .7495);		
						-moz-transform: translateY(13.53px) scale(.7495, .7495);		
						-o-transform: translateY(13.53px) scale(.7495, .7495);
					}
					15.3846% {
						opacity: .8364;
						-webkit-transform: translateY(8.83px) scale(.8364, .8364);			
						transform: translateY(8.83px) scale(.8364, .8364);			
						-moz-transform: translateY(8.83px) scale(.8364, .8364);		
						-o-transform: translateY(8.83px) scale(.8364, .8364);
					}
					16.9231% {
						opacity: .91;
						-webkit-transform: translateY(4.86px) scale(.91, .91);	
						transform: translateY(4.86px) scale(.91, .91);	
						-moz-transform: translateY(4.86px) scale(.91, .91);		
						-o-transform: translateY(4.86px) scale(.91, .91);
					}
					18.4615% {
						opacity: .9691;
						-webkit-transform: translateY(1.67px) scale(.9691, .9691);
						transform: translateY(1.67px) scale(.9691, .9691);	
						-moz-transform: translateY(1.67px) scale(.9691, .9691);	
						-o-transform: translateY(1.67px) scale(.9691, .9691);
					}
					20% {
						opacity: 1;
						-webkit-transform: translateY(-.74px) scale(1.0137, 1.0137);		
						transform: translateY(-.74px) scale(1.0137, 1.0137);	
						-moz-transform: translateY(-.74px) scale(1.0137, 1.0137);	
						-o-transform: translateY(-.74px) scale(1.0137, 1.0137);
					}
					21.5385% {
						-webkit-transform: translateY(-2.42px) scale(1.0448, 1.0448);		
						transform: translateY(-2.42px) scale(1.0448, 1.0448);		
						-moz-transform: translateY(-2.42px) scale(1.0448, 1.0448);	
						-o-transform: translateY(-2.42px) scale(1.0448, 1.0448);
					}
					23.0769% {
						-webkit-transform: translateY(-3.45px) scale(1.0638, 1.0638);	
						transform: translateY(-3.45px) scale(1.0638, 1.0638);	
						-moz-transform: translateY(-3.45px) scale(1.0638, 1.0638);	
						-o-transform: translateY(-3.45px) scale(1.0638, 1.0638);
					}
					24.6154% {
						-webkit-transform: translateY(-3.94px) scale(1.0730, 1.0730);		
						transform: translateY(-3.94px) scale(1.0730, 1.0730);		
						-moz-transform: translateY(-3.94px) scale(1.0730, 1.0730);		
						-o-transform: translateY(-3.94px) scale(1.0730, 1.0730);
					}
					26.1538% {
						-webkit-transform: translateY(-4.01px) scale(1.0743, 1.0743);		
						transform: translateY(-4.01px) scale(1.0743, 1.0743);		
						-moz-transform: translateY(-4.01px) scale(1.0743, 1.0743);		
						-o-transform: translateY(-4.01px) scale(1.0743, 1.0743);
					}
					27.6923% {
						-webkit-transform: translateY(-3.78px) scale(1.0700, 1.0700);		
						transform: translateY(-3.78px) scale(1.0700, 1.0700);		
						-moz-transform: translateY(-3.78px) scale(1.0700, 1.0700);		
						-o-transform: translateY(-3.78px) scale(1.0700, 1.0700);
					}
					29.2308% {
						-webkit-transform: translateY(-3.35px) scale(1.0620, 1.0620);	
						transform: translateY(-3.35px) scale(1.0620, 1.0620);	
						-moz-transform: translateY(-3.35px) scale(1.0620, 1.0620);	
						-o-transform: translateY(-3.35px) scale(1.0620, 1.0620);
					}
					30.7692% {
						-webkit-transform: translateY(-2.81px) scale(1.0520, 1.0520);	
						transform: translateY(-2.81px) scale(1.0520, 1.0520);	
						-moz-transform: translateY(-2.81px) scale(1.0520, 1.0520);	
						-o-transform: translateY(-2.81px) scale(1.0520, 1.0520);
					}
					32.3077% {
						-webkit-transform: translateY(-2.23px) scale(1.0413, 1.0413);	
						transform: translateY(-2.23px) scale(1.0413, 1.0413);	
						-moz-transform: translateY(-2.23px) scale(1.0413, 1.0413);	
						-o-transform: translateY(-2.23px) scale(1.0413, 1.0413);
					}
					33.8462% {
						-webkit-transform: translateY(-1.67px) scale(1.0310, 1.0310);		
						transform: translateY(-1.67px) scale(1.0310, 1.0310);	
						-moz-transform: translateY(-1.67px) scale(1.0310, 1.0310);	
						-o-transform: translateY(-1.67px) scale(1.0310, 1.0310);
					}
					35.3846% {
						-webkit-transform: translateY(-1.17px) scale(1.0216, 1.0216);		
						transform: translateY(-1.17px) scale(1.0216, 1.0216);		
						-moz-transform: translateY(-1.17px) scale(1.0216, 1.0216);		
						-o-transform: translateY(-1.17px) scale(1.0216, 1.0216);
					}
					36.9231% {
						-webkit-transform: translateY(-.73px) scale(1.0136, 1.0136);		
						transform: translateY(-.73px) scale(1.0136, 1.0136);		
						-moz-transform: translateY(-.73px) scale(1.0136, 1.0136);		
						-o-transform: translateY(-.73px) scale(1.0136, 1.0136);
					}
					38.4615% {
						-webkit-transform: translateY(-.38px) scale(1.0071, 1.0071);	
						transform: translateY(-.38px) scale(1.0071, 1.0071);	
						-moz-transform: translateY(-.38px) scale(1.0071, 1.0071);	
						-o-transform: translateY(-.38px) scale(1.0071, 1.0071);
					}
					40% {
						opacity: 1;
						-webkit-transform: translateY(-.12px) scale(1.0022, 1.0022);	
						transform: translateY(-.12px) scale(1.0022, 1.0022);	
						-moz-transform: translateY(-.12px) scale(1.0022, 1.0022);	
						-o-transform: translateY(-.12px) scale(1.0022, 1.0022);
					}
					41.5385% {
						opacity: .9988;
						-webkit-transform: translateY(.07px) scale(.9988, .9988);	
						transform: translateY(.07px) scale(.9988, .9988);	
						-moz-transform: translateY(.07px) scale(.9988, .9988);	
						-o-transform: translateY(.07px) scale(.9988, .9988);
					}
					43.0769% {
						opacity: .9966;
						-webkit-transform: translateY(.19px) scale(.9966, .9966);	
						transform: translateY(.19px) scale(.9966, .9966);	
						-moz-transform: translateY(.19px) scale(.9966, .9966);	
						-o-transform: translateY(.19px) scale(.9966, .9966);
					}
					44.6154% {
						opacity: .9954;
						-webkit-transform: translateY(.25px) scale(.9954, .9954);		
						transform: translateY(.25px) scale(.9954, .9954);		
						-moz-transform: translateY(.25px) scale(.9954, .9954);	
						-o-transform: translateY(.25px) scale(.9954, .9954);
					}
					46.1538% {
						opacity: .9949;
						-webkit-transform: translateY(.27px) scale(.9949, .9949);	
						transform: translateY(.27px) scale(.9949, .9949);	
						-moz-transform: translateY(.27px) scale(.9949, .9949);	
						-o-transform: translateY(.27px) scale(.9949, .9949);
					}
					47.6923% {
						opacity: .995;
						-webkit-transform: translateY(.27px) scale(.995, .995);		
						transform: translateY(.27px) scale(.995, .995);		
						-moz-transform: translateY(.27px) scale(.995, .995);		
						-o-transform: translateY(.27px) scale(.995, .995);
					}
					49.2308% {
						opacity: .9955;
						-webkit-transform: translateY(.24px) scale(.9955, .9955);	
						transform: translateY(.24px) scale(.9955, .9955);	
						-moz-transform: translateY(.24px) scale(.9955, .9955);	
						-o-transform: translateY(.24px) scale(.9955, .9955);
					}
					50.7692% {
						opacity: .9962;
						-webkit-transform: translateY(.21px) scale(.9962, .9962);	
						transform: translateY(.21px) scale(.9962, .9962);	
						-moz-transform: translateY(.21px) scale(.9962, .9962);	
						-o-transform: translateY(.21px) scale(.9962, .9962);
					}
					52.3077% {
						opacity: .9969;
						-webkit-transform: translateY(.17px) scale(.9969, .9969);	
						transform: translateY(.17px) scale(.9969, .9969);	
						-moz-transform: translateY(.17px) scale(.9969, .9969);	
						-o-transform: translateY(.17px) scale(.9969, .9969);
					}
					53.8462% {
						opacity: .9977;
						-webkit-transform: translateY(.13px) scale(.9977, .9977);	
						transform: translateY(.13px) scale(.9977, .9977);	
						-moz-transform: translateY(.13px) scale(.9977, .9977);	
						-o-transform: translateY(.13px) scale(.9977, .9977);
					}
					55.3846% {
						opacity: .9984;
						-webkit-transform: translateY(.09px) scale(.9984, .9984);	
						transform: translateY(.09px) scale(.9984, .9984);	
						-moz-transform: translateY(.09px) scale(.9984, .9984);	
						-o-transform: translateY(.09px) scale(.9984, .9984);
					}
					56.9231% {
						opacity: .9989;
						-webkit-transform: translateY(.06px) scale(.9989, .9989);		
						transform: translateY(.06px) scale(.9989, .9989);	
						-moz-transform: translateY(.06px) scale(.9989, .9989);	
						-o-transform: translateY(.06px) scale(.9989, .9989);
					}
					58.4615% {
						opacity: .9994;
						-webkit-transform: translateY(.03px) scale(.9994, .9994);	
						transform: translateY(.03px) scale(.9994, .9994);	
						-moz-transform: translateY(.03px) scale(.9994, .9994);	
						-o-transform: translateY(.03px) scale(.9994, .9994);
					}
					60% {
						opacity: .9998;
						-webkit-transform: translateY(.01px) scale(.9998, .9998);		
						transform: translateY(.01px) scale(.9998, .9998);	
						-moz-transform: translateY(.01px) scale(.9998, .9998);	
						-o-transform: translateY(.01px) scale(.9998, .9998);
					}
					61.5385% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1);		
						transform: translateY(0) scale(1, 1);		
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					63.0769% {
						-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
					}
					64.6154% {
						-webkit-transform: translateY(-.01px) scale(1.0003, 1.0003);	
						transform: translateY(-.01px) scale(1.0003, 1.0003);	
						-moz-transform: translateY(-.01px) scale(1.0003, 1.0003);	
						-o-transform: translateY(-.01px) scale(1.0003, 1.0003);
					}
					66.1538%, 67.6923% {
						-webkit-transform: translateY(-.02px) scale(1.0003, 1.0003);	
						transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-moz-transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-o-transform: translateY(-.02px) scale(1.0003, 1.0003);
					}
					69.2308% {
						-webkit-transform: translateY(-.01px) scale(1.0003, 1.0003);	
						transform: translateY(-.01px) scale(1.0003, 1.0003);	
						-moz-transform: translateY(-.01px) scale(1.0003, 1.0003);	
						-o-transform: translateY(-.01px) scale(1.0003, 1.0003);
					}
					70.7692%, 72.3077% {
						-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
					}
					73.8462%, 75.3846% {
						-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);		
						transform: translateY(-.01px) scale(1.0001, 1.0001);		
						-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);		
						-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
					}
					76.9231% {
						-webkit-transform: translateY(0) scale(1.0001, 1.0001);	
						transform: translateY(0) scale(1.0001, 1.0001);	
						-moz-transform: translateY(0) scale(1.0001, 1.0001);	
						-o-transform: translateY(0) scale(1.0001, 1.0001);
					}
					78.4615%, 80%, 81.5385%, 83.0769%, 84.6154%, 86.1538%, 87.6923%, 89.2308%, 90.7692%, 92.3077%, 93.8462%, 95.3846%, 96.9231%, 98.4615% {
						-webkit-transform: translateY(0) scale(1, 1);	
						transform: translateY(0) scale(1, 1);	
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					100% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1) rotate(.0001deg);	
						transform: translateY(0) scale(1, 1) rotate(.0001deg);	
						-moz-transform: translateY(0) scale(1, 1) rotate(.0001deg);	
						-o-transform: translateY(0) scale(1, 1) rotate(.0001deg);
					}
					}";		
		}
		if($count==4)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
					-webkit-animation-duration: .9333s;
					-webkit-animation-name: head-".$count."-anim;
					-moz-animation-duration: .9333s;
					-moz-animation-name: head-".$count."-anim;
					animation-duration: .9333s;
					animation-name: head-".$count."-anim;
					}";
					
			$html.="@keyframes head-4-anim {
						0% {
						opacity: .0036;
						-webkit-transform: translateY(53.81px) scale(.0036, .0036);	
						transform: translateY(53.81px) scale(.0036, .0036);		
						-moz-transform: translateY(53.81px) scale(.0036, .0036);		
						-o-transform: translateY(53.81px) scale(.0036, .0036);
					}
					1.7857% {
						opacity: .0112;
						-webkit-transform: translateY(53.39px) scale(.0112, .0112);		
						transform: translateY(53.39px) scale(.0112, .0112);		
						-moz-transform: translateY(53.39px) scale(.0112, .0112);		
						-o-transform: translateY(53.39px) scale(.0112, .0112);
					}
					3.5714% {
						opacity: .0265;
						-webkit-transform: translateY(52.57px) scale(.0265, .0265);		
						transform: translateY(52.57px) scale(.0265, .0265);		
						-moz-transform: translateY(52.57px) scale(.0265, .0265);		
						-o-transform: translateY(52.57px) scale(.0265, .0265);
					}
					5.3571% {
						opacity: .0524;
						-webkit-transform: translateY(51.17px) scale(.0524, .0524);		
						transform: translateY(51.17px) scale(.0524, .0524);		
						-moz-transform: translateY(51.17px) scale(.0524, .0524);		
						-o-transform: translateY(51.17px) scale(.0524, .0524);
					}
					7.1429% {
						opacity: .0912;
						-webkit-transform: translateY(49.08px) scale(.0912, .0912);		
						transform: translateY(49.08px) scale(.0912, .0912);		
						-moz-transform: translateY(49.08px) scale(.0912, .0912);		
						-o-transform: translateY(49.08px) scale(.0912, .0912);
					}
					8.9286% {
						opacity: .144;
						-webkit-transform: translateY(46.22px) scale(.144, .144);	
						transform: translateY(46.22px) scale(.144, .144);	
						-moz-transform: translateY(46.22px) scale(.144, .144);	
						-o-transform: translateY(46.22px) scale(.144, .144);
					}
					10.7143% {
						opacity: .2108;
						-webkit-transform: translateY(42.62px) scale(.2108, .2108);	
						transform: translateY(42.62px) scale(.2108, .2108);	
						-moz-transform: translateY(42.62px) scale(.2108, .2108);	
						-o-transform: translateY(42.62px) scale(.2108, .2108);
					}
					12.5000% {
						opacity: .2901;
						-webkit-transform: translateY(38.33px) scale(.2901, .2901);		
						transform: translateY(38.33px) scale(.2901, .2901);		
						-moz-transform: translateY(38.33px) scale(.2901, .2901);		
						-o-transform: translateY(38.33px) scale(.2901, .2901);
					}
					14.2857% {
						opacity: .3792;
						-webkit-transform: translateY(33.52px) scale(.3792, .3792);
						transform: translateY(33.52px) scale(.3792, .3792);	
						-moz-transform: translateY(33.52px) scale(.3792, .3792);	
						-o-transform: translateY(33.52px) scale(.3792, .3792);
					}
					16.0714% {
						opacity: .4746;
						-webkit-transform: translateY(28.37px) scale(.4746, .4746);		
						transform: translateY(28.37px) scale(.4746, .4746);		
						-moz-transform: translateY(28.37px) scale(.4746, .4746);		
						-o-transform: translateY(28.37px) scale(.4746, .4746);
					}
					17.8571% {
						opacity: .5722;
						-webkit-transform: translateY(23.1px) scale(.5722, .5722);		
						transform: translateY(23.1px) scale(.5722, .5722);		
						-moz-transform: translateY(23.1px) scale(.5722, .5722);		
						-o-transform: translateY(23.1px) scale(.5722, .5722);
					}
					19.6429% {
						opacity: .668;
						-webkit-transform: translateY(17.93px) scale(.668, .668);	
						transform: translateY(17.93px) scale(.668, .668);	
						-moz-transform: translateY(17.93px) scale(.668, .668);	
						-o-transform: translateY(17.93px) scale(.668, .668);
					}
					21.4286% {
						opacity: .7583;
						-webkit-transform: translateY(13.05px) scale(.7583, .7583);		
						transform: translateY(13.05px) scale(.7583, .7583);		
						-moz-transform: translateY(13.05px) scale(.7583, .7583);		
						-o-transform: translateY(13.05px) scale(.7583, .7583);
					}
					23.2143% {
						opacity: .8399;
						-webkit-transform: translateY(8.65px) scale(.8399, .8399);	
						transform: translateY(8.65px) scale(.8399, .8399);	
						-moz-transform: translateY(8.65px) scale(.8399, .8399);	
						-o-transform: translateY(8.65px) scale(.8399, .8399);
					}
					25.0000% {
						opacity: .9105;
						-webkit-transform: translateY(4.83px) scale(.9105, .9105);	
						transform: translateY(4.83px) scale(.9105, .9105);	
						-moz-transform: translateY(4.83px) scale(.9105, .9105);	
						-o-transform: translateY(4.83px) scale(.9105, .9105);
					}
					26.7857% {
						opacity: .9689;
						-webkit-transform: translateY(1.68px) scale(.9689, .9689);	
						transform: translateY(1.68px) scale(.9689, .9689);	
						-moz-transform: translateY(1.68px) scale(.9689, .9689);	
						-o-transform: translateY(1.68px) scale(.9689, .9689);
					}
					28.5714% {
						opacity: 1;
						-webkit-transform: translateY(-.78px) scale(1.0145, 1.0145);	
						transform: translateY(-.78px) scale(1.0145, 1.0145);	
						-moz-transform: translateY(-.78px) scale(1.0145, 1.0145);	
						-o-transform: translateY(-.78px) scale(1.0145, 1.0145);
					}
					30.3571% {
						-webkit-transform: translateY(-2.58px) scale(1.0477, 1.0477);	
						transform: translateY(-2.58px) scale(1.0477, 1.0477);	
						-moz-transform: translateY(-2.58px) scale(1.0477, 1.0477);	
						-o-transform: translateY(-2.58px) scale(1.0477, 1.0477);
					}
					32.1429% {
						-webkit-transform: translateY(-3.75px) scale(1.0695, 1.0695);		
						transform: translateY(-3.75px) scale(1.0695, 1.0695);		
						-moz-transform: translateY(-3.75px) scale(1.0695, 1.0695);	
						-o-transform: translateY(-3.75px) scale(1.0695, 1.0695);
					}
					33.9286% {
						-webkit-transform: translateY(-4.39px) scale(1.0813, 1.0813);			
						transform: translateY(-4.39px) scale(1.0813, 1.0813);		
						-moz-transform: translateY(-4.39px) scale(1.0813, 1.0813);		
						-o-transform: translateY(-4.39px) scale(1.0813, 1.0813);
					}
					35.7143% {
						-webkit-transform: translateY(-4.59px) scale(1.0849, 1.0849);
						transform: translateY(-4.59px) scale(1.0849, 1.0849);
						-moz-transform: translateY(-4.59px) scale(1.0849, 1.0849);
						-o-transform: translateY(-4.59px) scale(1.0849, 1.0849);
					}
					37.5000% {
						-webkit-transform: translateY(-4.44px) scale(1.0822, 1.0822);	
						transform: translateY(-4.44px) scale(1.0822, 1.0822);	
						-moz-transform: translateY(-4.44px) scale(1.0822, 1.0822);	
						-o-transform: translateY(-4.44px) scale(1.0822, 1.0822);
					}
					39.2857% {
						-webkit-transform: translateY(-4.05px) scale(1.0750, 1.0750);	
						transform: translateY(-4.05px) scale(1.0750, 1.0750);	
						-moz-transform: translateY(-4.05px) scale(1.0750, 1.0750);	
						-o-transform: translateY(-4.05px) scale(1.0750, 1.0750);
					}
					41.0714% {
						-webkit-transform: translateY(-3.51px) scale(1.0649, 1.0649);		
						transform: translateY(-3.51px) scale(1.0649, 1.0649);	
						-moz-transform: translateY(-3.51px) scale(1.0649, 1.0649);	
						-o-transform: translateY(-3.51px) scale(1.0649, 1.0649);
					}
					42.8571% {
						-webkit-transform: translateY(-2.88px) scale(1.0534, 1.0534);		
						transform: translateY(-2.88px) scale(1.0534, 1.0534);	
						-moz-transform: translateY(-2.88px) scale(1.0534, 1.0534);	
						-o-transform: translateY(-2.88px) scale(1.0534, 1.0534);
					}
					44.6429% {
						-webkit-transform: translateY(-2.25px) scale(1.0416, 1.0416);	
						transform: translateY(-2.25px) scale(1.0416, 1.0416);	
						-moz-transform: translateY(-2.25px) scale(1.0416, 1.0416);	
						-o-transform: translateY(-2.25px) scale(1.0416, 1.0416);
					}
					46.4286% {
						-webkit-transform: translateY(-1.65px) scale(1.0305, 1.0305);	
						transform: translateY(-1.65px) scale(1.0305, 1.0305);	
						-moz-transform: translateY(-1.65px) scale(1.0305, 1.0305);	
						-o-transform: translateY(-1.65px) scale(1.0305, 1.0305);
					}
					48.2143% {
						-webkit-transform: translateY(-1.11px) scale(1.0205, 1.0205);	
						transform: translateY(-1.11px) scale(1.0205, 1.0205);	
						-moz-transform: translateY(-1.11px) scale(1.0205, 1.0205);	
						-o-transform: translateY(-1.11px) scale(1.0205, 1.0205);
					}
					50% {
						-webkit-transform: translateY(-.65px) scale(1.0121, 1.0121);	
						transform: translateY(-.65px) scale(1.0121, 1.0121);	
						-moz-transform: translateY(-.65px) scale(1.0121, 1.0121);	
						-o-transform: translateY(-.65px) scale(1.0121, 1.0121);
					}
					51.7857% {
						-webkit-transform: translateY(-.29px) scale(1.0053, 1.0053);	
						transform: translateY(-.29px) scale(1.0053, 1.0053);	
						-moz-transform: translateY(-.29px) scale(1.0053, 1.0053);	
						-o-transform: translateY(-.29px) scale(1.0053, 1.0053);
					}
					53.5714% {
						opacity: 1;
						-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);
						transform: translateY(-.01px) scale(1.0002, 1.0002);
						-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);
						-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
					}
					55.3571% {
						opacity: .9967;
						-webkit-transform: translateY(.18px) scale(.9967, .9967);	
						transform: translateY(.18px) scale(.9967, .9967);	
						-moz-transform: translateY(.18px) scale(.9967, .9967);	
						-o-transform: translateY(.18px) scale(.9967, .9967);
					}
					57.1429% {
						opacity: .9945;
						-webkit-transform: translateY(.3px) scale(.9945, .9945);
						transform: translateY(.3px) scale(.9945, .9945);	
						-moz-transform: translateY(.3px) scale(.9945, .9945);	
						-o-transform: translateY(.3px) scale(.9945, .9945);
					}
					58.9286% {
						opacity: .9934;
						-webkit-transform: translateY(.36px) scale(.9934, .9934);
						transform: translateY(.36px) scale(.9934, .9934);
						-moz-transform: translateY(.36px) scale(.9934, .9934);
						-o-transform: translateY(.36px) scale(.9934, .9934);
					}
					60.7143% {
						opacity: .9931;
						-webkit-transform: translateY(.37px) scale(.9931, .9931);	
						transform: translateY(.37px) scale(.9931, .9931);	
						-moz-transform: translateY(.37px) scale(.9931, .9931);	
						-o-transform: translateY(.37px) scale(.9931, .9931);
					}
					62.5000% {
						opacity: .9934;
						-webkit-transform: translateY(.36px) scale(.9934, .9934);		
						transform: translateY(.36px) scale(.9934, .9934);		
						-moz-transform: translateY(.36px) scale(.9934, .9934);		
						-o-transform: translateY(.36px) scale(.9934, .9934);
					}
					64.2857% {
						opacity: .9941;
						-webkit-transform: translateY(.32px) scale(.9941, .9941);	
						transform: translateY(.32px) scale(.9941, .9941);	
						-moz-transform: translateY(.32px) scale(.9941, .9941);	
						-o-transform: translateY(.32px) scale(.9941, .9941);
					}
					66.0714% {
						opacity: .9951;
						-webkit-transform: translateY(.27px) scale(.9951, .9951);
						transform: translateY(.27px) scale(.9951, .9951);
						-moz-transform: translateY(.27px) scale(.9951, .9951);	
						-o-transform: translateY(.27px) scale(.9951, .9951);
					}
					67.8571% {
						opacity: .9961;
						-webkit-transform: translateY(.21px) scale(.9961, .9961);		
						transform: translateY(.21px) scale(.9961, .9961);		
						-moz-transform: translateY(.21px) scale(.9961, .9961);	
						-o-transform: translateY(.21px) scale(.9961, .9961);
					}
					69.6429% {
						opacity: .997;
						-webkit-transform: translateY(.16px) scale(.997, .997);	
						transform: translateY(.16px) scale(.997, .997);	
						-moz-transform: translateY(.16px) scale(.997, .997);	
						-o-transform: translateY(.16px) scale(.997, .997);
					}
					71.4286% {
						opacity: .9979;
						-webkit-transform: translateY(.11px) scale(.9979, .9979);	
						transform: translateY(.11px) scale(.9979, .9979);	
						-moz-transform: translateY(.11px) scale(.9979, .9979);	
						-o-transform: translateY(.11px) scale(.9979, .9979);
					}
					73.2143% {
						opacity: .9987;
						-webkit-transform: translateY(.07px) scale(.9987, .9987);	
						transform: translateY(.07px) scale(.9987, .9987);	
						-moz-transform: translateY(.07px) scale(.9987, .9987);	
						-o-transform: translateY(.07px) scale(.9987, .9987);
					}
					75.0000% {
						opacity: .9993;
						-webkit-transform: translateY(.04px) scale(.9993, .9993);		
						transform: translateY(.04px) scale(.9993, .9993);	
						-moz-transform: translateY(.04px) scale(.9993, .9993);	
						-o-transform: translateY(.04px) scale(.9993, .9993);
					}
					76.7857% {
						opacity: .9998;
						-webkit-transform: translateY(.01px) scale(.9998, .9998);		
						transform: translateY(.01px) scale(.9998, .9998);	
						-moz-transform: translateY(.01px) scale(.9998, .9998);	
						-o-transform: translateY(.01px) scale(.9998, .9998);
					}
					78.5714% {
						opacity: 1;
						-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);
						transform: translateY(-.01px) scale(1.0001, 1.0001);
						-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);
						-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
					}
					80.3571% {
						-webkit-transform: translateY(-.02px) scale(1.0003, 1.0003);
						transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-moz-transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-o-transform: translateY(-.02px) scale(1.0003, 1.0003);
					}
					82.1429% {
						-webkit-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-moz-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-o-transform: translateY(-.02px) scale(1.0004, 1.0004);
					}
					83.9286%, 85.7143% {
						-webkit-transform: translateY(-.03px) scale(1.0005, 1.0005);		
						transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-moz-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-o-transform: translateY(-.03px) scale(1.0005, 1.0005);
					}
					87.5000%, 89.2857% {
						-webkit-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-moz-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-o-transform: translateY(-.02px) scale(1.0004, 1.0004);
					}
					91.0714% {
						-webkit-transform: translateY(-.02px) scale(1.0003, 1.0003);		
						transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-moz-transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-o-transform: translateY(-.02px) scale(1.0003, 1.0003);
					}
					92.8571%, 94.6429% {
						-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						transform: translateY(-.01px) scale(1.0002, 1.0002);
						-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);
						-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
					}
					96.4286% {
						-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);		
						transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
					}
					98.2143% {
						-webkit-transform: translateY(0) scale(1.0001, 1.0001);	
						transform: translateY(0) scale(1.0001, 1.0001);	
						-moz-transform: translateY(0) scale(1.0001, 1.0001);	
						-o-transform: translateY(0) scale(1.0001, 1.0001);
					}
					100% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						transform: translateY(0) scale(1, 1) rotate(.0001deg);	
						-moz-transform: translateY(0) scale(1, 1) rotate(.0001deg);	
						-o-transform: translateY(0) scale(1, 1) rotate(.0001deg);
					}
					}";		
		}
		if($count==5)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
					-webkit-animation-duration: 1.2167s;
					-webkit-animation-name: head-".$count."-anim;
					-moz-animation-duration: 1.2167s;
					-moz-animation-name: head-".$count."-anim;
					animation-duration: 1.2167s;
					animation-name: head-".$count."-anim;
					}";
					
			$html.="@keyframes head-5-anim {
						0% {
						opacity: .0007;
						-webkit-transform: translateY(53.96px) scale(.0007, .0007);		
						transform: translateY(53.96px) scale(.0007, .0007);		
						-moz-transform: translateY(53.96px) scale(.0007, .0007);		
						-o-transform: translateY(53.96px) scale(.0007, .0007);
					}
					1.3699% {
						opacity: .0025;
						-webkit-transform: translateY(53.86px) scale(.0025, .0025);			
						transform: translateY(53.86px) scale(.0025, .0025);		
						-moz-transform: translateY(53.86px) scale(.0025, .0025);		
						-o-transform: translateY(53.86px) scale(.0025, .0025);
					}
					2.7397% {
						opacity: .007;
						-webkit-transform: translateY(53.62px) scale(.0070, .0070);		
						transform: translateY(53.62px) scale(.0070, .0070);		
						-moz-transform: translateY(53.62px) scale(.0070, .0070);		
						-o-transform: translateY(53.62px) scale(.0070, .0070);
					}
					4.1096% {
						opacity: .0156;
						-webkit-transform: translateY(53.16px) scale(.0156, .0156);		
						transform: translateY(53.16px) scale(.0156, .0156);	
						-moz-transform: translateY(53.16px) scale(.0156, .0156);	
						-o-transform: translateY(53.16px) scale(.0156, .0156);
					}
					5.4795% {
						opacity: .0306;
						-webkit-transform: translateY(52.35px) scale(.0306, .0306);			
						transform: translateY(52.35px) scale(.0306, .0306);			
						-moz-transform: translateY(52.35px) scale(.0306, .0306);		
						-o-transform: translateY(52.35px) scale(.0306, .0306);
					}
					6.8493% {
						opacity: .0539;
						-webkit-transform: translateY(51.09px) scale(.0539, .0539);		
						transform: translateY(51.09px) scale(.0539, .0539);		
						-moz-transform: translateY(51.09px) scale(.0539, .0539);	
						-o-transform: translateY(51.09px) scale(.0539, .0539);
					}
					8.2192% {
						opacity: .0872;
						-webkit-transform: translateY(49.29px) scale(.0872, .0872);			
						transform: translateY(49.29px) scale(.0872, .0872);		
						-moz-transform: translateY(49.29px) scale(.0872, .0872);		
						-o-transform: translateY(49.29px) scale(.0872, .0872);
					}
					9.5890% {
						opacity: .1319;
						-webkit-transform: translateY(46.88px) scale(.1319, .1319);	
						transform: translateY(46.88px) scale(.1319, .1319);	
						-moz-transform: translateY(46.88px) scale(.1319, .1319);	
						-o-transform: translateY(46.88px) scale(.1319, .1319);
					}
					10.9589% {
						opacity: .1882;
						-webkit-transform: translateY(43.84px) scale(.1882, .1882);	
						transform: translateY(43.84px) scale(.1882, .1882);	
						-moz-transform: translateY(43.84px) scale(.1882, .1882);	
						-o-transform: translateY(43.84px) scale(.1882, .1882);
					}
					12.3288% {
						opacity: .2556;
						-webkit-transform: translateY(40.2px) scale(.2556, .2556);	
						transform: translateY(40.2px) scale(.2556, .2556);	
						-moz-transform: translateY(40.2px) scale(.2556, .2556);	
						-o-transform: translateY(40.2px) scale(.2556, .2556);
					}
					13.6986% {
						opacity: .3328;
						-webkit-transform: translateY(36.03px) scale(.3328, .3328);	
						transform: translateY(36.03px) scale(.3328, .3328);	
						-moz-transform: translateY(36.03px) scale(.3328, .3328);	
						-o-transform: translateY(36.03px) scale(.3328, .3328);
					}
					15.0685% {
						opacity: .4176;
						-webkit-transform: translateY(31.45px) scale(.4176, .4176);
						transform: translateY(31.45px) scale(.4176, .4176);	
						-moz-transform: translateY(31.45px) scale(.4176, .4176);	
						-o-transform: translateY(31.45px) scale(.4176, .4176);
					}
					16.4384% {
						opacity: .507;
						-webkit-transform: translateY(26.62px) scale(.5070, .5070);		
						transform: translateY(26.62px) scale(.5070, .5070);		
						-moz-transform: translateY(26.62px) scale(.5070, .5070);		
						-o-transform: translateY(26.62px) scale(.5070, .5070);
					}
					17.8082% {
						opacity: .5979;
						-webkit-transform: translateY(21.71px) scale(.5979, .5979);			
						transform: translateY(21.71px) scale(.5979, .5979);			
						-moz-transform: translateY(21.71px) scale(.5979, .5979);		
						-o-transform: translateY(21.71px) scale(.5979, .5979);
					}
					19.1781% {
						opacity: .6871;
						-webkit-transform: translateY(16.9px) scale(.6871, .6871);		
						transform: translateY(16.9px) scale(.6871, .6871);		
						-moz-transform: translateY(16.9px) scale(.6871, .6871);		
						-o-transform: translateY(16.9px) scale(.6871, .6871);
					}
					20.5479% {
						opacity: .7714;
						-webkit-transform: translateY(12.34px) scale(.7714, .7714);		
						transform: translateY(12.34px) scale(.7714, .7714);		
						-moz-transform: translateY(12.34px) scale(.7714, .7714);		
						-o-transform: translateY(12.34px) scale(.7714, .7714);
					}
					21.9178% {
						opacity: .8484;
						-webkit-transform: translateY(8.19px) scale(.8484, .8484);	
						transform: translateY(8.19px) scale(.8484, .8484);	
						-moz-transform: translateY(8.19px) scale(.8484, .8484);	
						-o-transform: translateY(8.19px) scale(.8484, .8484);
					}
					23.2877% {
						opacity: .9158;
						-webkit-transform: translateY(4.55px) scale(.9158, .9158);	
						transform: translateY(4.55px) scale(.9158, .9158);	
						-moz-transform: translateY(4.55px) scale(.9158, .9158);	
						-o-transform: translateY(4.55px) scale(.9158, .9158);
					}
					24.6575% {
						opacity: .9725;
						-webkit-transform: translateY(1.49px) scale(.9725, .9725);	
						transform: translateY(1.49px) scale(.9725, .9725);	
						-moz-transform: translateY(1.49px) scale(.9725, .9725);	
						-o-transform: translateY(1.49px) scale(.9725, .9725);
					}
					26.0274% {
						opacity: 1;
						-webkit-transform: translateY(-.96px) scale(1.0177, 1.0177);		
						transform: translateY(-.96px) scale(1.0177, 1.0177);		
						-moz-transform: translateY(-.96px) scale(1.0177, 1.0177);	
						-o-transform: translateY(-.96px) scale(1.0177, 1.0177);
					}
					27.3973% {
						-webkit-transform: translateY(-2.78px) scale(1.0515, 1.0515);	
						transform: translateY(-2.78px) scale(1.0515, 1.0515);	
						-moz-transform: translateY(-2.78px) scale(1.0515, 1.0515);	
						-o-transform: translateY(-2.78px) scale(1.0515, 1.0515);
					}
					28.7671% {
						-webkit-transform: translateY(-4.03px) scale(1.0746, 1.0746);	
						transform: translateY(-4.03px) scale(1.0746, 1.0746);	
						-moz-transform: translateY(-4.03px) scale(1.0746, 1.0746);	
						-o-transform: translateY(-4.03px) scale(1.0746, 1.0746);
					}
					30.1370% {
						-webkit-transform: translateY(-4.75px) scale(1.0880, 1.0880);	
						transform: translateY(-4.75px) scale(1.0880, 1.0880);	
						-moz-transform: translateY(-4.75px) scale(1.0880, 1.0880);	
						-o-transform: translateY(-4.75px) scale(1.0880, 1.0880);
					}
					31.5068% {
						-webkit-transform: translateY(-5.03px) scale(1.0932, 1.0932);	
						transform: translateY(-5.03px) scale(1.0932, 1.0932);	
						-moz-transform: translateY(-5.03px) scale(1.0932, 1.0932);	
						-o-transform: translateY(-5.03px) scale(1.0932, 1.0932);	
					}
					32.8767% {
						-webkit-transform: translateY(-4.95px) scale(1.0917, 1.0917);	
						transform: translateY(-4.95px) scale(1.0917, 1.0917);	
						-moz-transform: translateY(-4.95px) scale(1.0917, 1.0917);	
						-o-transform: translateY(-4.95px) scale(1.0917, 1.0917);
					}
					34.2466% {
						-webkit-transform: translateY(-4.6px) scale(1.0852, 1.0852);		
						transform: translateY(-4.6px) scale(1.0852, 1.0852);	
						-moz-transform: translateY(-4.6px) scale(1.0852, 1.0852);	
						-o-transform: translateY(-4.6px) scale(1.0852, 1.0852);
					}
					35.6164% {
						-webkit-transform: translateY(-4.07px) scale(1.0754, 1.0754);
						transform: translateY(-4.07px) scale(1.0754, 1.0754);		
						-moz-transform: translateY(-4.07px) scale(1.0754, 1.0754);		
						-o-transform: translateY(-4.07px) scale(1.0754, 1.0754);
					}
					36.9863% {
						-webkit-transform: translateY(-3.43px) scale(1.0635, 1.0635);	
						transform: translateY(-3.43px) scale(1.0635, 1.0635);	
						-moz-transform: translateY(-3.43px) scale(1.0635, 1.0635);	
						-o-transform: translateY(-3.43px) scale(1.0635, 1.0635);
					}
					38.3562% {
						-webkit-transform: translateY(-2.75px) scale(1.0509, 1.0509);
						transform: translateY(-2.75px) scale(1.0509, 1.0509);
						-moz-transform: translateY(-2.75px) scale(1.0509, 1.0509);
						-o-transform: translateY(-2.75px) scale(1.0509, 1.0509);
					}
					39.7260% {
						-webkit-transform: translateY(-2.08px) scale(1.0385, 1.0385);
						transform: translateY(-2.08px) scale(1.0385, 1.0385);
						-moz-transform: translateY(-2.08px) scale(1.0385, 1.0385);
						-o-transform: translateY(-2.08px) scale(1.0385, 1.0385);
					}
					41.0959% {
						-webkit-transform: translateY(-1.46px) scale(1.0271, 1.0271);
						transform: translateY(-1.46px) scale(1.0271, 1.0271);
						-moz-transform: translateY(-1.46px) scale(1.0271, 1.0271);
						-o-transform: translateY(-1.46px) scale(1.0271, 1.0271);
					}
					42.4658% {
						-webkit-transform: translateY(-.92px) scale(1.0171, 1.0171);	
						transform: translateY(-.92px) scale(1.0171, 1.0171);	
						-moz-transform: translateY(-.92px) scale(1.0171, 1.0171);	
						-o-transform: translateY(-.92px) scale(1.0171, 1.0171);
					}
					43.8356% {
						-webkit-transform: translateY(-.47px) scale(1.0088, 1.0088);	
						transform: translateY(-.47px) scale(1.0088, 1.0088);	
						-moz-transform: translateY(-.47px) scale(1.0088, 1.0088);	
						-o-transform: translateY(-.47px) scale(1.0088, 1.0088);
					}
					45.2055% {
						opacity: 1;
						-webkit-transform: translateY(-.12px) scale(1.0022, 1.0022);	
						transform: translateY(-.12px) scale(1.0022, 1.0022);	
						-moz-transform: translateY(-.12px) scale(1.0022, 1.0022);
						-o-transform: translateY(-.12px) scale(1.0022, 1.0022);
					}
					46.5753% {
						opacity: .9974;
						-webkit-transform: translateY(.14px) scale(.9974, .9974);
						transform: translateY(.14px) scale(.9974, .9974);	
						-moz-transform: translateY(.14px) scale(.9974, .9974);	
						-o-transform: translateY(.14px) scale(.9974, .9974);
					}
					47.9452% {
						opacity: .9941;
						-webkit-transform: translateY(.32px) scale(.9941, .9941);				
						transform: translateY(.32px) scale(.9941, .9941);			
						-moz-transform: translateY(.32px) scale(.9941, .9941);			
						-o-transform: translateY(.32px) scale(.9941, .9941);
					}
					49.3151% {
						opacity: .9922;
						-webkit-transform: translateY(.42px) scale(.9922, .9922);	
						transform: translateY(.42px) scale(.9922, .9922);	
						-moz-transform: translateY(.42px) scale(.9922, .9922);	
						-o-transform: translateY(.42px) scale(.9922, .9922);
					}
					50.6849% {
						opacity: .9914;
						-webkit-transform: translateY(.46px) scale(.9914, .9914);		
						transform: translateY(.46px) scale(.9914, .9914);		
						-moz-transform: translateY(.46px) scale(.9914, .9914);	
						-o-transform: translateY(.46px) scale(.9914, .9914);
					}
					52.0548% {
						opacity: .9915;
						-webkit-transform: translateY(.46px) scale(.9915, .9915);
						transform: translateY(.46px) scale(.9915, .9915);	
						-moz-transform: translateY(.46px) scale(.9915, .9915);	
						-o-transform: translateY(.46px) scale(.9915, .9915);
					}
					53.4247% {
						opacity: .9921;
						-webkit-transform: translateY(.43px) scale(.9921, .9921);		
						transform: translateY(.43px) scale(.9921, .9921);	
						-moz-transform: translateY(.43px) scale(.9921, .9921);	
						-o-transform: translateY(.43px) scale(.9921, .9921);
					}
					54.7945% {
						opacity: .9931;
						-webkit-transform: translateY(.37px) scale(.9931, .9931);
						transform: translateY(.37px) scale(.9931, .9931);	
						-moz-transform: translateY(.37px) scale(.9931, .9931);	
						-o-transform: translateY(.37px) scale(.9931, .9931);
					}
					56.1644% {
						opacity: .9942;
						-webkit-transform: translateY(.31px) scale(.9942, .9942);	
						transform: translateY(.31px) scale(.9942, .9942);	
						-moz-transform: translateY(.31px) scale(.9942, .9942);	
						-o-transform: translateY(.31px) scale(.9942, .9942);
					}
					57.5342% {
						opacity: .9955;
						-webkit-transform: translateY(.24px) scale(.9955, .9955);	
						transform: translateY(.24px) scale(.9955, .9955);	
						-moz-transform: translateY(.24px) scale(.9955, .9955);	
						-o-transform: translateY(.24px) scale(.9955, .9955);
					}
					58.9041% {
						opacity: .9967;
						-webkit-transform: translateY(.18px) scale(.9967, .9967);		
						transform: translateY(.18px) scale(.9967, .9967);		
						-moz-transform: translateY(.18px) scale(.9967, .9967);	
						-o-transform: translateY(.18px) scale(.9967, .9967);
					}
					60.2740% {
						opacity: .9977;
						-webkit-transform: translateY(.12px) scale(.9977, .9977);	
						transform: translateY(.12px) scale(.9977, .9977);	
						-moz-transform: translateY(.12px) scale(.9977, .9977);	
						-o-transform: translateY(.12px) scale(.9977, .9977);
					}
					61.6438% {
						opacity: .9986;
						-webkit-transform: translateY(.07px) scale(.9986, .9986);	
						transform: translateY(.07px) scale(.9986, .9986);	
						-moz-transform: translateY(.07px) scale(.9986, .9986);	
						-o-transform: translateY(.07px) scale(.9986, .9986);
					}
					63.0137% {
						opacity: .9994;
						-webkit-transform: translateY(.04px) scale(.9994, .9994);	
						transform: translateY(.04px) scale(.9994, .9994);	
						-moz-transform: translateY(.04px) scale(.9994, .9994);	
						-o-transform: translateY(.04px) scale(.9994, .9994);
					}
					64.3836% {
						opacity: .9999;
						-webkit-transform: translateY(.01px) scale(.9999, .9999);	
						transform: translateY(.01px) scale(.9999, .9999);	
						-moz-transform: translateY(.01px) scale(.9999, .9999);	
						-o-transform: translateY(.01px) scale(.9999, .9999);
					}
					65.7534% {
						opacity: 1;
						-webkit-transform: translateY(-.01px) scale(1.0003, 1.0003);	
						transform: translateY(-.01px) scale(1.0003, 1.0003);	
						-moz-transform: translateY(-.01px) scale(1.0003, 1.0003);	
						-o-transform: translateY(-.01px) scale(1.0003, 1.0003);
					}
					67.1233% {
						-webkit-transform: translateY(-.03px) scale(1.0005, 1.0005);		
						transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-moz-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-o-transform: translateY(-.03px) scale(1.0005, 1.0005);
					}
					68.4932% {
						-webkit-transform: translateY(-.03px) scale(1.0006, 1.0006);	
						transform: translateY(-.03px) scale(1.0006, 1.0006);	
						-moz-transform: translateY(-.03px) scale(1.0006, 1.0006);	
						-o-transform: translateY(-.03px) scale(1.0006, 1.0006);
					}
					69.8630% {
						-webkit-transform: translateY(-.04px) scale(1.0007, 1.0007);	
						transform: translateY(-.04px) scale(1.0007, 1.0007);	
						-moz-transform: translateY(-.04px) scale(1.0007, 1.0007);	
						-o-transform: translateY(-.04px) scale(1.0007, 1.0007);
					}
					71.2329% {
						-webkit-transform: translateY(-.04px) scale(1.0006, 1.0006);	
						transform: translateY(-.04px) scale(1.0006, 1.0006);	
						-moz-transform: translateY(-.04px) scale(1.0006, 1.0006);	
						-o-transform: translateY(-.04px) scale(1.0006, 1.0006);
					}
					72.6027% {
						-webkit-transform: translateY(-.03px) scale(1.0006, 1.0006);	
						transform: translateY(-.03px) scale(1.0006, 1.0006);	
						-moz-transform: translateY(-.03px) scale(1.0006, 1.0006);	
						-o-transform: translateY(-.03px) scale(1.0006, 1.0006);
					}
					73.9726% {
						-webkit-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-moz-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-o-transform: translateY(-.03px) scale(1.0005, 1.0005);
					}
					75.3425% {
						-webkit-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-moz-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-o-transform: translateY(-.02px) scale(1.0004, 1.0004);
					}
					76.7123% {
						-webkit-transform: translateY(-.02px) scale(1.0003, 1.0003);	
						transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-moz-transform: translateY(-.02px) scale(1.0003, 1.0003);	
						-o-transform: translateY(-.02px) scale(1.0003, 1.0003);
					}
					78.0822% {
						-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);
						transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
					}
					79.4521% {
						-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
					}
					80.8219% {
						-webkit-transform: translateY(0) scale(1.0001, 1.0001);			
						transform: translateY(0) scale(1.0001, 1.0001);			
						-moz-transform: translateY(0) scale(1.0001, 1.0001);		
						-o-transform: translateY(0) scale(1.0001, 1.0001);
					}
					82.1918%, 83.5616%, 84.9315%, 86.3014%, 87.6712%, 89.0411%, 90.4110%, 91.7808%, 93.1507%, 94.5205%, 95.8904%, 97.2603%, 98.6301% {
						-webkit-transform: translateY(0) scale(1, 1);	
						transform: translateY(0) scale(1, 1);	
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					100% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						-moz-transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						-o-transform: translateY(0) scale(1, 1) rotate(.0001deg);
					}
					}";		
		}
		if($count==6)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
					-webkit-animation-duration: 1.2833s;
					-webkit-animation-name: head-".$count."-anim;
					-moz-animation-duration: 1.2833s;
					-moz-animation-name: head-".$count."-anim;
					animation-duration: 1.2833s;
					animation-name: head-".$count."-anim;
					}";
			
			$html.="@keyframes head-6-anim {
						0% {
						opacity: .0001;
						-webkit-transform: translateY(53.99px) scale(.0001, .0001);		
						transform: translateY(53.99px) scale(.0001, .0001);	
						-moz-transform: translateY(53.99px) scale(.0001, .0001);	
						-o-transform: translateY(53.99px) scale(.0001, .0001);
					}
					1.2987% {
						opacity: .0005;
						-webkit-transform: translateY(53.97px) scale(.0005, .0005);	
						transform: translateY(53.97px) scale(.0005, .0005);	
						-moz-transform: translateY(53.97px) scale(.0005, .0005);	
						-o-transform: translateY(53.97px) scale(.0005, .0005);
					}
					2.5974% {
						opacity: .0017;
						-webkit-transform: translateY(53.91px) scale(.0017, .0017);	
						transform: translateY(53.91px) scale(.0017, .0017);		
						-moz-transform: translateY(53.91px) scale(.0017, .0017);		
						-o-transform: translateY(53.91px) scale(.0017, .0017);
					}
					3.8961% {
						opacity: .0043;
						-webkit-transform: translateY(53.77px) scale(.0043, .0043);		
						transform: translateY(53.77px) scale(.0043, .0043);		
						-moz-transform: translateY(53.77px) scale(.0043, .0043);		
						-o-transform: translateY(53.77px) scale(.0043, .0043);
					}
					5.1948% {
						opacity: .0093;
						-webkit-transform: translateY(53.5px) scale(.0093, .0093);	
						transform: translateY(53.5px) scale(.0093, .0093);	
						-moz-transform: translateY(53.5px) scale(.0093, .0093);	
						-o-transform: translateY(53.5px) scale(.0093, .0093);
					}
					6.4935% {
						opacity: .0181;
						-webkit-transform: translateY(53.02px) scale(.0181, .0181);		
						transform: translateY(53.02px) scale(.0181, .0181);		
						-moz-transform: translateY(53.02px) scale(.0181, .0181);		
						-o-transform: translateY(53.02px) scale(.0181, .0181);
					}
					7.7922% {
						opacity: .0322;
						-webkit-transform: translateY(52.26px) scale(.0322, .0322);	
						transform: translateY(52.26px) scale(.0322, .0322);	
						-moz-transform: translateY(52.26px) scale(.0322, .0322);	
						-o-transform: translateY(52.26px) scale(.0322, .0322);
					}
					9.0909% {
						opacity: .0531;
						-webkit-transform: translateY(51.13px) scale(.0531, .0531);		
						transform: translateY(51.13px) scale(.0531, .0531);		
						-moz-transform: translateY(51.13px) scale(.0531, .0531);		
						-o-transform: translateY(51.13px) scale(.0531, .0531);
					}
					10.3896% {
						opacity: .0823;
						-webkit-transform: translateY(49.56px) scale(.0823, .0823);		
						transform: translateY(49.56px) scale(.0823, .0823);		
						-moz-transform: translateY(49.56px) scale(.0823, .0823);		
						-o-transform: translateY(49.56px) scale(.0823, .0823);
					}
					11.6883% {
						opacity: .1208;
						-webkit-transform: translateY(47.48px) scale(.1208, .1208);	
						transform: translateY(47.48px) scale(.1208, .1208);	
						-moz-transform: translateY(47.48px) scale(.1208, .1208);	
						-o-transform: translateY(47.48px) scale(.1208, .1208);
					}
					12.9870% {
						opacity: .1692;
						-webkit-transform: translateY(44.86px) scale(.1692, .1692);	
						transform: translateY(44.86px) scale(.1692, .1692);	
						-moz-transform: translateY(44.86px) scale(.1692, .1692);	
						-o-transform: translateY(44.86px) scale(.1692, .1692);
					}
					14.2857% {
						opacity: .2277;
						-webkit-transform: translateY(41.71px) scale(.2277, .2277);	
						transform: translateY(41.71px) scale(.2277, .2277);	
						-moz-transform: translateY(41.71px) scale(.2277, .2277);		
						-o-transform: translateY(41.71px) scale(.2277, .2277);
					}
					15.5844% {
						opacity: .2953;
						-webkit-transform: translateY(38.05px) scale(.2953, .2953);	
						transform: translateY(38.05px) scale(.2953, .2953);	
						-moz-transform: translateY(38.05px) scale(.2953, .2953);		
						-o-transform: translateY(38.05px) scale(.2953, .2953);
					}
					16.8831% {
						opacity: .3709;
						-webkit-transform: translateY(33.97px) scale(.3709, .3709);		
						transform: translateY(33.97px) scale(.3709, .3709);		
						-moz-transform: translateY(33.97px) scale(.3709, .3709);		
						-o-transform: translateY(33.97px) scale(.3709, .3709);
					}
					18.1818% {
						opacity: .4524;
						-webkit-transform: translateY(29.57px) scale(.4524, .4524);		
						transform: translateY(29.57px) scale(.4524, .4524);		
						-moz-transform: translateY(29.57px) scale(.4524, .4524);		
						-o-transform: translateY(29.57px) scale(.4524, .4524);
					}
					19.4805% {
						opacity: .5374;
						-webkit-transform: translateY(24.98px) scale(.5374, .5374);		
						transform: translateY(24.98px) scale(.5374, .5374);		
						-moz-transform: translateY(24.98px) scale(.5374, .5374);		
						-o-transform: translateY(24.98px) scale(.5374, .5374);
					}
					20.7792% {
						opacity: .6232;
						-webkit-transform: translateY(20.34px) scale(.6232, .6232);			
						transform: translateY(20.34px) scale(.6232, .6232);		
						-moz-transform: translateY(20.34px) scale(.6232, .6232);		
						-o-transform: translateY(20.34px) scale(.6232, .6232);
					}
					22.0779% {
						opacity: .7072;
						-webkit-transform: translateY(15.81px) scale(.7072, .7072);	
						transform: translateY(15.81px) scale(.7072, .7072);		
						-moz-transform: translateY(15.81px) scale(.7072, .7072);		
						-o-transform: translateY(15.81px) scale(.7072, .7072);
					}
					23.3766% {
						opacity: .7868;
						-webkit-transform: translateY(11.51px) scale(.7868, .7868);	
						transform: translateY(11.51px) scale(.7868, .7868);	
						-moz-transform: translateY(11.51px) scale(.7868, .7868);	
						-o-transform: translateY(11.51px) scale(.7868, .7868);
					}
					24.6753% {
						opacity: .8597;
						-webkit-transform: translateY(7.58px) scale(.8597, .8597);		
						transform: translateY(7.58px) scale(.8597, .8597);		
						-moz-transform: translateY(7.58px) scale(.8597, .8597);	
						-o-transform: translateY(7.58px) scale(.8597, .8597);
					}
					25.9740% {
						opacity: .924;
						-webkit-transform: translateY(4.1px) scale(.924, .924);			
						transform: translateY(4.1px) scale(.924, .924);		
						-moz-transform: translateY(4.1px) scale(.924, .924);		
						-o-transform: translateY(4.1px) scale(.924, .924);
					}
					27.2727% {
						opacity: .9786;
						-webkit-transform: translateY(1.16px) scale(.9786, .9786);	
						transform: translateY(1.16px) scale(.9786, .9786);	
						-moz-transform: translateY(1.16px) scale(.9786, .9786);	
						-o-transform: translateY(1.16px) scale(.9786, .9786);
					}
					28.5714% {
						opacity: 1;
						-webkit-transform: translateY(-1.22px) scale(1.0227, 1.0227);
						transform: translateY(-1.22px) scale(1.0227, 1.0227);
						-moz-transform: translateY(-1.22px) scale(1.0227, 1.0227);
						-o-transform: translateY(-1.22px) scale(1.0227, 1.0227);
					}
					29.8701% {
						-webkit-transform: translateY(-3.04px) scale(1.0563, 1.0563);	
						transform: translateY(-3.04px) scale(1.0563, 1.0563);	
						-moz-transform: translateY(-3.04px) scale(1.0563, 1.0563);	
						-o-transform: translateY(-3.04px) scale(1.0563, 1.0563);
					}
					31.1688% {
						-webkit-transform: translateY(-4.3px) scale(1.0797, 1.0797);	
						transform: translateY(-4.3px) scale(1.0797, 1.0797);	
						-moz-transform: translateY(-4.3px) scale(1.0797, 1.0797);	
						-o-transform: translateY(-4.3px) scale(1.0797, 1.0797);
					}
					32.4675% {
						-webkit-transform: translateY(-5.07px) scale(1.0939, 1.0939);	
						transform: translateY(-5.07px) scale(1.0939, 1.0939);	
						-moz-transform: translateY(-5.07px) scale(1.0939, 1.0939);	
						-o-transform: translateY(-5.07px) scale(1.0939, 1.0939);
					}
					33.7662% {
						-webkit-transform: translateY(-5.4px) scale(1.1, 1.1);		
						transform: translateY(-5.4px) scale(1.1, 1.1);		
						-moz-transform: translateY(-5.4px) scale(1.1, 1.1);		
						-o-transform: translateY(-5.4px) scale(1.1, 1.1);
					}
					35.0649% {
						-webkit-transform: translateY(-5.37px) scale(1.0994, 1.0994);	
						transform: translateY(-5.37px) scale(1.0994, 1.0994);	
						-moz-transform: translateY(-5.37px) scale(1.0994, 1.0994);			
						-o-transform: translateY(-5.37px) scale(1.0994, 1.0994);
					}
					36.3636% {
						-webkit-transform: translateY(-5.05px) scale(1.0935, 1.0935);	
						transform: translateY(-5.05px) scale(1.0935, 1.0935);	
						-moz-transform: translateY(-5.05px) scale(1.0935, 1.0935);	
						-o-transform: translateY(-5.05px) scale(1.0935, 1.0935);
					}
					37.6623% {
						-webkit-transform: translateY(-4.53px) scale(1.0839, 1.0839);	
						transform: translateY(-4.53px) scale(1.0839, 1.0839);	
						-moz-transform: translateY(-4.53px) scale(1.0839, 1.0839);	
						-o-transform: translateY(-4.53px) scale(1.0839, 1.0839);
					}
					38.9610% {
						-webkit-transform: translateY(-3.89px) scale(1.0720, 1.0720);		
						transform: translateY(-3.89px) scale(1.0720, 1.0720);		
						-moz-transform: translateY(-3.89px) scale(1.0720, 1.0720);	
						-o-transform: translateY(-3.89px) scale(1.0720, 1.0720);
					}
					40.2597% {
						-webkit-transform: translateY(-3.18px) scale(1.0589, 1.0589);	
						transform: translateY(-3.18px) scale(1.0589, 1.0589);	
						-moz-transform: translateY(-3.18px) scale(1.0589, 1.0589);	
						-o-transform: translateY(-3.18px) scale(1.0589, 1.0589);
					}
					41.5584% {
						-webkit-transform: translateY(-2.46px) scale(1.0456, 1.0456);	
						transform: translateY(-2.46px) scale(1.0456, 1.0456);	
						-moz-transform: translateY(-2.46px) scale(1.0456, 1.0456);	
						-o-transform: translateY(-2.46px) scale(1.0456, 1.0456);
					}
					42.8571% {
						-webkit-transform: translateY(-1.79px) scale(1.0331, 1.0331);	
						transform: translateY(-1.79px) scale(1.0331, 1.0331);	
						-moz-transform: translateY(-1.79px) scale(1.0331, 1.0331);	
						-o-transform: translateY(-1.79px) scale(1.0331, 1.0331);
					}
					44.1558% {
						-webkit-transform: translateY(-1.18px) scale(1.0218, 1.0218);	
						transform: translateY(-1.18px) scale(1.0218, 1.0218);	
						-moz-transform: translateY(-1.18px) scale(1.0218, 1.0218);	
						-o-transform: translateY(-1.18px) scale(1.0218, 1.0218);
					}
					45.4545% {
						-webkit-transform: translateY(-.66px) scale(1.0122, 1.0122);	
						transform: translateY(-.66px) scale(1.0122, 1.0122);	
						-moz-transform: translateY(-.66px) scale(1.0122, 1.0122);	
						-o-transform: translateY(-.66px) scale(1.0122, 1.0122);
					}
					46.7532% {
						opacity: 1;
						-webkit-transform: translateY(-.24px) scale(1.0044, 1.0044);	
						transform: translateY(-.24px) scale(1.0044, 1.0044);	
						-moz-transform: translateY(-.24px) scale(1.0044, 1.0044);	
						-o-transform: translateY(-.24px) scale(1.0044, 1.0044);
					}
					48.0519% {
						opacity: .9984;
						-webkit-transform: translateY(.09px) scale(.9984, .9984);	
						transform: translateY(.09px) scale(.9984, .9984);	
						-moz-transform: translateY(.09px) scale(.9984, .9984);	
						-o-transform: translateY(.09px) scale(.9984, .9984);
					}
					49.3506% {
						opacity: .9941;
						-webkit-transform: translateY(.32px) scale(.9941, .9941);		
						transform: translateY(.32px) scale(.9941, .9941);		
						-moz-transform: translateY(.32px) scale(.9941, .9941);		
						-o-transform: translateY(.32px) scale(.9941, .9941);
					}
					50.6494% {
						opacity: .9914;
						-webkit-transform: translateY(.46px) scale(.9914, .9914);	
						transform: translateY(.46px) scale(.9914, .9914);	
						-moz-transform: translateY(.46px) scale(.9914, .9914);	
						-o-transform: translateY(.46px) scale(.9914, .9914);
					}
					51.9481% {
						opacity: .99;
						-webkit-transform: translateY(.54px) scale(.99, .99);		
						transform: translateY(.54px) scale(.99, .99);		
						-moz-transform: translateY(.54px) scale(.99, .99);		
						-o-transform: translateY(.54px) scale(.99, .99);
					}
					53.2468% {
						opacity: .9897;
						-webkit-transform: translateY(.56px) scale(.9897, .9897);		
						transform: translateY(.56px) scale(.9897, .9897);		
						-moz-transform: translateY(.56px) scale(.9897, .9897);			
						-o-transform: translateY(.56px) scale(.9897, .9897);
					}
					54.5455% {
						opacity: .9901;
						-webkit-transform: translateY(.54px) scale(.9901, .9901);			
						transform: translateY(.54px) scale(.9901, .9901);			
						-moz-transform: translateY(.54px) scale(.9901, .9901);		
						-o-transform: translateY(.54px) scale(.9901, .9901);
					}
					55.8442% {
						opacity: .9911;
						-webkit-transform: translateY(.48px) scale(.9911, .9911);	
						transform: translateY(.48px) scale(.9911, .9911);	
						-moz-transform: translateY(.48px) scale(.9911, .9911);	
						-o-transform: translateY(.48px) scale(.9911, .9911);
					}
					57.1429% {
						opacity: .9923;
						-webkit-transform: translateY(.41px) scale(.9923, .9923);	
						transform: translateY(.41px) scale(.9923, .9923);	
						-moz-transform: translateY(.41px) scale(.9923, .9923);	
						-o-transform: translateY(.41px) scale(.9923, .9923);
					}
					58.4416% {
						opacity: .9938;
						-webkit-transform: translateY(.34px) scale(.9938, .9938);	
						transform: translateY(.34px) scale(.9938, .9938);	
						-moz-transform: translateY(.34px) scale(.9938, .9938);	
						-o-transform: translateY(.34px) scale(.9938, .9938);
					}
					59.7403% {
						opacity: .9952;
						-webkit-transform: translateY(.26px) scale(.9952, .9952);	
						transform: translateY(.26px) scale(.9952, .9952);	
						-moz-transform: translateY(.26px) scale(.9952, .9952);	
						-o-transform: translateY(.26px) scale(.9952, .9952);
					}
					61.0390% {
						opacity: .9966;
						-webkit-transform: translateY(.18px) scale(.9966, .9966);	
						transform: translateY(.18px) scale(.9966, .9966);	
						-moz-transform: translateY(.18px) scale(.9966, .9966);	
						-o-transform: translateY(.18px) scale(.9966, .9966);
					}
					62.3377% {
						opacity: .9978;
						-webkit-transform: translateY(.12px) scale(.9978, .9978);		
						transform: translateY(.12px) scale(.9978, .9978);	
						-moz-transform: translateY(.12px) scale(.9978, .9978);	
						-o-transform: translateY(.12px) scale(.9978, .9978);
					}
					63.6364% {
						opacity: .9988;
						-webkit-transform: translateY(.07px) scale(.9988, .9988);	
						transform: translateY(.07px) scale(.9988, .9988);	
						-moz-transform: translateY(.07px) scale(.9988, .9988);	
						-o-transform: translateY(.07px) scale(.9988, .9988);
					}
					64.9351% {
						opacity: .9995;
						-webkit-transform: translateY(.02px) scale(.9995, .9995);	
						transform: translateY(.02px) scale(.9995, .9995);	
						-moz-transform: translateY(.02px) scale(.9995, .9995);	
						-o-transform: translateY(.02px) scale(.9995, .9995);
					}
					66.2338% {
						opacity: 1;
						-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);	
						-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
					}
					67.5325% {
						-webkit-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-moz-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-o-transform: translateY(-.03px) scale(1.0005, 1.0005);
					}
					68.8312% {
						-webkit-transform: translateY(-.04px) scale(1.0008, 1.0008);	
						transform: translateY(-.04px) scale(1.0008, 1.0008);	
						-moz-transform: translateY(-.04px) scale(1.0008, 1.0008);	
						-o-transform: translateY(-.04px) scale(1.0008, 1.0008);
					}
					70.1299%, 71.4286% {
						-webkit-transform: translateY(-.05px) scale(1.0009, 1.0009);
						transform: translateY(-.05px) scale(1.0009, 1.0009);
						-moz-transform: translateY(-.05px) scale(1.0009, 1.0009);	
						-o-transform: translateY(-.05px) scale(1.0009, 1.0009);
					}
					72.7273% {
						-webkit-transform: translateY(-.05px) scale(1.0008, 1.0008);		
						transform: translateY(-.05px) scale(1.0008, 1.0008);		
						-moz-transform: translateY(-.05px) scale(1.0008, 1.0008);		
						-o-transform: translateY(-.05px) scale(1.0008, 1.0008);
					}
					74.0260% {
						-webkit-transform: translateY(-.04px) scale(1.0007, 1.0007);	
						transform: translateY(-.04px) scale(1.0007, 1.0007);	
						-moz-transform: translateY(-.04px) scale(1.0007, 1.0007);	
						-o-transform: translateY(-.04px) scale(1.0007, 1.0007);
					}
					75.3247% {
						-webkit-transform: translateY(-.03px) scale(1.0006, 1.0006);	
						transform: translateY(-.03px) scale(1.0006, 1.0006);	
						-moz-transform: translateY(-.03px) scale(1.0006, 1.0006);	
						-o-transform: translateY(-.03px) scale(1.0006, 1.0006);
					}
					76.6234% {
						-webkit-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-moz-transform: translateY(-.03px) scale(1.0005, 1.0005);	
						-o-transform: translateY(-.03px) scale(1.0005, 1.0005);
					}
					77.9221% {
						-webkit-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-moz-transform: translateY(-.02px) scale(1.0004, 1.0004);	
						-o-transform: translateY(-.02px) scale(1.0004, 1.0004);
					}
					79.2208%, 80.5195% {
						-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);	
						-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
					}
					81.8182% {
						-webkit-transform: translateY(0) scale(1.0001, 1.0001);		
						transform: translateY(0) scale(1.0001, 1.0001);		
						-moz-transform: translateY(0) scale(1.0001, 1.0001);		
						-o-transform: translateY(0) scale(1.0001, 1.0001);
					}
					83.1169%, 84.4156% {
						-webkit-transform: translateY(0) scale(1, 1);	
						transform: translateY(0) scale(1, 1);	
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					85.7143% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1);	
						transform: translateY(0) scale(1, 1);	
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					87.0130% {
						opacity: .9999;
						-webkit-transform: translateY(0) scale(.9999, .9999);
						transform: translateY(0) scale(.9999, .9999);	
						-moz-transform: translateY(0) scale(.9999, .9999);	
						-o-transform: translateY(0) scale(.9999, .9999);
					}
					88.3117%, 89.6104%, 90.9091% {
						-webkit-transform: translateY(0) scale(.9999, .9999);	
						transform: translateY(0) scale(.9999, .9999);	
						-moz-transform: translateY(0) scale(.9999, .9999);	
						-o-transform: translateY(0) scale(.9999, .9999);
					}
					92.2078% {
						opacity: .9999;
						-webkit-transform: translateY(0) scale(.9999, .9999);	
						transform: translateY(0) scale(.9999, .9999);	
						-moz-transform: translateY(0) scale(.9999, .9999);	
						-o-transform: translateY(0) scale(.9999, .9999);
					}
					93.5065% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1);		
						transform: translateY(0) scale(1, 1);		
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					94.8052%, 96.1039%, 97.4026%, 98.7013% {
						-webkit-transform: translateY(0) scale(1, 1);	
						transform: translateY(0) scale(1, 1);	
						-moz-transform: translateY(0) scale(1, 1);	
						-o-transform: translateY(0) scale(1, 1);
					}
					100% {
						opacity: 1;
						-webkit-transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						-moz-transform: translateY(0) scale(1, 1) rotate(.0001deg);		
						-o-transform: translateY(0) scale(1, 1) rotate(.0001deg);
					}
					}";			
		}
		if($count==7)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
					-webkit-animation-duration: 1.5333s;
					-webkit-animation-name: head-".$count."-anim;
					-moz-animation-duration: 1.5333s;
					-moz-animation-name: head-".$count."-anim;
					animation-duration: 1.5333s;
					animation-name: head-".$count."-anim;
					}";
		}
		if($count==8)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
					-webkit-animation-duration: 1.6s;
					-webkit-animation-name: head-7-anim;
					-moz-animation-duration: 1.6s;
					-moz-animation-name: head-7-anim;
					animation-duration: 1.6s;
					animation-name: head-7-anim;
					}";
		}
		if($count==9)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
				-webkit-animation-duration: 1.6333s;
				-webkit-animation-name: head-7-anim;
				-moz-animation-duration: 1.6333s;
				-moz-animation-name: head-7-anim;
				animation-duration: 1.6333s;
				animation-name: head-7-anim;
				}";
		}
		if($count==10)
		{
			$html.="ul#ai_reactions_main li:nth-child(".$count.") {
				-webkit-animation-duration: 1.6999s;
				-webkit-animation-name: head-7-anim;
				-moz-animation-duration: 1.6999s;
				-moz-animation-name: head-7-anim;
				animation-duration: 1.6999s;
				animation-name: head-7-anim;
				}";
		}		
		
		if($count==7 || $count==8 || $count==9 || $count==10)
		{
			$html.="@keyframes head-7-anim {
					0% {
					opacity: .0001;
					-webkit-transform: translateY(53.99px) scale(.0001, .0001);		
					transform: translateY(53.99px) scale(.0001, .0001);		
					-moz-transform: translateY(53.99px) scale(.0001, .0001);		
					-o-transform: translateY(53.99px) scale(.0001, .0001);
				}
				1.2987% {
					opacity: .0005;
					-webkit-transform: translateY(53.97px) scale(.0005, .0005);	
					transform: translateY(53.97px) scale(.0005, .0005);		
					-moz-transform: translateY(53.97px) scale(.0005, .0005);		
					-o-transform: translateY(53.97px) scale(.0005, .0005);
				}
				2.5974% {
					opacity: .0017;
					-webkit-transform: translateY(53.91px) scale(.0017, .0017);		
					transform: translateY(53.91px) scale(.0017, .0017);			
					-moz-transform: translateY(53.91px) scale(.0017, .0017);		
					-o-transform: translateY(53.91px) scale(.0017, .0017);
				}
				3.8961% {
					opacity: .0043;
					-webkit-transform: translateY(53.77px) scale(.0043, .0043);	
					transform: translateY(53.77px) scale(.0043, .0043);	
					-moz-transform: translateY(53.77px) scale(.0043, .0043);	
					-o-transform: translateY(53.77px) scale(.0043, .0043);
				}
				5.1948% {
					opacity: .0093;
					-webkit-transform: translateY(53.5px) scale(.0093, .0093);	
					transform: translateY(53.5px) scale(.0093, .0093);	
					-moz-transform: translateY(53.5px) scale(.0093, .0093);		
					-o-transform: translateY(53.5px) scale(.0093, .0093);
				}
				6.4935% {
					opacity: .0181;
					-webkit-transform: translateY(53.02px) scale(.0181, .0181);		
					transform: translateY(53.02px) scale(.0181, .0181);		
					-moz-transform: translateY(53.02px) scale(.0181, .0181);		
					-o-transform: translateY(53.02px) scale(.0181, .0181);
				}
				7.7922% {
					opacity: .0322;
					-webkit-transform: translateY(52.26px) scale(.0322, .0322);	
					transform: translateY(52.26px) scale(.0322, .0322);	
					-moz-transform: translateY(52.26px) scale(.0322, .0322);	
					-o-transform: translateY(52.26px) scale(.0322, .0322);
				}
				9.0909% {
					opacity: .0531;
					-webkit-transform: translateY(51.13px) scale(.0531, .0531);				
					transform: translateY(51.13px) scale(.0531, .0531);			
					-moz-transform: translateY(51.13px) scale(.0531, .0531);			
					-o-transform: translateY(51.13px) scale(.0531, .0531);
				}
				10.3896% {
					opacity: .0823;
					-webkit-transform: translateY(49.56px) scale(.0823, .0823);		
					transform: translateY(49.56px) scale(.0823, .0823);		
					-moz-transform: translateY(49.56px) scale(.0823, .0823);		
					-o-transform: translateY(49.56px) scale(.0823, .0823);
				}
				11.6883% {
					opacity: .1208;
					-webkit-transform: translateY(47.48px) scale(.1208, .1208);	
					transform: translateY(47.48px) scale(.1208, .1208);	
					-moz-transform: translateY(47.48px) scale(.1208, .1208);	
					-o-transform: translateY(47.48px) scale(.1208, .1208);
				}
				12.9870% {
					opacity: .1692;
					-webkit-transform: translateY(44.86px) scale(.1692, .1692);		
					transform: translateY(44.86px) scale(.1692, .1692);		
					-moz-transform: translateY(44.86px) scale(.1692, .1692);		
					-o-transform: translateY(44.86px) scale(.1692, .1692);
				}
				14.2857% {
					opacity: .2277;
					-webkit-transform: translateY(41.71px) scale(.2277, .2277);			
					transform: translateY(41.71px) scale(.2277, .2277);			
					-moz-transform: translateY(41.71px) scale(.2277, .2277);			
					-o-transform: translateY(41.71px) scale(.2277, .2277);
				}
				15.5844% {
					opacity: .2953;
					-webkit-transform: translateY(38.05px) scale(.2953, .2953);	
					transform: translateY(38.05px) scale(.2953, .2953);	
					-moz-transform: translateY(38.05px) scale(.2953, .2953);		
					-o-transform: translateY(38.05px) scale(.2953, .2953);
				}
				16.8831% {
					opacity: .3709;
					-webkit-transform: translateY(33.97px) scale(.3709, .3709);	
					transform: translateY(33.97px) scale(.3709, .3709);	
					-moz-transform: translateY(33.97px) scale(.3709, .3709);	
					-o-transform: translateY(33.97px) scale(.3709, .3709);
				}
				18.1818% {
					opacity: .4524;
					-webkit-transform: translateY(29.57px) scale(.4524, .4524);	
					transform: translateY(29.57px) scale(.4524, .4524);	
					-moz-transform: translateY(29.57px) scale(.4524, .4524);	
					-o-transform: translateY(29.57px) scale(.4524, .4524);
				}
				19.4805% {
					opacity: .5374;
					-webkit-transform: translateY(24.98px) scale(.5374, .5374);	
					transform: translateY(24.98px) scale(.5374, .5374);	
					-moz-transform: translateY(24.98px) scale(.5374, .5374);	
					-o-transform: translateY(24.98px) scale(.5374, .5374);
				}
				20.7792% {
					opacity: .6232;
					-webkit-transform: translateY(20.34px) scale(.6232, .6232);		
					transform: translateY(20.34px) scale(.6232, .6232);		
					-moz-transform: translateY(20.34px) scale(.6232, .6232);		
					-o-transform: translateY(20.34px) scale(.6232, .6232);
				}
				22.0779% {
					opacity: .7072;
					-webkit-transform: translateY(15.81px) scale(.7072, .7072);	
					transform: translateY(15.81px) scale(.7072, .7072);	
					-moz-transform: translateY(15.81px) scale(.7072, .7072);	
					-o-transform: translateY(15.81px) scale(.7072, .7072);
				}
				23.3766% {
					opacity: .7868;
					-webkit-transform: translateY(11.51px) scale(.7868, .7868);	
					transform: translateY(11.51px) scale(.7868, .7868);	
					-moz-transform: translateY(11.51px) scale(.7868, .7868);	
					-o-transform: translateY(11.51px) scale(.7868, .7868);
				}
				24.6753% {
					opacity: .8597;
					-webkit-transform: translateY(7.58px) scale(.8597, .8597);	
					transform: translateY(7.58px) scale(.8597, .8597);		
					-moz-transform: translateY(7.58px) scale(.8597, .8597);		
					-o-transform: translateY(7.58px) scale(.8597, .8597);
				}
				25.9740% {
					opacity: .924;
					-webkit-transform: translateY(4.1px) scale(.924, .924);		
					transform: translateY(4.1px) scale(.924, .924);		
					-moz-transform: translateY(4.1px) scale(.924, .924);		
					-o-transform: translateY(4.1px) scale(.924, .924);
				}
				27.2727% {
					opacity: .9786;
					-webkit-transform: translateY(1.16px) scale(.9786, .9786);	
					transform: translateY(1.16px) scale(.9786, .9786);	
					-moz-transform: translateY(1.16px) scale(.9786, .9786);	
					-o-transform: translateY(1.16px) scale(.9786, .9786);
				}
				28.5714% {
					opacity: 1;
					-webkit-transform: translateY(-1.22px) scale(1.0227, 1.0227);		
					transform: translateY(-1.22px) scale(1.0227, 1.0227);		
					-moz-transform: translateY(-1.22px) scale(1.0227, 1.0227);		
					-o-transform: translateY(-1.22px) scale(1.0227, 1.0227);
				}
				29.8701% {
					-webkit-transform: translateY(-3.04px) scale(1.0563, 1.0563);	
					transform: translateY(-3.04px) scale(1.0563, 1.0563);	
					-moz-transform: translateY(-3.04px) scale(1.0563, 1.0563);	
					-o-transform: translateY(-3.04px) scale(1.0563, 1.0563);
				}
				31.1688% {
					-webkit-transform: translateY(-4.3px) scale(1.0797, 1.0797);
					transform: translateY(-4.3px) scale(1.0797, 1.0797);
					-moz-transform: translateY(-4.3px) scale(1.0797, 1.0797);
					-o-transform: translateY(-4.3px) scale(1.0797, 1.0797);
				}
				32.4675% {
					-webkit-transform: translateY(-5.07px) scale(1.0939, 1.0939);		
					transform: translateY(-5.07px) scale(1.0939, 1.0939);		
					-moz-transform: translateY(-5.07px) scale(1.0939, 1.0939);		
					-o-transform: translateY(-5.07px) scale(1.0939, 1.0939);
				}
				33.7662% {
					-webkit-transform: translateY(-5.4px) scale(1.1, 1.1);	
					transform: translateY(-5.4px) scale(1.1, 1.1);	
					-moz-transform: translateY(-5.4px) scale(1.1, 1.1);		
					-o-transform: translateY(-5.4px) scale(1.1, 1.1);
				}
				35.0649% {
					-webkit-transform: translateY(-5.37px) scale(1.0994, 1.0994);		
					transform: translateY(-5.37px) scale(1.0994, 1.0994);		
					-moz-transform: translateY(-5.37px) scale(1.0994, 1.0994);		
					-o-transform: translateY(-5.37px) scale(1.0994, 1.0994);
				}
				36.3636% {
					-webkit-transform: translateY(-5.05px) scale(1.0935, 1.0935);	
					transform: translateY(-5.05px) scale(1.0935, 1.0935);	
					-moz-transform: translateY(-5.05px) scale(1.0935, 1.0935);	
					-o-transform: translateY(-5.05px) scale(1.0935, 1.0935);
				}
				37.6623% {
					-webkit-transform: translateY(-4.53px) scale(1.0839, 1.0839);	
					transform: translateY(-4.53px) scale(1.0839, 1.0839);	
					-moz-transform: translateY(-4.53px) scale(1.0839, 1.0839);	
					-o-transform: translateY(-4.53px) scale(1.0839, 1.0839);
				}
				38.9610% {
					-webkit-transform: translateY(-3.89px) scale(1.0720, 1.0720);		
					transform: translateY(-3.89px) scale(1.0720, 1.0720);		
					-moz-transform: translateY(-3.89px) scale(1.0720, 1.0720);		
					-o-transform: translateY(-3.89px) scale(1.0720, 1.0720);
				}
				40.2597% {
					-webkit-transform: translateY(-3.18px) scale(1.0589, 1.0589);	
					transform: translateY(-3.18px) scale(1.0589, 1.0589);	
					-moz-transform: translateY(-3.18px) scale(1.0589, 1.0589);	
					-o-transform: translateY(-3.18px) scale(1.0589, 1.0589);
				}
				41.5584% {
					-webkit-transform: translateY(-2.46px) scale(1.0456, 1.0456);
					transform: translateY(-2.46px) scale(1.0456, 1.0456);
					-moz-transform: translateY(-2.46px) scale(1.0456, 1.0456);
					-o-transform: translateY(-2.46px) scale(1.0456, 1.0456);
				}
				42.8571% {
					-webkit-transform: translateY(-1.79px) scale(1.0331, 1.0331);		
					transform: translateY(-1.79px) scale(1.0331, 1.0331);		
					-moz-transform: translateY(-1.79px) scale(1.0331, 1.0331);		
					-o-transform: translateY(-1.79px) scale(1.0331, 1.0331);
				}
				44.1558% {
					-webkit-transform: translateY(-1.18px) scale(1.0218, 1.0218);	
					transform: translateY(-1.18px) scale(1.0218, 1.0218);	
					-moz-transform: translateY(-1.18px) scale(1.0218, 1.0218);	
					-o-transform: translateY(-1.18px) scale(1.0218, 1.0218);
				}
				45.4545% {
					-webkit-transform: translateY(-.66px) scale(1.0122, 1.0122);	
					transform: translateY(-.66px) scale(1.0122, 1.0122);	
					-moz-transform: translateY(-.66px) scale(1.0122, 1.0122);	
					-o-transform: translateY(-.66px) scale(1.0122, 1.0122);
				}
				46.7532% {
					opacity: 1;
					-webkit-transform: translateY(-.24px) scale(1.0044, 1.0044);	
					transform: translateY(-.24px) scale(1.0044, 1.0044);	
					-moz-transform: translateY(-.24px) scale(1.0044, 1.0044);	
					-o-transform: translateY(-.24px) scale(1.0044, 1.0044);
				}
				48.0519% {
					opacity: .9984;
					-webkit-transform: translateY(.09px) scale(.9984, .9984);	
					transform: translateY(.09px) scale(.9984, .9984);	
					-moz-transform: translateY(.09px) scale(.9984, .9984);		
					-o-transform: translateY(.09px) scale(.9984, .9984);
				}
				49.3506% {
					opacity: .9941;
					-webkit-transform: translateY(.32px) scale(.9941, .9941);	
					transform: translateY(.32px) scale(.9941, .9941);	
					-moz-transform: translateY(.32px) scale(.9941, .9941);	
					-o-transform: translateY(.32px) scale(.9941, .9941);
				}
				50.6494% {
					opacity: .9914;
					-webkit-transform: translateY(.46px) scale(.9914, .9914);		
					transform: translateY(.46px) scale(.9914, .9914);		
					-moz-transform: translateY(.46px) scale(.9914, .9914);		
					-o-transform: translateY(.46px) scale(.9914, .9914);
				}
				51.9481% {
					opacity: .99;
					-webkit-transform: translateY(.54px) scale(.99, .99);	
					transform: translateY(.54px) scale(.99, .99);	
					-moz-transform: translateY(.54px) scale(.99, .99);	
					-o-transform: translateY(.54px) scale(.99, .99);
				}
				53.2468% {
					opacity: .9897;
					-webkit-transform: translateY(.56px) scale(.9897, .9897);
					transform: translateY(.56px) scale(.9897, .9897);	
					-moz-transform: translateY(.56px) scale(.9897, .9897);	
					-o-transform: translateY(.56px) scale(.9897, .9897);
				}
				54.5455% {
					opacity: .9901;
					-webkit-transform: translateY(.54px) scale(.9901, .9901);		
					transform: translateY(.54px) scale(.9901, .9901);		
					-moz-transform: translateY(.54px) scale(.9901, .9901);		
					-o-transform: translateY(.54px) scale(.9901, .9901);
				}
				55.8442% {
					opacity: .9911;
					-webkit-transform: translateY(.48px) scale(.9911, .9911);		
					transform: translateY(.48px) scale(.9911, .9911);		
					-moz-transform: translateY(.48px) scale(.9911, .9911);		
					-o-transform: translateY(.48px) scale(.9911, .9911);
				}
				57.1429% {
					opacity: .9923;
					-webkit-transform: translateY(.41px) scale(.9923, .9923);	
					transform: translateY(.41px) scale(.9923, .9923);	
					-moz-transform: translateY(.41px) scale(.9923, .9923);	
					-o-transform: translateY(.41px) scale(.9923, .9923);
				}
				58.4416% {
					opacity: .9938;
					-webkit-transform: translateY(.34px) scale(.9938, .9938);	
					transform: translateY(.34px) scale(.9938, .9938);		
					-moz-transform: translateY(.34px) scale(.9938, .9938);		
					-o-transform: translateY(.34px) scale(.9938, .9938);
				}
				59.7403% {
					opacity: .9952;
					-webkit-transform: translateY(.26px) scale(.9952, .9952);	
					transform: translateY(.26px) scale(.9952, .9952);	
					-moz-transform: translateY(.26px) scale(.9952, .9952);		
					-o-transform: translateY(.26px) scale(.9952, .9952);
				}
				61.0390% {
					opacity: .9966;
					-webkit-transform: translateY(.18px) scale(.9966, .9966);
					transform: translateY(.18px) scale(.9966, .9966);	
					-moz-transform: translateY(.18px) scale(.9966, .9966);	
					-o-transform: translateY(.18px) scale(.9966, .9966);
				}
				62.3377% {
					opacity: .9978;
					-webkit-transform: translateY(.12px) scale(.9978, .9978);	
					transform: translateY(.12px) scale(.9978, .9978);		
					-moz-transform: translateY(.12px) scale(.9978, .9978);		
					-o-transform: translateY(.12px) scale(.9978, .9978);
				}
				63.6364% {
					opacity: .9988;
					-webkit-transform: translateY(.07px) scale(.9988, .9988);	
					transform: translateY(.07px) scale(.9988, .9988);	
					-moz-transform: translateY(.07px) scale(.9988, .9988);	
					-o-transform: translateY(.07px) scale(.9988, .9988);
				}
				64.9351% {
					opacity: .9995;
					-webkit-transform: translateY(.02px) scale(.9995, .9995);	
					transform: translateY(.02px) scale(.9995, .9995);	
					-moz-transform: translateY(.02px) scale(.9995, .9995);	
					-o-transform: translateY(.02px) scale(.9995, .9995);
				}
				66.2338% {
					opacity: 1;
					-webkit-transform: translateY(-.01px) scale(1.0001, 1.0001);	
					transform: translateY(-.01px) scale(1.0001, 1.0001);	
					-moz-transform: translateY(-.01px) scale(1.0001, 1.0001);	
					-o-transform: translateY(-.01px) scale(1.0001, 1.0001);
				}
				67.5325% {
					-webkit-transform: translateY(-.03px) scale(1.0005, 1.0005);
					transform: translateY(-.03px) scale(1.0005, 1.0005);	
					-moz-transform: translateY(-.03px) scale(1.0005, 1.0005);	
					-o-transform: translateY(-.03px) scale(1.0005, 1.0005);
				}
				68.8312% {
					-webkit-transform: translateY(-.04px) scale(1.0008, 1.0008);		
					transform: translateY(-.04px) scale(1.0008, 1.0008);		
					-moz-transform: translateY(-.04px) scale(1.0008, 1.0008);		
					-o-transform: translateY(-.04px) scale(1.0008, 1.0008);
				}
				70.1299%, 71.4286% {
					-webkit-transform: translateY(-.05px) scale(1.0009, 1.0009);	
					transform: translateY(-.05px) scale(1.0009, 1.0009);	
					-moz-transform: translateY(-.05px) scale(1.0009, 1.0009);	
					-o-transform: translateY(-.05px) scale(1.0009, 1.0009);
				}
				72.7273% {
					-webkit-transform: translateY(-.05px) scale(1.0008, 1.0008);	
					transform: translateY(-.05px) scale(1.0008, 1.0008);	
					-moz-transform: translateY(-.05px) scale(1.0008, 1.0008);	
					-o-transform: translateY(-.05px) scale(1.0008, 1.0008);
				}
				74.0260% {
					-webkit-transform: translateY(-.04px) scale(1.0007, 1.0007);	
					transform: translateY(-.04px) scale(1.0007, 1.0007);	
					-moz-transform: translateY(-.04px) scale(1.0007, 1.0007);	
					-o-transform: translateY(-.04px) scale(1.0007, 1.0007);
				}
				75.3247% {
					-webkit-transform: translateY(-.03px) scale(1.0006, 1.0006);	
					transform: translateY(-.03px) scale(1.0006, 1.0006);	
					-moz-transform: translateY(-.03px) scale(1.0006, 1.0006);	
					-o-transform: translateY(-.03px) scale(1.0006, 1.0006);
				}
				76.6234% {
					-webkit-transform: translateY(-.03px) scale(1.0005, 1.0005);	
					transform: translateY(-.03px) scale(1.0005, 1.0005);	
					-moz-transform: translateY(-.03px) scale(1.0005, 1.0005);	
					-o-transform: translateY(-.03px) scale(1.0005, 1.0005);
				}
				77.9221% {
					-webkit-transform: translateY(-.02px) scale(1.0004, 1.0004);		
					transform: translateY(-.02px) scale(1.0004, 1.0004);	
					-moz-transform: translateY(-.02px) scale(1.0004, 1.0004);	
					-o-transform: translateY(-.02px) scale(1.0004, 1.0004);
				}
				79.2208%, 80.5195% {
					-webkit-transform: translateY(-.01px) scale(1.0002, 1.0002);	
					transform: translateY(-.01px) scale(1.0002, 1.0002);	
					-moz-transform: translateY(-.01px) scale(1.0002, 1.0002);	
					-o-transform: translateY(-.01px) scale(1.0002, 1.0002);
				}
				81.8182% {
					-webkit-transform: translateY(0) scale(1.0001, 1.0001);			
					transform: translateY(0) scale(1.0001, 1.0001);			
					-moz-transform: translateY(0) scale(1.0001, 1.0001);		
					-o-transform: translateY(0) scale(1.0001, 1.0001);
				}
				83.1169%, 84.4156% {
					-webkit-transform: translateY(0) scale(1, 1);	
					transform: translateY(0) scale(1, 1);	
					-moz-transform: translateY(0) scale(1, 1);	
					-o-transform: translateY(0) scale(1, 1);
				}
				85.7143% {
					opacity: 1;
					-webkit-transform: translateY(0) scale(1, 1);	
					transform: translateY(0) scale(1, 1);	
					-moz-transform: translateY(0) scale(1, 1);	
					-o-transform: translateY(0) scale(1, 1);
				}
				87.0130% {
					opacity: .9999;
					-webkit-transform: translateY(0) scale(.9999, .9999);		
					transform: translateY(0) scale(.9999, .9999);		
					-moz-transform: translateY(0) scale(.9999, .9999);		
					-o-transform: translateY(0) scale(.9999, .9999);
				}
				88.3117%, 89.6104%, 90.9091% {
					-webkit-transform: translateY(0) scale(.9999, .9999);	
					transform: translateY(0) scale(.9999, .9999);	
					-moz-transform: translateY(0) scale(.9999, .9999);	
					-o-transform: translateY(0) scale(.9999, .9999);
				}
				92.2078% {
					opacity: .9999;
					-webkit-transform: translateY(0) scale(.9999, .9999);	
					transform: translateY(0) scale(.9999, .9999);	
					-moz-transform: translateY(0) scale(.9999, .9999);	
					-o-transform: translateY(0) scale(.9999, .9999);
				}
				93.5065% {
					opacity: 1;
					-webkit-transform: translateY(0) scale(1, 1);	
					transform: translateY(0) scale(1, 1);	
					-moz-transform: translateY(0) scale(1, 1);	
					-o-transform: translateY(0) scale(1, 1);
				}
				94.8052%, 96.1039%, 97.4026%, 98.7013% {
					-webkit-transform: translateY(0) scale(1, 1);	
					transform: translateY(0) scale(1, 1);	
					-moz-transform: translateY(0) scale(1, 1);	
					-o-transform: translateY(0) scale(1, 1);
				}
				100% {
					opacity: 1;
					-webkit-transform: translateY(0) scale(1, 1) rotate(.0001deg);		
					transform: translateY(0) scale(1, 1) rotate(.0001deg);	
					-moz-transform: translateY(0) scale(1, 1) rotate(.0001deg);	
					-o-transform: translateY(0) scale(1, 1) rotate(.0001deg);
				}
				}";
		}
		$html.="</style>";
		$result['html']=$html;
		return json_encode($result);
	}
}
?>