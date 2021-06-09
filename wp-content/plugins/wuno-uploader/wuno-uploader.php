<?php
/**
 * Plugin Name: Wuno Uploader
 * Plugin URI: 
 * Description: This plugin adds functionality for uploading CSV files to the database
 * Version: 1.0.0
 * Author:
 * Author URI: 
 * License: Copyright (C) 
 * Unauthorized copying of this file, via any medium is strictly 
 * 
 * 
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// create custom plugin settings menu
add_action('admin_menu', 'wuno_plugin_create_menu');

function wuno_plugin_create_menu() {

    //create new top-level menu
    add_menu_page('Wuno Plugin Settings', 'Wuno Installer', 'administrator', __FILE__, 'wuno_settings_page' , plugins_url('/images/icon.png', __FILE__) );

    //call register settings function
    add_action( 'admin_init', 'register_wuno_settings' );
}

function register_wuno_settings() {
    //register our settings
    register_setting( 'wuno-settings-group', 'file_to_install' );
    register_setting( 'wuno-settings-group', 'some_other_option' );
    register_setting( 'wuno-settings-group', 'option_etc' );
}

function wuno_settings_page() {
 if (isset($_POST['wuno-inventory'])) {
        productsExec();
    } 
?>

<h1>Wuno Inventory Updater</h1>

<form method="POST">
    <label for="wuno-inventory">Path To Inventory</label>
    <input type="text" name="wuno-inventory" id="wuno-inventory" value="inventory.csv">
    <input type="submit" value="Install" class="button button-primary button-large">
</form>

<?php
    } 

function productsExec() {
       require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
       global $wpdb;
       $table_name = $wpdb->prefix . "wuno_inventory";
       // path where your CSV file is located
       define('CSV_PATH','');
       // Name of your CSV file
       $csv_file = CSV_PATH . "inventory.csv"; 

       $sql = "DROP TABLE IF EXISTS $table_name";
       $wpdb->query($sql);

      $sql = "CREATE TABLE " . $table_name . " (
      id int(8) NOT NULL AUTO_INCREMENT,
      wuno_product varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      wuno_description varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      wuno_alternates varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      wuno_onhand varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      wuno_condition varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
      PRIMARY KEY  (id)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

           $wpdb->query($sql);

    if (($handle = fopen($csv_file, "r")) !== FALSE) {
           fgetcsv($handle);   
           while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                for ($c=0; $c < $num; $c++) {
                  $col[$c] = $data[$c];
                }

         $col1 = $col[0];
         $col2 = $col[1];
         $col3 = $col[2];

        // SQL Query to insert data into DataBase
        $query = "INSERT INTO" . $table_name . "(wuno_product, wuno_description, wuno_alternates, wuno_onhand, wuno_condition) 
        VALUES('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."')";

        $results = $wpdb->query( $query );

        }
        fclose($handle);
        }
     echo "<h2>The inventory was successfully imported to the database!</h2>";     
 }

?>