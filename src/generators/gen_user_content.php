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
                            <h5 class="card-title">About</h5>
                            <p class="card-text">Name:  <?php print $user_details["first_name"] ?> <?php print $user_details["last_name"] ?></p>
                            <p class="card-text">Bio: <?php print $user_details["bio"]?></p>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card feed-item">
                        <div class="card-body">
                            <h5 class="card-title">Skills</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="card feed-item">
                        <div class="card-body">
                            <h5 class="card-title">Experience</h5>
                        </div>
                    </div>
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
                    
                            $sql = "SELECT user_id_second FROM connections WHERE user_id_first = '" . $current_user_id . "';";
                            $result = mysqli_query($conn, $sql);
                            $friend_count = 0;
                            if ($result) {
                                if (mysqli_num_rows($result) == 0) {
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">You have no friends :(</li>';
                                } else {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($friend_count >= 5) {
                                            $friend_name = '<a href="/user.php?id=' . $current_user_id . '"> ... </a>';
                                            include('friend.php');
                                            break;
                                        }

                                        $friend_count += 1;
                                        $sql = "SELECT first_name, last_name FROM users WHERE user_id = '" . $row['user_id_second'] . "';";
                                        $friend_name_result = mysqli_query($conn, $sql);
                        
                                        if ($friend_name_result) {
                                            $friend_row = $friend_name_result->fetch_assoc();
                                            $friend_name = '<a href="/user.php?id=' . $row['user_id_second'] . '">' . $friend_row['first_name'] . " " . $friend_row['last_name'] . '</a>';
                                            include('index/friend.php');
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
    /* .padding-top {
        s
    } */
</style>
