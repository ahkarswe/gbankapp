<?php

session_start();
if($_SESSION['uname']){
    include 'header.php';
    include 'dbconn_new.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <title>
            Home
        </title>
    </head>
    <body>
    <h1 class="text-primary text-center">
        DC Man Power
    </h1>
<div class="container ">
    <a class="btn btn-success" type="submit" href="/create.php">New Employee</a>
       <div>
<table class="table table-hover table-bordered table-striped">
   <thead>
    <tr>
        
        <th scope="col"><i class="bi bi-person-circle"></i>  Name</th>
        <th scope="col"> <i class="bi bi-person-vcard-fill"></i>  NRC</th>
        <th scope="col"><i class="bi bi-mailbox"></i>  Address</th>
        <th scope="col"><i class="bi bi-person-badge-fill"></i>  Staff ID</th>
        <th scope="col"><i class="bi bi-calendar2"></i>  Join Date</th>
        <th scope="col"><i class="bi bi-people"></i>  Sex</th>
        <th scope="col"><i class="bi bi-telephone"></i>  Phone No.</th>
        <th scope="col"><i class="bi bi-envelope-at"></i>  Email</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
   </thead> 
   <tbody>

   <?php

$sql="SELECT id,name,nrc,address,staff_id,joindate,sex,phone,email FROM user";
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
    <td>$row[sex]</td>
    <td>$row[phone]</td>
    <td>$row[email]</td>
    <td>
    <a class='btn btn-primary btn-sm' href = '/edit.php?id=$row[id]'><i class='bi bi-pencil-square'></i></a>
    </td>
    <td>
    <a class='btn btn-danger btn-sm' href='/delete.php?id=$row[id]'><i class='bi bi-trash-fill' '></i>  Delete</a>
    </td>
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
<!-- For no Login Users-->
<?php
}else{ 
    include "header_no_login.php";
    include "dbconn_new.php";
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <title>
            Home
        </title>
    </head>
    <body>
    <h1 class="text-primary text-center">
        DC Man Power
    </h1>
    <p class="text-danger text-center"> Please login for more information.</p></br>
<div class="container my-5">
           
<table class="table table-hover">
   <thead>
    <tr>
        
        <th>Name</th>
        
        <th>Address</th>
        <th>Staff ID</th>
        
        <th>Sex</th>
        <th>Email</th>
    </tr>
   </thead> 
   <tbody>

   <?php

$sql="SELECT id,name,address,staff_id,sex,email FROM user";
$result = $conn->query($sql);
if(!$result){
    die("Invalid query:". $conn->error);
}
while($row=$result->fetch_assoc()) {
    echo "
    <tr>
    
    <td>$row[name] </td>
    
    <td>$row[address]</td>
    <td>$row[staff_id]</td>
    
    <td>$row[sex]</td>
    <td>$row[email]</td>
   
</tr>
    ";
}

?>
   
   </tbody>
</table>
</div>
    </body>
</html>


 <?php   
}
?>

<form method="POST">
<input type="datetime-local" name="date">
<input type="time" name="time">
<button type="submit" name="submit">sumit</button>

    <?php
    $date=$_POST['date'];
    $time=$_POST['time'];
    if(isset($_POST['submit'])){
        
echo "today date is " . $date . "and time is ". $time;
    }
    ?>
    
</form>
<h1>end of doc</h1>
<foorter>

</foorter>