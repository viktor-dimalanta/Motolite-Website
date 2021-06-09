<?php
 
//$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
//echo $parse_uri[0]; exit();
//require_once( $parse_uri[0] . 'wp-load.php' );
 
?>





<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/Motolite/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] .  '/Motolite/wp-includes/wp-db.php');


//require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
//require_once($_SERVER['DOCUMENT_ROOT'] .  '/wp-includes/wp-db.php');


global $wpdb;

if($_REQUEST['modalid']) {
    $con_id = $_REQUEST['modalid'];
    $newpass = $_REQUEST['newpass'];
     //escape string


//echo $con_id;
//echo $newpass;

        $table_name = $wpdb->prefix . "users";
      



  $id = $con_id;

$wpdb->update(
                $table_name, //table
                array('user_pass' => MD5($newpass)), //data
                array('ID' => $con_id), //where
                array('%s'), //data format
                array('%s') //where format
        );

 }
?>
