<li class="list-group-item d-flex justify-content-between align-items-center">
    <?php
    echo $title;
    if (strcmp($user_id, $current_user_id) == 0) {
        include "remove_skill_form.php";
    } 
    ?>
</li>
