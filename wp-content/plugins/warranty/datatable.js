$(document).ready(function() {
  var s =  $(this).children().closest("td").html();
  var table = $('#warranty_tbl').dataTable( {

    dom: 'Bfrtip',
        buttons: [
            'colvis'
        ],
    "deferRender": true,
    "bProcessing": true,
    "bServerSide": true,
    //"sAjaxSource":  '<?php echo plugins_url('warranty/xhr.php'); ?>',
    "lengthMenu": [ 5,10, 15,25, 50, 75, 100 ],
//remove the sort need to adjust if no sort needed



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
    var table =  $('#warranty_tbl').DataTable();
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

