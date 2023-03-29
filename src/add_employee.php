<?php

$user_id = $_GET["id"];
$organisation_id = $_GET["org_id"];

use LDAP\Result;
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "SELECT * FROM organisation_employees WHERE user_id='$user_id' AND org_id ='$organisation_id';";
    if ($result = $conn->query($sql_insert)) {
        if ($result->num_rows > 0) {
            header("Location: company.php?id=$organisation_id");
        } else {
            $sql_insert = "INSERT INTO organisation_employees (user_id, org_id) VALUES ('$user_id', '$organisation_id');";

            if (($conn->query($sql_insert))) {
                header("Location: company.php?id=$organisation_id");
            }else {
                echo $conn->error;
            }
        }
    } else {
        echo $conn->error;
    }


    $conn->close();
?>