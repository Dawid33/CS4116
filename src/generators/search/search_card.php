<?php 
    $search_type = $_GET["search-type"];
?>

<div class="card feed-item search-card">
    <div class="card-body d-flex justify-content-between">
        <div>
            <h5 class="card-title"><?php echo $title ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $org_name ?></h6>
            <p class="card-text"><?php echo $description ?></p>
        </div>
        <?php if($search_type == "users" && $already_connected==false && $user_id!=$_SESSION["user"]) { ?>
            <form action="add_connection.php" method="post">
                <input type="hidden" value="<?php echo $user_id ?>" name="user_id"></input>
                <input type="hidden" value="search" name="location"></input>
                <input type='submit' name="add_friend" value="Add Connection" class='btn btn-submit btn-sm btn-primary'></input>
            </form>
        <?php } else if($search_type == "users" && $user_id!=$_SESSION["user"]) { ?>
            <form action="remove_connection.php" method="post">
                <input type="hidden" value="<?php echo $user_id ?>" name="user_id"></input>
                <input type="hidden" value="search" name="location"></input>
                <input type='submit' name="add_friend" value="Remove Connection" class='btn btn-remove btn-sm btn-danger'></input>
            </form>
        <?php } ?>
    </div>
</div>
            
