<?php
session_start();
$current_user_id = $_SESSION["user"];
    $content_php_file = "gen_about_content.php";
    $head_content = "<link href=\"css/index.css\" rel=\"stylesheet\" type=\"text/css\">";
    include('generators/generic.php');
    ?>
