<?php
    $user_id = $_POST["user_id"];
    $id = $_POST["user_skill_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "DPDATE users
    SET is_banned='1'
    WHERE user_id='$id';";

    if (($conn->query($sql_insert))) {
        header("Location: user.php?id=" . $user_id);
    }else {
        echo $conn->error;
    }

    $conn->close();
?>