<?php
 
//$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
//echo $parse_uri[0]; exit();
//require_once( $parse_uri[0] . 'wp-load.php' );
 
?>





<?php 
//require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
//require_once($_SERVER['DOCUMENT_ROOT'] .  '/wp-includes/wp-db.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/Motolite/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] .  '/Motolite/wp-includes/wp-db.php');



global $wpdb;


if($_REQUEST['id']) {
    $con_id = $_REQUEST['id'];
    $st_id = $_REQUEST['stat'];  //escape string

  $id = $con_id;
  $st = $st_id;




    $query2 = "UPDATE wp_user_ext SET status = '".$st_id."' where id = '".$con_id."'";






 $wpdb->query($query2);
}


?>

