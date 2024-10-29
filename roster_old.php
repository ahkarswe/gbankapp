<?php
session_start();

include 'dbconn_new.php';
include 'header.php';
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


<!-- for choosing Month-->


    <div class="d-flex justify-content-center">
    <form method="POST">
        <div class="input-group mb-2">
        <select class="form-select form-select-sm" name="month">
            <option>Choose Months</option>
            <option>August</option>
            <option>Sep</option>
            <option>Oct</option>
        </select>
        
        <button class="btn btn-success" name="choose">Choose</button>
        </div>
    </form>
    </div>
    <hr>

    <?php
$month=$_POST['month'];
if($month=='August'){
if(isset($_POST['choose'])){
?>
  

<h2 class="text-success">August Shift Rosster</h2>
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
$sql="SELECT * FROM august WHERE date between '2023-08-01' AND '2023-08-31' ";
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

?>


</tbody>
        </table>
</div>
<?php
}
}
?>
<!-- For Sep-->
<?php
$month=$_POST['month'];
if($month=='Sep'){
if(isset($_POST['choose'])){
?>
  

<h2 class="text-success">September Shift Rosster</h2>
        <table class="table table-hover">
        <thead>
        <tr>
            <th>Date</th>
            <th>Group A</th>
            <th>Group B</th>
            <th>Group C</th>
        </tr>

</thead>
<tbody


<?php 
$sql="SELECT * FROM august WHERE date between '2023-09-01' AND '2023-09-30' ";
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

?>


</tbody>
        </table>
</div>
<?php
}
}
?>
<!-- For Oct-->
<?php
$month=$_POST['month'];
if($month=='Oct'){
if(isset($_POST['choose'])){
?>
  

<h2 class="text-success">October Shift Rosster</h2>
        <table class="table table-hover">
        <thead>
        <tr>
            <th>Date</th>
            <th>Group A</th>
            <th>Group B</th>
            <th>Group C</th>
        </tr>

</thead>
<tbody


<?php 
$sql="SELECT * FROM august WHERE date between '2023-10-01' AND '2023-10-31' ";
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

?>


</tbody>
        </table>
</div>
<?php
}
}
?>

</body>
</html>

