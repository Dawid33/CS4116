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