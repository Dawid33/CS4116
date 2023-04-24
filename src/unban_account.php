<?php
    $user_id = $_POST["user_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_update = "UPDATE users SET is_banned='0' WHERE user_id='$user_id'";

    if (($conn->query($sql_update))) {
        header("Location: user.php?id=" . $user_id);
    }else {
        echo $conn->error;
    }

    $conn->close();
?>