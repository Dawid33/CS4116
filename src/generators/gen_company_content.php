<?php
    session_start();
    $current_user_id = $_SESSION["user"];
    $current_org_id = $_GET["id"];
    
    $isOwner = 0;
    $isAdmin = $_SESSION["user_is_admin"];
    $isAnEmployee = 0;
    $isCurrentEmployee = 0;
    $numberOfEmployees = 0;

    $ownerName = "No user specified";

    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    } 

    $userSql = "SELECT user_id FROM organisation WHERE org_id = '$current_org_id'";
    $userResult = $conn->query($userSql);
    
    while($row = $userResult->fetch_assoc()) {
        if ($row["user_id"] == $current_user_id) {
            $isOwner = 1;
        }

        $ownerNameSql = "SELECT first_name, last_name FROM users WHERE user_id = '{$row["user_id"]}'";
        $ownerNameResult = $conn->query($ownerNameSql);
        $user_details = mysqli_fetch_array($ownerNameResult, MYSQLI_ASSOC);
        $ownerName = $user_details["first_name"] . " " . $user_details["last_name"];

    }

    $orgSql = "SELECT name, description FROM organisation WHERE org_id = '$current_org_id'";
    $orgResult = $conn->query($orgSql);
    $org_details = mysqli_fetch_array($orgResult, MYSQLI_ASSOC);


    $isEmployeeSql = "SELECT * FROM organisation_employees WHERE org_id = '$current_org_id'";
    $isEmployeeResult = $conn->query($isEmployeeSql);
    while($r = $isEmployeeResult->fetch_assoc()){
        if($r["user_id"]==$current_user_id){
            $isAnEmployee=1;
        }
    }

?>

<head>
    <link href="css/button.css" rel="stylesheet" type="text/css">
</head>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="d-flex">
                        <h5>Company Info</h5>
                        <?php if($isAdmin || $isOwner) print "<a href='edit_org.php?id=$current_org_id' type='button' class='mx-2 btn btn-submit btn-sm btn-primary'>Edit Info</a>"?>
                    </div>
                    <?php if($isAdmin || $isOwner) include("delete_company_form.php");?>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">Name</h6>
                        <div>                    
                            <?php echo $org_details["name"]?>
                        </div>
                    <hr></hr>
                    <h6 class="card-subtitle mb-2">Description</h6>
                        <div>                    
                            <?php echo $org_details["description"]?>
                        </div>
                        <hr></hr>
                    <h6 class="card-subtitle mb-2">Owner</h6>
                        <div>                    
                            <?php echo $ownerName?>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Company Vacancies</h5>
                    <?php if($isAdmin || $isOwner) print "<a href='create_vacancy.php?id=$current_org_id' type='button' class='btn btn-submit btn-sm btn-primary'>Add Vacancy</a>"?>
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

                            $orgSql = "SELECT name FROM organisation WHERE org_id = '" . $row['org_id'] . "';";

                            $org_name_result = mysqli_query($conn, $orgSql);

                            if ($org_name_result) {
                                $org_name = '<a href="/company.php?id=' . $current_org_id . '">' . $org_name_result->fetch_assoc()['name'] . '</a>';
                                include('index/vacancy_card.php');
                            }
                        }         
                    ?>
                </div>
            </div>
        </div>
    </div>
<br>

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Company Employees</h5>
                    <?php 
                        if(!$isAnEmployee && !$isAdmin && !$isOwner) print '<a href="/add_employee.php?id=' . $current_user_id . "&org_id=" . $current_org_id . '"  type="button" class="btn btn-submit btn-sm btn-primary">' . 'Link Profile to Organisation' . '</a>';   
                    ?>
                </div>
                <div class="card-body">
                    <?php
                        $sql = "SELECT * FROM organisation_employees WHERE org_id = '" . $_GET['id'] . "'";
                        $result = $conn->query($sql);
 
                        if($result->num_rows == 0) {
                            print "This company has no employees";
                        } else {
                            $numberOfEmployees = $result->num_rows;
                            while($row = $result->fetch_assoc()) {
                                $userSql = "SELECT first_name, last_name FROM users WHERE user_id = '" . $row['user_id'] . "'";
                                $userResult = $conn->query($userSql);
                                while($row2 = $userResult->fetch_assoc()) {
                                    $name = '<a href="/user.php?id=' . $row['user_id'] . '">' . $row2['first_name'] . " " . $row2['last_name'] . '</a>';
                                }
    
                                $employeeSql = "SELECT employee_connection_id FROM organisation_employees WHERE user_id = '" . $row['user_id'] . "'";
                                $employeeResult = $conn->query($employeeSql);
                                $employee_details = mysqli_fetch_array($employeeResult, MYSQLI_ASSOC);
                                $employee_connection_id = $employee_details["employee_connection_id"];
                                
                                if ($current_user_id == $row['user_id']) {
                                    $isCurrentEmployee = 1;
                                }
                                    include('employee_card.php');
                             }
                        }         
                        
                        $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
