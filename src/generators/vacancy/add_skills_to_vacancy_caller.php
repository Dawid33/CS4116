<?php 
                $sql = "SELECT * FROM vacancy_skills WHERE vacancy_id = '$vacancy_id'";
                $result = mysqli_query($conn, $sql);
                if ($result == false) {
                    echo "Database error.";
                } elseif ($result->num_rows == 0) {
                    echo "No skills defined.";
                } else { 
                    while ($row = $result->fetch_assoc()) {

                        $sql = "SELECT title, skill_id FROM skills WHERE skill_id = '" . $row["skill_id"] . "'";
                        $skill_result = mysqli_query($conn, $sql);
                        $title = $skill_result->fetch_assoc()["title"];
                        $user_skill_id = $row["vacancy_skill_id"]; 
                        include("skill_row.php");
                    }
                    if ($isOwner == 1 || $_SESSION["user_is_admin"] == 1) {
                        include("add_skills_to_vacancy_form.php");
                    }
    }
?>