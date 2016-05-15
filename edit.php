<?php
    session_start();
    include_once("classes/Db.class.php");
    include_once("classes/Search.class.php");
    include_once("classes/User.class.php");
spl_autoload_register(function ($class_name) {
    include 'classes/' .$class_name . '.class.php';
});


    print_r($_SESSION["ID"]);
    if (isset($_POST['submit'])) {
        if (isset($_GET['go'])) {
            $editProfile = new User();
            $editProfile->ID = $_SESSION["ID"];
            print_r($editProfile->UserName);

                $editProfile->UserName = $_POST["username"];
                $editProfile->Password = $_POST["password"];
                $editProfile->Email = $_POST["email"];
            
            if (isset($_POST['prive'])) {
                $editProfile->Prive = true;
            } else {
                $editProfile->Prive = false;
            } 
            
            if ($_POST['Avatar']) {
                $editProfile->ProfilePicture = $_POST['Avatar'];
            } else {
                // keep the old profile picture
            } 
            
            print_r($_POST);
            
            try {
                if ($editProfile->UsernameAvailable()) {
                    $editProfile->Edit(); //INSERT USER INTO TABLE
                    $feedback = "Edit Succeeded";
                } else {
                    $feedback = "Username has already been taken!";
                } 
            } catch (Exception $e) {
                $feedback = $e->getMessage();
            }
        }
    }
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once("include_navigation.php"); ?>

<div id="RegisterArea">
<form method="post" action="edit.php?go" id="editform">
    <p><input type="text" id="Username" name="username" placeholder="Change Username"></p>
    <div class="usernameFeedback"><img id="loadingImage" src="images/loading.gif" /><span>checking</span></div>
    <p><input type="password" id="editPassword" name="password" placeholder="Change Password"></p>
    <p><input type="text" id="editEmail" name="email" placeholder="Change Email"></p>
    <p><label for="prive">Make your account private.</label>
    <input type="checkbox" name="prive"></p>
    <p><label for="Avatar">Upload new profile picture</label>
    <input type="file" name="Avatar" id="uploadProfilePicture"></p>
    <p id="submit">
        <input type="submit" name="submit" value="Edit">
    </p>
</form>
</div>
</body>
</html>