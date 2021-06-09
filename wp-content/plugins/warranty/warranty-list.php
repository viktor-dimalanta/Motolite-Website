<?php
/**
 * Viktor
 */

function sinetiks_warranty_list() {


require_once('class_capabilities.php');
$function = new Capabilities();

    ?>



<head>
 <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>


   
  
<style>
.dataTables_filter {
    display: none;
}
#warranty_tbl > tbody > tr > td:nth-child(11){

      vertical-align: middle;
}
.dt-button-collection a.buttons-columnVisibility:before,
.dt-button-collection a.buttons-columnVisibility.active span:before {
display:block;
position:absolute;
top:1.2em;
left:0;
width:12px;
height:12px;
box-sizing:border-box;
}

.dt-button-collection a.buttons-columnVisibility:before {
content:' ';
margin-top:-6px;
margin-left:5px;
border:1px solid black;
border-radius:0px;
}

.dt-button-collection a.buttons-columnVisibility.active span:before {
content:'\2714';
margin-top:-11px;
margin-left:8px;
text-align:center;
text-shadow:1px 1px #DDD, -1px -1px #DDD, 1px -1px #DDD, -1px 1px #DDD;
}

.dt-button-collection a.buttons-columnVisibility span {
margin-left:8px;

}
body {
  font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
  margin: 0;
  padding: 0;
  color: #333;
  background-color: #eeeeee !important;
}


div.container {
  min-width: 980px;
  margin: 0 auto;
}

/** highlight on hover **/
#warranty_tbl tbody tr.even:hover, #warranty_tbl tbody tr.even td.highlighted {
    background-color: #dbe5ff;
}

#warranty_tbl tbody tr.odd:hover, #warranty_tbl tbody tr.odd td.highlighted {
    background-color: #dbe5ff;
}

#warranty_tbl tr.even:hover {
    background-color: #dbe5ff;
}

#warranty_tbl tr.even:hover td.sorting_1 {
    background-color: #dbe5ff;
}

#warranty_tbl tr.even:hover td.sorting_2 {
    background-color: #dbe5ff;
}

#warranty_tbl tr.even:hover td.sorting_3 {
    background-color :#dbe5ff;
}

#warranty_tbl tr.odd:hover {
    background-color: #dbe5ff;
}

#warranty_tbl tr.odd:hover td.sorting_1 {
    background-color: #dbe5ff;
}

#warranty_tbl tr.odd:hover td.sorting_2 {
    background-color: #dbe5ff;
}

#warranty_tbl tr.odd:hover td.sorting_3 {
    background-color: #dbe5ff;
}


</style>
  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />

<link type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />
        <meta charset="utf-8">
        
   <script>
   
