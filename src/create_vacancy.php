<?php 
    $content_php_file = "vacancy/add_vacancy.php";
    include('generators/generic.php');

    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
    }

    if(isset($_POST["submit"])){
        $title=$_POST["title"];
        $desc=$_POST["desc"];
        $req_exp=$_POST["req_exp"];

        //insert query

        $sql="insert into 'vacancies' (title,description,required_experience) values ('$title','$desc','$req_exp')";

        $result=mysqli_query($conn,$sql);

        if($result){
            echo "submit successfull";
        } else {
            die("Connection failure: " . $conn->connect_error);
        }
    }

?>