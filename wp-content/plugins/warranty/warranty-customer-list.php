<?php
/**
 * Viktor
 */

function sinetiks_warranty_customer_list() {

    ?>
<head>
  <style type="text/css">
    

    #warranty_tbl > tbody > tr > td:nth-child(7){

      vertical-align: middle;
}
  </style>
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
"bProcessing": true,
    "bServerSide": true,
    "sAjaxSource":  '<?php echo plugins_url('warranty/customer-list-xhr.php'); ?>',
"lengthMenu": [ 5,10, 15,25, 50, 75, 100 ],
"language": {
    "processing": "<img src=' <?php echo plugins_url('warranty/images/loader.gif') ?>' width=130px;/>" //add a loading image,simply putting <img src="loader.gif" /> tag.
  },


  "columnDefs": [ 

     {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },

{

                  "targets": [7],
                   "render": function (data, type, full, meta, row) {
                    return '<center><a href="<?php echo admin_url('admin.php?page=historical_records&id=');    ?>'+full[0]+'" class="btn btn-xs btn-success">' +'<i class="glyphicon glyphicon-time" title="View Historical Data" > </i>'+ '</a></center>'
                  }

                  },
    ],
  });






$('#filter').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
  } );

</script>



</head>
<body>  
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />


    <div class="wrap">

        <h2>Customer Records</h2>



<br><br>



        <?php
        global $wpdb;
    

        $rows = $wpdb->get_results("SELECT * FROM wp_customer ");



        ?>

     
       <table id="warranty_tbl" class="table table-striped table-bordered" cellspacing="0">
    <thead>
      <tr>    <th >id</th>
              <th >Name</th>
                <th >Email</th>
                <th >Mobile No.</th>
                <th >Address</th>
                <th >Company Name</th>
                <th >Ownership Type</th>
              

        
                
                <th style="width:80px; text-align: center"> Historical Records</th>
                
</tr>
    </thead>
    <tbody>


    </tbody>
  </table>
    </div>



    <?php
}



