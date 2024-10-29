
<?php
include 'header.html'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <title>
            Home
        </title>
    </head>
    <body>
    <h1 class="text-primary text-center">
        DC Man Power
    </h1>
<div class="container my-5">
    <a class="btn btn-success" type="submit" href="/create.php">New Employee</a>
       
<table class="table">
   <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Address</th>
        <th>Salary</th>
        <th>Sex</th>
        <th>Email</th>
    </tr>
   </thead> 
   <tbody>

   <?php
$servername = "localhost";
$username = "ahkar";
$password = "Ng2k@ys2b7aks";
$database = "mindgnite";

// Create connection
$conn = new mysqli($servername, $username, $password ,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
//read database table
$sql="SELECT id,name,age,address,salary,sex,email FROM user";
$result = $conn->query($sql);
if(!$result){
    die("Invalid query:". $conn->error);
}
while($row=$result->fetch_assoc()) {
    echo "
    <tr>
    <td>$row[id]</td>
    <td>$row[name] </td>
    <td>$row[age]</td>
    <td>$row[address]</td>
    <td>$row[salary]</td>
    <td>$row[sex]</td>
    <td>$row[email]</td>
    <td>
    <a class='btn btn-primary btn-sm' href = '/edit.php?id=$row[id]'>Edit</a>
    <a class='btn btn-danger btn-sm' href='/delete.php?id=$row[id]'>Delete</a>
    </td>
</tr>
    ";
}

?>




   
   </tbody>
</table>



</div>
    </body>
</html>
