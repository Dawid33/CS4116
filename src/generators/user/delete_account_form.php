
<div class ="card mt-4">
    <div class="card-header d-flex justify-content-between">
        <h5>delete account</h5>
    </div>
    <div class="card-body">
        <form action="delete_account.php" method="post">
            <input style="display:none;" name="user_id" value="<?php echo $user_id; ?>" type="text"> </input>
            <button type="button" class="mb-1 btn btn-submit btn-sm btn-primary">Delete account</button> 
        </form>
    </div>
</div>
