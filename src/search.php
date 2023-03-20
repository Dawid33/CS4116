<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
       header("Location: login.php");
    } 
    $current_user_id = $_SESSION["user"];

    $content_php_file = "search/gen_search_content.php";
    $js_body = "<script src=/js/search.js></script>";
    $head_content = "<link href=\"css/search.css\" rel=\"stylesheet\" type=\"text/css\">";
    include('generators/generic.php');
?>
