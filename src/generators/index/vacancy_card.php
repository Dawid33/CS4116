<head>
    <link href="css/button.css" rel="stylesheet" type="text/css">
</head>

<div class="card feed-item">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title"><?php echo $title ?></h5>
            <?php if ($isAdmin || $isOwner) { ?>
            <form action="remove_vacancy.php" method="post">
                <input style="display:none;" name="vacancy_id" value="<?php echo $vacancy_id; ?>" type="text"> </input>
                <input style="display:none;" name="org_id" value="<?php echo $org_id; ?>" type="text"> </input>
                <input class="btn btn-sm btn-remove btn-danger" type="submit" name="remove" value="Remove Vacancy"></input>
            </form>
            <?php } ?>
        </div>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $org_name ?></h6>
        <p class="card-text"><?php echo $description ?></p>
    </div>
</div>