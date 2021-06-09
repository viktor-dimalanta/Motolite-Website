<?php

function sinetiks_warranty_create() {

  ?>
  <head>


 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.8.3.js" type="text/javascript"></script>
  <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css"
    rel="stylesheet" type="text/css" /> 









    <style type="text/css">
        

    .ui-dialog .ui-dialog-titlebar-close span {
    display: unset;
    margin: -8px;
}


    label, input {

        display: block;

    }

    input.text {

        margin-bottom: 12px;

        width: 95%;

        padding: .4em;

    }
    fieldset {

        padding: 0;

        border: 0;

        margin-top: 25px;

    }


    h1 {

        font-size: 1.2em;

        margin: .6em 0;

    }

 
    .ui-widget .ui-widget {
    font-size: 0em;
}
    .ui-dialog .ui-state-error {

        padding: .3em;

    }


    .validateTips {

        border: 1px solid transparent;

        padding: 0.3em;

    }

    #dialog-form {

        display: none;

    }

    #users {

        width:700px;
    }

    .radio-inline input[type="radio"] {
    position: absolute;
    margin-left: -150px;
}
    .radio-inline2 input[type="radio"] {
    position: absolute;
    margin-left: 60px;
}

/* div for creating warranty  */
    .table-div{display:table}
.tr-div{display:table-row}
.td-div{display:table-cell;border:0px solid silver;width: 400px; font-weight: 90;}


    .table-div label, .table-div input
    {
        display: block;
        width: 220px;
        float: left;
        margin-bottom: 10px;
    }
 
    .table-div label
    {
        text-align: left;
        padding-right: 60px;
    }
 
    br
    {
        clear: left;
    }
    .wrap {
    max-width:960px;
    margin:auto;
    width:100%;
    display:table;
    font-size:100%;
    border-collapse:collapse;
}
 .no label
    {
        text-align: left;
        padding-right:10px;

    }

.form-group.required .control-label:after { 
   content:"*";
   color:red;
}
    </style>   
<script type="text/javascript">


      //modal of html table fleet
        $(function () { 

            var new_dialog = function (type, row) {

                var dlg = $("#dialog-form").clone();

                var serial = dlg.find(("#serial")),

            brand_type = dlg.find(("#brand_type")),

            brand_size = dlg.find(("#brand_size")),

           

            plate = dlg.find(("#plate"));

                type = type || 'Create';

                var config = {

                    autoOpen: true,

              

                    modal: true,

                    buttons: {

                        "Add Battery": save_data,

                        "Cancel": function () {

                            dlg.dialog("close");

                        }

                    },

                    close: function () {

                        dlg.remove();

                    }

                };

                if (type === 'Edit') {

                    config.title = "Edit User";

                    get_data();

                    delete (config.buttons['Add Battery']);

                    config.buttons['Edit battery'] = function () {

                        row.remove();

                        save_data(); 

                    }; 

                }

                dlg.dialog(config); 

                function get_data() {

                    var
                    _serial= $(row.children().get(0)).text(),

                     _brand_type = $(row.children().get(1)).text(),

                _brand_size = $(row.children().get(2)).text();
                _plate = $(row.children().get(3)).text();


                    serial.val(_serial);

                    brand_type.val(_brand_type);

                    brand_size.val(_brand_size); 
                    plate.val(_plate); 

                } 

                function save_data() {

                    $("#users tbody").append("<tr>" + "<td>" + serial.val() + "</td>" + "<td>" + brand_type.val() + "</td>" + "<td>" + brand_size.val() + "</td>"+ "<td>" + plate.val() + "</td>" + "<td align='center'><a href='' class='edit btn btn-xs btn-primary'> <i class='glyphicon glyphicon-pencil' title='Edit'></i> </a>  <span class='delete btn btn-xs btn-danger' href=''><i class='glyphicon glyphicon-remove' title='Delete Item'></i></a></span></td>"  + "</tr>");


                    dlg.dialog("close");

                }

            }; 

            $(document).on('click', 'span.delete', function () {

                $(this).closest('tr').find('td').fadeOut(1000, 

        function () {

            // alert($(this).text());

            $(this).parents('tr:first').remove();

        }); 

                return false;

            });

            $(document).on('click', 'td a.edit', function () {

                new_dialog('Edit', $(this).parents('tr'));

                return false;

            }); 

            $("#create-user").button().click(new_dialog); 

        });




