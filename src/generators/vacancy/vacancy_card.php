<!-- <div class="card feed-item">
    <div class="card-body">
        <h5 class="card-title"><?php echo $title ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $org_name ?></h6>
        <p class="card-text"><?php echo $description ?></p>
    </div>
</div> -->
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <h5>Vacancy</h5>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Company Info</h6>
                <div>
                    <?php echo $title ?>
                </div>
                <hr>
                </hr>
                <h6 class="card-subtitle mb-2">Description</h6>
                <div>
                    <?php echo $description ?>
                </div>
                <hr>
                </hr>
                <h6 class="card-subtitle mb-2"> Required Skills</h6>
                <ul class="list-group">
                    <?php
                    foreach ($skills as $key => $skill) {
                        include("skill_row.php");
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>