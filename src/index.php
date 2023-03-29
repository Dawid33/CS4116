<?php 
    session_start();
    if (!isset($_SESSION["user"])) {
        if ($_SESSION["is_banned"]) {
            header("Location: banned.php");
        } else {
       header("Location: login.php");
        }
    }
    
    if (!isset($_SESSION["user_is_admin"])) {
        header("Location: login.php");
     }
    $current_user_id = $_SESSION["user"];

    $content_php_file = "index/gen_index_content.php";
    $head_content = "<link href=\"css/index.css\" rel=\"stylesheet\" type=\"text/css\">";
    include('generators/generic.php');
?>
