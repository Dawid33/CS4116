<p> <?php echo $title; ?> </p>
<form action="remove_skill.php" method="post">
    <input style="display:none;" name="user_skill_id" value="<?php echo $user_skill_id; ?>" type="text"> </input>
    <input style="display:none;" name="user_id" value="<?php echo $user_id; ?>" type="text"> </input>
    <button type="submit"> Remove </button>
</form>