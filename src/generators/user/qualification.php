
<tr class="list-group-item d-flex">
    <td class="qual-remove"> 
        <form action="remove_qualification.php" method="post" id="remove-qualification">
            <input style="display:none" name="qualification_id" value="<?php echo $qual_id?>">
            <input style="display:none" name="user_id" value="<?php echo $current_user_id ?>">
            <button name="">Remove</button>
        </form>
    </td>
    <td class="qual-title"> <?php echo $title; ?> </td>
    <td> <?php echo $description; ?> </td>
</tr> 