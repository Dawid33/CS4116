<?php
    $user_id = $_GET["id"];
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);  

    $conn->close();

?>

<container>  
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-7">
                    <div class="card feed-item">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">About
                                <?php if($user_id == $_SESSION["user"]) print '<a href="edit_user.php" type="button" class="btn btn-sm btn-primary">Edit</a>' ?>
                            </h5>
                            <p class="card-text">Name:  <?php print $user_details["first_name"] ?> <?php print $user_details["last_name"] ?></p>
                            <p class="card-text">Bio: <?php echo $user_details["bio"] ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card feed-item">
                        <div class="card">
                            <div class="card-header">
                            Skills
                            </div>
                            <?php
                                $user_id = $_GET["id"];
                                $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                                if ($conn->connect_error) {
                                    die("Connection failure: " . $conn->connect_error);
                                }

                                $sql = "SELECT * FROM user_skills WHERE user_id = '$user_id'";
                                $result = mysqli_query($conn, $sql);
                                if ($result == false) {
                                    echo "Database error.";
                                } elseif ($result->num_rows == 0) {
                                    echo "No skills defined.";
                                } while ($row = $result->fetch_assoc()) {
                                    $sql = "SELECT title, skill_id FROM skills WHERE skill_id = '" . $row["skill_id"] . "'";
                                    $skill_result = mysqli_query($conn, $sql);
                                    $title = $skill_result->fetch_assoc()["title"];
                                    $user_skill_id = $row["user_skill_id"]; 
                                    include("skill_row.php");
                                }
                            ?>
                            <?php 
                                if (strcmp($user_id, $current_user_id) == 0) {
                                    include("add_skill_form.php");
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                           Qualifications 
                        </div>
                        <table class="style="table-layout: fixed; width: 100%;">
                            <?php
                                $user_id = $_GET["id"];
                                $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                                if ($conn->connect_error) {
                                    die("Connection failure: " . $conn->connect_error);
                                }

                                $sql = "SELECT * FROM qualifications WHERE user_id = '$user_id'";
                                $result = mysqli_query($conn, $sql);
                                if ($result == false) {
                                    echo "Database error.";
                                } elseif ($result->num_rows == 0) {
                                    echo "No qualificatoins supplied.";
                                } while ($row = $result->fetch_assoc()) {
                                    $title = $row["qualification_title"]; 
                                    $description = $row["qualification_description"]; 
                                    $qual_id = $row["qualification_id"];
                                    include("qualification.php");
                                }
                            ?>
                        </table>
                    </div>

                    </br>
                    <?php 
                        if (strcmp($user_id, $current_user_id) == 0) {
                            include("add_qualification_form.php");
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div id="nav-friends">
                <div class="card">
                    <div class="card-header">
                        Friends
                    </div>
                    <ul class="list-group">
                        <?php
                            $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failure: " . $conn->connect_error);
                            }
                    
                            $sql = "SELECT user_id_second FROM connections WHERE user_id_first = '" . $user_id. "';";
                            $result = mysqli_query($conn, $sql);
                            $friend_count = 0;
                            if ($result) {
                                if (mysqli_num_rows($result) == 0) {
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">You have no friends :(</li>';
                                } else {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($friend_count >= 5) {
                                            $friend_name = '<a href="/user.php?id=' . $user_id. '"> ... </a>';
                                            include('friend.php');
                                            break;
                                        }

                                        $friend_count += 1;
                                        $sql = "SELECT first_name, last_name FROM users WHERE user_id = '" . $row['user_id_second'] . "';";
                                        $friend_name_result = mysqli_query($conn, $sql);
                        
                                        if ($friend_name_result) {
                                            $friend_row = $friend_name_result->fetch_assoc();
                                            $friend_name = '<a href="/user.php?id=' . $row['user_id_second'] . '">' . $friend_row['first_name'] . " " . $friend_row['last_name'] . '</a>';
                                            include('friend.php');
                                        } else {
                                            echo "<div class='alert alert-danger'>Cannot fetch vacancies</div>";
                                        }
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</container>
<style>
    .btn {
        background-color: #242337;
        color: aliceblue;
    }
</style>
