<?php

    $user_id = $_POST["user_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "INSERT INTO qualifications (user_id, qualification_title, qualification_description, qualification_degree, qualification_year) VALUES ('$user_id', '$title', '$description', '', NOW());";

    if (($conn->query($sql_insert))) {
        header("Location: user.php?id=$user_id");
    }else {
        echo $conn->error;
    }


    $conn->close();
?>