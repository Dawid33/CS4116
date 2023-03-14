
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
                <a class="navbar-brand" href="/index.php">WiredIn</a>
                <ul class="navbar-nav">
                    <li>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
                </ul>
            </div>
        </nav>
        <div id="content-container">
            <?php include($content_php_file); ?>
        </div>
        <footer class="card">
            <p class="card-text">This is the footer.</p>
        </footer>
    </div>
</body>
</html>