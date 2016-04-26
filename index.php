<?php
    session_start();
    spl_autoload_register(function ($class_name) {
        include 'classes/' .$class_name . '.class.php';
    });
    if(isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])){
        if(!empty($_POST) && !empty($_POST["post"])){
            $post = new instaPost();
            $post->Post = $_POST["post"];
            $post->UserID = $_SESSION["user_id"];
            $post->Save();
        }
    }
    else {
        header('Location: index.php');
    }
    $post = new instaPost();
    $results = $post->GetAll();
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

</body>
</html>
