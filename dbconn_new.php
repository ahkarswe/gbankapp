<?php
$servername = "gbank-server.mysql.database.azure.com";
$username = "ksqhgzhdhh";
$password = "P@ssw0rd";
$database = "gbank-database";

// Create connection
$conn = new mysqli($servername, $username, $password , $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    //echo"connected";
}
