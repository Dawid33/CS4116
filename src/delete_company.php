<?php
    $current_org_id = $_GET["id"];
    $current_user_id = $_SESSION["user"];
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_delete = "DELETE FROM organisation WHERE org_id='$current_org_id';";

    if (($conn->query($sql_delete))) {
        header("Location: user.php?id=" . $current_user_id);
    }else {
        echo $conn->error;
    }

    $conn->close();
?>