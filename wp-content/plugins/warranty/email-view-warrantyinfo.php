<?php ob_start(); 

function view_warranty_email() {



global $wpdb;



        $table_name = $wpdb->prefix . "warranty";
        $table_name2 = $wpdb->prefix ."battery";
        $table_name3 = $wpdb->prefix ."customer";
        $table_name4 = $wpdb->prefix ."vehicle";
        $table_name5 = $wpdb->prefix ."promo";
        $table_name6 = $wpdb->prefix ."distributor";



 $id = $_GET["id"];



        $warranty = $wpdb->get_results($wpdb->prepare("SELECT id,expires_on,warranty from $table_name where id=%s", $id));
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




            $expires_on = $w->expires_on;
            $warranty = $w->warranty;

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

//change date format for purchase date popup
$myDateTime = DateTime::createFromFormat('Y-m-d', $purchase_date);
$newDateString = $myDateTime->format('F d, Y');
//change date format for expires date popup
$myDateTime = DateTime::createFromFormat('Y-m-d', $expires_on);
$newDateString2 = $myDateTime->format('F d, Y');


//imgsrc depends on type


if ($brand == "Enduro"){

$imagesrc = 'images/motolite_images/enduro.jpg';

} else if ($brand == "Excel") {
$imagesrc = 'images/motolite_images/excel.jpg';

}
else{
  $imagesrc = 'images/motolite_images/gold.jpg';
}

}

  echo "

    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js'></script>
    <script>
        $(document).ready(function() {
        $('#download_pdf').click(function () {
        var pdf = new jsPDF('p', 'pt', 'letter')
        , source = $('#dvContainer2')[0]
        , specialElementHandlers = {
        '#bypassme': function(element, renderer)
        {      
          return true
        }
        }
        margins = {
       top: 40,
    bottom: 60,
    left: 60,
    width: 522
        };
        pdf.fromHTML(
          source
          , margins.left
          , margins.top 
          , {
            'width': margins.width 
            , 'elementHandlers': specialElementHandlers
          },
        function (dispose) {
          pdf.save('Warranty-information.pdf');
        },
        margins
        )
      });
      });
    </script>


<script>
 var id = ".$id."; 
$(function () {
      $('.SendEmail').click(function (event) {
        var email = 'someone@gmail.com';
        var subject = 'Battery Warranty';
       
        var emailBody = window.location.protocol + '/' + window.location.host + '/' + window.location.pathname + '?page=view_warranty_email'+'%26id=' +id;
       
       document.location = 'mailto:'+email+'?subject='+subject+'&body='+emailBody;
    
      });
    });
</script>

<script>
function print_this(){

 var divContents = $('#dvContainer').html();
            var printWindow = window.open('', '', 'height=800,width=1000');
           printWindow.document.write('<html><head><style >@media print {.controls{ display:none; }.DoPrint{ display:div; }} input {border: none;background: transparent; }</style><title>www.motolite.com</title>');

            printWindow.document.write('</head><body><h2>Warranty Information<br><hr></h2>');
           printWindow.document.write(divContents);
            printWindow.document.write('<br><h5> <center>Motolite.com ?? 2017 </center></h5></body></html>');
          printWindow.document.close();
            printWindow.print();


            printWindow.onclose = ( printWindow.close());

  

 
}
</script>
";
echo "
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>


<h3>Warranty Information</h3><hr style='border-width: 2px;'> <br>
<center>
  <div id='dvContainer'>
