

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

if($_REQUEST['start_date_js']) {
    //escape string




    $purchase_date_start = $_REQUEST['start_date_js'];
    $end_date_js = $_REQUEST['end_date_js'];
    $encoder = $_REQUEST['encoder'];


        //$purchase_date_start = "June 1, 2017";
        //$purchase_date_end = "June 20, 2017";


        $start_date= date('Y-m-d', strtotime($purchase_date_start));
        $end_date= date('Y-m-d', strtotime($end_date_js));


        $rows = $wpdb->get_results("SELECT * FROM wp_warranty LEFT JOIN wp_battery ON wp_warranty.id = wp_battery.id LEFT JOIN wp_customer ON wp_warranty.id = wp_customer.id LEFT JOIN wp_vehicle ON wp_warranty.id = wp_vehicle.id WHERE  wp_battery.purchase_date BETWEEN '$start_date' AND '$end_date' AND wp_warranty.registrant = '$encoder' ");


         
    


  echo "


   <table id='warranty_tbl' class='table table-striped table-bordered' width='100px' cellspacing='0'>
    <thead>
      <tr>      <th >Firstname</th>
                <th >Lastname</th>
                <th >Email</th>
                 <th >Address</th>
                <th >Mobile</th>
                <th>Telephone</th>
                <th >Vehicle Make</th>
                <th >Vehicle Year</th>
                <th>Plate</th>
                <th >Battery Serial</th>


                <th>Battery Sales</th>
                <th >Purchase Date</th>
                <th >Distributor Name</th>
                <th>Distributor Address</th>
                <th >Application Type</th>
                <th>Battery ID</th>
                <th >Ownership Type</th>



              
                
</tr>
<tr>   
<tfoot>
                <td style='font-style: italic; color: gray;'>Firstname</td>
                <td style='font-style: italic; color: gray;'>Lastname</td>
                <td style='font-style: italic; color: gray;'>Email</td>
                 <td style='font-style: italic; color: gray;'>Address</td>
                <td style='font-style: italic; color: gray;'>Mobile</td>
                <td style='font-style: italic; color: gray;'>Telephone</td>
                <td style='font-style: italic; color: gray;'>Vehicle Make</td>
                <td style='font-style: italic; color: gray;'>Vehicle Year</td>
                <td style='font-style: italic; color: gray;'>Plate</td>
                <td style='font-style: italic; color: gray;'>Battery Serial</td>


                <td style='font-style: italic; color: gray;'>Battery Sales</td>
                <td style='font-style: italic; color: gray;'>Purchase Date</td>
                <td style='font-style: italic; color: gray;'>Distributor Name</td>
                <td style='font-style: italic; color: gray;'>Distributor Address</td>
                <td style='font-style: italic; color: gray;'>Application Type</td>
                <td style='font-style: italic; color: gray;'>Battery ID</td>
                <td style='font-style: italic; color: gray;'>Ownership Type</td>



              
  </tfoot>              
</tr>
    </thead>
   



  
 

 

";              

 }
?>


    <?php foreach ($rows as $row) { echo "  <tbody> <tr style='height: 65px;' class='content' >

                    <td style='font-size: 14px;'>$row->fname  </td>
                    <td style='font-size: 14px;'> $row->lname </td>
                    <td style='font-size: 14px;'> $row->email</td>
                    <td style='font-size: 14px;'>  $row->address </td>
                    <td style='font-size: 14px;'>$row->mobile </td>
                    <td style='font-size: 14px;'>$row->telephone </td>
                    <td style='font-size: 14px;'> $row->vehicle_make </td>
                     <td style='font-size: 14px'>$row->vehicle_year </td>
                      <td style='font-size: 14px;'> $row->vehicle_plate </td>
                      <td style='font-size: 14px;'> $row->serial_no </td>

                      <td style='font-size: 14px;'>$row->battery_sales </td>
                      <td style='font-size: 14px;'> $row->purchase_date</td>
                      <td style='font-size: 14px;'> $row->distributor_name </td>
                      <td style='font-size: 14px;'> $row->distributor_address </td>
                      <td style='font-size: 14px;'> $row->vehicle_application </td>
                      <td style='font-size: 14px;'> $row->battery_id </td>
                      <td style='font-size: 14px;'> $row->ownership_type </td>





                    </tr>    </tbody>
  </table>";?>
    
     <?php } ?>



   

