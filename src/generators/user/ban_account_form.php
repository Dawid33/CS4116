<?php if(!$user_details["is_banned"]) { ?>
    <form action="ban_account.php" method="post">
        <input style="display:none;" name="user_id" value="<?php echo $user_id; ?>" type="text"> </input>
        <button type="submit" class="mb-1 btn btn-submit btn-warning">Ban user</button> 
    </form>
<?php } else { ?>
    <form action="unban_account.php" method="post">
        <input style="display:none;" name="user_id" value="<?php echo $user_id; ?>" type="text"> </input>
        <button type="submit" class="mb-1 btn btn-submit btn-warning">Unban user</button> 
    </form>
<?php } ?>