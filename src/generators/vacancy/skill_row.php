<li class="list-group-item d-flex justify-content-between align-items-center">
    <?php echo $skill; 

    $vacancy_skill_id;
    $skillSql = 'SELECT skill_id FROM skills WHERE title = "' . $skill . '"';
    $skillResult = $conn->query($skillSql);
    while ($row = $skillResult->fetch_assoc()) {
        $vacancySql = 'SELECT * FROM vacancy_skills WHERE vacancy_id = "' . $vacancy_id . '" AND skill_id = "' . $row["skill_id"] . '"';
        $vacancyResult = $conn->query($vacancySql);
        while ($row = $vacancyResult->fetch_assoc()) {
            $vacancy_skill_id = $row["vacancy_skill_id"];
        }
    }
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