<?php
/**
 * Viktor
 */

function sinetiks_warranty_users() {
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
        
  
<?php
add_action( 'admin_footer', 'warrantyDetailsAction' ); // Write our JS below here

function warrantyDetailsAction() { ?>


<?php } ?>


<?php


    global $wpdb;


?>



</head>

    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">

        <h2>Warranty Registration System</h2>
        <br>
                <a href="<?php echo admin_url('admin.php?page=sinetiks_warranty_create'); ?>"> <button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Register a Battery </button></a>
           <br><br>
 <input type="text" name="" id="filter" class="filter1" placeholder=" type a keyword";>
 <select id="mySelect"  name ="search">
 <option value="0">All</option>
 <option value="1">Client Name</option>
 <option value="2">Ownership Type</option>
  <option value="3">Plate No.</option>
  <option value="4">Battery</option>
  <option value="5">Serial No.</option>
  <option value="6">Purchased On</option>
  <option value="7">Warranty</option>
  <option value="8">Expires On</option>
  <option value="9">Registrant</option>
  <option value="10">Last Update</option>
</select>
<br><br>


<div>
<span>Filter records by encoder</span> 



<select id='filterText' style='display:inline-block; width: 130px;' onchange='filterText()'>
                <option >Select All</option>
                <?php 
               $result=$wpdb->get_results("select * from wp_warranty");
               foreach($result as $row) {
                $registrant=$row->registrant;
                $registrant=$row->registrant;
            echo '<option value='.$registrant.'>'.$registrant.'</option>';
        }
    ?>
</select>





</div>
<br>



        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "warranty";

        $rows = $wpdb->get_results("SELECT wp_warranty.id,wp_customer.ownership_type,wp_customer.fname,wp_customer.lname,wp_battery.brand, wp_battery.serial_no,wp_battery.purchase_date,wp_warranty.warranty,wp_warranty.expires_on,wp_warranty.last_update,wp_vehicle.vehicle_plate,wp_warranty.registrant FROM wp_warranty LEFT JOIN wp_battery ON wp_warranty.id = wp_battery.id LEFT JOIN wp_customer ON wp_warranty.id = wp_customer.id LEFT JOIN wp_vehicle ON wp_warranty.id = wp_vehicle.id");



        ?>

     
       <table id="warranty_tbl" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>      <th >Client Name</th>
                <th >Ownership Type</th>
                <th >Plate No.</th>
                 <th >Battery</th>
                <th >Serial No.</th>
                <th>Purchased Date</th>
                <th >Warranty</th>

                <th >Expires On</th>
                <th>Registrant</th>
                <th >Last Update</th>
                <th style="width:80px; text-align: center"> Action</th>
                
</tr>
    </thead>
    <tbody>




 
     <?php foreach ($rows as $row) { ?>
      <tr style="height: 65px;" class="content" ><td style="font-size: 14px;"><?php echo ($row->fname ." " . $row->lname  ); ?></td>
                    <td style="font-size: 14px;"><?php echo $row->ownership_type; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->vehicle_plate; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->brand; ?></a></td>
                    <td style="font-size: 14px;"><?php echo $row->serial_no; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->purchase_date; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->warranty; ?></td>

                     <td style="font-size: 14px;"><?php echo $row->expires_on; ?></td>
                      <td style="font-size: 14px;"><?php echo $row->registrant; ?></td>
                      <td style="font-size: 14px;"><?php echo $row->last_update; ?></td>


                    <td align="center" style="vertical-align: middle;" >

                    <a class="btn btn-xs btn-primary" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_update&id=' . $row->id); ?>"><i class="glyphicon glyphicon-pencil" title="Edit"></i> </a>

                    <a class="btn btn-xs btn-warning" href="<?php echo admin_url('admin.php?page=battery_replacement&id='. $row->id); ?>"><i class="glyphicon glyphicon-file" title="Edit Replacement Record"></i> </a>

               <br>
                      <a class="btn btn-xs btn-success" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_update&id=' . $row->id); ?>" style="margin-top: 2px;"><i class="glyphicon glyphicon-stats" title="View Statistics" ></i> </a>

                    <a class="btn btn-xs btn-danger" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_delete&id='. $row->id); ?>" onClick="return confirm('Delete this warranty record?')" style="margin-top: 2px;"><i class="glyphicon glyphicon-trash" title="Delete Item"></i> </a>

                      </td>

                



                    </tr>
     <?php } ?>
    </tbody>
  </table>

    </div>

<!--Modal of Battery Details -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="modal fade" id="modalMyformData" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">×</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Warranty Information
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="fetched-data"></div>
                   <hr style="border-width: 2px;"> 
            </div>
        

        </div>
    </div>
</div>

    <?php
}


function sinetiks_warranty_delete_users($id) {
   
        global $wpdb;



        $id = $_GET['id'];
   
      
           $table_name1 = $wpdb->prefix ."customer";
        $table_name2 = $wpdb->prefix ."battery";
        $table_name3 = $wpdb->prefix ."warranty";

   

        
        $sql1 = "DELETE  FROM ".$table_name3." WHERE id = $id";
          $sql2 = "DELETE  FROM ".$table_name2." WHERE id = $id";
            $sql3 = "DELETE  FROM ".$table_name1." WHERE id = $id";

             $sql4 = "DELETE  FROM ".$table_name4." WHERE id = $id";
              $sql5 = "DELETE  FROM ".$table_name5." WHERE id = $id";
               $sql6 = "DELETE  FROM ".$table_name6." WHERE id = $id";




         $wpdb->query($sql1);
            $wpdb->query($sql2);
             $wpdb->query($sql3);
             $wpdb->query($sql4);
            $wpdb->query($sql5);
             $wpdb->query($sql6);



        $message.="Deleted";

  sinetiks_warranty_list();

    ?>


    <?php
}

