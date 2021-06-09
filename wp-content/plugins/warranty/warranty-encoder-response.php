<?php
 
//$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
//echo $parse_uri[0]; exit();
//require_once( $parse_uri[0] . 'wp-load.php' );
 
?>

<?php 


require_once($_SERVER['DOCUMENT_ROOT'] . '/Motolite/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] .  '/Motolite/wp-includes/wp-db.php');


//require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
//require_once($_SERVER['DOCUMENT_ROOT'] .  '/wp-includes/wp-db.php');


global $wpdb;

if($_REQUEST['rowid']) {
    $con_id = $_REQUEST['rowid']; //escape string




        $table_name = $wpdb->prefix . "users";
      



  $id = $con_id;



        $user_details = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
      



            foreach ($user_details as $b)
                 {



            $brand = $b->brand;
            $purchase_date = $b->purchase_date;
            $brand_type_size = $b->brand_type_size;
            $serial_no = $b->serial_no;
            $sales_invoice = $b->sales_invoice;


          }


         
    



  echo "

  
    <div id='dvContainer'>

  
              <div>
            <label for = 'newpass'>New Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input type='password' id='newpass' pattern='.{10,}' required title='Minimum 10 characters required'  placeholder='Enter new password' />
            <div style='height:5px;'> </div>
             <label for = 'confirmpass'>Confirm Password &nbsp; </label><input type='password' id='confirmpass' placeholder='Confirm password' />
         <div style='float: right; '><br>
             <button onclick='validate()' class='btn btn-primary' style='margin-right: 5px;' >Save</button><br>
             </div>
                 </div>
             
                  
            
           
            </div>
       


";              



 }
?>

<script type="text/javascript">

function validate(){
var modalid=<?php echo json_encode($id); ?>;


var newpass = document.getElementById("newpass").value;
var confirmpass = document.getElementById("confirmpass").value
var passnew  = document.getElementById("newpass");
var confirmnew  = document.getElementById("confirmpass");
if (newpass == confirmpass && passnew.value.length > 10){

$.ajax({
            type : 'post',
            url : '<?php echo plugins_url('warranty/warranty-encoder-response_changepass.php'); ?>', //Here you will fetch records 
            data :  {modalid: modalid, newpass: newpass}, //Pass $id

            success : function(data){
              //alert(rowid);
              $('#modalMyformData').modal('hide');
              alert('Password Change Succesfully!');

            $('.fetched-data').html(data);//Show fetched data from database
            }
        });

}


else if (newpass == confirmpass && passnew.value.length < 10  ){

  alert("Sorry password is too short!");
}



else{
  alert("Sorry you input wrong password combination!");

}


}
   




</script>



