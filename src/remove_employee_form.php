<form action="remove_employee.php" method="post">
    <input style="display:none;" name="employee_connection_id" value="<?php echo $employee_connection_id; ?>" type="text"> </input>
    <input style="display:none;" name="org_id" value="<?php echo $org_id; ?>" type="text"> </input>
    <button type="submit" class="btn btn-remove btn-danger btn-sm"> Remove Employee </button>
</form>