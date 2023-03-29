<?php
    $vacancy_id = $_POST["vacancy_id"];
    $vacancy = $_POST["vacancy_skill_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "DELETE FROM vacancy_skills WHERE vacancy_skill_id='$vacancy';";

    if (($conn->query($sql_insert))) {
        header("Location: vacancy.php?id=" . $vacancy_id);
    }else {
        echo $conn->error;
    }

    $conn->close();
?>