$(function(){
    //Add, Save, Edit and Delete functions code
  //  $(".btnEdit").bind("click", Edit);
    $(".btnDelete").bind("click", Delete);
    //$("#btnAdd").bind("click", Add);
});

function Delete(){
    var par = $(this).parent().parent(); //tr
    par.remove();
}; 





</script>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>     
<script type="text/javascript">
//datepicker
 $( function() {
    $( "#datepicker" ).datepicker({

        dateFormat: 'MM dd, yy',
    });
  } );

    

</script>
<script>
//option application type


$(document).ready(function(){
    $('input[id="A1"]').attr('disabled', 'disabled');
    $('input[id="level1"]').attr('disabled', 'disabled');
});


$(function() {
    $('input[id="level1"]').click(function() {


        if ($(this).val() == 'commercial') {
            
            $('input[id="A1"]').removeAttr('disabled');
        } else {
            $('input[id="A1"]').attr('disabled', 'disabled');
        }
    });
});
$(function() {
    $('input[id="level0"]').click(function() {

        if ($(this).val() == 'x') {

            $('input[id="level1"]').removeAttr('disabled');

            $('input[id="A1"]').attr('disabled', 'disabled');
           
        } else {
            $('input[id="level1"]').attr('disabled', 'disabled');
            $('input[id="A1"]').attr('disabled', 'disabled');
        }
    });
});




//Battery brand and Size
var batteryBrand = {
    Enduro: ["EnSmall", "EnMedium", "EnLarge", "Others"],
    Gold: ["gSmall", "gMedium", "gLarge", "Others"],
    Excel: ["eSmall", "eMedium", "eLarge", "Tea", "Others"]
}

    function changecat(value) {
        if (value.length == 0) document.getElementById("brand_type_size").innerHTML = "<option></option>";
        else {
            var catOptions = "";
            for (categoryId in batteryBrand[value]) {
                catOptions += "<option>" + batteryBrand[value][categoryId] + "</option>";
            }
            document.getElementById("brand_type_size").innerHTML = catOptions;
        }
    }



    </script>

<script>

function but(){
//setTimeout('redirect()', 5000); 

$('#save').click(window.location.href = "https://www.google.co.in");

window.setTimeout(function(){},5000);
}




</script>
      
  </head>
  <?php

    $id = $_POST["id"];
   
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $company = $_POST["company"];
    $address = $_POST["address"];
    $telephone = $_POST["telephone"];
    $mobile = $_POST["mobile"];
    $ownership_type = $_POST["ownership_type"];



    
    $brand = $_POST["brand"];
    $purchase_date = $_POST["purchase_date"];
    $brand_type_size = $_POST["brand_type_size"];
    $serial_no = $_POST["serial_no"];
    $sales_invoice = $_POST["sales_invoice"];


    $vehicle_make = $_POST["vehicle_make"];
    $vehicle_model = $_POST["vehicle_model"];
    $vehicle_year = $_POST["vehicle_year"];
    $vehicle_plate = $_POST["vehicle_plate"];
    $vehicle_application = $_POST["vehicle_application1"];


    $promo_name = $_POST["promo_name"];
    $active_promo = $_POST["active_promo"];
    $promo_duration = $_POST["promo_duration"];

    $distributor_name = $_POST["distributor_name"];
    $distributor_address = $_POST["distributor_address"];
    $outlet_name = $_POST["outlet_name"];
    $outlet_address = $_POST["outlet_address"];




