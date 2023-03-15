<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $search_term = $_GET['search-term'];
        $search_type = $_GET['search-type'];
    } else {
        $search_term = '';
        $search_type = '';
    }

    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");
    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    if ($search_type == "users") {
        $sql = "SELECT * FROM users WHERE first_name LIKE '%" . $search_term . "%';";
        $result = mysqli_query($conn, $sql);

        while($row = $result->fetch_assoc()) {
            $title = '<a href="http://' . $_SERVER['SERVER_NAME'] . '/user.php?id=' . $row['user_id'] . '">' . $row['first_name'] . " " . $row["last_name"] . '</a>';
            include('search_card.php');
        }
    } elseif ($search_type == "vacancies") {
        $sql = "SELECT * FROM vacancies WHERE title LIKE '%" . $search_term . "%';";
        $result = mysqli_query($conn, $sql);

        while($row = $result->fetch_assoc()) {
            $title = '<a href="http://' . $_SERVER['SERVER_NAME'] . '/vacancy.php?id=' . $row['vacancy_id'] . '">' . $row['title'] . '</a>';
            $description = $row['description'];
            include('search_card.php');
        }
    } elseif ($search_type == "organisations") {
        $sql = "SELECT * FROM organisation WHERE name LIKE '%" . $search_term . "%';";
        $result = mysqli_query($conn, $sql);

        while($row = $result->fetch_assoc()) {
            $title = '<a href="http://' . $_SERVER['SERVER_NAME'] . '/company.php?id=' . $row['org_id'] . '">' . $row['name'] . '</a>';
            include('search_card.php');
        }
    }
?>