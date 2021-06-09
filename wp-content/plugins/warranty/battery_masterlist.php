<?php
/**
 * Viktor
 */

function sinetiks_battery_master_list() {


require_once('class_capabilities.php');
$function = new Capabilities();

    ?>



<head>
 <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>


  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />

 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 


        <meta charset="utf-8">
        
   <script>
   
$(document).ready(function() {
   var table =  $('#warranty_tbl').DataTable({

"lengthMenu": [ 100 ],
"bLengthChange": false,


//remove the sort need to adjust if no sort needed
 
   });
    
  
});




</script>







      <?php



        global $wpdb;

     

        $rows = $wpdb->get_results("SELECT * FROM wp_battery_masterlist ");



        ?>


</head>

    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">

        <h2>Battery Masterlist</h2>
   
       <hr style="border: 1px solid #f00">
      
  <body>
<center>
<div style="width: 90%;">

       <table id="warranty_tbl" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>      <th >Category</th>
                <th >Battery Brand </th>
                <th >Battery Size</th>
                <th >Battery ID</th>
                
                
                
</tr>
    </thead>
    <tbody>



  
 
     <?php foreach ($rows as $row) { ?>
      <tr style="height: 65px;" class="content" >


                    <td style="font-size: 14px;"><?php echo ($row->category ); ?></td>
                    <td style="font-size: 14px;"><?php echo $row->battery_brand; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->battery_size; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->battery_id; ?></td>
                    
                    </tr>
     <?php } ?>
    </tbody>
  </table>


</body>
 </div>
  
      </div>
</center>
    <?php
$user = wp_get_current_user();
if( $user->has_cap( 'encoder' ) ) {
    $function->remove_register();
}

}


