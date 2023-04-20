<tr class="qual-list list-group-item justify-content-between d-flex">
    <td class="qual-title"> <b> <?php echo $title; ?> </b> </td>
    <td style="width: 65%;"> <?php echo $description; ?> </td>
    <td class="mr-auto p-2">
        <?php
        if (strcmp($user_id, $current_user_id) == 0 || $_SESSION["user_is_admin"] == 1) {
            include "remove_qualification_form.php";
        } 
        ?>
    </td>
</tr>