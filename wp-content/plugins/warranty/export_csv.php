<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/Motolite/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] .  '/Motolite/wp-includes/wp-db.php');



global $wpdb;

//$wpdb->show_errors(); 

    //$purchase_date_start = $_REQUEST['start_date_js'];
    //$end_date_js = $_REQUEST['end_date_js'];
   // $encoder = $_REQUEST['encoder'];

        //running sample without if
        //$encoder = "vic";
     // $purchase_date_start = "June 1, 2017";
       // $purchase_date_end = "June 20, 2017";

function exp2(){
global $wpdb;



$purchase_date_start = $_REQUEST['start_date_js2'];
    $purchase_date_end = $_REQUEST['end_date_js2'];
   $encoder = $_REQUEST['encoder2'];


      $start_date= date('Y-m-d', strtotime($purchase_date_start));
       $end_date= date('Y-m-d', strtotime($purchase_date_end));
                     
$MyQuery = $wpdb->get_results($wpdb->prepare("SELECT fname,lname,email,address,mobile,telephone,vehicle_make,vehicle_model,vehicle_year,vehicle_plate,serial_no,battery_sales,purchase_date,distributor_name,distributor_address,vehicle_application,battery_id,ownership_type FROM wp_warranty LEFT JOIN wp_battery ON wp_warranty.id = wp_battery.id LEFT JOIN wp_customer ON wp_warranty.id = wp_customer.id LEFT JOIN wp_vehicle ON wp_warranty.id = wp_vehicle.id LEFT JOIN wp_distributor ON wp_warranty.id = wp_distributor.id WHERE  wp_battery.purchase_date BETWEEN '$start_date' AND '$end_date' AND wp_warranty.registrant = '$encoder'" , $id));


// Prepare our csv download

// Set header row values
$csv_fields=array();
$csv_fields[] = 'Owner Firstname';
$csv_fields[] = 'Owner Lastname';
$csv_fields[] = 'Owner Email';
$csv_fields[] = 'Owner Address';
$csv_fields[] = 'Owner Mobile';
$csv_fields[] = 'Owner Telephone';
$csv_fields[] = 'Vehicle Make';
$csv_fields[] = 'Vehicle Model';
$csv_fields[] = 'Vehicle Year';
$csv_fields[] = 'Vehicle Plate';
$csv_fields[] = 'Battery Serial';
$csv_fields[] = 'Battery Sales';
$csv_fields[] = 'Battery Date';
$csv_fields[] = 'Distributor Name';
$csv_fields[] = 'Distributor Address';
$csv_fields[] = 'Application';
$csv_fields[] = 'Battery ID';
$csv_fields[] = 'Ownership Type';

$output_handle = @fopen( 'php://output', 'w' );
 

// Insert header row
fputcsv( $output_handle, $csv_fields );

// Parse results to csv format
foreach ($MyQuery as $Result) {
    $leadArray = (array) $Result; // Cast the Object to an array
    // Add row to file
    fputcsv( $output_handle, $leadArray );
    }
 
// Close output file stream


fclose( $output_handle ); 

die();


}

if($_REQUEST['start_date_js2']) {


$purchase_date_start = $_REQUEST['start_date_js2'];
    $purchase_date_end = $_REQUEST['end_date_js2'];
   $encoder = $_REQUEST['encoder2'];


      $start_date= date('Y-m-d', strtotime($purchase_date_start));
       $end_date= date('Y-m-d', strtotime($purchase_date_end));

exp2();

     //   $rows = $wpdb->get_results("SELECT * FROM wp_warranty LEFT JOIN wp_battery ON wp_warranty.id = wp_battery.id LEFT JOIN wp_customer ON wp_warranty.id = wp_customer.id LEFT JOIN wp_vehicle ON wp_warranty.id = wp_vehicle.id WHERE  wp_battery.purchase_date BETWEEN '$start_date' AND '$end_date' AND wp_warranty.registrant = '$encoder' ");


        
// Grab any post values you sent with your submit function


// Build your query                     
//$MyQuery = $wpdb->get_results($wpdb->prepare('SELECT id,expires_on FROM wp_warranty WHERE id =1 ',$id));
   
}


