<?php
    session_start();
    $current_user_id = $_SESSION["user"];
    $connect_user = $_POST["user_id"];
    $location = $_POST["location"];

    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $remove_connection_query = "DELETE FROM connections WHERE user_id_first = '$current_user_id' AND user_id_second = '$connect_user'";

    if ($conn->query($remove_connection_query) === TRUE) {
        if($location == "profile"){
            header("Location: user.php?id=".$connect_user);
        }else{
            header("Location: search.php?search-type=users");
        }
    } else {
        $conn->error;
    }
    
    $conn->close();
?>
