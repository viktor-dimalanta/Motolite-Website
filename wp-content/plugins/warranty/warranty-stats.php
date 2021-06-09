<?php

function sinetiks_warranty_stats() {


    global $wpdb;


    $table_name = $wpdb->prefix . "warranty";
          $table_name2 = $wpdb->prefix ."battery";
        $table_name3 = $wpdb->prefix ."customer";
        $table_name4 = $wpdb->prefix ."vehicle";
        $table_name5 = $wpdb->prefix ."promo";
        $table_name6 = $wpdb->prefix ."distributor";
         

    $id = $_GET["id"];

    



        $warranty = $wpdb->get_results($wpdb->prepare("SELECT id,expires_on from $table_name where id=%s", $id));
        $battery = $wpdb->get_results($wpdb->prepare("SELECT id,brand,purchase_date,brand_type_size,serial_no,sales_invoice from $table_name2 where id=%s", $id));
         $customer = $wpdb->get_results($wpdb->prepare("SELECT id,fname,lname,mobile,ownership_type,email,address,company,telephone from $table_name3 where id=%s", $id));
         $promo = $wpdb->get_results($wpdb->prepare("SELECT id,promo_name,active_promo,promo_duration from $table_name5 where id=%s", $id));
         $vehicle = $wpdb->get_results($wpdb->prepare("SELECT id,vehicle_make,vehicle_model,vehicle_year,vehicle_plate,vehicle_application from $table_name4 where id=%s", $id));
         $distributor = $wpdb->get_results($wpdb->prepare("SELECT id,distributor_name,distributor_address,outlet_name,outlet_address from $table_name6 where id=%s", $id));



        foreach ($warranty as $w ) 
            foreach ($battery as $b)
                foreach ($customer as $c)
                    foreach ($promo as $p)
                        foreach ($vehicle as $v)
                            foreach ($distributor as $d) {



            $brand = $b->brand;
            $purchase_date = $b->purchase_date;
            $brand_type_size = $b->brand_type_size;
            $serial_no = $b->serial_no;
            $sales_invoice = $b->sales_invoice;


            $fname = $c->fname;
            $lname = $c->lname;
            $mobile = $c->mobile;
            $email = $c->email;
            $address = $c->address;
            $company = $c->company;
            $telephone = $c->telephone;
            $ownership_type = $c->ownership_type;


            $promo_name = $p->promo_name;
            $promo_duration = $p->promo_duration;
            $active_promo = $p->active_promo;

            $vehicle_make = $v->vehicle_make;
            $vehicle_model = $v->vehicle_model;
            $vehicle_year = $v->vehicle_year;
            $vehicle_plate = $v->vehicle_plate;
            $vehicle_application = $v->vehicle_application;


            $distributor_name = $d->distributor_name;
            $distributor_address = $d->distributor_address;
            $outlet_name = $d->outlet_name;
            $outlet_address = $d->outlet_address;


        }
    
    ?>



 <head>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   


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
.btn-circle.btn-xl {
 
    width: 157px;
    height: 153px;
    padding: 22px 16px;
    font-size: 24px;
    line-height: 1.33;
    border-radius: 86px;
}

.glyphicon-xl {
 
    font-size: 2.5em;
}
    </style>   

      
  </head>





    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/warranty/style-admin.css" rel="stylesheet" />
    <div class="wrap">
    <br>
        <h3>Statistics</h3>
       <hr style="border: 1px solid #f00">
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>

        <a href=# title="Convert to CSV">
        <i class="fa fa-file-excel-o" style="font-size:20px;color:green; float: right;"></i>

        </a>

        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="myForm">


         
            <div class='table-div' style="width:100%; margin-left: 20px;">

                <div class="tr-div">

                    <th class="ss-th-width" >   </th><br>
                  
                </div>



                <div class="tr-div">
                    
                    <div class="td-div"><label>Username</label><input type="text" name="fname" readonly value="<?php echo $fname; ?>" class="ss-field-width"/></div>

                  
                    <div class="td-div"> <label>Store Address</label><input type="text" name="outlet_address" readonly value="<?php echo $outlet_address; ?>" class="ss-field-width"/>
                    </div>
                    
                </div>
            


                <div class="tr-div">

               
                     <div class="td-div"><label>Firstname</label><input type="text" name="fname" readonly value="<?php echo $fname; ?>" class="ss-field-width"/></div>
                    <div class="td-div"><label>Distributor</label><input type="text" name="distributor_name"  readonly value="<?php echo $distributor_name; ?>" class="ss-field-width" /></div>
                
                </div>
               


                <div class="tr-div">
                
                    <div class="td-div"> <label>Lastname</label><input type="text" name="lname" readonly value="<?php echo $lname; ?>" class="ss-field-width" /></div>
                    <div class="td-div"><label>Branch</label><input type="text" name="distributor_address" readonly value="<?php echo $distributor_address; ?>" class="ss-field-width" /></div>
                </div>
                 


                 <div class="tr-div">
                     
                    <div class="td-div"><label>Email</label><input type="email" name="email" readonly value="<?php echo $email; ?>" class="ss-field-width" /></div>

                     <div class="td-div"><label>Last Entry Submission</label><input type="text" name="last" readonly value="<?php echo $last_entry_date; ?>" class="ss-field-width"/></div>


  
                    </div>  
          
               
                </div>
            


<br>

                <hr style="border: 1px solid #f00">

         
        </form>

  
 <div class='table-div' style="width:100%">

                    <div class="tr-div" >
                     


                    <div class="td-div" style="padding: 15px; vertical-align: middle ">
                    <span class="btn btn-lg btn-success btn-block " style="height: 80px; ">
                    <table align="center" width="100%">
                    <tr>
                    <td align="left">
                    <font size=8px><?php echo  "20"?></font>
                    </td>
                    <td>
                    &nbsp; Average Entries a day&nbsp;&nbsp;

                    </td>
                    <td>
                    <i class="glyphicon glyphicon-thumbs-up glyphicon-xl" ></i>
                    </td>
                    </tr>
                    </table>
                    </span>

                    </div>






                    
                       <div class="td-div" style="padding: 15px; vertical-align: middle ">
                    <button type="button" class="btn btn-lg btn-info btn-block" style="height: 80px; ">
                    <table align="center" width="100%">
                    <tr>
                    <td align="left"> 
                    <font size=13px><?php echo  "30"?></font>
                    </td>
                    <td>
                    &nbsp;Weekly Entries&nbsp;&nbsp;

                    </td>
                    <td>
                    <i class="glyphicon glyphicon-list-alt glyphicon-xl" ></i>
                    </td>
                    </tr>
                    </table>
                    </button>

                    </div>



                    
                      <div class="td-div" style="padding: 15px; vertical-align: middle ">
                    <button type="button" class="btn btn-lg btn-primary btn-block" style="height: 80px; ">
                    <table align="center" width="100%">
                    <tr>
                    <td align="left">
                    <font size=13px><?php echo  "50"?></font>
                    </td>
                    <td>
                    &nbsp;Monthly Entries&nbsp;&nbsp;

                    </td>
                    <td>
                    <i class="glyphicon glyphicon-calendar glyphicon-xl" ></i>
                    </td>
                    </tr>
                    </table>
                    </button>

                    </div>

                    </div>

                    <div class="tr-div" >
                     
                    <div class="td-div" style="padding: 15px; vertical-align: middle ">
                    <button type="button" class="btn btn-lg btn-warning btn-block" style="height: 80px; ">
                    <table align="center" width="100%">
                    <tr>
                    <td align="left">
                    <font size=13px><?php echo  "30"?></font>
                    </td>
                    <td>
                    &nbsp;Total Average Entries&nbsp;&nbsp;

                    </td>
                    <td>
                    <i class="glyphicon glyphicon-check glyphicon-xl" ></i>
                    </td>
                    </tr>
                    </table>
                    </button>
                    </div>


                    <div class="td-div" style="padding: 15px; " align="center"; >
                    <button type="button" class="btn btn-circle btn-danger btn-xl"><font size=13px><?php echo  "70%"?></font>&nbsp; <br><span style="font-size: 15px;">Productivity</span></button>
                    </div>



                       <div class="td-div" style="padding: 15px; vertical-align: middle ">
                    <button type="button" class="btn btn-lg btn-warning btn-block" style="height: 80px; ">
                    <table align="center" width="100%">
                    <tr>
                    <td align="left">
                    <font size=13px><?php echo  "20"?></font>
                    </td>
                    <td>
                    &nbsp;Duplicate Entries&nbsp;&nbsp;

                    </td>
                    <td>
                    <i class="glyphicon glyphicon-duplicate glyphicon-xl" ></i>
                    </td>
                    </tr>
                    </table>
                    </button>

                    </div>


                    </div>

                    <div class="tr-div" >
                     
                    <div class="td-div" style="padding: 15px; vertical-align: middle ">
                    <button type="button" class="btn btn-lg btn-info btn-block" style="height: 80px; ">
                    <table align="center" width="100%">
                    <tr>
                    <td align="left">
                    <font size=13px><?php echo  "10"?></font>
                    </td>
                    <td>
                    &nbsp;Incomplete Entries&nbsp;&nbsp;

                    </td>
                    <td>
                    <i class="glyphicon glyphicon-alert glyphicon-xl" ></i>
                    </td>
                    </tr>
                    </table>
                    </button>
                    </div>



                    <div class="td-div" style="padding: 15px; " align="center">
                  <button type="button" class="btn  btn-block" style="height: 40px; width: 80px" title="Email to Encoder"> Email</button>

                    </div>

            
                    <div class="td-div" style="padding: 15px; vertical-align: middle ">
                    <button type="button" class="btn btn-lg btn-info btn-block" style="height: 80px; ">
                    <table align="center" width="100%">
                    <tr>
                    <td align="left">
                    <font size=13px><?php echo  "10"?></font>
                    </td>
                    <td>
                    &nbsp;Valid Duplicate &nbsp;&nbsp;

                    </td>
                    <td>
                    <i class="glyphicon glyphicon-pushpin glyphicon-xl" ></i>
                    </td>
                    </tr>
                    </table>
                    </button>
                    </div>
</div>

 </div>
  <hr style="border: 1px solid #f00">
 </div>  
          








    <?php
}