//convert purchase date datepicker to mysql format
$string_date = date('Y-m-d', strtotime($purchase_date));





// add 2months to purchase date
$string_date2 = date("Y-m-d");
$string_date2 = strtotime(date('Y-m-d', strtotime($purchase_date)). " +2 month");
$string_date2 = date("Y-m-d",$string_date2);
$monthwarranty = "2 months";





//last update field
        date_default_timezone_set("Asia/Manila");
        $a = "@";
        $curr_dt = date("F d, Y");
        $user_logged = wp_get_current_user();
        $userfn = $user_logged->user_firstname;
        $userln = $user_logged->user_lastname;

        $user_role = $user_logged->user_role;

        $reg = $userfn. " ".$userln;
        $last =  $curr_dt. " ".$a." ".date("h:i:sa")." ".$userfn." ".$userln;
        $dateTime = $curr_dt. " ".$a." ".date("h:i:sa")."";


    global  $wpdb;
    
    $wpdb->get_results("SELECT * FROM `wp_battery` WHERE `serial_no` = '$serial_no'");
    $serial_rowcount = $wpdb->num_rows ;

    $wpdb->get_results("SELECT * FROM `wp_vehicle` WHERE `vehicle_plate` = '$vehicle_plate'");
    $vehicle_plate_rowcount = $wpdb->num_rows ;


    //insert
    if (isset($_POST['insert'])) {

        //accounts
        $current_user = wp_get_current_user();
        $roles = $current_user->roles;
        $role = array_shift( $roles );


//Incomplete

        //admin incomplete
        if($role == "administrator" && $vehicle_application =='' || $role == "administrator" && $serial_no == '' || $role == "administrator" && $purchase_date == ''){
            echo "Incomplete Admin ";
                
                    }
        //tsd incomplete
        elseif($role =="tsd" && $serial_no =='' || $role =="tsd" && $outlet_name == '' || $role =="tsd" && $outlet_address == ''|| $role =="tsd" && $purchase_date == ''){
            echo "Incomplete TSD ";
               
                    }
        //marketing incomplete
        elseif ($role = "marketing" && $serial_no =='' || $role =="marketing" && $outlet_name == '' ) {
            echo "Incomplete Marketing";
        }
        //cojv incomplete
        elseif ($role = "cojv" && $fname =='' || $role =="cojv" && $company == '' || $role =="cojv" && $lname == '' || $role =="cojv" && $telephone == '' || $role =="cojv" && $email == '' || $role =="cojv" && $mobile == '' || $role =="cojv" && $address == '' || $role =="cojv" && $ownership_type == '' || $role =="cojv" && $brand == '' || $role =="cojv" && $serial_no == '' || $role =="cojv" && $brand_type_size == '' || $role =="cojv" && $sales_invoice == '' || $role =="cojv" && $purchase_date == '' || $role =="cojv" && $vehicle_application == '' || $role =="cojv" && $vehicle_make == '' || $role =="cojv" && $year == '' || $role =="cojv" && $vehicle_model == '' || $role =="cojv" && $vehicle_plate == '' || $role =="cojv" && $distributor_name == '' || $role =="cojv" && $distributor_address == '' || $role =="cojv" && $outlet_name == '' || $role =="cojv" && $outlet_address == '') {
            echo "Incomplete COJV";
        }
        //Dealer/Distributor incomplete
        elseif ($role = "dealer" && $fname =='' || $role =="dealer" && $lname == '' || $role =="dealer" && $vehicle_application == '' || $role =="dealer" && $brand_type_size == '' || $role =="dealer" && $serial_no == '' || $role =="dealer" && $purchase_date == '') {

            echo "Incomplete Dealer/Distributtor";
        }

//duplicate serial validation or duplicate vehicel plate no
       else if ($serial_rowcount >0 || $vehicle_plate_rowcount >0){
            echo "duplicate";
            $table_name7 = $wpdb->prefix ."warranty_classification";
            $sql7="INSERT INTO ".$table_name7." (id,battery_serial,dateNtime,classification,encoder) VALUES('','$serial_no','$dateTime','Duplicate','$reg') ;";

             $wpdb->query($sql7);        
         }
//valid duplicate

         else if ($serial_rowcount >0 && $vehicle_plate_rowcount >0){

                echo "valid duplicate";
             }



        else{
            //Registered and Tracked


        global $wpdb;
        $table_name1 = $wpdb->prefix ."customer";
        $table_name2 = $wpdb->prefix ."battery";
        $table_name3 = $wpdb->prefix ."distributor";
        $table_name4 = $wpdb->prefix ."vehicle";
        $table_name5 = $wpdb->prefix ."promo";
        $table_name6 = $wpdb->prefix ."warranty";

//registered and track validation
         $table_name7 = $wpdb->prefix ."warranty_classification";
            $sql7="INSERT INTO ".$table_name7." (id,battery_serial,dateNtime,classification,encoder) VALUES('','$serial_no','$dateTime','Registered & Track','$reg') ;";
             $wpdb->query($sql7);
         



        $sql1="INSERT INTO ".$table_name1." (id,fname,lname,mobile,ownership_type,email,address,company,telephone) VALUES('','$fname','$lname','$mobile','$ownership_type','$email','$address','$company','$telephone') ;";
        $sql2="INSERT INTO ".$table_name2." (id,brand,purchase_date,brand_type_size,serial_no,sales_invoice) VALUES('','$brand','$string_date','$brand_type_size','$serial_no','$sales_invoice');";
        $sql3="INSERT INTO ".$table_name4." (id,vehicle_make,vehicle_model,vehicle_year,vehicle_plate,vehicle_application) VALUES('','$vehicle_make','$vehicle_model','$vehicle_year','$vehicle_plate','$vehicle_application');";
        $sql4="INSERT INTO ".$table_name3." (id,distributor_name,distributor_address,outlet_name,outlet_address) VALUES('','$distributor_name','$distributor_address','$outlet_name','$outlet_address');";
        $sql5="INSERT INTO ".$table_name5." (id,promo_name,active_promo,promo_duration) VALUES('','$promo_name','$active_promo','$promo_duration');";


        $sql6=" INSERT INTO ".$table_name6." (id,customer_id,battery_id,promo_id,vehicle_id,distributor_id,last_update,registrant,expires_on,warranty) VALUES ('',LAST_INSERT_ID(),LAST_INSERT_ID(),LAST_INSERT_ID(),LAST_INSERT_ID(),LAST_INSERT_ID(),'$last','$reg','$string_date2','$monthwarranty');";
  
      

              $wpdb->query($sql1);
               $wpdb->query($sql2);
                $wpdb->query($sql3);
                $wpdb->query($sql4);
               $wpdb->query($sql5);
                $wpdb->query($sql6);

        $message.="Warranty inserted";
    }}






    ?>














    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />

    <?php if (isset($message)): ?> <script>  
      
    alert("Warranty inserted successfully!"); 

     </script>   <?php endif; ?>
    <div class="wrap">
    <br>
        <h3>Customer Information Sheet</h3>

       <hr style="border: 1px solid #b5abab">
        
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="myForm">


         
            <div class='table-div form-group required' style="width:100%">

                <div class="tr-div">

                    <th class="ss-th-width" ><b style="color:gray;"><h4>Owner Information</h4></b></th><br>
                  
                </div>



                <div class="tr-div">
                    
                    <div class="td-div"><label class='control-label'>Firstname</label><input type="text" name="fname" required="required" value="<?php echo $fname; ?>" class="ss-field-width "/></div>

                  
                    <div class="td-div"> <label class='control-label'>Company</label><input type="text" name="company" required="required" value="<?php echo $company; ?>" class="ss-field-width"/>

                    </div>
                    
                </div>
            


                <div class="tr-div">

               
                    <div class="td-div"> <label>Lastname</label><input type="text" name="lname" value="<?php echo $lname; ?>" class="ss-field-width" /></div>
                    <div class="td-div"><label>Telephone</label><input type="text" name="telephone" value="<?php echo $telephone; ?>" class="ss-field-width" /></div>
                
                </div>
               


                <div class="tr-div">
                
                    <div class="td-div"><label>Email</label><input type="email" name="email" value="<?php echo $email; ?>" class="ss-field-width" /></div>
                    <div class="td-div"><label>Mobile</label><input type="text" name="mobile" value="<?php echo $mobile; ?>" class="ss-field-width" /></div>
                </div>
                 


                 <div class="tr-div">
                     
                    <div class="td-div"><label>Address</label><input type="text" name="address" value="<?php echo $address; ?>" class="ss-field-width"/></div>
  
                     
                   <div class="td-div">

                        <div class="tr-div">

                            <div class="td-div">
                        <label>Ownership Type</label>
                        </div>
                        <div class="td-div" style="vertical-align: top;">
                        <span class="radio-inline"  >
                    <input type="radio" style="margin-left: -33px; width:10px;" name="ownership_type" value="Owner"<?php echo $ownership_type; ?>>Owner

                    </span>
                    </div>
                    <div class="td-div" style="vertical-align: top;">
                     <span class="radio-inline" >
                    <input type="radio" style="margin-left: -27px; width: 10px;" name="ownership_type" value="Driver"<?php echo $ownership_type; ?>>Driver
                    </span>
                    </div>
                    </div>

                  

                    </div>
                </div>
            


                <div class="tr-div">
                    <th class="ss-th-width"><b style="color:gray;"><h4>Battery</h4></b></th><br>
                </div>


                <div class="tr-div">
                    
                    <div class="td-div"><label style="margin-top: -19px;">Battery Brand</label>

                    <select name="brand" id="brand" onChange="changecat(this.value);" style="margin-top: -46px; width: 218px;">
                    <option value="" disabled selected>Select</option>
                    <option value="Enduro">Enduro</option>
                    <option value="Gold">Gold</option>
                    <option value="Excel">Excel</option>
                    </select>

                    </div>
             

                    
                    <div class="td-div"><label>Battery Serial No.</label><input type="text" name="serial_no" value="<?php echo $serial_no; ?>" class="ss-field-width"/></div>
                </div>



                 <div class="tr-div">
                    
                    <div class="td-div"><label style="margin-top: -19px; ">Battery Brand Type Size</label>

                <select name="brand_type_size" id="brand_type_size"  style="margin-top: -46px; width: 218px;">
                <option value="" disabled selected>Select</option>
                </select>


                    </div>

                
                   
                    <div class="td-div"> <label>Sales Invoice</label><input type="text" name="sales_invoice" value="<?php echo $sales_invoice; ?>" class="ss-field-width" /></div>
                </div>


                 <div class="tr-div">

                 
                    <div class="td-div"><label>Battery Purchase Date</label><input name="purchase_date" id = 'datepicker' placeholder="Select purchase date"  type="text" value="">
                        <!--
