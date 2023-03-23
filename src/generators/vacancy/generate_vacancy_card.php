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
            $skills = [];

            $sql = "SELECT * FROM vacancy_skills WHERE vacancy_id = '" . $_GET['id'] . "'";
            $vacancy_skill_result = mysqli_query($conn, $sql);
            if ($vacancy_skill_result == false) {
                echo "Database error.";
            } while ($row = $vacancy_skill_result->fetch_assoc()) {
                $sql = "SELECT title, skill_id FROM skills WHERE skill_id = '" . $row["skill_id"] . "'";
                $skill_result = mysqli_query($conn, $sql);
                $skill_title = $skill_result->fetch_assoc()["title"];
                array_push($skills, $skill_title);
            }
            include('vacancy_card.php');
        }
    } else {
        echo "Cannot find vacancy.";
    }
?>