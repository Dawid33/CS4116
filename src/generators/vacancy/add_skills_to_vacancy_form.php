<hr></hr>
<form action="vacancy_skills.php" method="post">
        <label> Add Skill:
            <select class="form-select form-select-sm" name="skill_id" id="skill_id">
                <?php
                    $sql = "SELECT * FROM skills";
                    $skills = mysqli_query($conn, $sql);

                    if ($skills == false) {
                        echo "Database error.";
                    } 
                    
                    while ($skill = $skills->fetch_assoc()) {
                        echo "<option name=\"skill_id\" value=\"" . $skill['skill_id'] . "\"> " . $skill['title'] . "</option>";
                    }
                ?>
            </select>
        </label>
        <input style="display:none" name="vacancy_id" value="<?php echo $vacancy_id ?>">
        <button type="submit" class="mb-1 btn btn-submit btn-sm btn-primary"> Add </button>
</form>

<style>
    .btn-submit {
        background-color: #242337;
        color: aliceblue;
        outline-color: #242337;
        border-color: #242337;
    }

    .btn-remove {
        background-color: #E24F3D;
    }
</style>
