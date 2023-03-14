<content>
    <?php
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        $sql = "SELECT org_id, vacancy_id, title, description FROM vacancies;";
        $result = mysqli_query($conn, $sql);

        $failed = false;
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $title = '<a href="http://' . $_SERVER['SERVER_NAME'] . '/vacancy.php?id=' . $row['vacancy_id'] . '">' . $row['title'] . '</a>';
                $description = $row['description'];

                $sql = "SELECT name FROM organisation WHERE org_id = '" . $row['org_id'] . "';";
                $org_name_result = mysqli_query($conn, $sql);

                if ($org_name_result) {
                    $org_name = '<a href="http://' . $_SERVER['SERVER_NAME'] . '/company.php?id=' . $row['vacancy_id'] . '">' . $org_name_result->fetch_assoc()['name'] . '</a>';
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
</content>

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
                if ($result) {
                    if (mysqli_num_rows($result) == 0) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">You have no friends :(</li>';
                    } else {
                        while ($row = $result->fetch_assoc()) {
                            $sql = "SELECT first_name, last_name FROM users WHERE user_id = '" . $row['user_id_second'] . "';";
                            $friend_name_result = mysqli_query($conn, $sql);
            
                            if ($friend_name_result) {
                                $friend_row = $friend_name_result->fetch_assoc();
                                $friend_name = '<a href="http://' . $_SERVER['SERVER_NAME'] . '/user.php?id=' . $row['user_id_second'] . '">' . $friend_row['first_name'] . " " . $friend_row['last_name'] . '</a>';
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

<!-- <li class="list-group-item d-flex justify-content-between align-items-center">
    A list item
    <span class="badge bg-primary rounded-pill">14</span>
</li>
<li class="list-group-item d-flex justify-content-between align-items-center">
    A second list item
    <span class="badge bg-primary rounded-pill">2</span>
</li>
<li class="list-group-item d-flex justify-content-between align-items-center">
    A third list item
    <span class="badge bg-primary rounded-pill">1</span>
</li> -->