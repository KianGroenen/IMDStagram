<?php
session_start();

include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("classes/post.class.php");
include_once("classes/GetDetailPosts.class.php");
spl_autoload_register(function ($class_name) {
    include 'classes/' .$class_name . '.class.php';
});


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php
        $PDO = Db::getInstance();
        $stmt = $PDO->prepare("SELECT * FROM users WHERE ID = $_SESSION[ID]");
        $stmt->execute();
        $data = $stmt->fetch();
        echo $data['username'];
        ?></title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once("include_navigation.php"); ?>

</body>
</html>
