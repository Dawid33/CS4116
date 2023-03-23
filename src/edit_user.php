<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 
    $current_user_id = $_SESSION["user"];
    $user_id = $_GET["id"];
    $edit_errors = array();

    if (isset($_POST["save"])) {
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }   

        $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
        $bio = mysqli_real_escape_string($conn, $_POST["bio"]);  

        if (empty($first_name) || empty($last_name)) {
            $error=true;
        }else{
            $error=false;
        }

        if (!$error) {
            $sql_update = "UPDATE users SET first_name='$first_name', last_name='$last_name', bio='$bio' WHERE user_id = '$user_id'";

            if (($conn->query($sql_update))) {
                header("Location: user.php?id=".$user_id);
            }else {
                echo $conn->error;
            }
        } else {
            $edit_errors["fieldsValidation"] = "Full name is required";
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
            <div class="d-flex justify-content-between display-6"> WiredIn 
                <div> 
                    <a href="user.php?id=<?php print $user_id ?>" class="btn btn-lg" role="button">Cancel</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="d-flex justify-content-center display-5">Edit Profile</div>
        </div>
        </br>
        <div class="row">
            <div class= "d-md-flex justify-content-center"> 
                <form action="edit_user.php?id=<?php echo $user_id; ?>" method="post">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo htmlspecialchars($_POST['first_name'] ?? '', ENT_QUOTES);?>">
                    </div>
                    </br>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo htmlspecialchars($_POST['last_name'] ?? '', ENT_QUOTES);?>"> 
                    </div>
                    </br>
                    <div class="form-group">
                        <textarea class="form-control" name="bio" placeholder="Bio" rows="2"><?php echo htmlspecialchars($_POST['bio'] ?? '', ENT_QUOTES);?></textarea> 
                    </div>
                    </br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-lg" type="submit" name="save" value="Save"></input>
                    </div>
                    </br>
                    <?php if(array_key_exists("fieldsValidation", $edit_errors)){ $err = $edit_errors["fieldsValidation"]; print "<div class='text-center alert alert-danger'>$err</div>"; }?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
