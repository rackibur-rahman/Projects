<?php
/*
Plugin name:Post And Page Reactions
Plugin URI:www.areteit.com
Description:A plugin that helps registered users and guests to react on wordpress posts and pages.
Author: Paramveer Singh for Arete IT Private Limited
Author URI: https://www.areteit.com/
Version:1.0.5
License:GPL/MIT
*/
if ( ! defined( 'ABSPATH' ) ) exit;
include("core.php");

/*****activation and deactivation hooks******/
register_activation_hook( __FILE__, array('ai_wp_smileys_class','ai_wp_create_table'));
register_activation_hook( __FILE__, 'ai_wp_post_reactions');
register_deactivation_hook( __FILE__, 'ai_wp_post_reactions_truncate');
/*****************
function making menus in admin panel
-smiley
******************************/
function ai_settings_wp_menu_smiley()
{
   add_menu_page('Arete Post And Page Reactions', 'Post & Page Reactions', 'main_option', __FILE__, 'ai_wp_get_manage_smileys', plugins_url('post-and-page-reactions/img/icon.png', dirname(__FILE__) ));
    add_submenu_page(__FILE__, 'Reactions', 'Reactions', 'manage_options',__FILE__.'/settings', 'ai_wp_get_manage_smileys');
	add_submenu_page(__FILE__, 'Settings', 'Settings', 'manage_options',__FILE__.'/smiley_settings', 'ai_wp_manage_smileys_setting');
}
add_action('admin_menu','ai_settings_wp_menu_smiley');
/*****************
function for enqueue 
wp media so that administrator
change smiley images 
******************************/
function ai_load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'ai_load_wp_media_files' );

function ai_wp_manage_smileys_setting()
{
	echo ai_wp_smiley_main_settings();
}
function ai_wp_get_manage_smileys()
{
	echo ai_wp_get_all_smileys(); 
}

if(isset($_REQUEST['smiley_location_settings']))
{
	$location = esc_html($_REQUEST['enable_location_ai']);
	ai_post_reaction_update_location($location);
}

if(isset($_REQUEST['smiley_pages_settings']))
{
	$posts = $_REQUEST['custom_smileys'];
	ai_post_reaction_update_pages($posts);
}
if(isset($_REQUEST['smiley_guest_user']))
{
	$guest_user = esc_html($_REQUEST['ai_guest_user']);
	ai_post_reaction_update_guest($guest_user);
}
?>