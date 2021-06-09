<?php
/**
 * Viktor
 */

function database_table() {


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

"lengthMenu": [ 5,10, 15,25, 50, 75, 100 ],


//remove the sort need to adjust if no sort needed
  "columnDefs": [ {
      "targets": [3],
      "orderable": false
    } ]
   });
    
     $('#dropdown1').on('change', function () {
                    table.columns(3).search( this.value ).draw();
                } );
                $('#dropdown2').on('change', function () {
                    table.columns(2).search( this.value ).draw();
                } );
});




</script>







      <?php



        global $wpdb;

     

        $rows = $wpdb->get_results("SELECT * FROM wp_warranty_classification ");



        ?>


</head>

    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">

        <h2>Database Tables</h2>
   
       <hr style="border: 1px solid #f00">
      
  <body>
<div style="float: right; margin-right: 160px; ">
Filter Records by Encoder: &nbsp;<select id="dropdown1" style="width: 180px; margin-left: 26px;">
 <option value="">All</option>
  <?php 
               $result=$wpdb->get_results("SELECT encoder FROM wp_warranty_classification  GROUP BY encoder");
               foreach($result as $row) {
                $encoder=$row->encoder;
                
            echo '<option value='.$encoder.'>'.$encoder.'</option>';
        }
    ?>
</select><br>

Filter by Warranty Classification&nbsp;<select id="dropdown2" style="margin-top: 5px; width: 180px;">
    <option value="">All</option>
   <?php 
               $result=$wpdb->get_results("SELECT classification FROM wp_warranty_classification  GROUP BY classification");
               foreach($result as $row) {
                $classification=$row->classification;
                
            echo '<option value='.$classification.'>'.$classification.'</option>';
        }
    ?>
</select>
</div>
<br><br><br><hr>
<center>
<div style="width: 70%;">

       <table id="warranty_tbl" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>      <th >File</th>
                <th >Time Stamp</th>
                <th >Status</th>
                <th >Download</th>
                
                
                
</tr>
    </thead>
    <tbody>



  
 
     <?php foreach ($rows as $row) { ?>
      <tr style="height: 65px;" class="content" >


                    <td style="font-size: 14px;"><?php echo ($row->battery_serial ); ?></td>
                    <td style="font-size: 14px;"><?php echo $row->dateNtime; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->classification; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->encoder; ?></td>
                    
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


