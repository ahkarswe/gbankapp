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
$LicenseGroup="";
$useCase = "";
$vendor ="";
$price ="";
$remarks="";
$errorMessage="";
$successMessage="";
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET method: Show the data of the client
    if (!isset($_GET["id"])){
        header("location:/inventory.php");
        exit;
    }
    $id =$_GET["id"];
    //read the row of selected client from database table
    $sql = "SELECT * FROM inventory WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if(!$row){
        header("location:/inventory.php");
        exit;
    }
    $id = $row["id"];
    $names=$row["names"];
    $newItem = $row["item"];
    $serial = $row["serial"];
    $product_vendors= $row["product_vendors"];
    $license_term = $row["license_term"];
    $PDate = $row["purchase_date"];
    $licenseDate = $row["end_date"];
    $LicenseGroup = $row["l_group"];
    $useCase = $row["use_case"];
    $vendor = $row["vendors"];
    $price = $row["price"];
    $remarks=$row["remarks"];
    
}elseif(isset($_POST['editInv'])){
$id = $_POST["id"];
$names = $_POST["names"];
$newItem = $_POST['item'];
$serial = $_POST['serial'];
$product_vendors = $_POST["product_vendors"];
$license_term = $_POST['licenseTerm'];
$PDate = $_POST['pDate'];
$licenseDate =$_POST['licenseDate'];
$LicenseGroup=$_POST['licenseGroup'];
$useCase = $_POST['useCase'];
$vendor = $_POST['vendor'];
$price = $_POST['price'];
$remarks=$_POST['remarks'];

do {
    if(empty($newItem) || empty($serial) ||empty($license_term) ||empty($PDate)|| empty($licenseDate) || empty($useCase)){
        $errorMessage = "All the field are required";
        break;
    }
//add new employee to database
$database = "UPDATE inventory SET id='$id',names='$names',item='$newItem',serial= '$serial',product_vendors='$product_vendors',license_term='$license_term',purchase_date='$PDate',end_date='$licenseDate',l_group='$LicenseGroup',use_case='$useCase',vendors='$vendor',price='$price',remarks='$remarks' WHERE id ='$id'";
$result = $conn->query($database);
if (!$result){
    $errorMessage="Invalid query:" . $connection->error;
    break;
}
$successMessage = "Edit Inventory correctly";
header("location:/inventory.php");
exit;
} while (false);

}else{
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
    
    <title>Create Inventory</title>
</head>

<body>
    <div class="container ">
        <div class="row">
            <div class="col">
                <div class="card col-8">
                    <div class="card-header">
                    <h2 class="text-primary"><i class="bi bi-box-seam-fill"></i>  Edit Inventory</h2></br>
                    </div>
                    <div class="card-body">
                        <form method="post">
                        <div class="row">
                        
                            <label for="id " class="col-3 col-form-label">ID</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="id" value="<?php echo $id?>" name="id" readonly>
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="names " class="col-3 col-form-label">Name</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="names" value="<?php echo $names?>" name="names">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="item " class="col-3 col-form-label">Model Name</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="item" value="<?php echo $newItem?>" name="item">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="serial " class="col-3 col-form-label">Serial</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="serial" value="<?php echo $serial?>" name="serial">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="product_vendors " class="col-3 col-form-label">Vendor</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="product_vendors" value="<?php echo $product_vendors?>" name="product_vendors">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="LicenseTerm " class="col-3 col-form-label">License Term</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="licenseTerm" value="<?php echo $license_term?>" name="licenseTerm">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="pd " class="col-3 col-form-label">Start Date</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="pd"value="<?php echo $PDate?>" name="pDate">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="licenseDate " class="col-3 col-form-label">License End Date</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="licenseDate" value="<?php echo $licenseDate?>" name="licenseDate">
                        </div>                     
                        </div>

                        <div class="row">
                        
                        <label for="licenseGroup " class="col-3 col-form-label">License Group</label>
                        <div class="col">
                        <input type="text" class="col-6  mb-3 form-control" id="licenseGroup" value="<?php echo $LicenseGroup?>" name="licenseGroup">
                    </div>                     
                    </div>

                        <div class="row">
                        
                            <label for="usecase " class="col-3 col-form-label">Use Case</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="usecase" value="<?php echo $useCase?>" name="useCase">
                        </div>                     
                        </div>
                        
                        <div class="row">
                        
                            <label for="vendor " class="col-3 col-form-label">Local SI</label>
                            <div class="col">
                            <input type="text" class="col-6 mb-3 form-control" id="vendor" value="<?php echo $vendor?>" name="vendor">
                        </div>                     
                        </div>

                        <div class="row">
                        
                            <label for="price " class="col-3 col-form-label">Price</label>
                            <div class="col">
                            <input type="text" class="col-6  mb-3 form-control" id="price" value="<?php echo $price?>" name="price">
                        </div>                     
                        </div>
                        <div class="row">
                        
                            <label for="remarks " class="col-3 col-form-label">Remarks</label>
                            <div class="col">
                            <input type="textarea" class="col-6  mb-3 form-control" id="remarks" value = "<?php echo $remarks ?>"  name="remarks">
                            
                        </div>                     
                        </div>

                        <div class="row">
                            <div class="offset-sm-3 col-sm-3 d-grid ">
                            <button type="submit" class="btn btn-primary" name="editInv">OK</button>
                            </div>
                            <div class="col-3 d-grid">
                            <button type="submit" class="btn btn-primary" name="create">Cancel</button>
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
?>