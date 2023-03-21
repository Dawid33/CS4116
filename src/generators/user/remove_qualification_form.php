<td class="qual-remove">
    <form action="remove_qualification.php" method="post" id="remove-qualification">
        <input style="display:none" name="qualification_id" value="<?php echo $qual_id ?>">
        <input style="display:none" name="user_id" value="<?php echo $current_user_id ?>">
        <button class="btn btn-remove btn-danger btn-sm" name="">Remove</button>
    </form>
</td>