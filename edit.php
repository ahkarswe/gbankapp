<?php
include 'header.php';
include 'dbconn_new.php';
session_start();
if($_SESSION['ugroup']=='Admin'){
?>
<?php

$id = "";
$name = "";
$nrc = "";
$address = "";
$staffid = "";
$joindate ="";
$shift_groups = "";
$phone ="";
$email = "";
$errorMessage = "";
$successMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET method: Show the data of the client
    if (!isset($_GET["id"])){
        header("location:/index.php");
        exit;
    }
    $id =$_GET["id"];
    //read the row of selected client from database table
    $sql = "SELECT * FROM user WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if(!$row){
        header("location:/index.php");
        exit;
    }
    $id = $row["id"];
    $name = $row["name"];
    $nrc = $row["nrc"];
    $address = $row["address"];
    $staffid = $row["staff_id"];
    $joindate = $row["joindate"];
    $shift_groups = $row["shift_groups"];
    $phone= $row["phone"];
    $email = $row["email"];
}
else{
    //post method: Update the data of the client
    $id = $_POST["id"];
    $name = $_POST["name"];
    $nrc = $_POST["db_nrc"];
    $address = $_POST["address"];
    $staffid = $_POST["db_staff_id"];
    $joindate = $_POST["db_joindate"];
    $shift_groups = $_POST["db_shift_groups"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    do{
        if (empty($name) || empty($nrc) || empty($address) || empty($staffid) || empty($joindate)|| empty($shift_groups) || empty($phone) || empty($email)) {
            $errorMessage = "All the field are required";
            break;
        }
        $sql="UPDATE user SET name='$name',nrc='$nrc',address='$address',staff_id='$staffid',joindate='$joindate',shift_groups='$shift_groups',phone='$phone', email='$email'".
        " WHERE id='$id'";
        $result = $conn->query($sql);
        if (!$result){
            $errorMessage="Invalid query:" . $connection->error;
            break;
        }
        $successMessage = "Employee added correctly";
        header("location:/index.php");
        exit;
    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>
        Edit
    </title>
</head>

<body>

    <div class="container my-5">
        <h5>Edit Employee <?php echo " - " .$name ?></h5></br>
        <hr>
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
            <input type="hidden" value="<?php echo $id?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id; ?>" readonly>
                </div>
            </div>
           
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">NRC NO.</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="db_nrc" value="<?php echo $nrc; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Staff ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="db_staff_id" value="<?php echo $staffid; ?>">
                </div>
    </div>
                <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Join Date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="db_joindate" placeholder="yyyy-mm-dd" value="<?php echo $joindate; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Group</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="db_shift_groups" value="<?php echo $shift_groups; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone No.</label>
                <div class="col-sm-6">
                <input type="tex"  name="phone" class="form-control" value="<?php echo $phone; ?>">
                </div>

            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
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
                <div class="offset-sm-3 col-sm-3 d-grid ">
                    <button class="btn btn-primary" type="submit">OK</button>
                </div>

                <div class=" col-sm-3 d-grid ">
                    <a class="btn btn-primary" href="/index.php" role="button">
                        Cancel
                    </a>
                </div>
            </div>




        </form>
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