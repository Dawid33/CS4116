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
        <?php if($search_type == "users" && $already_connected==false) { print "<a href='' type='button' class='btn btn-submit btn-sm btn-primary'>Add Connection</a>";}else{print "<a href='' type='button' class='btn btn-submit btn-sm btn-danger'>Remove Connection</a>";} ?>
    </div>
</div>

<form action="generators/user/add_connection.php" method="post">
    <input type="hidden" value="" name="user_id">
    <button href='' type='submit' name="add_friend" class='btn btn-submit btn-sm btn-primary'>Add Connection</button>
</form>
            
