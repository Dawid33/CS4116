
<h5 class="card-title">Add Skill</h5>
<form action="add_skill.php" method="post">
    <label> Field
        <select name="skill_id" id="skill_id">
            <?php
                $sql = "SELECT * FROM skills";
                $skills = mysqli_query($conn, $sql);

                if ($skills == false) {
                    echo "Database error.";
                } while ($skill = $skills->fetch_assoc()) {
                    echo "<option name=\"skill_id\" value=\"" . $skill['skill_id'] . "\"> " . $skill['title'] . "</option>";
                }
            ?>
        </select>
    </label>
    <input style="display:none" name="user_id" value="<?php echo $current_user_id ?>">
    <button type="submit" class="btn btn-sm btn-primary"> Submit </button>
</form>