<?php
/**
 * Viktor
 */

function sinetiks_warranty_export() {


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
 /**  
$(document).ready(function() {
   var table =  $('#warranty_tbl').DataTable({

     "lengthMenu": [ 5,10, 15,25, 50, 75, 100 ],
   });
    
    
               
});

**/


$( document ).ready(function() {
   document.getElementById("exp").disabled = true;

});

//datepicker

  $( function() {
    $( "#datepicker" ).datepicker({

        dateFormat: 'MM dd, yy',
    });
     $( "#datepicker2" ).datepicker({

        dateFormat: 'MM dd, yy',
    });
  } );


</script>

<?php
add_action( 'admin_footer', 'warrantyDetailsAction' ); // Write our JS below here

function warrantyDetailsAction() { ?>


  <script type="text/javascript">
    
    function generate(){


        if ($('input#datepicker').val() == ""  || $('input#datepicker2').val() == "" )   {
                alert('Start date and End date is Required');
            } else {

      var start_date_js = document.getElementById("datepicker").value;
      var end_date_js = document.getElementById("datepicker2").value;
      var encoder = document.getElementById("filterText").value;

         $.ajax({
            type : 'POST',
            url : '<?php echo plugins_url('warranty/warranty-export-response.php'); ?>', //Here you will fetch records 
            data :  {start_date_js: start_date_js, end_date_js: end_date_js, encoder: encoder }, //Pass $id

            success : function(data){
              //$('.responseDiv span').text(start_date_js);
           //alert(start_date_js);
            $('.table').html(data);//Show fetched data from database
             //$('#warranty_tbl').DataTable();
             document.getElementById("exp").disabled = false;

        //$("#warranty_tbl").load(window.location + " #warranty_tbl");


            }
        });


      //alert(start_date_js);
      //alert(end_date_js);
    }
  }


    function export_csv(){

          var start_date_js = document.getElementById("datepicker").value;
        var end_date_js = document.getElementById("datepicker2").value;
        var encoder = document.getElementById("filterText").value;

          $.ajax({
            type : 'POST',
            url : '<?php echo plugins_url('warranty/export_csv.php'); ?>', //Here you will fetch records 
            data :  {start_date_js2: start_date_js, end_date_js2: end_date_js, encoder2: encoder }, //Pass $id

            success : function(response){
              
             console.log(response);
             var download_csv = document.createElement('a');
             download_csv.href = 'data:text/csv;charset=utf-8,' + encodeURI(response);
             download_csv.target = '_blank';
             download_csv.download = 'Warranty_Export_' + start_date_js + '_to_' + end_date_js + '.csv' ;
             download_csv.click();
            }
        });

    }

  </script>
<?php } ?>








      <?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/Motolite/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] .  '/Motolite/wp-includes/wp-db.php');



        global $wpdb;




        ?>


</head>

    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">

        <h2>Export Warranty Registration</h2>
   <div id='response'></div>
       <hr style="border: 1px solid #f00">
<center>
                 <div class="tr-div">

                 
                    <div class="td-div"><b>Start Date</b> &nbsp;<input name="purchase_date_start" id = 'datepicker' placeholder="Pick a Date"  type="text" style="width: 110px;" >&nbsp;&nbsp;&nbsp;
                    <b>End Date</b> &nbsp;

                    <input name="purchase_date_end" id = 'datepicker2' placeholder="Pick a Date"  type="text" style="width: 110px;">
                    </div>
                    
                    
                </div>

<br>
Filter Records by Encoder

<select id='filterText' style='display:inline-block; width: 130px;' >
                <option value = 'all'>Select All</option>
                <?php 
               $result=$wpdb->get_results("select registrant from wp_warranty GROUP BY registrant");
               foreach($result as $row) {
                $registrant=$row->registrant;
                
            echo '<option value="'.$registrant.'">'.$registrant.'</option>';
        }
    ?>
</select>
<br><br>
<button class="btn btn-primary" name="generate" onclick="generate()"><i class="glyphicon glyphicon-refresh" ></i> Generate </button>



</center>
<hr>


<button class="btn btn-success" id= "exp" onclick="export_csv()"><i class="glyphicon glyphicon-download-alt" ></i>&nbsp; Export to Excel </button>




<br>
<br>
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
   


 </table>
 
      </div>
    <?php
$user = wp_get_current_user();
if( $user->has_cap( 'encoder' ) ) {
    $function->remove_register();
}

}


