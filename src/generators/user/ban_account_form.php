
<div class ="card mt-4">
    <div class="card-header d-flex justify-content-between">
        <h5>Ban account</h5>
    </div>
    <div class="card-body">
        <form action="ban_account.php" method="post">
            <input style="display:none;" name="user_id" value="<?php echo $user_id; ?>" type="text"> </input>
            <button type="button" class="mb-1 btn btn-submit btn-sm btn-primary">Ban account</button> 
        </form>
    </div><div class="card-body">
        <form action="unban_account.php" method="post">
            <input style="display:none;" name="user_id" value="<?php echo $user_id; ?>" type="text"> </input>
            <button type="button" class="mb-1 btn btn-submit btn-sm btn-primary">unban account</button> 
        </form>
    </div>
</div>
