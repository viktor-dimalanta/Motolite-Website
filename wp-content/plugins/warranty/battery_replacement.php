<?php
   
function battery_replacement() {
    ?>
<head>
 <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<style>
.dataTables_filter {
    display: none;
}

</style>
  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />

        <meta charset="utf-8">
   <script>
   



//datepicker

  $( function() {
    $( "#datepicker" ).datepicker();
  } );

//datatable
$( function() {
   var table = $('#warranty_tbl').DataTable( {

"lengthMenu": [ 5,10, 25, 50, 75, 100 ]


   }

 

    );


  } );


</script>

</head>

    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap" >
        <h2>Replacement Records</h2>
        <br>

                <a href="<?php echo admin_url('admin.php?page=battery_replacement_create&id=' . $_GET['id']);?>"> <button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
           

 <br> <br>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "battery_replacement";
         $r = $_GET['id'];

        $rows = $wpdb->get_results("SELECT * FROM wp_battery_replacement WHERE id = '$r' ORDER BY id DESC");

     
  


        ?>

       <table id="warranty_tbl" class="table table-striped table-bordered" cellspacing="0">
    <thead>
      <tr>      
                
                <th >Replaced</th>
                <th >Date and Time Stamp</th>
                <th >Replaced by</th>
                 <th >Replacement Battery Serial No.</th>
                <th >Replacement Date</th>
                <th>Delivery Receipt No.</th>
                <th >Monitoring Done by</th>

            
            


</tr>
    </thead>
    <tbody>
     <?php foreach ($rows as $row) { ?>
      <tr>

      <td ><?php echo  $row->replaced_status  ; ?></td>
                    <td ><?php echo $row->date_time_stamp; ?></td>
                    <td ><?php echo $row->replaced_by; ?></td>
                          <td><?php echo $row->replacement_bat_serial; ?></td>
                    <td ><?php echo $row->replacement_date; ?></td>
                    <td ><?php echo $row->delivery_reciept; ?></td>
                    <td ><?php echo $row->monitored_by; ?></td>


                  </tr>
     <?php } ?>
    </tbody>
  </table>

    </div>
    <?php
}




function battery_replacement_create() {

   
   $r = $_GET['id'];
 
    $replaced_status = $_POST["replaced_status"];
    $date_time_stamp = $_POST["date_time_stamp"];
    $replaced_by = $_POST["replaced_by"];
    $replacement_bat_serial = $_POST["replacement_bat_serial"];
    $replacement_date = $_POST["replacement_date"];
    $delivery_reciept = $_POST["delivery_reciept"];
    $monitored_by = $_POST["monitored_by"];

    $serial_no = $_POST["serial_no"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name1 = $wpdb->prefix ."battery_replacement";
         $table_name2 = $wpdb->prefix ."battery";

   
         



        $sql1="INSERT INTO ".$table_name1." (id,replaced_id,replaced_status,date_time_stamp,replaced_by,replacement_bat_serial,replacement_date,delivery_reciept,monitored_by) VALUES('','$r','$replaced_status','$date_time_stamp','$replaced_by','$replacement_bat_serial','$replacement_date','$delivery_reciept','$monitored_by') ;";

        $sql2 = "UPDATE $table_name2 SET serial_no='$replacement_bat_serial' WHERE id=$r";


$wpdb->query($sql1);
$wpdb->query($sql2);

$message.="Battery Replacement Inserted";


 
}

?>



<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-warranty/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add Battery Replacement</h2><br>
        Records of <br><br>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
          
            <table class='wp-list-table widefat fixed'>

                <tr>
                    <th class="ss-th-width">Replaced</th>
                    <td><select name="replaced_status" value="<?php echo $replaced_status; ?>" class="ss-field-width" />
                   <option value="Yes">Yes</option>
                   <option value="No">No</option>
                  </select></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Replace By</th>
                    <td><input type="text" name="replaced_by" value="<?php echo $replaced_by; ?>" class="ss-field-width" /></td>
                </tr>
                 <tr>
                    <th class="ss-th-width">Replacement Battery Serial No.</th>
                    <td><input type="text" name="replacement_bat_serial" value="<?php echo $replacement_bat_serial; ?>" class="ss-field-width" /></td>
                </tr>
           

                  <tr>
                    <th class="ss-th-width">Replacement Date</th>
                    <td><input name="replacement_date" id = 'datepicker' placeholder="Date of training" class="form-control" type="text" value="<?php echo date('F d, Y'); ?>"></td>
                </tr>


                <tr>
                    <th class="ss-th-width">Delivery Reciept No.</th>
                    <td><input type="text" name="delivery_reciept" value="<?php echo $delivery_reciept; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Monitoring Done By</th>
                    <td><input type="text" name="monitored_by" value="<?php echo $monitored_by; ?>" class="ss-field-width" /></td>
                </tr>

                
               
                 <tr>
                    <th class="ss-th-width">Date and Time Stamp</th>
                    <td><input type="text" name="date_time_stamp" value="<?php echo $date_time_stamp; ?>" class="ss-field-width" /></td>
                </tr>
                  

            </table>
            <br>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>



    <?php

}

