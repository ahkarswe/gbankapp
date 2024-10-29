<?php
session_start();

include 'dbconn_new.php';
include 'header_no_login.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>roster</title>
</head>
<body>
<h1 class="text-center text-primary">Gbank NOC Shift Roster</h1>
    <!-- For Today Roster -->
    <div class="container">
        <h3 class="text-success">Today Shift</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Group A</th>
            <th>Group B</th>
            <th>Group C</th>
        </tr>

</thead>
<tbody>
        <?php
        
        $today=date("Y-m-d");
        $sql="SELECT * FROM august WHERE date='$today'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        echo "
        <tr class='table-success'>
        <td>Today</td>
        <td>$row[group_A]</td>
        <td>$row[group_B]</td>
        <td>$row[group_C]</td>
        </tr>
        ";
        
        ?>
        </tbody>
</table><br>
</div>
<!--Month Table Start here-->
<div class="container">
<div class="row">
<div class="col">
<form method="post">

<div class="input-group mb-3">
            <lable class="mt-2" for="startDate">From  </lable>
        <input type="date" class="form-control mx-2" id="startDate" name="startDate">
        <lable class="mt-2" for="endDate">To  </lable>
        <input type="date" class="form-control ms-2" id="endDate" name="endDate">
                <button class="btn btn-success" name="chkDate">View Roster</button>
        </div>

</form>

<hr>
</div>
</div>
<!--Code for month Start Here-->
<div class="row">
    <?php
    if(isset($_POST['chkDate'])){
        $startDate= $_POST['startDate'];
        $endDate = $_POST['endDate'];
   ?>     
    
    <h2 class="text-success">Shift Roster From <?php echo"(" . $startDate. ")" ?>To <?php echo "(" .$endDate. ")"?>.</h2>
        <table class="table table-hover">
        <thead>
        <tr>
            <th>Date</th>
            <th>Group A</th>
            <th>Group B</th>
            <th>Group C</th>
        </tr>

</thead>
<tbody>
 <?php
$sql="SELECT * FROM august WHERE date between '$startDate' AND '$endDate' ";
$result=$conn->query($sql);

while ($row=$result->fetch_assoc()){
    echo"
    <tr>
  <th>$row[date]</th>
   <td>$row[group_A]</td>
    <td> $row[group_B]</td>
    <td> $row[group_C]</td>
   </tr>
   ";
}
    }
?>


</tbody>
 </table>


  
    
</div>

</div>


</body>
</html>

