<?php

include_once("classes/User.class.php");

if(!empty($_POST)){
    if(!empty($_POST["loginUsername"]) && !empty($_POST["loginPassword"])){
        $userLogin = new User();
        $userLogin->UserName = $_POST["loginUsername"];
        $userLogin->Password = $_POST["loginPassword"];

        //echo $userLogin->canLogin();

        if($userLogin->canLogin()){
            $_SESSION['loggedin'] = true;
            header('Location: index.php');
        }
        else{
            echo "Foutieve Login gegevens";
        }
    }else{

    }
}






?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDStagram login</title>
    <script src="js/scripts.js" type="javascript"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include_once("include_navigation.php"); ?>

<div id="loginArea">
    <h1 id="h1Login">Login to IMDStagram</h1>

    <form id="Login" action="" method="post">
        <p><input id="loginUsername" name= "loginUsername" type="text" placeholder="username"></p>
        <p><input id="loginPassword" name="loginPassword" type="password" placeholder="password"></p>
        <p id="submitLogin"><input type="submit" name="commitlogin" value="Login"></p>
    </form>

    <p id="noAccountYet">
        No account yet? Click <a href="registratie.php" type="button" id="registratieHere">here</a>
    </p>

</div>

</body>
</html>