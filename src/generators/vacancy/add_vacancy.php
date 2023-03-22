<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/create_vacancy.css" rel="stylesheet" type="text/css">
</head>
<body>

<hr></hr>
<form action="create_vacancy.php" method="post">
        <label> Add vacancy
        <br>
        <div>
            <label for="title">Title</label>
            <input class="form-control input-lg" id="title" type="text" name = "title">
        </div>
        <div class="description">
            <label for="description">Description</label>
            <input class="form-control input-lg" id="description" type="text" name = "desc">
        </div>
        <div class="required_experience">
            <label for="required_experience">Required experience</label>
            <input class="form-control input-lg" id="required_experience" type="text" name = "req_exp">
        </div>
        <button class ="btn btn-dark btn-lg my-3" name = "submit">Submit</button>
</form>

</body>
</html>