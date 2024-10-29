<?php 
session_start();
if ($_SESSION['ugroup']=='Admin'){
require_once 'dbconn_new.php';
require_once 'header.php';
$error_pass="";
$errormassage="";
$username="";

if(isset($_POST['signup'])){
$username= $_POST['username'];
$pass= $_POST['password'];
$repass= $_POST['repatedpassword'];
$priv=$_POST['pri'];
$option=["cost"=>12];
$hashPass= password_hash($pass,PASSWORD_DEFAULT,$option);
if(empty($username)||empty($pass)||empty($repass)){
    $errormassage='all field are require';
    echo $errormassage;
}
else if($pass!==$repass){
$error_pass= 'password doesn\' t match';
echo $error_pass;
}else{

if($priv=='User'){
    $group="User";
}
if($priv=='Admin'){
    $group="Admin";
}
$sql="INSERT INTO login (uname,password,user_group)value ('$username','$hashPass','$group')";
$result=$conn->query($sql);

}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    
<div class="container">
<div class="row">
<h1 class="text-primary mb-4">Signup</h1>
<hr>
<div class="col">
    <form method="post">
        <div class=" form-group row">
            <div class="col-md-2 col-sm-4">
        <label class="form-label" for="username">User Name</label>
            </div>
            <div class="col-md-3 mb-3 col-sm-6" >
    <input type="text" class="form-control" placeholder="Enter User Nmae" name="username" value="<?php echo $username ?>">
            </div>
        </div>
       <div class=" from-group row">
        <div class="col-md-2 col-sm-4">
            <label for="password" class="form-label">Enter Password</label>
        </div>
<div class="col-md-3 mb-3 col-sm-6">
    <input type="password" class="form-control" placholder="Enter Password" name="password">
</div>
</div>
<div class="form-group row">
    <div class="col-md-2 col-sm-4"><label class="form-label" for="repeatedpassword" >Repeated Password  </label></div>
    <div class="col-md-3 mb-3">
        
    <input type="password" class="form-control" aria-placeholder="repated Password" name="repatedpassword">
    
</div>
</div>
<div class=" form-group row">
    <div class="col-md-2 col-sm-6">
    <label>Privlage Level</label><br>
    </div>
    <div class="col-md-3 col-sm-6">
    User <input type="radio" name="pri" value="User">      
    Admin <input type="radio" name="pri" value="Admin"> 
</div>
</div>

  <div class="row justify-content-center">
    <div class="col-6 mt-4">

    <button type="submit" class="btn btn-success " name="signup">Sign Up </button>
</div>
</div>
<p><a href=forget_password.php>forget password?</a></p>

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