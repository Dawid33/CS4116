<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <title>Bootstrap demo</title>
</head>

<body>
    <div id="main-container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">WiredIn</a>
                <ul class="navbar-nav">
                    <li>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Forum</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Watchlist</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
                </ul>
            </div>
        </nav>
        <content>
            <div class="card feed-item">
                <div class="card-body">
                    <h5 class="card-title">Job Title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Organisation</h6>
                    <p class="card-text">Short job description.</p>
                </div>
            </div>
            <div class="card feed-item">
                <div class="card-body">
                    <h5 class="card-title">Job Title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Organisation</h6>
                    <p class="card-text">Short job description.</p>
                </div>
            </div>
            <div class="card feed-item">
                <div class="card-body">
                    <h5 class="card-title">Job Title</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Organisation</h6>
                    <p class="card-text">Short job description.</p>
                </div>
            </div>
        </content>
        <nav id="nav-friends">
            <div class="card">
                <div class="card-header">
                    Friends
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        A list item
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        A second list item
                        <span class="badge bg-primary rounded-pill">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        A third list item
                        <span class="badge bg-primary rounded-pill">1</span>
                    </li>
                </ul>
            </div>
        </nav>
        <footer class="card">
            <p class="card-text">This is the footer.</p>
        </footer>
    </div>
</body>

<!-- <?php echo "Hello World from PHP!" ?> -->

</html>