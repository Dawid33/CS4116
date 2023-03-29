<?php
    $org_id = $_POST["org_id"];
    $id = $_POST["employee_connection_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "DELETE FROM organisation_employees WHERE employee_connection_id='$id';";

    if (($conn->query($sql_insert))) {
        header("Location: company.php?id=" . $org_id);
    }else {
        echo $conn->error;
    }

    $conn->close();
?>