<?php 
session_start();
if ($_SESSION['ugroup']=='Admin'){
require_once 'dbconn_new.php';
require_once 'header.php';
$error_pass="";
$errormassage="";
$username="";
$userError="";

if(isset($_POST['reset'])){
$username= $_POST['username'];
$pass= $_POST['password'];
$repass= $_POST['repatedpassword'];
$priv=$_POST['pri'];
$option=["cost"=>12];
$hashPass= password_hash($pass,PASSWORD_DEFAULT,$option);
$sql= "SELECT * FROM login WHERE uname='$username'";
$result=$conn->query($sql);
 $row=$result->fetch_assoc();
 
 


if(empty($username)||empty($pass)||empty($repass)){
    $errormassage='all field are require';
    
}
else if($pass!==$repass){
$error_pass= 'password doesn\' t match';
echo $error_pass;
}else{
    if(!$row){
        $userError="your username cannot find in our system";
        
        
     }
    
    
// if($priv=='User'){
//     $group="User";
// }
// if($priv=='Admin'){
//     $group="Admin";
// }


$sql="UPDATE login SET password='$hashPass' WHERE uname='$username'";
$result = $conn->query($sql);
        if (!$result){
            $errorMessage="Invalid query:" . $connection->error;
           
        }
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
</head>
<body>
    
<div class="container">
<div class="row">
<h3 class="text-primary mb-4">Reset Password</h3>
 
<?php
if(!empty($userError)){
echo"
<div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$userError</strong>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>
";
}
if(!empty($errormassage)){
    echo"
    <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$errormassage</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>
    ";
    }
?>
<hr>
<div class="col">
    <form method="post">
        <div class="row">
            <div class="col-md-2 col-sm-4">
        <label class="form-label" for="username">User Name</label>
            </div>
            <div class="col-md-3 col-sm-6 mb-3" >
    <input type="text" class="form-control" placeholder="Enter User Nmae" name="username" value="<?php echo $username ?>">
            </div>
        </div>
       <div class="row">
        <div class="col-md-2 col-sm-4">
            <label for="password" class="form-label">Enter Password</label>
        </div>
<div class="col-md-3 col-sm-6 mb-3">
    <input type="password" class="form-control" placholder="Enter Password" name="password">
</div>
</div>
<div class="row">
    <div class="col-md-2 col-sm-4"><label class="form-label" for="repeatedpassword" >Repeated Password  </label></div>
    <div class="col-md-3 col-sm-6 mb-3">
        
    <input type="password" class="form-control" aria-placeholder="repated Password" name="repatedpassword">
    
</div>
</div>
<!-- <div class="row">
    <div class="col-2">
    <label>Privlage Level</label><br>
    </div>
    <div class="col-3">
    User <input type="radio" name="pri" value="User">      
    Admin <input type="radio" name="pri" value="Admin"> 
</div>
</div> -->

  <div class="row justify-content-center justify-content-sm-center">
    <div class="col-6 mt-4">

    <button type="submit" class="btn btn-danger  " name="reset">Reset </button>
</div>
</div>


    </form>


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