echo date('F d, Y');  default value today
                        -->
                    </div>
                    
                </div>

         </div>
         <!--
         <hr style="border: 1px solid #d3d3d3">
         <h5><i>This section is for multiple battery purchase</i></h5>

<button class="btn btn-success" onclick="return false" id="create-user" ><i class="glyphicon glyphicon-plus"></i> Add Battery</button>  

<div align="center">
<br>

       <table id="users" class="table table-striped table-bordered " width="100%" cellspacing="0">

            <thead>

                <tr>

                    <th><center>Serial </center></th>
                    <th><center>Brand Type </center></th>
                    <th><center>Brand Size</center></th>
                    <th><center>Plate No.</center></th>

                    <th style="width: 90px; "> <center>Actions</center></th>

                </tr>

            </thead>

             <tfoot>
    <tr>
      <td style="font-style: italic; color: gray;" align="center">Serial</td>
      <td style="font-style: italic; color: gray;" align="center">Brand Type</td>
      <td style="font-style: italic; color: gray;" align="center">Brand Size</td>
      <td style="font-style: italic; color: gray;" align="center">Plate No.</td>
      <td style="font-style: italic; color: gray;" align="center">Actions</td>
    </tr>
  </tfoot>

            <tbody>

                <tr> 



                </tr>

            </tbody>

        </table>

    </div>

