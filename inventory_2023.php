<?php
session_start();
if($_SESSION['ugroup']=='Admin'){
    include 'header.php';
    include 'dbconn_backup.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
       <script> "https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"</script>
        
    <title>inventory for 2022-2023</title>
</head>
<body style="font-size:medium;">
<h1 class="text-warning text-center">Inventory:inventory for 2022-2023</h1>
   <div class="container-fluid">
<div class="row">
<div class="col">
   <form method='post'>
    
    <input type=text name="vendors"
     placeholder="type vendor name">
    <button type=submit name="search"> search</button>
<div style="overflow:auto">
<table class="table table-hover table-bordered table-striped">
<thead>
<tr>
<th>NO.</th>
<th>Product Name</th>
<th>Model</th>
<th>Serial No.</th>
<th>Name</th>
<th>Licence Term</th>
<th>License Start Date</th>
<th>License End Date</th>
<th>Use Case</th>
<th>License Status</th>
<th>SI</th>
<th>PO Price </th>
<th>Remarks</th>


</tr>
</thead>
<tbody>
<?php
date_default_timezone_set("Asia/Yangon");

$currentDate = date("Y-m-d");
$moreOneMonth = date("Y-m-d",strtotime("+ 1months"));
$moreTenDay=date("Y-m-d",strtotime("+ 10day"));
$licenseExpired= "";

//echo $moreOneMonth;
$string=$_POST['vendors'];
if(isset($_POST['search'])){
    if($_POST['vendors']=="Cisco" || "cisco" ){
    $sql="SELECT * FROM inventory2023 WHERE product_vendors=\"cisco\"";
$result = $conn->query($sql);
if(!$result){
    die("Invalid query:". $conn->error);
}
  
    }

    if($string=="Fortigate"||$string=="fortinet"||$string=="Fortinet"){
        $sql="SELECT * FROM inventory2023 WHERE product_vendors=\"fortinet\"";
    $result = $conn->query($sql);
    if(!$result){
        die("Invalid query:". $conn->error);
    }
      
        }

        if($string=="Palo" || $string=="palo" || $string=="Palo Alto Networks" || $string=="Palo Alto"){

            $sql="SELECT * FROM inventory2023 WHERE product_vendors=\"Palo Alto Networks\"";
        $result = $conn->query($sql);
        if(!$result){
            die("Invalid query:". $conn->error);
        }
          
            }

            if($string=="F5"||$string=="f5"){
                $sql="SELECT * FROM inventory2023 WHERE product_vendors=\"F5\"";
            $result = $conn->query($sql);
            if(!$result){
                die("Invalid query:". $conn->error);
            }
              
                }

            

            if($string=="vmware"||$string=="VMware"){
                $sql="SELECT * FROM inventory2023 WHERE product_vendors=\"VMware\"";
            $result = $conn->query($sql);
            if(!$result){
                die("Invalid query:". $conn->error);
            }
              
                }

        $errordate = "";



        $x=0;
        while($row=$result->fetch_assoc()){
            $x++;
            $licenceEnd=$row['end_date'];
            $nextCycleDate =date('Y-m-d', strtotime('+1 months', strtotime($licenceEnd)) );
           // echo $nextCycleDate;
            
           
            if(strtotime($licenceEnd) <= strtotime($moreOneMonth)){
                $errordate ="<div class ='text-warning'>license is about to expire</div>";
            }
            if(strtotime($licenceEnd) <= strtotime($moreTenDay)){
                $errordate ="License will expire less then 10 Day";
            }
            if(strtotime($licenceEnd) <= strtotime($currentDate)){
                $errordate="<div class ='text-danger'>license expired</div>";
              }
              if(strtotime($licenceEnd) > strtotime($moreOneMonth)){
                $errordate="<div class='text-success'>license is ok</div>";
              }
              
        
        
            echo "
            <tr>
            <td>$x</td>
            <td>$row[names]</td>
            <td>$row[item]</td>
            <td>$row[serial]</td>
            <td>$row[product_vendors]</td>
            <td>$row[license_term] year</td>
            <td>$row[purchase_date]</td>
            <td>$row[end_date]</td>
            <td>$row[use_case]</td>
            <td> $errordate</td>
            <td>$row[vendors]</td>
            <td>$row[price]</td>
            <td style='word-wrap: break-word;min-width: 160px;max-width: 160px;'>$row[remarks]</td>
           
                ";
        }




        
    }else{



$sql="SELECT * FROM inventory2023";
$result = $conn->query($sql);
if(!$result){
    die("Invalid query:". $conn->error);
}


$errordate = "";



$x=0;
while($row=$result->fetch_assoc()){
    $x++;
    $licenceEnd=$row['end_date'];
    $nextCycleDate =date('Y-m-d', strtotime('+1 months', strtotime($licenceEnd)) );
   // echo $nextCycleDate;
    
   
    if(strtotime($licenceEnd) <= strtotime($moreOneMonth)){
        $errordate ="<div class ='text-warning'>license is about to expire</div>";
    }
    if(strtotime($licenceEnd) <= strtotime($moreTenDay)){
        $errordate ="License will expire less then 10 Day";
    }
    if(strtotime($licenceEnd) <= strtotime($currentDate)){
        $errordate="<div class ='text-danger'>license expired</div>";
      }
      if(strtotime($licenceEnd) > strtotime($moreOneMonth)){
        $errordate="<div class='text-success'>license is ok</div>";
      }
      


    echo "
    <tr>
    <td>$x</td>
    <td>$row[names]</td>
    <td>$row[item]</td>
    <td>$row[serial]</td>
    <td>$row[product_vendors]</td>
    <td>$row[license_term] year</td>
    <td>$row[purchase_date]</td>
    <td>$row[end_date]</td>
    <td>$row[use_case]</td>
    <td> $errordate</td>
    <td>$row[vendors]</td>
    <td>$row[price]</td>
    <td style='word-wrap: break-word;min-width: 160px;max-width: 160px;'>$row[remarks]</td>
   
        ";
}
    
}
?>

</tbody>
</table>
</div>
</form>

</div>

</div>
   </div> 

 
</body>

</html>
<?php 
}else{
    //header("location: javascript://history.go(-1)");
    header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=1');
       
    exit();
}

?>