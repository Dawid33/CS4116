<?php
$vacancySql = 'SELECT * FROM vacancy_skills WHERE vacancy_id = "' . $vacancy_id . '"';
$vacancyResult = $conn->query($vacancySql);
while ($row = $vacancyResult->fetch_assoc()) {
    $vacancy_skill_id = $row["vacancy_skill_id"];
}
?>

<form action="remove_vacancy_skill.php" method="post">
    <input style="display:none;" name="vacancy_skill_id" value="<?php echo $vacancy_skill_id; ?>" type="text"> </input>
    <input style="display:none;" name="vacancy_id" value="<?php echo $vacancy_id; ?>" type="text"> </input>
    <button type="submit" class="btn btn-remove btn-danger btn-sm"> Remove </button>
</form>