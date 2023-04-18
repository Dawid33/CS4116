<?php
    session_start();
    $current_user_id = $_SESSION["user"];
    
    $user_id = $_GET["id"];
    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $orgSql = "SELECT org_id FROM organisation WHERE user_id = '$user_id'";
    $orgResult = mysqli_query($conn, $orgSql);
    $org_details = mysqli_fetch_array($orgResult, MYSQLI_ASSOC);
    $org_id_for_button = $org_details['org_id'];

    $connections_search = "SELECT * FROM connections WHERE '$current_user_id' = user_id_first AND '$user_id' = user_id_second";
    $connections_result = mysqli_query($conn, $connections_search);
    $already_connected = false;
    if(mysqli_num_rows($connections_result)){
        $already_connected = true;
    }
?>

<head>
    <link href="css/button.css" rel="stylesheet" type="text/css">
</head>

<container>  
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-7">
                    <div class="card feed-item">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h5>About</h5> 
                                <div>
                                    <?php 
                                    if (empty($org_details)) {
                                        if($user_id == $_SESSION["user"] || $_SESSION["user_is_admin"] == 1) print '<a href="create_organisation.php" type="button" class="mb-1 btn btn-submit btn-sm btn-primary">Create Organisation</a>';
                                    } else {
                                        if($user_id == $_SESSION["user"] || $_SESSION["user_is_admin"] == 1) print "<a href='company.php?id=$org_id_for_button' type='button' class='mb-1 btn btn-submit btn-sm btn-primary'>View Organisation</a>";
                                    }?> 
                                    <?php if($user_id == $_SESSION["user"] || $_SESSION["user_is_admin"] == 1) print "<a href='edit_user.php?id=$user_id' type='button' class='mb-1 btn btn-submit btn-sm btn-primary'>Edit</a>"; ?>
                                    <?php if($already_connected==false && $user_id!=$current_user_id && $_SESSION["user_is_admin"]!=1) { ?>
                                        <form action="add_connection.php" method="post">
                                            <input type="hidden" value="<?php echo $user_id ?>" name="user_id"></input>
                                            <input type="hidden" value="profile" name="location"></input>
                                            <input type='submit' name="add_friend" value="Add Connection" class='btn btn-submit btn-sm btn-primary'></input>
                                        </form>
                                    <?php } else if($already_connected==true) { ?>
                                        <form action="remove_connection.php" method="post">
                                            <input type="hidden" value="<?php echo $user_id ?>" name="user_id"></input>
                                            <input type="hidden" value="profile" name="location"></input>
                                            <input type='submit' name="add_friend" value="Remove Connection" class='btn btn-remove btn-sm btn-danger'></input>
                                        </form>
                                    <?php } ?>
                                </div>                            
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2">Name</h6>
                                <p class="card-text"> <?php print $user_details["first_name"] ?> <?php print $user_details["last_name"] ?></p>
                                <?php if(!empty($user_details["bio"])) { ?>
                                    <hr></hr>
                                    <h6 class="card-subtitle mb-2">Bio</h6>
                                    <p class="card-text"> <?php echo $user_details["bio"]  ?></p> 
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="card feed-item">
                        <div class="card">
                            <div class="card-header">
                                <h5>Skills</h5> 
                            </div>
                            <div class="card-body">
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
                                    if (strcmp($user_id, $current_user_id) == 0 || $_SESSION["user_is_admin"] == 1) {
                                        include("add_skill_form.php");
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                           <h5>Qualifications</h5> 
                        </div>
                        <div class="card-body">
                            <table style="table-layout: fixed; width: 100%;">
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
                                        echo "No qualifications supplied.";
                                    } while ($row = $result->fetch_assoc()) {
                                        $title = $row["qualification_title"]; 
                                        $description = $row["qualification_description"]; 
                                        $qual_id = $row["qualification_id"];
                                        include("qualification.php");
                                    }
                                ?>
                            </table>
                        </div>
                    </div>

                    </br>
                    <?php 
                        if (strcmp($user_id, $current_user_id) == 0 || $_SESSION["user_is_admin"] == 1) {
                            include("add_qualification_form.php");
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div id="nav-friends">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Friends</h5>
                        <?php if($user_id == $_SESSION["user"] || $_SESSION["user_is_admin"] == 1) print "<a href='search.php?search-type=users' type='button' class='mb-1 btn btn-submit btn-sm btn-primary'>Connections</a>"; ?>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php
                                $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failure: " . $conn->connect_error);
                                }
                        
                                $sql = "SELECT user_id_second FROM connections WHERE user_id_first = '" . $current_user_id. "';";
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

            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between">
                    <h5>Employment</h5>
                </div>
                <div class="card-body">
                    
                    <?php
                        $employmentSql = "SELECT org_id FROM organisation_employees WHERE user_id = '$current_user_id'";
                        $employmentResult = $conn->query($employmentSql);

                        while($r = $employmentResult->fetch_assoc()){
                            $test = $r["org_id"];
                            
                            $getOrgSql = "SELECT * FROM organisation WHERE org_id = '$test'";
                            $getOrgResult = $conn->query($getOrgSql);
                            $org = $getOrgResult->fetch_assoc();

                            $orgId = $org["org_id"];
                            print "<p class='card-text'>" . "<a href='company.php?id=$orgId'>" . $org['name'] . "</p>";
                        }

                        $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</container>