function formatDate(date) {
  var monthNames = [
    "January", "February", "March",
    "April", "May", "June", "July",
    "August", "September", "October",
    "November", "December"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return monthNames[monthIndex]  + ' ' + day + ',' + ' ' + year;
}

$(document).ready(function() {
  var s =  $(this).children().closest("td").html();

  var table = $('#warranty_tbl').dataTable( {

    dom: 'Bfrtip',
        buttons: [
            'colvis'
        ],
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource":  '<?php echo plugins_url('warranty/xhr.php'); ?>',
    "lengthMenu": [ 5,10, 15,25, 50, 75, 100 ],
    "language": {
    "processing": "<img src=' <?php echo plugins_url('warranty/images/loader.gif') ?>' width=130px;/>" //add a loading image,simply putting <img src="loader.gif" /> tag.
  },

//remove the sort need to adjust if no sort needed

    
    "columnDefs": [

               {  "targets":[ 8 ], 
                  "sType": "date", 
                  "mRender": function(date, type, full) {
                    return ( formatDate(new Date(date)));
              }},



               {  "targets":[ 6 ], 
                  "sType": "date", 
                  "mRender": function(date, type, full) {
                    return ( formatDate(new Date(date)));
              }},


                 {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
                {
                    "targets":[ 4],

                    "render": function (data, type, full, meta) {
                      full[0];
                    return "<a href='#modalMyformData' data-toggle='modal' data-target='#modalMyformData' data-Id='" + full[0] +"'            >" + full[4] +"</a>"; }
                },


                {

                  "targets": [ 5],
                   "render": function (data, type, full, meta, row) {
                    return '<a href="<?php echo admin_url('admin.php?page=sinetiks_warranty_update&id=');    ?>'+full[0]+'" class="">' + full[5]  + '</a>'
                  }

                  },

              
                   {

                  "targets": [ 11],
                   "render": function (data, type, full, meta, row) {
                    return '<center><a href="<?php echo admin_url('admin.php?page=sinetiks_warranty_update&id=');    ?>'+full[0]+'" class="btn btn-xs btn-primary">' +'<i class="glyphicon glyphicon-pencil" title="Edit" > </i>'+ '</a>'+ '  ' +  '<a href="<?php echo admin_url('admin.php?page=battery_replacement&id=');    ?>'+full[0]+'" class="btn btn-xs btn-warning">' +'<i class="glyphicon glyphicon-file" title="Edit Replacement Record"></i>'+ '</a>'+ ' '+ '<a onclick="return confirm(\'Are you sure you want to delete warranty?\')" href="<?php echo admin_url('admin.php?page=sinetiks_warranty_delete&id=');    ?>'+full[0]+'" class="btn btn-xs btn-danger">' +'<i class="glyphicon glyphicon-trash" title="Delete Item"></i>'+ '</a></center>'
                  }

                  },

            ]

  } );
} );


//Registrant Search
$(document).ready(function() {
   var table =  $('#warranty_tbl').DataTable();
    
     $('#dropdown1').on('change', function () {
                    table.columns(9).search( this.value ).draw();
                } );
               
});


//datatable and Search with dropdown
$(document).ready(function(){
    var table =  $('#table').DataTable();
$('#filter').on( 'keyup', function () {


                    var s = document.getElementById('mySelect');
                    var item1 = s.options[s.selectedIndex].value;



   

    if (item1 == 0){


    table.search( this.value ).draw();



    }else{

       table.columns(item1).search( this.value ).draw();
    }





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
            url : '<?php echo plugins_url('warranty/warranty-list-response.php'); ?>', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id

            success : function(data){

            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
});
</script>



<?php } ?>


<?php


    global $wpdb;



    
?>



</head>

    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">
        <div class="row">
            <div class="left">
              <h3>&nbsp;Warranty Registration System</h3>
            </div>
            <br>
            <div class="right">
              <a href="<?php echo admin_url('admin.php?page=sinetiks_warranty_create'); ?>"> <button class="btn btn-success btn-right" ><i class="glyphicon glyphicon-plus" ></i> Register a Battery </button></a>
            </div>
        </div>

        <div class="row">
    <center>
          <div class="search-box center-block shadow rounded" style="padding: 30px; width:36%">
           <b> Search</b>&nbsp; <input type="text" name="" id="filter" class="filter1" placeholder=" type a keyword" style="width:160px" ;>
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
          </div></center>
        </div>
       



<div class="filter_encoder">
<span>Filter records by encoder</span> 

<select id="dropdown1" style="margin-left: 8px; width: 126px;">
 <option value="">No Filter</option>
  <?php 
               $result=$wpdb->get_results("SELECT wp_warranty.id,wp_customer.ownership_type,wp_customer.fname,wp_customer.lname,wp_battery.brand, wp_battery.serial_no,wp_battery.purchase_date,wp_warranty.warranty,wp_warranty.expires_on,wp_warranty.last_update,wp_vehicle.vehicle_plate,wp_warranty.registrant FROM wp_warranty LEFT JOIN wp_battery ON wp_warranty.id = wp_battery.id LEFT JOIN wp_customer ON wp_warranty.id = wp_customer.id LEFT JOIN wp_vehicle ON wp_warranty.id = wp_vehicle.id GROUP BY registrant");
               foreach($result as $row) {
                $registrant=$row->registrant;
                
            echo '<option value='.$registrant.'>'.$registrant.'</option>';
        }
    ?>
</select>


</div>
<br>



     
       <table id="warranty_tbl" class="table table-striped table-bordered shadow rounded" width="100%" cellspacing="0">
    <thead>
      <tr>      
      <th >id</th>
      <th >Client Name</th>
                <th >Ownership Type</th>
                <th >Plate No.</th>
                 <th >Battery</th>
                <th >Serial No.</th>
                <th>Purchased Date</th>
                <th >Warranty</th>

                <th >Expires On</th>
                <th>Registrant</th>
                <th >Last Update</th>
                <th> <font color =white>...</font>Action<font color =white>...</font></th>
                
</tr>
    </thead>
    <tbody>



    </tbody>
  </table>

    </div>

<!--Modal of Battery Details -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="modal fade" id="modalMyformData" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:650px;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">×</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b> Warranty Information</b>
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
$user = wp_get_current_user();
if( $user->has_cap( 'encoder' ) ) {
    $function->remove_register();
}
/**


 


if( $user->has_cap( 'administrator' ) ) {

 echo "<script>";
 echo "document.getElementById('edits').style.display = 'none';";
 echo "</script>";



} else if($user->has_cap( 'meh' )){

echo "<script>";
 echo "document.getElementById('myDIV').style.display = 'block';";
 echo "</script>";
}


**/
}


function sinetiks_warranty_delete($id) {
   
        global $wpdb;



        $id = $_GET['id'];
   
      
           $table_name1 = $wpdb->prefix ."customer";
        $table_name2 = $wpdb->prefix ."battery";
        $table_name3 = $wpdb->prefix ."warranty";

          $table_name4 = $wpdb->prefix ."promo";
            $table_name5 = $wpdb->prefix ."distributor";
              $table_name6 = $wpdb->prefix ."vehicle";


   

        
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
