<?php
include 'dbconn_new.php';
// $sql = "SELECT * FROM login WHERE uname=$username";
// $result = $conn->query($sql);
// $row = $result->fetch_assoc();
// $username = $row['uname'];
$username=$_SESSION['uname'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<div class="sticky-top">
    <div>
    <header>

        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-dark border-bottom box-shadow mb-3">
            <div class="container-fluid">
                <a class="navbar-brand h1" href="/index.php" style="color:coral" >Gbank</a> 
                <b class="text-light"><?php echo" Welcome" ." " . $username;?></b>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                
                <ul class="navbar-nav flex-grow-1">
                    </ul >                     
                        
                        
                    <ul class="navbar-nav mr-0">
                        <li class="nav-item">
                            <a class="nav-link text-light " href="/index.php"><i class="bi bi-house" style="color:coral"></i>  Home</a>
                        </li>
                        <li class="nav-item dropdown">
    <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-box-seam-fill" style="color:coral"></i> Inventory</a></button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="/inventory.php">Current Inventory</a></li>
      <li><a class="dropdown-item" href="/inventory_2023.php">2022-2023 Inventory</a></li>
        <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Older Than 2022</a></li>
    </ul>
  </li>

                        <li class="nav-item">
                            <a class="nav-link text-light " href="/create_shift.php"><i class="bi bi-arrow-repeat" style="color:coral"></i>  Roster</a>
                            <li class="nav-item">
                            <a class="nav-link text-light " href="/check_list_admin.php"><i class="bi bi-card-checklist" style="color:coral"></i> Check</a>
                        </li>
                        </li>
                        <li class="nav-item my-sm-0">
                            <a class="nav-link tex-light" href="signup.php"><i class="bi bi-box-arrow-up" style="color:coral"></i>  Signup</a>
                        </li>
                        
                        <li class="nav-item my-sm-0">
                            <a class="nav-link tex-light" href="logout.php"><i class="bi bi-lock-fill" style="color:coral"></i>  Logout</a>
                        </li>
                        
                        </ul>
                       
                   
                </div>
            </div>
        </nav>
    </header>
</div>
</div>