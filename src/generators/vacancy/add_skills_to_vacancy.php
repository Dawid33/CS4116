<?php

use LDAP\Result;
print "check0";

    $vacancy_id = $_POST["vacancy_id"];
    $skill_id = $_POST["skill_id"];
    
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql_insert = "SELECT * FROM vacancy_skills WHERE skill_id ='$skill_id' and vacancy_id='$vacancy_id';";
    if ($result = $conn->query($sql_insert)) {
        print "check1";
        if ($result->num_rows > 0) {
            header("Location: vacancy.php?id=$vacancy_id");
            print "check2";
        } else {
            print "check3";
            $sql_insert = "INSERT INTO vacancy_skills (vacancy_id, skill_id) VALUES ('$vacancy_id', '$skill_id');";

            if (($conn->query($sql_insert))) {
                header("Location: vacancy.php?id=$vacancy_id");
            }else {
                echo $conn->error;
            }
        }
    } else {
        echo $conn->error;
    }
    $conn->close();
?>