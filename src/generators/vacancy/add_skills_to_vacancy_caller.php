<?php 
                $sql = "SELECT * FROM vacancy_skills WHERE vacancy_id = '$vacancy_id'";
                $result = mysqli_query($conn, $sql);
                if ($result == false) {
                    echo "Database error.";
                } elseif ($result->num_rows == 0) {
                    echo "No skills defined.";
                } else {
                    if ($isOwner == 1 || $_SESSION["user_is_admin"] == 1) {
                        include("add_skills_to_vacancy_form.php");
                    }
    }
?>