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

        $emailSql = "SELECT email FROM users WHERE user_id = '$current_user_id'";
        $email = mysqli_query($conn, $emailSql);
        $userEmail = mysqli_fetch_array($email, MYSQLI_ASSOC);

        foreach ($userEmail as $emailData) {
        $orgSql = "SELECT org_id FROM organisation  WHERE email = '$emailData'";
        }

        $orgResult = mysqli_query($conn, $orgSql);
        $org = mysqli_fetch_array($orgResult, MYSQLI_ASSOC);
        $current_org_id = $org["org_id"];

        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        $sql_update = "UPDATE organisation SET description='$description' WHERE org_id = '$current_org_id'";

        if (($conn->query($sql_update))) {
            header("Location: company.php?id=".$current_org_id);
        } else {
            echo $conn->error;
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
                    <a href="company.php?id=<?php 
                    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failure: " . $conn->connect_error);
                    }   
            
                    $emailSql = "SELECT email FROM users WHERE user_id = '$current_user_id'";
                    $email = mysqli_query($conn, $emailSql);
                    $userEmail = mysqli_fetch_array($email, MYSQLI_ASSOC);
            
                    foreach ($userEmail as $emailData) {
                    $orgSql = "SELECT org_id FROM organisation  WHERE email = '$emailData'";
                    }
            
                    $orgResult = mysqli_query($conn, $orgSql);
                    $org = mysqli_fetch_array($orgResult, MYSQLI_ASSOC);
                    $current_org_id = $org["org_id"];
                    
                    print $current_org_id ?>" class="btn btn-lg" role="button">Cancel</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="d-flex justify-content-center display-5">Edit Company Description</div>
        </div>
        </br>
        <div class="row">
            <div class= "d-md-flex justify-content-center"> 
                <form action="edit_org_description.php" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="description" placeholder="Company Description" rows="2"><?php echo htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES);?></textarea> 
                    </div>
                    </br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-lg" type="submit" name="save" value="Save"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>