<?php
    session_start();
    $current_user_id = $_SESSION["user"];
    $current_org_id = $_GET["id"];
    $can_edit=false;
    $isOwner = 0;
    $isAdmin = 0;

    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM organisation WHERE org_id = '$current_org_id'";
    $result = mysqli_query($conn, $sql);
    $org_details = mysqli_fetch_array($result, MYSQLI_ASSOC); 


    $userSql = "SELECT user_id FROM organisation WHERE org_id = '$current_org_id'";
    $userResult = $conn->query($userSql);
    
    $isOwner = 0;

    while($row = $userResult->fetch_assoc())
    {
        if ($row["user_id"] == $current_user_id) {
            $isOwner = 1;
        }
    }
    
    $adminSql = "SELECT is_admin FROM users WHERE user_id = '" . $current_user_id . "';";
    $adminResult = $conn->query($adminSql);

    while($row = $adminResult->fetch_assoc())
    {
        if ($row["is_admin"] == 1) {
            $isAdmin = 1;
        }
    }

    $conn->close();
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <h5>Company Info</h5>
                    <div>
                         <?php if($isAdmin || $isOwner) print "<a href='edit_org_name.php' type='button' class='btn btn-submit btn-sm btn-primary mr-1'>Edit</a>"?>
                         <?php if($isAdmin || $isOwner) print "<a href='create_vacancy.php?id=$current_org_id' type='button' class='btn btn-submit btn-sm btn-primary'>Add Vacancy</a>"?>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Company Info</h6>
                        <div>                    
                            <?php echo $org_details["name"]?>
                        </div>
                    <hr></hr>
                    <h6 class="card-subtitle mb-2">Description</h6>
                        <div>                    
                            <?php echo $org_details["description"]?>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Company Vacancies</h5>
                </div>
                <div class="card-body">
                    <?php
                        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                        if ($conn->connect_error) {
                            die("Connection failure: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM vacancies WHERE org_id = '" . $_GET['id'] . "' ORDER BY creation_date";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()) {
                            $vacancy_id = $row['vacancy_id'];
                            $title = '<a href="/vacancy.php?id=' . $row['vacancy_id'] . '">' . $row['title'] . '</a>';
                            $description = $row['description'];
                            $org_id = $_GET['id'];

                            $sql = "SELECT name FROM organisation WHERE org_id = '" . $row['org_id'] . "';";

                            $org_name_result = mysqli_query($conn, $sql);

                            if ($org_name_result) {
                                $org_name = '<a href="/company.php?id=' . $row['vacancy_id'] . '">' . $org_name_result->fetch_assoc()['name'] . '</a>';
                                include('index/vacancy_card.php');
                            }
                        }         
                    ?>
                </div>
            </div>
        </div>
    </div>
    
</div>

<style>
    .btn-submit {
        background-color: #242337;
        color: aliceblue;
        outline-color: #242337;
        border-color: #242337;
    }

    .btn-remove {
        background-color: #E24F3D;
    }
</style>
