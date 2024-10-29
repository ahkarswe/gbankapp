<?php
session_start();
if($_SESSION['ugroup']=='Admin'){


include 'dbconn_new.php';
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql="DELETE FROM inventory WHERE id=$id";
    $conn->query($sql);
}
header("location:/inventory.php");
exit;


}else{
    //header("location: javascript://history.go(-1)");
    header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=1');
       
    exit();
}
?>