<?php
/**
 * Viktor
 */

function sinetiks_warranty_encoder_list() {

    ?>
<head>
 <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        <meta charset="utf-8">
 
  <script>



//datepicker

  $( function() {
    $( "#datepicker" ).datepicker();
  } );

//datatable
$( function() {
   var table = $('#warranty_tbl').DataTable( {

"lengthMenu": [ 5,10, 15,25, 50, 75, 100 ],

  "columnDefs": [ {
      "targets": [ 10],
      "orderable": false
    } ],
    //to run ajax even in next button
    drawCallback: function() {
        var api = this.api();
        api.$('.livecheck').change(function() {
        var stat = 0;
        var id=$(this).attr('id');
     
        $.ajax({
            type : 'post',
            url : '<?php echo plugins_url('warranty/toggle-response.php'); ?>', 
            data :  {id: id, stat: stat},//Pass $id
            success : function(data){
           //setTimeout(function(){ location.reload(); }, 1);
            // alert("Status Changed to draft!");
            $('.fetched-data').html(data);
            
            }
        });
        });

        api.$('.draftcheck').change(function() {
            var stat = 1;
        var id=$(this).attr('id');
     
        $.ajax({
            type : 'post',
            url : '<?php echo plugins_url('warranty/toggle-response.php'); ?>', 
            data :  {id: id, stat: stat},//Pass $id
            success : function(data){
             //setTimeout(function(){ location.reload(); }, 1);
             // alert("Status Changed to live!");
            $('.fetched-data').html(data);

            }
        });
          });
    }
   });






$('#filter').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
  } );

</script>



<?php
add_action( 'admin_footer', 'warrantyDetailsAction' ); // Write our JS below here

function warrantyDetailsAction() { ?>


<script>
$(document).ready(function(){
    $('#modalMyformData').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : '<?php echo plugins_url('warranty/warranty-encoder-response.php'); ?>', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id

            success : function(data){
              //alert(rowid);

            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});
</script>



<?php } ?>


</head>
<body>  
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">

        <h2>Manage Encoder Login</h2>
        <br>
        Users that can encode warranty in front end
        <br><br>
                <a href="<?php echo admin_url('admin.php?page=sinetiks_warranty_create_encoder'); ?>"> <button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Encoder </button></a>
           <br><br>
 





<br>



        <?php
        global $wpdb;
    

        $rows = $wpdb->get_results("SELECT wp_users.id,wp_users.user_email,wp_users.user_login,wp_user_ext.outletname,wp_user_ext.outletaddress,wp_user_ext.telephone,wp_user_ext.branch,wp_user_ext.telephone,wp_user_ext.fname,wp_user_ext.lname,wp_user_ext.status,wp_user_ext.Type FROM wp_users LEFT JOIN wp_user_ext ON wp_users.id = wp_user_ext.id INNER JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id WHERE wp_usermeta.meta_key = 'wp_capabilities' AND wp_usermeta.meta_value LIKE '%dealer%' OR wp_usermeta.meta_value LIKE '%cojv%'");



        ?>

     
       <table id="warranty_tbl" class="table table-striped table-bordered" cellspacing="0">
    <thead>
      <tr>      <th >Type</th>
                <th >Username</th>
                <th >Email</th>
                <th >Name</th>
                 <th >Outlet Name</th>
                <th >Outlet Branch</th>
                <th>Outlet Address</th>
                <th >Outlet Tel</th>

                <th style="text-align: center">Status</th>
            <th style="display: none;"></th>

                <th style="display: none;"></th>
                
                <th style="width:80px; text-align: center"> Action</th>
                
</tr>
    </thead>
    <tbody>




 
     <?php foreach ($rows as $row) { ?>
      <tr style="height: 65px;" class="content" >
                    <td style="font-size: 14px;"><?php echo $row->Type; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->user_login; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->user_email; ?></td>
                    <td style="font-size: 14px;"><?php echo ($row->fname ." " . $row->lname  ); ?></td>
                    <td style="font-size: 14px;"><?php echo $row->outletname; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->branch; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->outletaddress; ?></td>
                    <td style="font-size: 14px;"><?php echo $row->telephone; ?></td>
                     <td style="font-size: 14px; vertical-align: middle; width:100px;">
                       <center>
                    
                       <?php 

                       if ($row->status == '1') {echo ' <input type="checkbox" checked data-toggle="toggle" data-on="Live" data-off="Draft" data-onstyle="success" data-offstyle="danger"  data-size="small"  class="livecheck" id="'.$row->id.'" onclick=confirm("Press a button!"); >';} 

                       else {echo ' <input type="checkbox"  data-toggle="toggle" data-on="Live" data-off="Draft" data-onstyle="success" data-offstyle="danger"  data-size="small"  class ="draftcheck" id="'.$row->id.'" >';}       

                       ?>

               



                        </center>
                     </td>
                      <td style="font-size: 14px; display: none;"></td>
                     <td style="font-size: 14px;  display: none;"></td>
                      
                


                    <td align="center" style="vertical-align: middle; width: 150px;" >
                    <center>
                    <a class="btn btn-xs btn-primary" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_update_encoder&id=' .$row->id); ?>"><i class="glyphicon glyphicon-pencil" title="Edit User"></i> </a>

                     <a class="btn btn-xs btn-success" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_stats&id=' .$row->id); ?>"><i class="glyphicon glyphicon-stats" title="View Statistics"></i> </a>

              
                    <a class="btn btn-xs btn-warning" href="#modalMyformData"  data-toggle="modal" data-target="#modalMyformData" data-Id="<?php echo $row->id;?>"> <i class="glyphicon glyphicon-lock" title="Change Password"></i> </a>

  
                    <a class="btn btn-xs btn-danger" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_delete_encoder&id='. $row->id); ?>" onClick="return confirm('Delete this warranty record?')" style="margin-top: 2px;"><i class="glyphicon glyphicon-trash" title="Delete Item"></i> </a>
</center>
                      </td>

                



                    </tr>
     <?php } ?>
    </tbody>
  </table>
    </div>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="modal fade" id="modalMyformData" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 325px;">
        <div class="modal-content" style="height: 200px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">×</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Change Password
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="fetched-data"></div>
                  
            </div>
        

        </div>
    </div>
</div>

    <?php
}


function sinetiks_warranty_delete_encoder($id) {
   
        global $wpdb;



        $id = $_GET['id'];
   
      
           $table_name1 = $wpdb->prefix ."users";
        $table_name2 = $wpdb->prefix ."user_ext";
   
   

        
        $sql1 = "DELETE  FROM ".$table_name1." WHERE id = $id";
          $sql2 = "DELETE  FROM ".$table_name2." WHERE id = $id";
           




         $wpdb->query($sql1);
            $wpdb->query($sql2);
            



        $message.="Deleted";

  sinetiks_warranty_encoder_list();

    ?>


    <?php
}




