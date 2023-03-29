<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-subtitle mb-2"><?php echo $name ?></h5>
                <?php 
                if($isAdmin || $isOwner) {
                    include("remove_employee_form.php");
                }
                ?>
            </div>
        </div>
    </div>
</div>