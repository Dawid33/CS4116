<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 
    $current_user_id = $_SESSION["user"];

    $create_org_errors = array();

    if (isset($_POST["create"])) {
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }   

        $company_name = mysqli_real_escape_string($conn, $_POST["company_name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);   

        if (empty($company_name) || empty($email) || empty($address) || empty($description)) {
            $error=true;
        }else{
            $error=false;
        }

        if (!$error) {
            $sql_insert= "INSERT INTO organisation (user_id, name, email, address, description)
                VALUES ('$current_user_id', '$company_name', '$email', '$address', '$description')";

            if (($conn->query($sql_insert))) {
                $sql_select = "SELECT * FROM organisation WHERE email = '$email'";
                $select_result = mysqli_query($conn, $sql_select);
                $org_details = mysqli_fetch_array($select_result, MYSQLI_ASSOC);  
                $org_location=$org_details["org_id"];
                header("Location: company.php?id=".$org_location);
                die();
            }else {
                echo $conn->error;
            }
        }else{
            $create_org_errors["fieldsValidation"] = "All fields are required";
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
                    <a href="user.php?id=<?php echo $current_user_id ?>" class="btn btn-lg" role="button">Cancel</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="d-flex justify-content-center display-5">Create Organisation Profile</div>
        </div>
        </br>
        <div class="row">
            <div class= "d-md-flex justify-content-center"> 
                <form action="create_organisation.php" method="post">
                    <div class="form-group">
                        <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="<?php echo htmlspecialchars($_POST['company_name'] ?? '', ENT_QUOTES);?>">
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Company Email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);?>"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <textarea class="form-control" name="address" placeholder="Address" rows="2"><?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES);?></textarea> 
                    </div>
                    </br>
                    <div class="form-group">
                        <textarea class="form-control" name="description" placeholder="Description" rows="2"><?php echo htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES);?></textarea> 
                    </div>
                    </br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-lg" type="submit" name="create" value="Create"></input>
                    </div>
                    </br>
                    <?php if(array_key_exists("fieldsValidation", $create_org_errors)){ $err = $create_org_errors["fieldsValidation"]; print "<div class='text-center alert alert-danger'>$err</div>"; }?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
