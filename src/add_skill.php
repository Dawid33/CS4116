<?php

use LDAP\Result;

    $user_id = $_POST["user_id"];
    $skill_id = $_POST["skill_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "SELECT * FROM user_skills WHERE skill_id ='$skill_id' and user_id='$user_id';";
    if ($result = $conn->query($sql_insert)) {
        if ($result->num_rows > 0) {
            header("Location: user.php?id=$user_id");
        } else {
            $sql_insert = "INSERT INTO user_skills (user_id, skill_id) VALUES ('$user_id', '$skill_id');";

            if (($conn->query($sql_insert))) {
                header("Location: user.php?id=$user_id");
            }else {
                echo $conn->error;
            }
        }
    } else {
        echo $conn->error;
    }


    $conn->close();
?>