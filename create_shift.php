<?php
include 'dbconn_new.php';
include 'header.php';
session_start();
if($_SESSION['ugroup']=='Admin'){
?>

<?php


$date = "";
$grooupA = "";
$groupB = "";
$groupC= "";

if (isset($_POST['create'])) {
    //$id = $_POST["id"];
    $date = $_POST["date"];
    $groupA = $_POST["groupA"];
    $groupB= $_POST["groupB"];
    $groupC = $_POST["groupC"];
    
    do {
        if (empty($date) || empty($groupA) ||empty($groupB)|| empty($groupC)) {
            $errorMessage = "All the field are required";
            break;
        }
        //add new employee to database
        $database = "INSERT INTO august (date,group_A,group_B,group_C)". "VALUES ('$date','$groupA','$groupB','$groupC')";
        $result = $conn->query($database);
        if (!$result){
            $errorMessage="Invalid query:" . $connection->error;
            break;
        }
        
        $date = "";
        $grooupA = "";
        $groupB = "";
        $groupC= "";
        $successMessage = "Shift added correctly";

        

    } while (false);
}

?>





<!DOCTYPE html>
<html lang="en">


    
    <title>
        Create
    </title>


<body>
<hr>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
        <h2 class="text-primary">  Add New Shift</h2></br>
        <hr class col-sm-3>
        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                 
                </div>
                
                ";
        }
        ?>

        <form method="post">
            
            <div class="row mb-3">
              
            <label class="col-sm-2 col-form-label">Date</label>
            
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="date">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">  Group A</label>
                <div class="col-sm-10">
                <select name="groupA" class="form-control">
                    <option></option>
    <option >Day</option>
    <option>Night</option>
    <option>OFF</option>
</select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"> Group B</label>
                <div class="col-sm-10">
                <select name="groupB" class="form-control">
    <option >Day</option>
    <option>Night</option>
    <option>OFF</option>
</select>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">  Group C</label>
                <div class="col-sm-10">
                <select name="groupC" class="form-control">
    <option >Day</option>
    <option>Night</option>
    <option>OFF</option>
</select>
                </div>
            </div>
    

            <?php
            if (!empty($successMessage)) {
                echo "
                   
                <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                
                    ";

            }
            ?>
            <div class= "row mb-3">
                <div class="offset-sm-2 col-sm-5 d-grid">
                    <button class="btn btn-primary" type="submit" name="create">Create</button>
                </div>

                <div class=" col-sm-5 d-grid ">
                    <a class="btn btn-primary" href="/index.php" role="button">
                        Cancel
                    </a>
                </div>
            </div>
       </form>
    
    <hr><br>
        </div>
    <!-- Start All View-->


<div class="col"> 
<h3 class="text-primary">Last 7 Shift Entry</h3>
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
$sql="SELECT * FROM august ORDER BY date DESC limit 7";
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
</table>

</div>
</div>
</div>
<hr>

</body>

</html>
<?php


}else{
    //header("location: javascript://history.go(-1)");
    header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=1');
       
    exit();
}
?>