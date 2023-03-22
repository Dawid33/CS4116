<tr class="qual-list list-group-item justify-content-between d-flex mb-2">
    <div>
        <td class="qual-title"> <b> <?php echo $title; ?> </b> </td>
        <td> <?php echo $description; ?> </td>
    </div>
    <div>
        <td>
            <?php
                if (strcmp($user_id, $current_user_id) == 0) {
                    include "remove_qualification_form.php";
                } 
            ?>
        </td>
    </div>
</tr>