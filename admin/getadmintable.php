<?php

require('../connection.php');

// Attempt select query execution
$sql = "SELECT * FROM `2020` ORDER BY `2020`.`date`";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){

            // Change decimal sign to comma
            $distance = str_replace('.', ',', $row['distance']);
            if ($distance > 0) {
                $distance = $distance . " km";
            };

            // Turn date to "normal" norwegian order: dd-mm-yyyy
            if ($row['date'] > 0) {
                $newDate = date("d-m-Y", strtotime($row['date']));
                $newDate = str_replace('-', '/', $newDate);
            };

            echo "<tr>";
                echo "<td>" . $newDate . "</td>";
                echo "<td>" . $row['dog'] . "</td>";
                echo "<td>" . $row['breed'] . "</td>";
                echo "<td>" . $row['ownername'] . "</td>";
                echo "<td><a href=\"mailto:" . $row['email'] . "\" >" . $row['email'] . "</a></td>";
                echo "<td>" . $row['place'] . "</td>";
                echo "<td>" . $distance . "</td>";
            echo "</tr>";
        }
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
// Close connection
mysqli_close($conn);

?>