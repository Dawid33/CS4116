<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 
    $current_user_id = $_SESSION["user"];

    $content_php_file = "gen_company_content.php";
    include('generators/generic.php');
?>
