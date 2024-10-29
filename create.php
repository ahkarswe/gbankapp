<?php
include 'header.php';
include 'dbconn_new.php';
session_start();
if($_SESSION['ugroup']=='Admin'){
?>
<?php

//$id = "";
$name = "";
$nrc = "";
$address = "";
$staffid = "";
$joindate="";
$shift_groups = "";
$phone="";
$email = "";
$errorMessage = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$id = $_POST["id"];
    $name = $_POST["name"];
    $nrc = $_POST["db_nrc"];
    $address = $_POST["address"];
    $staffid = $_POST["db_staff_id"];
    $joindate= $_POST["db_joindate"];
    $shift_groups = $_POST["db_shift_groups"];
    $phone=$_POST["phone"];
    $email = $_POST["email"];
    do {
        if (empty($name) || empty($nrc) || empty($address) || empty($staffid) ||empty($joindate)|| empty($shift_groups) || empty($phone) || empty($email)) {
            $errorMessage = "All the field are required";
            break;
        }
        //add new employee to database
        $database = "INSERT INTO user (name,nrc,address,staff_id,joindate,shift_groups,phone,email)". "VALUES ('$name','$nrc','$address','$staffid','$joindate','$shift_groups','$phone','$email')";
        $result = $conn->query($database);
        if (!$result){
            $errorMessage="Invalid query:" . $connection->error;
            break;
        }
        
        $name = "";
        $nrc = "";
        $address = "";
        $staffid = "";
        $joindate = "";
        $shift_groups = "";
        $phone="";
        $email = "";
        $successMessage = "Employee added correctly";

        header("location:/index.php");
        exit;

    } while (false);
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>
        Create
    </title>
</head>

<body>

    <div class="container-fluid col-sm-6">
        <h2 class="text-primary"><i class="bi bi-person-plus-fill"></i>  Add New Employee</h2></br>
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
            <div>
            <div class="row mb-3">
              
            <label class="col-sm-2 col-form-label"><i class="bi bi-person-circle"> </i> Name</label>
            
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><i class="bi bi-person-vcard-fill"></i>  NRC No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="db_nrc" value="<?php echo $nrc; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><i class="bi bi-mailbox"></i>  Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><i class="bi bi-person-badge-fill"></i>  Staff ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="db_staff_id" value="<?php echo $staffid; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2  col-form-label"><i class="bi bi-calendar2"></i>  Join Date</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="db_joindate" value="<?php echo $joindate; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><i class="bi bi-people"></i>  Group</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="db_shift_groups" value="<?php echo $shift_groups; ?>">
                </div>

            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><i class="bi bi-telephone"></i>  Phone No.</label>
                <div class="col-sm-10">
                <input type="tex"  name="phone" class="form-control"value="<?php echo $phone;?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><i class="bi bi-envelope-at"></i>  Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
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
                <div class="offset-sm-2 col-sm-5 d-grid ">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>

                <div class=" col-sm-5 d-grid ">
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