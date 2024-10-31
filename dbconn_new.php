<?php
$servername = "gbank-server.mysql.database.azure.com";
$username = "ksqhgzhdhh";
$password = "P@ssword";
$database = "gbank-database";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username,$port, $password ,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    //echo"connected";
}
