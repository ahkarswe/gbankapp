<?php
include 'dbconn_new.php';
include 'header.php';
session_start();
if($_SESSION['ugroup']=='Admin'){
?>
<?php
$names="";
$newItem = "";
$serial = "";
$product_vendors="";
$license_term="";
$PDate = "";
$licenseDate = "";
$useCase = "";
$vendor ="";
$price ="";
$remarks="";
$errorMessage="";
$successMessage="";

if(isset($_POST['createInv'])){
$names=$_POST["names"];
$newItem = $_POST['item'];
$serial = $_POST['serial'];
$product_vendors= $_POST["product_vendors"];
$licenseTerm = $_POST['licenseTerm'];
$PDate = $_POST['pDate'];
$licenseDate =$_POST['licenseDate'];
$useCase = $_POST['useCase'];
$vendor = $_POST['vendor'];
$price = $_POST['price'];
$remarks= $_POST['remarks'];
do {
    if(empty($newItem) || empty($serial) || empty($licenseTerm ) ||empty($PDate)|| empty($licenseDate) || empty($useCase)){
        $errorMessage = "All the field are required";
        break;
    }
//add new employee to database
$database = "INSERT INTO inventory (names,item,serial,product_vendors,license_term,purchase_date,end_date,use_case,vendors,price,remarks)". "VALUES ('$names','$newItem','$serial','$product_vendors', '$licenseTerm','$PDate','$licenseDate','$useCase','$vendor','$price','$remarks')";
$result = $conn->query($database);
if (!$result){
    $errorMessage="Invalid query:" . $connection->error;
    break;
}
$names="";
$newItem = "";
$serial = "";
$product_vendors="";
$licenseTerm="";
$PDate = "";
$licenseDate = "";
$useCase = "";
$vendor ="";
$price ="";
$remarks="";
$successMessage = "New Item added correctly";
header("location:/inventory.php");



} while (false);
   
}elseif(isset($_POST['cancel'])){
    header("location:/inventory.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Create Inventory</title>
</head>

<body>
    <div class="container ">
        <div class="row">
            <div class="col">
                <div class="card col-8">
                    <div class="card-header">
                    <h2 class="text-primary"><i class="bi bi-box-seam-fill"></i>  Add New Inventory</h2></br>
                    </div>
                    <div class="card-body">
                        <form method="post">

                        <div class="row">
                        
                        <label for="names " class="col-3 col-form-label"> Name</label>
                        <div class="col">
                        <input type="text" class="col-6 form-control mb-3" id="names" name="names">
                    </div>                     
                    </div>

                        <div class="row">
                        
                            <label for="item " class="col-3 col-form-label">Model Name</label>
                            <div class="col">
                            <input type="text" class="col-6 form-control mb-3" id="item" name="item">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="serial " class="col-3 col-form-label">Serial</label>
                            <div class="col">
                            <input type="text" class="col-6 form-control mb-3" id="serial" name="serial">
                        </div>                     
                        </div>

                        <div class="row">
                        
                        <label for="product_vendors " class="col-3 col-form-label"> Vendor</label>
                        <div class="col">
                        <input type="text" class="col-6 form-control mb-3" id="product_vendors" name="product_vendors">
                    </div>                     
                    </div>

                        <div class="row">
                        
                            <label for="LicenseTerm " class="col-3 col-form-label">License Term</label>
                            <div class="col">
                            <input type="text" class="col-6 form-control mb-3" id="licenseTerm" name="licenseTerm">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="pd " class="col-3 col-form-label">Start Date</label>
                            <div class="col">
                            <input type="date" class="col-6 form-control mb-3" id="pd" name="pDate">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="licenseDate " class="col-3 col-form-label">License End Date</label>
                            <div class="col">
                            <input type="date" class="col-6 form-control mb-3" id="licenseDate" name="licenseDate">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="usecase " class="col-3 col-form-label">Use Case</label>
                            <div class="col">
                            <input type="text" class="col-6 form-control mb-3" id="usecase" name="useCase">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="vendor " class="col-3 col-form-label">Local SI</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="vendor"  name="vendor">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="price " class="col-3 col-form-label">price</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="price"  name="price">
                        </div>                     
                        </div>
                        <div class="row">
                        
                            <label for="remarks " class="col-3 col-form-label">Remarks</label>
                            <div class="col">
                            <textarea  class="col-6 mb-3 form-control" id="remarks"  name="remarks"></textarea>
                        </div>                     
                        </div>


                        <div class="row">
                       
                            <div class="offset-sm-3 col-sm-4 d-grid ">
                            <button type="submit" class="btn btn-primary" name="createInv">Save</button>
                            </div>
                            <div class="col-4 d-grid">
                            <button type="submit" class="btn btn-primary" name="cancel">Cancel</button>
                            </div>
                                          
                        </div>




                        </form>






                    </div>
                    <div class="card-footer">
                    <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                 
                </div>
                
                ";
        }
        ?>

                    <?php
            if (!empty($successMessage)) {
                echo "
                   
                <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                
                    ";

            }
            ?>
                    </div>


                </div>


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