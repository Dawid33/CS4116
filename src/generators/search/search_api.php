<?php
session_start();
$skill_params = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search_term = $_GET['search-term'];
    $search_type = $_GET['search-type'];
    foreach ($_GET as $key => $val) {
        if (preg_match("/skill/i", $key)) {
            array_push($skill_params, $val);
        }
    }
} else {
    $search_term = '';
    $search_type = '';
}

$conn = new mysqli("db", "cs4116", "cs4116", "cs4116");
if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
}

if ($search_type == "users") {
    $sql = "SELECT * FROM users a WHERE a.first_name LIKE '%". $search_term ."%' OR a.last_name LIKE '%". $search_term ."%' OR EXISTS (SELECT * FROM qualifications WHERE user_id = a.user_id and qualification_title LIKE '%". $search_term ."%' )";
    $result = mysqli_query($conn, $sql);

    if ($result == false) {
        $description = "Query failed";
        include('search_card.php');
    } elseif ($result->num_rows == 0) {
        $description = "No results.";
        include('search_card.php');
    } else {
        while ($row = $result->fetch_assoc()) {
            // Check whether vacancy conforms to skill search params.
            $sql = "SELECT * FROM user_skills WHERE user_id= '" . $row['user_id'] . "';";
            $vacancy_skills = mysqli_query($conn, $sql);

            $has_matched = false;
            if ($vacancy_skills == false || sizeof($skill_params) == 0) {
                $has_matched = false;
            } else {
                while ($vac_skill_row = $vacancy_skills->fetch_assoc()) {
                    foreach ($skill_params as $_ => $param) {
                        if (strcmp($vac_skill_row['skill_id'], $param) == 0) {
                            $has_matched = true;
                            break;
                        }
                    }
                    if (!$has_matched) {
                        break;
                    }
                }
            }

            if (sizeof($skill_params) == 0 ) {
                $has_matched = true;
            }

            $user_id = $row["user_id"];
            $current_user_id = $_SESSION["user"];
            $friend_search = "SELECT * FROM connections WHERE '$current_user_id' = user_id_first AND '$user_id' = user_id_second";
            $friend_result = mysqli_query($conn, $friend_search);
            $already_friends = false;

            if(mysqli_num_rows($friend_result)){
                $already_friends = true;
            }

            if ($has_matched) {
                $user_id = $row["user_id"];
                $already_connected = $already_friends;
                $title = '<a href="/user.php?id=' . $row['user_id'] . '">' . $row['first_name'] . " " . $row["last_name"] . '</a>';
                include('search_card.php');
            }
        }
    }
} elseif ($search_type == "vacancies") {
    $sql = "SELECT * FROM vacancies WHERE title LIKE '%" . $search_term . "%';";
    $result = mysqli_query($conn, $sql);

    if ($result == false) {
        $description = "Query failed";
        include('search_card.php');
    } elseif ($result->num_rows == 0) {
        $description = "No results.";
        include('search_card.php');
    } else {
        while ($row = $result->fetch_assoc()) {
            // Check whether vacancy conforms to skill search params.
            $sql = "SELECT * FROM vacancy_skills WHERE vacancy_id = '" . $row['vacancy_id'] . "';";
            $vacancy_skills = mysqli_query($conn, $sql);

            $has_failed = true;
            if ($vacancy_skills == false || sizeof($skill_params) == 0) {
                $has_failed = false;
            } else {
                while ($vac_skill_row = $vacancy_skills->fetch_assoc()) {
                    foreach ($skill_params as $_ => $param) {
                        if (strcmp($vac_skill_row['skill_id'], $param) == 0) {
                            $has_failed = false;
                            break;
                        }
                    }
                    if (!$has_failed) {
                        break;
                    }
                }
            }

            if (!$has_failed) {
                $title = '<a href="/vacancy.php?id=' . $row['vacancy_id'] . '">' . $row['title'] . '</a>';
                $description = $row['description'];
                include('search_card.php');
            }
        }
    }
} elseif ($search_type == "organisations") {
    $sql = "SELECT * FROM organisation WHERE name LIKE '%" . $search_term . "%';";
    $result = mysqli_query($conn, $sql);

    if ($result == false) {
        $description = "Query failed";
        include('search_card.php');
    } elseif ($result->num_rows == 0) {
        $description = "No results.";
        include('search_card.php');
    } else {
        while ($row = $result->fetch_assoc()) {
            $title = '<a href="/company.php?id=' . $row['org_id'] . '">' . $row['name'] . '</a>';
            include('search_card.php');
        }
    }
}
