<?php
    $user_id = $_POST["user_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_delete = "DELETE FROM users WHERE user_id='$user_id'";

    if (($conn->query($sql_delete))) {
        header("Location: search.php?search-type=users");
    }else {
        echo $conn->error;
    }

    $conn->close();
?>