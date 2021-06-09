<?php
/*
Plugin Name: Warranty
Developed by: Viktor Angelo Dimalants

*/
final class ja_disable_users {
	/**
	 * Initialize all the things
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		// Actions
		add_action( 'init',                       array( $this, 'load_textdomain'             )        );
		add_action( 'show_user_profile',          array( $this, 'use_profile_field'           )        );
		add_action( 'edit_user_profile',          array( $this, 'use_profile_field'           )        );
		add_action( 'personal_options_update',    array( $this, 'user_profile_field_save'     )        );
		add_action( 'edit_user_profile_update',   array( $this, 'user_profile_field_save'     )        );
		add_action( 'wp_login',                   array( $this, 'user_login'                  ), 10, 2 );
		add_action( 'manage_users_custom_column', array( $this, 'manage_users_column_content' ), 10, 3 );
		add_action( 'admin_footer-users.php',	  array( $this, 'manage_users_css'            )        );
		
		// Filters
		add_filter( 'login_message',              array( $this, 'user_login_message'          )        );
		add_filter( 'manage_users_columns',       array( $this, 'manage_users_columns'	      )        );
	}
	/**
	 * Load the textdomain so we can support other languages
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {
		$domain = 'ja_disable_users';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	/**
	 * Add the field to user profiles
	 *
	 * @since 1.0.0
	 * @param object $user
	 */
	public function use_profile_field( $user ) {
		// Only show this option to users who can delete other users
		if ( !current_user_can( 'edit_users' ) )
			return;
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="ja_disable_user"><?php _e(' Disable User Account', 'ja_disable_users' ); ?></label>
					</th>
					<td>
						<input type="checkbox" name="ja_disable_user" id="ja_disable_user" value="1" <?php checked( 1, get_the_author_meta( 'ja_disable_user', $user->ID ) ); ?> />
						<span class="description"><?php _e( 'If checked, the user cannot login with this account.' , 'ja_disable_users' ); ?></span>
					</td>
				</tr>
			<tbody>
		</table>
		<?php
	}
	/**
	 * Saves the custom field to user meta
	 *
	 * @since 1.0.0
	 * @param int $user_id
	 */
	public function user_profile_field_save( $user_id ) {
		// Only worry about saving this field if the user has access
		if ( !current_user_can( 'edit_users' ) )
			return;
		if ( !isset( $_POST['ja_disable_user'] ) ) {
			$disabled = 0;
		} else {
			$disabled = $_POST['ja_disable_user'];
		}
	 
		update_user_meta( $user_id, 'ja_disable_user', $disabled );
	}
	/**
	 * After login check to see if user account is disabled
	 *
	 * @since 1.0.0
	 * @param string $user_login
	 * @param object $user
	 */
	public function user_login( $user_login, $user = null ) {
		if ( !$user ) {
			$user = get_user_by('login', $user_login);
		}
		if ( !$user ) {
			// not logged in - definitely not disabled
			return;
		}
		// Get user meta
		$disabled = get_user_meta( $user->ID, 'ja_disable_user', true );
		
		// Is the use logging in disabled?
		if ( $disabled == '1' ) {
			// Clear cookies, a.k.a log user out
			wp_clear_auth_cookie();
			// Build login URL and then redirect
			$login_url = site_url( 'wp-login.php', 'login' );
			$login_url = add_query_arg( 'disabled', '1', $login_url );
			wp_redirect( $login_url );
			exit;
		}
	}
	/**
	 * Show a notice to users who try to login and are disabled
	 *
	 * @since 1.0.0
	 * @param string $message
	 * @return string
	 */
	public function user_login_message( $message ) {
		// Show the error message if it seems to be a disabled user
		if ( isset( $_GET['disabled'] ) && $_GET['disabled'] == 1 ) 
			$message =  '<div id="login_error">' . apply_filters( 'ja_disable_users_notice', __( 'Account disabled', 'ja_disable_users' ) ) . '</div>';
		return $message;
	}
	/**
	 * Add custom disabled column to users list
	 *
	 * @since 1.0.3
	 * @param array $defaults
	 * @return array
	 */
	public function manage_users_columns( $defaults ) {
		$defaults['ja_user_disabled'] = __( 'Status', 'ja_disable_users' );
		return $defaults;
	}
	/**
	 * Set content of disabled users column
	 *
	 * @since 1.0.3
	 * @param empty $empty
	 * @param string $column_name
	 * @param int $user_ID
	 * @return string
	 */
	public function manage_users_column_content( $empty, $column_name, $user_ID ) {
		if ( $column_name == 'ja_user_disabled' ) {
			if ( get_the_author_meta( 'ja_disable_user', $user_ID )	== 1 ) {
				return __( 'Disabled', 'ja_disable_users' );
			} else {

				return __( 'Active', 'ja_disable_users' );
			}
		}
	}
	/**
	 * Specifiy the width of our custom column
	 *
	 * @since 1.0.3
 	 */
	public function manage_users_css() {
		echo '<style type="text/css">.column-ja_user_disabled { width: 80px; }</style>';
	}
}
new ja_disable_users();









