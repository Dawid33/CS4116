<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 
    $current_user_id = $_SESSION["user"];

    $content_php_file = "user/gen_user_content.php";
    $head_content = "<link href=\"css/user.css\" rel=\"stylesheet\" type=\"text/css\">";
    include('generators/generic.php');
?>
