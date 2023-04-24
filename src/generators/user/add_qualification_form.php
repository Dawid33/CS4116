<div class="card">
    <div class="card-header">
        <h5>Add Qualifications</h5> 
    </div>
    <div class="card-body">
        <form action="add_qualification.php" method="post" id="add-qualification">
            <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder="Title" required></input>
            </div>
            <br>
            <div class="form-group">
                <span class="input-group-btn" style="width:5px;"></span>

                <textarea class="form-control" type="text" name="description" placeholder="Description"></textarea>
            </div>
            <br>
            <input style="display:none" name="user_id" value="<?php echo $user_id ?>">
            <button type="submit" class="btn btn-submit btn-sm btn-primary"> Submit </button>
        </form>
    </div>
</div>