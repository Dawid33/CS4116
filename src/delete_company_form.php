<form action="delete_company.php" method="post">
    <input style="display:none;" name="user_id" value="<?php echo $current_user_id; ?>" type="text"> </input>
    <input style="display:none;" name="org_id" value="<?php echo $current_org_id; ?>" type="text"> </input>
    <button type="submit" class="btn btn-remove btn-danger btn-sm"> Delete Company </button>
</form>