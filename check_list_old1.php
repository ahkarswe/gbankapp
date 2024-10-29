<?php
include 'dbconn_new.php';
include 'header_no_login.php';

$chkDate ="";
$chkTime = "";
$checker = "";
$chkArea = "";
$comment = "";
$successMessage ="";

if(isset($_POST["save"])){
$chkDate = $_POST["date"];
$chkTime = $_POST["time"];
$checker = $_POST["checker"];
$chkArea = $_POST["area"];
$comment = $_POST["comment"];
date_default_timezone_set("Asia/Yangon");
$my_date_time = date("H:i", strtotime("+1 hours"));
//echo strtotime($chkTime);
//echo "$chkDate . $chkTime . $checker . $chkArea .$comment";

do {
    if (empty($chkDate) || empty($chkTime) || empty($checker) || empty($chkArea) ||empty($comment)) {
        $errorMessage = "All the field are required"; 
                 
        break;
    }
    if(strtotime($chkTime) > strtotime($my_date_time)){
        $timeError = "Your Checking time cannot over 1hr of current time";
        break;
    }
   
    
    //add db connection
    $sql="INSERT INTO checklist (date,time,checker,area,remark) VALUES ('$chkDate','$chkTime','$checker','$chkArea','$comment')";
    $result = $conn->query($sql);

    if (!$result){
        $errorMessage="Invalid query:" . $connection->error;
        break;
    }
    
    $chkDate = "";
    $chkTime = "";
    $checker = "";
    $chkArea = "";
    $comment = "";
    $successMessage = "Your Check List has been Saved.";

    header("location:/check_copy.php");
    exit;

} while (false);
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
    <title>Check List</title>
</head>
<body>
    <h1 class="text-center text-primary">Daily Check List</h1>
    <div class="container mb-2">
        <div class="card">
            <div class="card-header">
            <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                 
                </div>
                
                ";
        }
        elseif(!empty($timeError)) {
            echo "
                <div class='alert alert-primary alert-dismissible fade show' role='alert'> <strong>$timeError</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                 
                </div>
                
                ";
        }
        ?>

            </div>
            <div class="card-body">
           
                <form method="POST">
                <div class="input-group mb-3">
    <span class="input-group-text">Checking Date</span>
    <input type="date" class="form-control" id="date" name="date">
      </div>

      <div class="input-group mb-3">
      <span class="input-group-text">Checking Time</span>
    <input type="time" class="form-control" id="time" name="time">
      </div>

      <div class=" input-group mb-3">
      <span class="input-group-text">Checker</span>
      <select class="form-select" aria-label="checker" name="checker">
  <option selected></option>
  <option >U Hein Htet Naing</option>
  <option >U Myo Thant Htut</option>
  <option >U Swan Htet Aung</option>
  <option >U Ye Ko Ko Zaw</option>
  <option >U Sat Kaung San</option>
  <option >U Myo Htet Khaing</option>
  <option >U Htet Wai Yan Lwin</option>
</select>
          </div>

          <div class=" input-group mb-3">
          <span class="input-group-text">Checking Area</span>
      <select class="form-select" aria-label="area" name="area">
        <option> </option>
  <option>DC Room</option>
  <option>Power Room</option>
  <option>Generator</option>
</select>
          </div>
          <div class="input-group mb-3">
          <span class="input-group-text">Comment By Checker</span>
  <textarea class="form-control"  name="comment" placeholder="တွေ့ရှိချက်အသေးစိတ်အား English မြန်မာ ကြိုက်နှစ်သက်ရာဖြင့် ဖော်ပြရန်။"></textarea>
  </div>
  <div class="row mb-3">
  <div class=" offset-md-1 col-md-5  d-grid">
  <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
  </div>
  <div class=" col-md-5 d-grid">
  <button type="submit" class="btn btn-outline-primary" name="cancel">Cancel</button>
</div>
  </div>
      
                </form>
</div>
<div class="card-footer">
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
            

<!--Container end here-->
</div> 

    <div class="container col-md-4 col-sm-6">
<form  method="POST">
    <div class ="">
        

<div class="input-group mb-3">
        <select class="form-select form-select-sm" name="chkview">
            <option>Select One</option>
            <option>All</option>
            <option >U Hein Htet Naing</option>
  <option >U Myo Thant Htut</option>
  <option >U Swan Htet Aung</option>
  <option >U Ye Ko Ko Zaw</option>
  <option >U Sat Kaung San</option>
  <option >U Myo Htet Khaing</option>
  <option >U Htet Wai Yan Lwin</option>
        </select>
                <button class="btn btn-success" name="chkbtn">View/Close</button>
        </div>
        </div>
    </form>
        </div>
        
    

    
<?php
$allview = $_POST["chkview"];


    
if(isset($_POST["chkbtn"])){
    
?>
<div class="container">
    <table class="table">
    <thead>
        <tr>
            <th>Checking Date</th>
            <th>Checking Time</th>
            <th>Checker</th>
            <th>Checking Area</th>
            <th>Reported by Checker</th>
        </tr>
    </thead>
    <tbody>
<?php
    if($allview=="All"){
    $sql="SELECT * FROM checklist ORDER BY date DESC,time DESC";
    $result = $conn->query($sql);}

    if($allview=="U Hein Htet Naing"){
        $sql="SELECT * FROM checklist WHERE checker = 'U Hein Htet Naing' ORDER BY date DESC,time DESC";
        $result = $conn->query($sql);}

        if($allview=="U Myo Thant Htut"){
            $sql="SELECT * FROM checklist WHERE checker = 'U Myo Thant Htut' ORDER BY date DESC,time DESC";
            $result = $conn->query($sql);}

            if($allview=="U Swan Htet Aung"){
                $sql="SELECT * FROM checklist WHERE checker = 'U Swan Htet Aung' ORDER BY date DESC,time DESC";
                $result = $conn->query($sql);}

                if($allview=="U Ye Ko Ko Zaw"){
                    $sql="SELECT * FROM checklist WHERE checker = 'U Ye Ko Ko Zaw' ORDER BY date DESC,time DESC";
                    $result = $conn->query($sql);}
    
        if($allview=="U Sat Kaung San"){
            $sql="SELECT * FROM checklist WHERE checker = 'U Sat Kaung San' ORDER BY date DESC,time DESC";
            $result = $conn->query($sql);}

            if($allview=="U Myo Htet Khaing"){
                $sql="SELECT * FROM checklist WHERE checker = 'U Myo Htet Khaing' ORDER BY date DESC,time DESC";
                $result = $conn->query($sql);}

                if($allview=="U Htet Wai Yan Lwin"){
                    $sql="SELECT * FROM checklist WHERE checker = 'U Htet Wai Yan Lwin' ORDER BY date DESC,time DESC";
                    $result = $conn->query($sql);}

   while($row = $result->fetch_assoc()){
    echo "
    <tr>
    <td>$row[date]</td>
    <td>$row[time]</td>
    <td>$row[checker]</td>
    <td>$row[area]</td>
    <td style='word-wrap: break-word;min-width: 160px;max-width: 160px;'>$row[remark]</td>
    </tr>
";
   }
}

    
?>
    </tbody>

</table>
</div>
<?php

?>
</div>   
</body>
</html>



