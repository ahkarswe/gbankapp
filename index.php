<?php

session_start();
if($_SESSION['ugroup']=='Admin' || $_SESSION['ugroup']=='User'){

    include 'header.php';
    include 'dbconn_new.php';
    $svr_error;
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $svr_error=$_GET['error'];
       do{ if($svr_error==1){
           // echo"<script> alert('you are INSUFFICIENT privilege to view this page.')</script>";
            echo '
        
        <div class=" container alert alert-secondary text-center" role="alert">
      <strong>You have not privilege to view this page contact your administrator.</strong> <a href="index.php" class="btn btn-warning">ok</a>
    </div>
        ';
            break;
            header('location: /check_list_admin.php'); 
        }
          
       }while (false);
       
           /* echo '
        
        <div class=" container alert alert-secondary text-center" role="alert">
      <strong>You have not privilege to view this page contact your administrator.</strong> <a href="javascript:history.go(-1)" class="btn btn-warning">ok</a>
    </div>
        ';*/
        
    }

   /* $svr_error;
if($_SERVER['REQUEST_METHOD']=='GET'){
    $svr_error=$_GET['error'];
    if($svr_error==1){
        echo '
    
    <div class="alert alert-warning" role="alert">
  You have not privilege to view this page. <a href="javascript:history.go(-1)" class="alert-link">go home page</a> or contact your administrator.
</div>
    ';
    }
}*/

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
        <title>
            Home
        </title>
        
    </head>
    <body>
    <h1 class="text-primary text-center">
        DC Man Power
    </h1>
<div class="container">
    <a class="btn btn-success" type="submit" href="/create.php">New Employee</a>
       <div>
        <div style="overflow:auto">
<table class="table table-hover table-bordered table-striped">
   <thead>
    <tr>
        
        <th scope="col"><i class="bi bi-person-circle"></i>  Name</th>
        <th scope="col"> <i class="bi bi-person-vcard-fill"></i>  NRC</th>
        <th scope="col"><i class="bi bi-mailbox"></i>  Address</th>
        <th scope="col"><i class="bi bi-person-badge-fill"></i>  Staff ID</th>
        <th scope="col"><i class="bi bi-calendar2"></i>  Join Date</th>
        <th scope="col"><i class="bi bi-people"></i>  Group</th>
        <th scope="col"><i class="bi bi-telephone"></i>  Phone No.</th>
        <th scope="col"><i class="bi bi-envelope-at"></i>  Email</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
   </thead> 
   <tbody>

   <?php



$sql="SELECT id,name,nrc,address,staff_id,joindate,shift_groups,phone,email FROM user";
$result = $conn->query($sql);
if(!$result){
    die("Invalid query:". $conn->error);
}
while($row=$result->fetch_assoc()) {
    echo "
    <tr>
    
    <td>$row[name] </td>
    <td>$row[nrc]</td>
    <td>$row[address]</td>
    <td>$row[staff_id]</td>
    <td>$row[joindate]</td>
    <td>$row[shift_groups]</td>
    <td>$row[phone]</td>
    <td>$row[email]</td>
    
    <td>
    <a class='btn btn-primary btn-sm' href = '/edit.php?id=$row[id]'><i class='bi bi-pencil-square'></i></a>
    </td>
    <td>
    <a class='btn btn-danger btn-sm' href='/delete.php?id=$row[id]'><i class='bi bi-trash-fill' '></i></a>
    </td>
</tr>
    ";
}

?>
   
   </tbody>
</table>
</div>
</div>
</div>
    </body>
</html>
<!-- For no Login Users-->
<?php
}else{ 
    include_once "header_no_login.php";
    include_once "dbconn_new.php";
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <title>
            Home
        </title>
    </head>
    <body>
    <h1 class="text-primary text-center">
        DC Man Power
    </h1>
    <br>
    
       <div class="container-fluid mx-3">
        <div style="overflow:auto">
<table class="table table-hover">
   <thead>
    <tr>
        
        <th scope="col"><i class="bi bi-person-circle" style="color:coral"></i>  Name</th>
        <th scope="col"> <i class="bi bi-person-vcard-fill" style="color:coral"></i>  NRC</th>
        <th scope="col"><i class="bi bi-mailbox" style="color:coral"></i>  Address</th>
        <th scope="col"><i class="bi bi-person-badge-fill" style="color:coral"></i>  Staff ID</th>
        <th scope="col"><i class="bi bi-calendar2" style="color:coral"></i>  Join Date</th>
        <th scope="col"><i class="bi bi-people" style="color:coral"></i>  Group</th>
        <th scope="col"><i class="bi bi-telephone" style="color:coral"></i>  Phone No.</th>
        <th scope="col"><i class="bi bi-envelope-at" style="color:coral"></i>  Email</th>
        
    </tr>
   </thead> 
   <tbody>

   <?php

$sql="SELECT id,name,nrc,address,staff_id,joindate,shift_groups,phone,email FROM user";
$result = $conn->query($sql);
if(!$result){
    die("Invalid query:". $conn->error);
}
while($row=$result->fetch_assoc()) {
    echo "
    <tr>
    
    <td>$row[name] </td>
    <td>$row[nrc]</td>
    <td>$row[address]</td>
    <td>$row[staff_id]</td>
    <td>$row[joindate]</td>
    <td>$row[shift_groups]</td>
    <td>$row[phone]</td>
    <td>$row[email]</td>
   
</tr>
    ";
}

?>
   
   </tbody>
</table>
        </div>
</div>
    </body>
</html>


 <?php   
}
?>