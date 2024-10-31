<?php
include 'header_no_login.php';
include 'dbconn_new.php';
session_start();
$userName="";
if(isset($_POST['login'])){
  $userName=$_POST['username'];
  $userPassword = $_POST['password'];
  $sql="SELECT * FROM login WHERE uname='$userName' limit 1";
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
  $db_username=$row['uname'];
  $db_password=$row['password'];
  $db_group=$row['user_group'];
  //echo $db_password;

if($userName!=$db_username || password_verify($userPassword,$db_password)==false){

  print_r ($db_username);
  echo

  "
  <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>User name or Password is incorrect.</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>
  "
      ;

}elseif($userName==$db_username && password_verify($userPassword,$db_password)){
    $_SESSION['ugroup']=$db_group;
    $_SESSION['uname']=$db_username;
    header("location:/index.php");
  exit();
}

  /*if($userName!=$db_username || $userPassword!=$db_password){

    print_r ($db_username);
    echo

    "
    <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>User name or Password is incorrect.</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    "
        ;

  }
  elseif(password_verify($userPassword,$db_password)){
    $_SESSION['ugroup']=$db_group;
    $_SESSION['uname']=$db_username;
    header("location:/index.php");
        exit();

  }*/




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
    <title>Home</title>
</head>
<body>

    <div class="container-fluid col-sm-6">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center mb-3">Login</h1>
            </div>
            <div class="card-body">
    <form action="/home.php" method="post">
        <div class="mb-3">
          <label for="userName" class="form-label"><i class="bi bi-person-fill" style="color:blue"></i>User Name</label>
          <input type="text" class="form-control" id="userName" name="username" value="<?php echo $userName;?>">
         </div>

        <div class="mb-3">
          <label for="passWord" class="form-label"><i class="bi bi-key-fill" style="color:blue"></i>Password</label>
          <input type="password" class="form-control" id="passWord" name="password">
        </div>
        <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid ">
          <button class="btn btn-primary" type="submit" name="login">Login</button>

</div>
        </div>
      </form>
    </div>
    <div class="card-footer">

    </div>
    </div>
    </div>
</body>

</html>
