<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
</br>
    <div class="container">
    <div class="row">
            <div class="d-flex justify-content-center"> 
                <?php
                    if (isset($_POST["login"])) {
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        
                        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failure: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                        
                        if ($user) {
                            if ($password == $user["password"]) {
                                session_start();
                                $_SESSION["user"] = "yes";
                                header("Location: index.php");
                                die();
                            }else{
                                echo "<div class='alert alert-danger'>Password does not match</div>";
                            }
                        }else{
                            echo "<div class='alert alert-danger'>Email does not match</div>";
                        }

                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-between display-6"> WiredIn 
                <div> 
                    <a href="register.php" class="btn" role="button">Register</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="d-flex justify-content-center display-4">Welcome to the community</div>
        </div>
        </br>
        <div class="row">
            <div class="d-flex justify-content-center"> 
                <form action="login.php" method="post">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"> 
                    </div>
                    </br>
                    <div class="d-flex justify-content-center">
                        <input class="btn" type="submit" name="login" value="Login"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>