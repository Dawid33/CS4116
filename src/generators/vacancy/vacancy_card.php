<?php 
$current_user_id = $_SESSION["user"];
$isAdmin = $_SESSION["user_is_admin"];
$vacancy_id = $_GET["id"]; 
$isOwner = 0;

    $orgSql = "SELECT org_id FROM vacancies WHERE vacancy_id = '$vacancy_id'";
    $orgResult = $conn->query($orgSql);
    
    while ($row = $orgResult->fetch_assoc()) {

        $userSql = 'SELECT user_id FROM organisation WHERE org_id = "' . $row["org_id"] . '"';
        $userResult = $conn->query($userSql);

        while($row = $userResult->fetch_assoc()) {
        if ($row["user_id"] == $current_user_id) {
            $isOwner = 1;
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <h5>Vacancy</h5>
            </div>
            <div class="card-body">
                <h5 class="card-subtitle mb-2"><?php echo $title ?></h5>
                    
                <div>
                    <?php echo $description ?>
                </div>
                <hr>
                </hr>
                <h6 class="card-subtitle mb-2"> Required Skills</h6>
                <?php
                // if ($isOwner == 1 || $_SESSION["user_is_admin"] == 1) {
                //         include("add_skills_to_vacancy_caller.php");
                //     }
                ?>
                    <ul class="list-group">
                    <?php
                    if (sizeof($skills) > 0) {
                        foreach ($skills as $key => $skill) {
                            include("skill_row.php");
                        }
                    } else {
                        echo "No required skills.";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>