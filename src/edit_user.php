<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 
    $current_user_id = $_SESSION["user"];

    if (isset($_POST["save"])) {
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }   

        $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $last_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $bio = mysqli_real_escape_string($conn, $_POST["bio"]);  

        if (empty($first_name) || empty($last_name)) {
            $error=true;
        }else{
            $error=false;
        }

        // if (!$error) {
            $sql_update= "UPDATE users SET first_name='$first_name', last_name='$last_name', bio='$bio' WHERE user_id = '$current_user_id'";

            if (($conn->query($sql_update))) {
                header("Location: user.php?id=".$current_user_id);
                
            }else {
                echo $conn->error;
            }
        // // }else{
        //     $_SESSION["edit_profile_error"]=$edit_profile_error;
        //     header("Location: edit_user.php?error=" . "error");
        // }
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
<!-- action="index.php" -->
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between display-6"> WiredIn 
                <div> 
                    <a href="user.php?id=<?php print $current_user_id ?>" class="btn btn-lg" role="button">Cancel</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="d-flex justify-content-center display-5">Edit Profile</div>
        </div>
        </br>
        <div class="row">
            <div class= "d-md-flex justify-content-center"> 
                <form method="post">
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
                    <?php if(isset($_GET['error'])){ print "<div class='text-center alert alert-danger'>Name is required</div>"; }?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
