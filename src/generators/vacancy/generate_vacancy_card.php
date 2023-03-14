<?php
    if (isset($_GET['id'])) {
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        $sql = "SELECT title, description FROM vacancies where vacancy_id = '" . $_GET['id'] . "';";
        $result = mysqli_query($conn, $sql);
        if ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $description = $row['description'];
            include('vacancy_card.php');
        }
    } else {
        echo "Cannot find vacancy.";
    }
?>