<li class="list-group-item d-flex justify-content-between align-items-center">
    <?php echo $skill; 
    if ($isOwner == 1 || $_SESSION["user_is_admin"] == 1) {
        include "remove_vacancy_skill_form.php";
    } 
    ?>
</li> 


<style>
    .skill-list{
        margin-bottom: 10px;
    }

</style>