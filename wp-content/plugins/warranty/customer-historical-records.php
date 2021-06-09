<?php
   
function historical_records() {
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
        <h2>Historical Records</h2>
    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "warranty";
         $r = $_GET['id'];

        $rows = $wpdb->get_results("SELECT wp_customer.fname,wp_customer.lname,wp_warranty.id,wp_battery.brand, wp_battery.serial_no,wp_battery.purchase_date,wp_warranty.warranty,wp_warranty.expires_on,wp_vehicle.vehicle_plate FROM wp_warranty LEFT JOIN wp_battery ON wp_warranty.id = wp_battery.id LEFT JOIN wp_vehicle ON wp_warranty.id = wp_vehicle.id LEFT JOIN wp_customer ON wp_warranty.id = wp_customer.id WHERE wp_warranty.id = '$r' ORDER BY id DESC");

     
  


        ?>     
 <hr style="border-width: 2px;">
  <?php foreach ($rows as $row) { ?>
<h1><b>Customer Name:</b>&nbsp;&nbsp;<?php echo $row->fname; ?>&nbsp;<?php echo $row->lname; ?></h1>
<?php } ?>

 <div style="float: right;">
               <button class="btn btn-success" id= "exp" onclick="historical_export_csv()"><i class="glyphicon glyphicon-download-alt" ></i>&nbsp; Convert to CSV</button>
      </div>     

 <br> <br>
      

       <table id="warranty_tbl" class="table table-striped table-bordered" cellspacing="0">
    <thead>
      <tr>      
                
                <th >Plate</th>
                <th >Serial No.</th>
                <th >Battery</th>
                 <th >Purchased Date</th>
                <th >Warranty</th>
                <th>Expires On</th>
        
</tr>
    </thead>
    <tbody>
     <?php foreach ($rows as $row) { ?>
      <tr>

      <td ><?php echo  $row->vehicle_plate  ; ?></td>
                    <td ><?php echo $row->serial_no; ?></td>
                    <td ><?php echo $row->brand; ?></td>
                          <td><?php echo $row->purchase_date; ?></td>
                    <td ><?php echo $row->warranty; ?></td>
                    <td ><?php echo $row->expires_on; ?></td>
                  </tr>
     <?php } ?>
    </tbody>
  </table>

    </div>
    <?php

?>
<script type="text/javascript">
  
    function historical_export_csv(){

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

    <?php

}

