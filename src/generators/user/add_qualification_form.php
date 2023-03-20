<div class="card">
    <div class="card-header">
        Add Qualifications 
    </div>

    <form action="add_qualification.php" method="post" id="add-qualification">
        <label> Title <input type="text" name="title" value""></input></label>
        <label> Description <textarea type="text" name="description" value""></textarea></label>
        <input style="display:none" name="user_id" value="<?php echo $user_id ?>">
        <button type="submit" class="btn btn-primary"> Submit </button>
    </form>
</div>