<hr style="border: 1px solid #d3d3d3">
         <div class='table-div' style="width:100%">

                   <div class="tr-div">
                    <th class="ss-th-width"><b style="color:gray;"><h4>Promo</h4></b></th><br>
                </div>


                <div class="tr-div">
                    
                    <div class="td-div"><label>Promo Name</label><input type="text" name="promo_name" value="<?php echo $promo_name; ?>" class="ss-field-width"/></div>

                    
                    <div class="td-div"><label>Active Promo</label><input type="text" name="active_promo" value="<?php echo $active_promo; ?>" class="ss-field-width" /></div>
                </div>


             
                <div class="tr-div">
                   
                    <div class="td-div"> <label>Promo Duration</label><input type="text" name="promo_duration" value="<?php echo $promo_duration; ?>" class="ss-field-width"/></div>

                    
                    
                </div>
-->
                   <div class="tr-div">
                    <th class="ss-th-width"><b style="color:gray;"><h4>Application <span style="font-size: 13px;">(please select appropriate application)</span></h4></b></th><br>
                </div>




             
<!---
</div>
-->

<div class='table-div' style="width:100%">

    <div class="" style="margin-left:30px">
        <input type="radio" name="vehicle_application1" value="x" id="level0" style="width:10px; margin-left: -3px;"/>
        <label for="A" style=" margin-left: 12px;" >Automotive</label><br>
        <div class="sub1">
            <div style="margin-left:80px" >
                <input type="radio" name="vehicle_application2" value="0" id="level1" style="width:10px; margin-left: -30px;"/>
                <label for="A0">Private</label><br>
            </div>
            <div style="margin-left:80px">
                <input type="radio" name="vehicle_application2" value="commercial" id="level1" style="width:10px; margin-left: -30px;"/>
                <label for="A1">Commercial</label><br>
                
                
            <div class="sub3 tr-div">
            <div style="" class="td-div">
                <span class="radio-inline2 ">
                <input type="radio" name="vehicle_application" value="1" id="A1" style="width:10px"/>
                <label for="A0" style="margin-left:100px; width: 300px; font-weight: normal;">Commercial Haul Vehicle</label><br>
                </span>
                <span class="radio-inline2 ">
                <input type="radio" name="vehicle_application" value="2" id="A1" style="width:10px"/>
                <label for="A0" style="margin-left:100px; width: 350px; font-weight: normal;">Public Utility Vehicle (Bus, Jeep, Taxi)</label><br>
                </span>
                <span class="radio-inline2 ">
                <input type="radio" name="vehicle_application" value="3" id="A1" style="width:10px"/>
                <label for="A0" style="margin-left:100px; width: 350px; font-weight: normal;">Service Vehicle (Airport Taxi/Limo Service)</label><br>
                </span>
                <span class="radio-inline2 ">
                <input type="radio" name="vehicle_application" value="4" id="A1" style="width:10px"/>
                <label for="A0" style="margin-left:100px; width: 300px; font-weight: normal;">Construction Vehicle</label><br>
                </span>
            </div>

            <div style="" class="td-div">
                <span class="radio-inline2">
                <input type="radio" name="vehicle_application" value="5" id="A1" style="width:10px"/>
                <label for="A1" style="margin-left:100px; font-weight: normal;">Logging Vehicle</label><br>
                </span>
                <span class="radio-inline2">
                <input type="radio" name="vehicle_application" value="6" id="A1" style="width:10px"/>
                <label for="A1" style="margin-left:100px; font-weight: normal;">Fish Boat</label><br>
                </span>
                <span class="radio-inline2">
                <input type="radio" name="vehicle_application" value="7" id="A1" style="width:10px"/>
                <label for="A1" style="margin-left:100px; font-weight: normal;">Non-Automotive</label><br>
                </span>

            </div>
                
            </div>
        </div>
    </div>
    <div style="margin-left:30px">
        <input type="radio" name="vehicle_application1" value="-1" id="level0" style="width:10px; margin-left: -32px;"/>
        <label for="B">Industrial</label>
        
    </div>
    