//menu items
add_action('admin_menu','sinetiks_warranty_modifymenu');
function sinetiks_warranty_modifymenu() {
	
	
	add_menu_page('Warranty', //page title
	'All Warranty', //menu title
	'manage_options', //capabilities
	'sinetiks_warranty_list', //menu slug
	'sinetiks_warranty_list' //function
	);
	
	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Warranty Classification', //page title
	'<i class="glyphicon glyphicon-file"></i>&nbsp;Warranty Classification', //menu title
	'manage_options', //capability
	'sinetiks_warranty_classification', //menu slug
	'sinetiks_warranty_classification'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Import', //page title
	'<i class="glyphicon glyphicon-import"></i>&nbsp;Import Warranty', //menu title
	'manage_options', //capability
	'sinetiks_warranty_import', //menu slug
	'sinetiks_warranty_import'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Export', //page title
	'<i class="glyphicon glyphicon-export"></i>&nbsp;Export Warranty', //menu title
	'manage_options', //capability
	'sinetiks_warranty_export', //menu slug
	'sinetiks_warranty_export'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Manage Customers', //page title
	'<i class="glyphicon glyphicon-user"></i>&nbsp;Customers Record', //menu title
	'manage_options', //capability
	'sinetiks_warranty_customer_list', //menu slug
	'sinetiks_warranty_customer_list'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Database Table', //page title
	'<i class="glyphicon glyphicon-list-alt"></i>&nbsp;Database Tables',  //menu title
	'manage_options', //capability
	'database_table', //menu slug
	'database_table'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Promo', //page title
	'<i class="glyphicon glyphicon-star"></i>&nbsp;Promo', //menu title
	'manage_options', //capability
	'sinetiks_warranty_promo', //menu slug
	'sinetiks_warranty_promo'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Encoders Login', //page title
	'<i class="glyphicon glyphicon-lock"></i>&nbsp;Encoders Login', //menu title
	'manage_options', //capability
	'sinetiks_warranty_encoder_list', //menu slug
	'sinetiks_warranty_encoder_list'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Battery_Masterlist', //page title
	'Battery Masterlist', //menu title
	'manage_options', //capability
	'sinetiks_battery_master_list', //menu slug
	'sinetiks_battery_master_list'); //function


	add_submenu_page('sinetiks_warranty_list', //parent slug
	'View Statistics', //page title
	'View Statistics', //menu title
	'manage_options', //capability
	'sinetiks_warranty_stats', //menu slug
	'sinetiks_warranty_stats'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Delete', //page title
	'Delete Warranty', //menu title
	'manage_options', //capability
	'sinetiks_warranty_delete', //menu slug
	'sinetiks_warranty_delete'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Battery Replacement', //page title
	'Battery Replacement', //menu title
	'manage_options', //capability
	'battery_replacement', //menu slug
	'battery_replacement'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Add Battery Replacement', //page title
	'Add Battery Replacement', //menu title
	'manage_options', //capability
	'battery_replacement_create', //menu slug
	'battery_replacement_create'); //function

	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Update Warranty', //page title
	'Update', //menu title
	'manage_options', //capability
	'sinetiks_warranty_update', //menu slug
	'sinetiks_warranty_update'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Add Warranty', //page title
	'Create Warranty', //menu title
	'manage_options', //capability
	'sinetiks_warranty_create', //menu slug
	'sinetiks_warranty_create'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Update Warranty', //page title
	'Update', //menu title
	'manage_options', //capability
	'create_battery_table', //menu slug
	'create_battery_table'); //function
