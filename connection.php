<?php

$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$host = getenv('DB_HOST');
$database = "turhund";

// Create connection
$conn = mysqli_connect($host,$username,$password,$database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>