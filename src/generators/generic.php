
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/generic.css" rel="stylesheet" type="text/css">
    <?php echo $head_content ?>
    <title>Bootstrap demo</title>
</head>

<body>
    <div id="main-container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/index.php"><b>WiredIn</b></a>
                <ul class="navbar-nav">
                    <li class="navbar-brand"><a class="nav-link active" href="/search.php">Search</a></li>
                    <li class="navbar-brand"><a class="nav-link active" href="/index.php">Home</a></li>
                    <li class="navbar-brand"><a class="nav-link active" href="/user.php?id=<?php print $current_user_id ?>">Profile</a></li>
                    <li class="navbar-brand"><a class="nav-link active" href="/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div id="content-container">
            <?php include($content_php_file); ?>
        </div>
    </div>
    <?php print $js_body; ?>
</body>
</html>
