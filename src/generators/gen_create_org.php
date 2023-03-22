<?php    
    $errors = array(); 
    $success;
    if (isset($_POST["create"])) {
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        $user_id = $_SESSION["user"];
        $companyname =  mysqli_real_escape_string($conn, $_POST["companyname"]);
        $address =  mysqli_real_escape_string($conn, $_POST["address"]);
        $email = $_POST["email"];
        $description = mysqli_real_escape_string($conn, $_POST["description"]);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }      

        if (empty($firstname) || empty($lastname)  || empty($email) || empty($password)) {
            $errors["fieldsValidation"]="All fields are required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["emailValidation"]="Email is not valid";
        }

        $sql_email = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_email);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount>0) {
            $errors["fieldsValidation"]="Email already exists!";
        }

        if (count($errors)<=0) {
            $sql_insert= "INSERT INTO organisation (user_id, email, name, description, address)
            VALUES ('$user_id', '$email', '$companyname', '$description', '$address')";

            if (($conn->query($sql_insert))) {
                $success = "Company Created";
            }else {
                echo $conn->error;
            }
        }
    
        $conn->close();
    }



?>


<div class="container">
    <div class="row padding">
        <div class="d-flex justify-content-center display-4">Create Organisation</div>
    </div>
    <div classe="row">
        <div class="justify-content-center">
            <form action="create_organisation.php" method="post">
                <div class="form-group">
                    <input type="text" name="companyname" class="form-control" placeholder="Company Name" value="<?php echo htmlspecialchars($_POST['companyname'] ?? '', ENT_QUOTES);?>"></input> 
                </div>
                </br>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Company Email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);?>"></input>
                </div>
                </br>
                <div class="form-group">
                    <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES);?>"></input>
                </div>
                </br>
                <textarea class="form-control" name="description" placeholder="Description" value="<?php echo htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES);?>"></textarea>
                </br>
                <div class="d-flex justify-content-center">
                    <input class="btn" type="submit" name="create" value="Create Company"></input>
                </div>
                </br>
                <?php if(isset($success)){ print "<div class='alert alert-success'>$success</div>"; } ?>
            </form>
        </div>
    </div>
    
</div>

<style>
    .padding {
        padding: 30px;
    }
</style>