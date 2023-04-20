<?php

use LDAP\Result;

    $current_user_id = $_SESSION["user_is_admin"];
    $user_id = $_GET["id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_ban = "UPDATE users
                SET is_banned='1'
                WHERE user_id='$id';";

    if (($conn->query($sql_insert))) {
        header("Location: user.php?id=$user_id");
    }else {
        echo $conn->error;
    }


    $conn->close();

?>