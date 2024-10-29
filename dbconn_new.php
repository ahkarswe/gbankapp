<?php
$servername = "ahkar_mariadb_1";
$username = "root";
$password = "P@ssw0rd";
$database = "mindgnite";

// Create connection
$conn = new mysqli($servername, $username, $password ,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    //echo"connected";
}