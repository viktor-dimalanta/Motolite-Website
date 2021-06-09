<?php
/*
Plugin Name: OT Admin Theme
Plugin URI: http://orangeit-info.com/ot-wordpress-admin-theme-plugins/
Author: Jobayer
Author URI: http://freelancer-jobayer.com
Version: 1.0
Description: This is an awesome Plugins to customize color for your WordPress Admin area
Tags: admin theme, admin template, color admin, wp backend theme, wp backend template, unlimited color for admin
*/

function ot_admin_theme(){
	?>
		<style type="text/css">
			#wpadminbar, #adminmenu, #adminmenuback, #adminmenuwrap, #wpadminbar .menupop .ab-sub-wrapper, #adminmenu .wp-submenu, #adminmenu .wp-has-current-submenu .wp-submenu{
				background:
				<?php if(get_option('ot-header-texts')){echo get_option('ot-header-texts');}else{echo '#400040';}?> !important;
			}
			#adminmenu a, #collapse-menu, #wpadminbar #wp-admin-bar-my-sites a.ab-item, #wpadminbar #wp-admin-bar-site-name a.ab-item, #wpadminbar a.ab-item, #wpadminbar > #wp-toolbar span.ab-label, #wpadminbar > #wp-toolbar span.noticon, #adminmenu .wp-not-current-submenu li > a, .folded #adminmenu .wp-has-current-submenu li > a{
				color:<?php if(get_option('ot-admin-menu-color')){echo get_option('ot-admin-menu-color');}else{echo '#FFFFFF';} ?> !important;
			}
			#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow, #adminmenu .wp-menu-arrow div, #adminmenu li.current a.menu-top, #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, .folded #adminmenu li.wp-has-current-submenu{
				color:<?php if (get_option('ot-admin-menu-active-color')){echo get_option('ot-admin-menu-active-color');}else{echo'#008080';} ?>
			!important;}
			#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow, #adminmenu .wp-menu-arrow div, #adminmenu li.current a.menu-top, #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, .folded #adminmenu li.wp-has-current-submenu{
				background:<?php if(get_option('ot-admin-menu-active-background')){ echo get_option('ot-admin-menu-active-background');}else{echo'#400080';} ?>
			 !important;}
		</style>
	<?php
}
add_action('admin_head','ot_admin_theme');
	function ot_admin_menu(){
		add_menu_page('OT Admin Theme', 'OT Admin Theme', 'manage_options', 'ot-admin-theme','ot_admin_theme_setting', 'dashicons-portfolio', '10');
	}
add_action('admin_menu','ot_admin_menu');

function ot_admin_theme_setting(){
?>
	<h2>OT Admin Theme Setting</h2>
		<form action="options.php" method="POST">
			<?php do_settings_sections('ot-admin-theme'); ?>
			<?php settings_fields('ot-color-picker'); ?>
			<?php settings_errors(); ?>
			<?php submit_button(); ?>
		</form>
<?php
}
function field_for_admin_theme(){
	add_settings_section('ot-color-picker','','color_picker_sec','ot-admin-theme');
	add_settings_field('ot-header-texts', 'Theme Color', 'color_theme_fn', 'ot-admin-theme', 'ot-color-picker');
	register_setting('ot-color-picker', 'ot-header-texts');
	add_settings_field('ot-admin-menu-color', 'Admin Menu Text Color', 'ot_admin_menu_color', 'ot-admin-theme', 'ot-color-picker');
	register_setting('ot-color-picker', 'ot-admin-menu-color');
	add_settings_field('ot-admin-menu-active-color', 'Admin Menu Active Color', 'ot_admin_menu_active_color', 'ot-admin-theme', 'ot-color-picker');
	register_setting('ot-color-picker', 'ot-admin-menu-active-color');
	add_settings_field('ot-admin-menu-active-background', 'Admin Menu Active Background', 'ot_admin_menu_active_background', 'ot-admin-theme', 'ot-color-picker');
	register_setting('ot-color-picker', 'ot-admin-menu-active-background');
	
}
add_action('admin_init', 'field_for_admin_theme');

function color_theme_fn(){
	
	echo '<input type="color" class="ot_input" name="ot-header-texts" value="'.get_option('ot-header-texts').'"/>';
	
}
function ot_admin_menu_color(){
	echo '<input type="color" class="ot_input" name="ot-admin-menu-color" value="'.get_option('ot-admin-menu-color').'"/>';
}
function ot_admin_menu_active_color(){
	echo '<input type="color" class="ot_input" name="ot-admin-menu-active-color" value="'.get_option('ot-admin-menu-active-color').'"/>';
}function ot_admin_menu_active_background(){
	echo '<input type="color" class="ot_input" name="ot-admin-menu-active-background" value="'.get_option('ot-admin-menu-active-background').'"/>';
}

function color_picker_sec(){
	echo '';
}

function css_design_for_ot_field(){
	?>
		<style type="text/css">
			.ot_input{
				width:100px !important;
				height:30px !important;
			}
		</style>
	<?php
}
add_action('admin_head','css_design_for_ot_field');
/**
	 * Add link to settings page
	 */
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ot_link_settings_page' );

	function ot_link_settings_page ( $links ) {
	 $settings = array(
	 '<a href="' . admin_url( 'admin.php?page=ot-admin-theme' ) . '">Settings</a>',
	 );
	  
	return array_merge( $links, $settings);
	}


?>