</div>



</div>
<div class='table-div' style="width:100%">

                   <div class="tr-div">
                    <th class="ss-th-width"><b style="color:gray;"><h4>Vehicle</h4></b></th><br>
                </div>


                 <div class="tr-div">
                    
                    <div class="td-div"><label>Vehicle Make</label><input type="text" name="vehicle_make" value="<?php echo $vehicle_make; ?>" class="ss-field-width"/></div>

                                 
                    <div class="td-div"><label>Vehicle Year</label><input type="text" name="vehicle_year" value="<?php echo $vehicle_year; ?>" class="ss-field-width"/></div>
                </div>


                <div class="tr-div">
                    
                    <div class="td-div"><label>Vehicle Model</label><input type="text" name="vehicle_model" value="<?php echo $vehicle_model; ?>" class="ss-field-width"/></div>

                     
                    <div class="td-div"><label>Plate No.</label><input type="text" name="vehicle_plate" value="<?php echo $vehicle_plate; ?>" class="ss-field-width"/></div>
                </div>
               

                   <div class="tr-div">
                    <th class="ss-th-width"><b style="color:gray;"><h4>Distributor</h4></b></th><br>
                </div>



                 <div class="tr-div">
                    
                    <div class="td-div"><label>Distributor Name</label><input type="text" name="distributor_name" value="<?php echo $distributor_name; ?>" class="ss-field-width" /></div>
              
                    
                    <div class="td-div"><label>Distributor Address</label><input type="text" name="distributor_address" value="<?php echo $distributor_address; ?>" class="ss-field-width" /></div>

                </div>
                <div class="tr-div">
                    
                    <div class="td-div"><label>Outlet Name</label><input type="text" name="outlet_name" value="<?php echo $outlet_name; ?>" class="ss-field-width" /></div>
              
                    
                    <div class="td-div"><label>Outlet Address</label><input type="text" name="outlet_address" value="<?php echo $outlet_address; ?>" class="ss-field-width" /></div>

                </div>

                <div>
                <th class="ss-th-width"><b><h1></h1></b></th>
                </div>



            </div>
            <br>
                <hr style="border: 1px solid #b5abab">
            <input type='submit' name="insert" value='Save' class='button' id="save">

             <input onclick="but()" type='submit' name="saveandexit" value='Save and Exit' class='button' id="save">

             <a href="<?php echo admin_url('admin.php?page=sinetiks_warranty_list'); ?>"> <input type='button' name="cancel" value='Cancel' class='button' ></a>


        </form>

  
    </div>



<!-- Form -->
<div id="dialog-form" title="Add Battery" style="width: 255px; height: 200px;">
     

            <form style="margin-top: -15px; width: 277px;">

        <fieldset>

          

                <input type="text" name="serial" id="serial" value="" class="text ui-widget-content ui-corner-all" placeholder="Serial No." />
               
      
            <input type="text" name="brand_type" id="brand_type" value="" class="text ui-widget-content ui-corner-all" placeholder="Brand Type" />

        

            <input type="text" name="brand_size" id="brand_size" value="" class="text ui-widget-content ui-corner-all" placeholder="Brand Size" />
           
            <input type="text" name="plate" id="plate" value="" class="text ui-widget-content ui-corner-all" placeholder="Plate No." />

        </fieldset>

        </form>






    </div>




    <?php
}






