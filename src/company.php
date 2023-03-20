<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 
    $current_user_id = $_SESSION["user"];

    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        $sql = "SELECT email FROM users WHERE user_id = '$current_user_id'";
        $email = mysqli_query($conn, $sql);
        $userEmail = mysqli_fetch_array($email, MYSQLI_ASSOC);

        foreach ($userEmail as $emailData) {
        $sql = "SELECT org_id FROM organisation  WHERE email = '$emailData'";
        }
        $orgResult = mysqli_query($conn, $sql);
        $org = mysqli_fetch_array($orgResult, MYSQLI_ASSOC);
        $current_org_id = $org["org_id"];

    $content_php_file = "gen_company_content.php";
    $head_content = "<link href=\"css/company.css\" rel=\"stylesheet\" type=\"text/css\">";
    include('generators/generic.php');
?>
