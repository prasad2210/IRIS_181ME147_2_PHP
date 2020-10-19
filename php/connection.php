<?php
    $conn = new mysqli("localhost", "root", "", "gpacalculator");

    if($conn->connect_error){
        die("Database Connectivity Error");
    }

?>