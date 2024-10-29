<?php
session_start();
if($_SESSION['ugroup']=='Admin'){
    include 'header.php';
    include 'dbconn_new.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
       <script> "https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"</script>
        
    <title>Inventory</title>
</head>
<body style="font-size:medium;">

   <div class="container-fluid">
<div class="row">
    <div class="col">
    <div class="d-flex justify-content-start">
<a href="create_inventory.php" type="button" class="btn btn-primary">Create New Inventory</a>
    </div>
</div>
    <div class="col-md-3 col-sm-4 col-xs-4">
    <div class="container-fluid d-flex justify-content-end"> 
        <form method="post">     
<div class="input-group">
        <select class="form-select form-select-sm" name="chkvendors">
            <option>Select Vendor Name</option>
             <option>Cisco</option>
               <option>Fortinet</option>
                <option>Vmware</option>
                <option>Microsoft</option>
                <option>RedHat</option>
                <option>F5</option>
                <option>Palo Alto</option>
                <option>NetAPP</option>
                <option>Veritas</option>
                <option>Trend Micro</option>
                <option>Global Sign</option>
                <option>MTG</option>
                <option>Data Link</option>
        </select>
                <button class="btn btn-success" name="chkbtnvendors">Search</button>
        </div>
        </form>
    </div>
</div>
 </div>  
<div class="row">
<div class="col">


    
<form method='post'>
<table class="table table-hover table-bordered table-striped">
<thead>
<tr>
    <th>NO.</th>
<th>Product Name</th>
<th>Model</th>
<th>Serial No.</th>
<th>Vendor Name</th>
<th>Licence Term</th>
<th>License Start Date</th>
<th>License End Date</th>
<th>License group</th>
<th>Use Case</th>
<th>License Status</th>
<th>SI</th>
<th>PO Price </th>
<th>Remarks</th>
<th>Edit</th>


</tr>
</thead>
<tbody>
<?php
date_default_timezone_set("Asia/Yangon");

$currentDate = date("Y-m-d");
$moreOneMonth = date("Y-m-d",strtotime("+ 1months"));
$moreTenDay=date("Y-m-d",strtotime("+ 10day"));
$licenseExpired= "";

$vendors="";
if(isset($_POST['chkbtnvendors'])){
    
    if($_POST["chkvendors"]=="Cisco"){
        $vendors = "Cisco";
        
    }
    if($_POST["chkvendors"]=="Fortinet"){
        $vendors = "Fortinet";
    }
    if($_POST["chkvendors"]=="Vmware"){
        $vendors = "VMware";
    }
    if($_POST["chkvendors"]=="Microsoft"){
        $vendors = "Microsoft";
    }
    if($_POST["chkvendors"]=="RedHat"){
        $vendors = "RedHat";
    }
    if($_POST["chkvendors"]=="F5"){
        $vendors = "F5";
    }
    if($_POST["chkvendors"]=="Palo Alto"){
        $vendors = "Palo Alto Networks";
    }

    if($_POST["chkvendors"]=="NetAPP"){
        $vendors = "Netapp";
    }

    if($_POST["chkvendors"]=="Veritas"){
        $vendors = "Veritas";
    }
    if($_POST["chkvendors"]=="Trend Micro"){
        $vendors = "Trend Micro";
    }


    if($_POST["chkvendors"]=="Global Sign"){
        $vendors = "GlobalSign";
    }
    if($_POST["chkvendors"]=="MTG"){
        $vendors = "MTG";
    }
    if($_POST["chkvendors"]=="Data Link"){
        $vendors = "Data Link";
    }

    $sql="SELECT * FROM inventory WHERE product_vendors=\"$vendors\"";
    $result = $conn->query($sql);
    if(!$result){
        die("Invalid query:". $conn->error);
    }

    if($_POST["chkvendors"]=="Select Vendor Name"){
        $sql="SELECT * FROM inventory";
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
        <td>$row[l_group]</td>
        <td>$row[use_case]</td>
        <td> $errordate</td>
        <td>$row[vendors]</td>
        <td>$row[price]</td>
        <td style='word-wrap: break-word;min-width: 160px;max-width: 160px;'>$row[remarks]</td>
       
        <td>
        <a class='btn btn-primary btn-sm' href = '/edit_inventory.php?id=$row[id]'><i class='bi bi-pencil-square'></i></a>
        </td>
        
         </tr>
        ";
    }
}else{



//echo $moreOneMonth;

$sql="SELECT * FROM inventory";
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
    <td>$row[l_group]</td>
    <td>$row[use_case]</td>
    <td> $errordate</td>
    <td>$row[vendors]</td>
    <td>$row[price]</td>
    <td style='word-wrap: break-word;min-width: 160px;max-width: 160px;'>$row[remarks]</td>
   
    <td>
    <a class='btn btn-primary btn-sm' href = '/edit_inventory.php?id=$row[id]'><i class='bi bi-pencil-square'></i></a>
    </td>
    
     </tr>
    ";
}
}
?>

</tbody>
</table>

</form>

</div>

</div>
   </div> 

 
</body>

</html>
<?php
}else{
    header("location:javascript://history.go(-1)");;
    exit();
}

?>