<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-subtitle"><?php echo $name ?></h5>
                <?php 
                    if($isAdmin || $isOwner || $isCurrentEmployee) {
                        if ($numberOfEmployees <= 1) {
                            print "Cannot remove every employee from a company!";
                        } else {
                            include("remove_employee_form.php");
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>