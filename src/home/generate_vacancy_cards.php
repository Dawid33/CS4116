<?php
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql = "SELECT org_id, title, description FROM vacancies;";
    $result = mysqli_query($conn, $sql);

    $failed = false;
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $description = $row['description'];

            $sql = "SELECT email FROM organisation WHERE org_id = '" . $row['org_id'] . "';";
            $org_name_result = mysqli_query($conn, $sql);

            if ($result) {
                $org_name = $org_name_result->fetch_assoc()['name'];
                include('vacancy_card.php');
            } else {
                $failed = true;
                break;
            }
        }
    } else {
        $failed = true;
    }

    if ($failed) {
        echo "<div class='alert alert-danger'>Cannot fetch vacancies</div>";
    }
    
?>