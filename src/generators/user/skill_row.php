<li class="skill-list list-group-item d-flex justify-content-between align-items-center">
    <?php
    echo $title;
    if (strcmp($user_id, $current_user_id) == 0 || $_SESSION["user_is_admin"] == 1) {
        include "remove_skill_form.php";
    } 
    ?>
</li>


<style>
    .skill-list{
        margin-bottom: 10px;
    }

</style>