/**
	add_submenu_page('sinetiks_warranty_list', //parent slug
	'CMS Warranty Users', //page title
	'CMS Warranty Users', //menu title
	'manage_options', //capability
	'sinetiks_warranty_users', //menu slug
	'sinetiks_warranty_users'); //function
**/
	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Delete_Users', //page title
	'Delete Warranty Users', //menu title
	'manage_options', //capability
	'sinetiks_warranty_delete_users', //menu slug
	'sinetiks_warranty_delete_users'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Create Encoder', //page title
	'Create Encoder', //menu title
	'manage_options', //capability
	'sinetiks_warranty_create_encoder', //menu slug
	'sinetiks_warranty_create_encoder'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Update Encoder', //page title
	'Update Encoder', //menu title
	'manage_options', //capability
	'sinetiks_warranty_update_encoder', //menu slug
	'sinetiks_warranty_update_encoder'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Delete_Encoder', //page title
	'Delete Encoder Warranty Users', //menu title
	'manage_options', //capability
	'sinetiks_warranty_delete_encoder', //menu slug
	'sinetiks_warranty_delete_encoder'); //function

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Battery Application Type', //page title
	'Battery Application Type', //menu title
	'manage_options', //capability
	'sinetiks_battery_application_type', //menu slug
	'sinetiks_battery_application_type'); //function


	add_submenu_page('sinetiks_warranty_list', //parent slug
	'View Warranty Email', //page title
	'View Warranty Email', //menu title
	'manage_options', //capability
	'view_warranty_email', //menu slug
	'view_warranty_email'); //function	

	add_submenu_page('sinetiks_warranty_list', //parent slug
	'Customers Historical Records', //page title
	'Customers Historical Records', //menu title
	'manage_options', //capability
	'historical_records', //menu slug
	'historical_records'); //function	
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR. 'warranty-list.php');
require_once(ROOTDIR. 'battery_replacement.php');
require_once(ROOTDIR. 'customer-historical-records.php');
require_once(ROOTDIR . 'warranty-create.php');
require_once(ROOTDIR . 'warranty-update.php');
require_once(ROOTDIR . 'warranty-users.php');
require_once(ROOTDIR . 'warranty-encoder-list.php');
require_once(ROOTDIR . 'warranty-customer-list.php');
require_once(ROOTDIR . 'warranty-encoder-create.php');
require_once(ROOTDIR . 'warranty-encoder-update.php');
require_once(ROOTDIR . 'warranty-stats.php');
require_once(ROOTDIR . 'warranty-export.php');
require_once(ROOTDIR . 'warranty-import.php');
require_once(ROOTDIR . 'warranty-classification.php');
require_once(ROOTDIR . 'battery_masterlist.php');
require_once(ROOTDIR . 'battery_application_type.php');
require_once(ROOTDIR . 'database_table.php');
require_once(ROOTDIR . 'email-view-warrantyinfo.php');
require_once(ROOTDIR. 'warranty-promo.php');
//require_once(ROOTDIR . 'table_to_csv.php');
//require_once(ROOTDIR . 'dump.php');
//require_once(ROOTDIR . 'warranty-list-response.php');
//add_action( 'wp_ajax_warrantyResponse', 'warrantyResponse' );


