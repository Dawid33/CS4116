<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/user_registration.css" rel="stylesheet" type="text/css">
</head>

<body>
</br>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between display-6"> WiredIn 
                <div> 
                    <a href="login.php" class="btn" role="button">Login</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="d-flex justify-content-center display-4">Welcome to the community</div>
        </div>
        </br>
        <div class="row">
            <div class="d-flex justify-content-center"> 
                <form action="user_registration.php" method="post">
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" placeholder="First Name"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"> 
                    </div>
                    </br>
                    <div class="d-flex justify-content-center">
                        <input class="btn" type="submit" name="submit" value="Register"></input>
                    </div>
                </form>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="d-flex justify-content-center">
                <?php
                    if (isset($_POST["submit"])) {
                        $firstname = $_POST["firstname"];
                        $lastname = $_POST["lastname"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        $errors = array();

                        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failure: " . $conn->connect_error);
                        }      

           
                        if (empty($firstname) || empty($lastname)  || empty($email) || empty($password)) {
                            array_push($errors,"All fields are required");
                        }
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            array_push($errors, "Email is not valid");
                        }
                        if (strlen($password)<8) {
                            array_push($errors,"Password must be at least 8 charactes long");
                        }
        
                        $sql_email = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql_email);
                        $rowCount = mysqli_num_rows($result);

                        if ($rowCount>0) {
                         array_push($errors,"Email already exists!");
                        }

                        if (count($errors)>0) {
                            foreach ($errors as  $error) {
                                echo "</br> <div class='alert alert-danger'>$error</div>";
                            }
                        } else {
                            $user_id = rand();
                        
                            $sql_insert= "INSERT INTO users (first_name, last_name, email, password, user_id, is_admin)
                            VALUES ('$firstname', '$lastname', '$email', '$password', $user_id, 0)";
            
                            if (($conn->query($sql_insert))) {
                                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                            }else {
                                echo $conn->error;
                            }
                        }
                    
                        $conn->close();
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>