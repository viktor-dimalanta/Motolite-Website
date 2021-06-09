<?php
/**
 * Viktor
 */

function sinetiks_warranty_import() {


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
   



$( function() {
   var table = $('#warranty_tbl').DataTable( {

"lengthMenu": [ 5,10, 15,25, 50, 75, 100 ],


//remove the sort need to adjust if no sort needed
  "columnDefs": [ {
      "targets": [3],
      "orderable": false
    } ]
   }
   )});


</script>







      <?php



        global $wpdb;

     

        $rows = $wpdb->get_results("SELECT * FROM wp_warranty LEFT JOIN wp_battery ON wp_warranty.id = wp_battery.id LEFT JOIN wp_customer ON wp_warranty.id = wp_customer.id LEFT JOIN wp_vehicle ON wp_warranty.id = wp_vehicle.id ");



        ?>


</head>

    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">

        <h2>Import Warranty Registration</h2>
   
       <hr style="border: 1px solid #f00">
       <a href="<?php echo admin_url('admin.php?page=sinetiks_battery_application_type'); ?>">Application Types</a> &nbsp; | &nbsp; <a href="<?php echo admin_url('admin.php?page=sinetiks_battery_master_list'); ?>"> Battery Master list </a>&nbsp; | &nbsp; <a href="<?php echo admin_url('admin.php?page=database_table'); ?>">Database Table</a> <p align="right" style="float: right; margin-top: -5px;"> 


       <a href="<?php echo WP_PLUGIN_URL; ?>/warranty/Template/warranty-registration-template.csv" download>

       <input class="btn btn-info"  value="Download Template"/></a></p>



       

       <hr>
  <body ">






<div class="container">
<!-- container class is used to centered the body of the browser with some decent width-->
    


<div class="row">
<!-- row class is used for grid system in Bootstrap-->
        


<div class="col-md-4 col-md-offset-4">
<!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            



<div class="login-panel panel panel-info">

<div class="panel-heading">

<h3 class="panel-title">Select file to Import</h3>



                </div>


<div class="panel-body">

<form method="post" action="import.php" enctype="multipart/form-data">

<fieldset>

<div class="form-group">
                              <input type="file" name="file"/>
                            </div>



                        <input class="btn btn-success" type="submit" name="submit_file" value="Submit"/>
                        </fieldset>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


       <table id="warranty_tbl" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>      <th >File</th>
                <th >Date and Time Stamp</th>
                <th >Status</th>
                
                <th style="width:80px; text-align: center"> Action</th>
                
</tr>
    </thead>
    <tbody>



  
 
     <?php foreach ($rows as $row) { ?>
      <tr style="height: 65px;" class="content" >


                    <td style="font-size: 14px;"><?php echo ($row->fname ." " . $row->lname  ); ?></td>
                    <td style="font-size: 14px;"><?php echo $row->ownership_type; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->vehicle_plate; ?></td>
                    <td align="center" style="vertical-align: middle;">
                  
                    <a class="btn btn-xs btn-success" style="margin-left: 2px;" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_update&id=' . $row->id); ?>"><i class="glyphicon glyphicon-download-alt" title="Edit" > </i> </a>
                    
              


                    </tr>
     <?php } ?>
    </tbody>
  </table>


</body>
 

  
      </div>
    <?php
$user = wp_get_current_user();
if( $user->has_cap( 'encoder' ) ) {
    $function->remove_register();
}

}


