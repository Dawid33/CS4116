<tr class="list-group-item d-flex">
    <?php
    if (strcmp($user_id, $current_user_id) == 0) {
        include "remove_qualification_form.php";
    } 
    ?>
    <td class="qual-title"> <?php echo $title; ?> </td>
    <td> <?php echo $description; ?> </td>
</tr>