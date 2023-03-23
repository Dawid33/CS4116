<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 

    $current_user_id=$_SESSION["user"];
    $current_org_id=$_GET["id"];

    $create_vacancy_errors = array();

    if(isset($_POST["add"])){
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");
    
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        $title=mysqli_real_escape_string($conn, $_POST["title"]);
        $desc=mysqli_real_escape_string($conn, $_POST["description"]);

        if(empty($title) || empty($desc)){
            $error=true;
        }else{
            $error=false;
        }

        if(!$error){
            $sql_insert= "INSERT INTO vacancies (org_id, title, description, status)
            VALUES ('$current_org_id', '$title', '$desc', '1')";

            if($conn->query($sql_insert)){
                header("Location: company.php?id=".$current_org_id);
            }else{
                echo $conn->error;
            }
        }else{
            $create_vacancy_errors["fieldsValidation"]="All fields are required";
        }
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
                    <a href="company.php?id=<?php echo $current_org_id ?>" class="btn btn-lg" role="button">Cancel</a>
                </div>
            </div>
        </div>
        <div class="row padding">
            <div class="d-flex justify-content-center display-5">Add Vacancy</div>
        </div>
        </br>
        <div class="row">
            <div class= "d-md-flex justify-content-center"> 
                <form action="create_vacancy.php?id=<?php echo $current_org_id ?>" method="post">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo htmlspecialchars($_POST['title'] ?? '', ENT_QUOTES);?>">
                    </div>
                    </br>
                    <div class="form-group">
                        <textarea class="form-control" name="description" placeholder="Description" rows="2"><?php echo htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES);?></textarea> 
                    </div>
                    </br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-lg" type="submit" name="add" value="Add"></input>
                    </div>
                    </br>
                    <?php if(array_key_exists("fieldsValidation", $create_vacancy_errors)){ $err = $create_vacancy_errors["fieldsValidation"]; print "<div class='text-center alert alert-danger'>$err</div>"; }?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
