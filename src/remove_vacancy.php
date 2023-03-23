<?php
    $vacancy_id = $_POST["vacancy_id"];
    $org_id = $_POST["org_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "DELETE FROM vacancies WHERE vacancy_id='$vacancy_id';";

    if (($conn->query($sql_insert))) {
        header("Location: company.php?id=" . $org_id);
    }else {
        echo $conn->error;
    }

    $conn->close();
?>