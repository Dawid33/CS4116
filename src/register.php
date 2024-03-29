<?php
    $errors = array(); 
    $success;
    if (isset($_POST["submit"])) {
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        $firstname =  mysqli_real_escape_string($conn, $_POST["firstname"]);
        $lastname =  mysqli_real_escape_string($conn, $_POST["lastname"]);
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        if($password!=$confirm_password){
            $errors["passwordMatchValidation"]="Passwords must match";
        }
        
        if (preg_match('~[0-9]+~', $firstname) || preg_match('~[0-9]+~', $lastname)) {
            $errors["numbersValidation"]="First Name and Last Name cannot contain numerical characters";
        }

        if (empty($firstname) || empty($lastname)  || empty($email) || empty($password)) {
            $errors["fieldsValidation"]="All fields are required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["emailValidation"]="Email is not valid";
        }
        if (strlen($password)<6) {
            $errors["passwordValidation"]="Password must be at least 6 characters long";
        }

        $sql_email = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_email);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount>0) {
            $errors["emailExistsValidation"]="Email already exists!";
        }

        if (count($errors)<=0) {
            $sql_insert= "INSERT INTO users (first_name, last_name, email, password, is_admin, is_banned)
            VALUES ('$firstname', '$lastname', '$email', '$password', false, false)";

            if (($conn->query($sql_insert))) {
                $success = "You are registered successfully, please proceed to login.";
            }else {
                echo $conn->error;
            }
        }
    
        $conn->close();
    }
                ?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/register.css" rel="stylesheet" type="text/css">
</head>

<body>
</br>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between display-6"> <b>WiredIn</b> 
                <div> 
                    <a href="login.php" class="btn btn-submit btn-primary btn-lg" role="button">Login</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="col d-flex justify-content-center">
                <div class="display-4">Welcome to the Community</div>
            </div>
        </div>
        </br>
        <div class="row justify-content-center">
            <div class="col-4">
                <form action="register.php" method="post">
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo htmlspecialchars($_POST['firstname'] ?? '', ENT_QUOTES);?>"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo htmlspecialchars($_POST['lastname'] ?? '', ENT_QUOTES);?>"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);?>"> 
                    </div>
                    <hr>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES);?>"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password"> 
                    </div>
                    </br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-submit btn-primary btn-lg" type="submit" name="submit" value="Register"></input>
                    </div>
                    </br>
                        <?php if(isset($success)){ print "<div class='alert alert-success'>$success</div>"; } ?>
                        <?php if(array_key_exists("fieldsValidation", $errors)) print "<div class='text-center alert alert-danger'>" . $errors["fieldsValidation"] . "</div>"; ?>
                        <?php if(array_key_exists("passwordValidation", $errors)) print "<div class='text-center alert alert-danger'>" . $errors["passwordValidation"] . "</div>"; ?>
                        <?php if(array_key_exists("emailValidation", $errors)) print "<div class='text-center alert alert-danger'>" . $errors["emailValidation"] . "</div>"; ?>
                        <?php if(array_key_exists("numbersValidation", $errors))print "<div class='text-center alert alert-danger'>" . $errors["numbersValidation"] . "</div>"; ?>
                        <?php if(array_key_exists("passwordMatchValidation", $errors))print "<div class='text-center alert alert-danger'>" . $errors["passwordMatchValidation"] . "</div>"; ?>
                        <?php if(array_key_exists("emailExistsValidation", $errors))print "<div class='text-center alert alert-danger'>" . $errors["emailExistsValidation"] . "</div>"; ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>