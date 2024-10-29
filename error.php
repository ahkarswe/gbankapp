<?php 
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $svr_error=$_GET['error'];
        if($svr_error==1){
            echo '
        
        <div class="alert alert-warning" role="alert">
      You have not privilege to view this page. <a href="javascript:history.go(-1)" class="alert-link">go home page</a> or contact your administrator.
    </div>
        ';
        }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body style="background-image:url(/img/error.jpg);background-repeat: no-repeat;">
    Go go Go go Go
</body>
</html>



<?php

}
?>