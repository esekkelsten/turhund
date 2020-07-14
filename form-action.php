<?php

require('connection.php');
 
// Prepare an insert statement
$sql = "INSERT INTO `2020` (`date`, `ownername`, email, dog, breed, place, distance) VALUES (?, ?, ?, ?, ?, ?, ?)";
 
if($stmt = mysqli_prepare($conn, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssssd", $date, $ownername, $email, $dog, $breed, $place, $distance);
    
    // Set parameters
    $date = $_POST['date'];
    $ownername = $_POST['ownername'];
    $email = $_POST['email'];
    $dog = $_POST['dog'];
    $breed = $_POST['breed'];

    if ($breed == "breed-other") {
        $breed = $_POST['breed-other'];
    }

    $place = $_POST['place'];
    $distance = $_POST['distance'];
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}
 
// Close statement
mysqli_stmt_close($stmt);
 
// Close connection
mysqli_close($conn);
?>