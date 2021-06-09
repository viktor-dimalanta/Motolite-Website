<?php

function sinetiks_warranty_create_encoder() {

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
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css"
    rel="stylesheet" type="text/css" /> 








    <style type="text/css">
        


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


    </style>   


 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
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
//validation
function checkform()
{

 if (myForm.user_password.value != myForm.confirm_pass.value )
 {
alert('Sorry password combination is not correct\nInput password again!');
    return false;
}
else {

  return true;
}


}


</script>
      
  </head>

  <?php ob_start();

    $id = $_POST["id"];
    $user_login = $_POST["user_login"];
    $type = $_POST["type"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $user_email = $_POST["user_email"];
    $address = $_POST["address"];
    $distributor_name = $_POST["distributor_name"];
    $distributor_address = $_POST["distributor_address"];
    $outletname = $_POST["outletname"];
    $outletaddress = $_POST["outletaddress"];
     $branch = $_POST["branch"];
    $telephone = $_POST["telephone"];
    $status = $_POST["status"];
    $user_password = $_POST["user_password"];




    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name1 = $wpdb->prefix ."users";
        $table_name2 = $wpdb->prefix ."user_ext";
        $table_name3 = $wpdb->prefix ."usermeta";

        $authid = $wpdb->insert_id;
        //$cap = "a:1:{s:7:\"encoder\";b:1;}";

        //$cojv = "a:1:{s:7:\"cojv\";b:1;}";
       // $dealer = "a:1:{s:7:\"dealer\";b:1;}";

        if ($_POST["type"] == 'Company Owned JV'){
           $cap = "a:1:{s:4:\"cojv\";b:1;}";

        } else {
          $cap = "a:1:{s:6:\"dealer\";b:1;}";
        }


       // $sq = 'LAST_INSERT_ID()';
       // $sq_q = "SELECT * FROM ".$table_name2." WHERE id = $sq ";





        $sql1="INSERT INTO ".$table_name1." (id,user_email,user_login,user_pass,user_nicename,user_registered,user_status,display_name) VALUES('','$user_email','$user_login',MD5('$user_password'),'$fname$lname',now(),'$status','$user_login') ;";

        $sql2="INSERT INTO ".$table_name2." (id,fname,lname,distributor_name,distributor_address,outletname,outletaddress,branch,telephone,status,address,type) VALUES(LAST_INSERT_ID(),'$fname','$lname','$distributor_name','$distributor_address','$outletname','$outletaddress','$branch','$telephone','$status','$address','$type');";




          $sql3="INSERT INTO ".$table_name3." (umeta_id,user_id,meta_key,meta_value) VALUES


          ('',(select MAX(id) FROM wp_users),'nickname',' $fname'),
          ('',(select MAX(id) FROM wp_users),'first_name',' $fname'),
          ('',(select MAX(id) FROM wp_users),'last_name',' $lname'),
          ('',(select MAX(id) FROM wp_users),'description',''),
          ('',(select MAX(id) FROM wp_users),'rich_editing','true'),
          ('',(select MAX(id) FROM wp_users),'comment_shortcuts','false'),
          ('',(select MAX(id) FROM wp_users),'admin_color',' fresh'),
          ('',(select MAX(id) FROM wp_users),'use_ssl','0'),
          ('',(select MAX(id) FROM wp_users),'show_admin_bar_front',' true'),
          ('',(select MAX(id) FROM wp_users),'locale',''),
          
          ('',(select MAX(id) FROM wp_users),'wp_user_level',' 10'),
          ('',(select MAX(id) FROM wp_users),'dismissed_wp_pointers',''),
          ('',(select MAX(id) FROM wp_users),'ja_disable_user',' 0'),
          ('',(select MAX(id) FROM wp_users),'wp_dashboard_quick_press_last_post_id','12');";
         
      
    
$sql4 = "INSERT INTO ".$table_name3." (umeta_id,user_id,meta_key,meta_value) VALUES('',(select MAX(id) FROM wp_users),'wp_capabilities','$cap')";



        //ALTER TABLE `wp_usermeta` CHANGE `user_id` `user_id` VARCHAR(20) NULL;
          /**
          ALTER TABLE wp_usermeta AUTO_INCREMENT = 1;
          ALTER TABLE wp_users AUTO_INCREMENT = 1;
          ALTER TABLE wp_user_ext AUTO_INCREMENT = 1;


            **/

              $wpdb->query($sql1);  
               $wpdb->query($sql2);
                $wpdb->query($sql3);
                $wpdb->query($sql4);
               
         
        $message.="New User Created!";
    }


    ?>


    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />

    <?php if (isset($message)): ?> <script>  
      
 

     </script>   <?php endif; ?>
    <div class="wrap">
    <br>
        <h3>Create Encoder</h3>

       <hr style="border: 1px solid #f00">
        
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="myForm" name="myForm"  onSubmit="return checkform(this);"> 


         
            <div class='table-div' style="width:100%">

<br>
            <div class="tr-div">
                    
                   

            <div class="td-div"><label>Type</label>



            <select name="type" value="<?php echo $type; ?>" class="ss-field-width" style = "width: 100px; margin-bottom: 10px">
          <option value="Company Owned JV">Company Owned JV</option>
        <option value="Dealer">Dealer</option>
  
      </select>
            </div>
                  
                     
                    
                    </div>
       
                <div class="tr-div">
                    
                    <div class="td-div"><label>Firstname<font color=red size=4px;>*</font></label><input type="text" name="fname" value="<?php echo $fname; ?>" class="ss-field-width" required/> </div>

                  
                    <div class="td-div"> <label>Outlet Name</label><input type="text" name="outletname" value="<?php echo $outletname; ?>" class="ss-field-width"/>

                    </div>
                    
                </div>
            


                <div class="tr-div">

               
                    <div class="td-div"> <label>Lastname</label><input type="text" name="lname" value="<?php echo $lname; ?>" class="ss-field-width" /></div>
                    <div class="td-div"><label>Outlet Address</label><input type="text" name="outletaddress" value="<?php echo $outletaddress; ?>" class="ss-field-width" /></div>
                
                </div>
               


                <div class="tr-div">
                
                    <div class="td-div"><label>Email</label><input type="email" name="user_email" value="<?php echo $user_email; ?>" class="ss-field-width" /></div>
                    <div class="td-div"><label>Outlet Branch</label><input type="text" name="branch" value="<?php echo $branch; ?>" class="ss-field-width" /></div>
                </div>
                 


                 <div class="tr-div">
                     
                    <div class="td-div"><label>Address</label><input type="text" name="address" value="<?php echo $address; ?>" class="ss-field-width"/></div>
  
                     <div class="td-div"><label>Outlet Tel No.</label><input type="text" name="telephone" value="<?php echo $telephone; ?>" class="ss-field-width"/></div>
               
                </div>
            



                <div class="tr-div">
                    
                    <div class="td-div"><label>Distributor Name</label><input type="text" name="distributor_name" value="<?php echo $distributor_name; ?>" class="ss-field-width" /></div>
             

                    
                    <div class="td-div"><label>Distributor Address</label><input type="text" name="distributor_address" value="<?php echo $distributor_address; ?>" class="ss-field-width"/></div>
                </div>



                 <div class="tr-div">
                    
                    <div class="td-div"><label>Status</label>



            <select name="status" value="<?php echo $status; ?>" class="ss-field-width" style = "width: 100px; margin-bottom: 10px">
          <option value="1">Live</option>
        <option value="0">Draft</option>
  
      </select>
            </div>
                   
                   
                </div>

                <h4> <span style="color: gray">Password</span></h4>
<br>
    <div class="tr-div">
    <div class="td-div"><label>User Login</label><input type="text" name="user_login" value="<?php echo $user_login; ?>" class="ss-field-width" required maxlength="15"/><span id="user-result"></span></div>


    </div>

                <div class="tr-div">
                    <div class="td-div"><label>Create password</label><input type="password" name="user_password" value="<?php echo $password; ?>" pattern=".{10,}" required title="Minimum 10 characters required" class="ss-field-width" required/></div>

                </div>
                  <div class="tr-div">
                    
                    <div class="td-div"><label>Confirm password</label><input type="password" name="confirm_pass" value="<?php echo $confirm_pass; ?>" class="ss-field-width" required/></div>

                </div>

   

         </div>
         
            <br>
                <hr style="border: 1px solid #f00">
            <input type='submit' name="insert" value='Save' class='button' id="save">

             <a href="<?php echo admin_url('admin.php?page=sinetiks_warranty_list'); ?>"> <input type='button' name="cancel" value='Cancel' class='button' ></a>


        </form>

  
    </div>


    <?php
}