<table>
<tr>
<td>
      <div>
  
       Serial No. <input type='text' name='serial_no' value='".$serial_no."' readonly style='margin-left:80px;' /> <br>
       </div>
       <div style='margin-top: 5px;'>
        Owner Name <input type='text' value='".$fname." ".$lname."' readonly style='margin-left: 58px;' /><br/> 
        </div>
       <div style='margin-top: 5px;'>
        Vehicle Plate No. <input type='text' value='".$vehicle_plate."' id='company' readonly style='margin-left: 34px;' /><br/> 
        </div>
       <div style='margin-top: 5px;'>
        Purchased Date <input type='text' value='".$newDateString."' id='company' readonly style='margin-left: 40px;' /><br/> 
        </div >
       <div style='margin-top: 5px;'>
        Battery <input type='text' value='".$brand."' id='company' readonly style='margin-left: 94px;' /><br/> 
        </div>
       <div style='margin-top: 5px;'>
        Warranty Period <input type='text' value='".$warranty."' id='company' readonly style='margin-left: 38px;' /><br/> 
        </div>
       <div style='margin-top: 5px;'>
        End of Warranty<input type='text' value='".$newDateString2."' id='company' readonly style='margin-left: 41px;' /><br/> 
        </div>
       <div style='margin-top: 5px;'>
        Outlet Name<input type='text' value='".$outlet_name."' id='company' readonly style='margin-left: 62px;' /><br/> 
        </div>
       <div style='margin-top: 5px;'>
        Outlet Address <input type='text' value='".$outlet_address."' id='company' readonly style='margin-left: 44px;' /><br/> 
        </div>
</td>
<td valign='top'>

<img src='".$imagesrc."' width='200' height='200' style='margin-left: 30px;' /><br><br>
<div style='margin-left: 20px;' class='controls' id='controls';>

<button class='btn btn-success' onclick='print_this()' ><i class='glyphicon glyphicon-print'></i> Print </button>
<button class='btn btn-success' id='download_pdf'><i class='glyphicon glyphicon-file'></i> PDF </button>
<button class='SendEmail btn btn-success' ><i class='glyphicon glyphicon-envelope'></i> Email </button>
</div>
</td>

        </tr>

</table> 
</div>
            
<hr style='border-width: 2px;'> 

<div id='dvContainer2' style='display: none; '>

                   <div class='tr-div'>
                   
                   <hr>
                    <th class='ss-th-width'><b style='color:gray;'><h2>Warranty Information</h2></b></th><br><br>

                    <img src='".$imagesrc."'width='200' height='200' style='margin-left: 30px; float:right;' />
                </div>


                 <div class='tr-div'>
                    
                    <div class='td-div'><p style='margin-left: 30px; '><font size= 4px;><b>Serial No.       :</b>    <font color='gray' >".$serial_no."</font></font></div>
                    <div class='td-div'><p style='margin-left: 30px; '><font size= 4px;><b>Owner Name.      :</b>   <font color='gray' >".$fname."</font></font></p></div>
                    <div class='td-div'><p style='margin-left: 30px; '><font size= 4px;><b>Vehicle Plate No.      :</b>   <font color='gray' >".$vehicle_plate."</font></font></p></div>
                    <div class='td-div'><p style='margin-left: 30px; '><font size= 4px;><b>Purchased Date      : </b>  <font color='gray' >".$newDateString."</font></font></p></div>
                    <div class='td-div'><p style='margin-left: 30px; '  q><font size= 4px;><b>Battery :</b> <font color='gray' >".$brand."</font></font></p></div>
                    <div class='td-div'><p style='margin-left: 30px; '><font size= 4px;><b>Warranty Period      :</b>   <font color='gray' >".$warranty."</font></font></p></div>
                    <div class='td-div'><p style='margin-left: 30px; '><font size= 4px;><b>End of Warranty     :</b>   <font color='gray'>".$newDateString2."</font></font></p></div>
                    <div class='td-div'><p style='margin-left: 30px; '><font size= 4px;><b>Outlet Name      : </b>  <font color='gray' >".$outlet_name."</font></font></p></div>
                    <div class='td-div'><p style='margin-left: 30px;'><font size= 4px;><b>Outlet Address      : </b>  <font color='gray' >".$outlet_address."</font></font></p></div>
                 




                </div>

<hr>

            </div>


";  
 
}
?>

