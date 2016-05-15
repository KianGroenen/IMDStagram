<?php


include_once("classes/User.class.php");
spl_autoload_register(function ($class_name) {
            include 'classes/' .$class_name . '.class.php';
        });
if(!empty($_POST))
    	{
            $user = new User();
            $user->UserName = $_POST['username'];
            $user->Password = $_POST['password'];
            $user->Email = $_POST['email'];

            if(isset($_POST['prive'])){
                $user->Prive = true;
            }else{
                $user->Prive = false;
            }

            if($_POST['Avatar']) {
                $user->ProfilePicture = $_POST['Avatar'];
            }else{
                $user->ProfilePicture = "dickbutt.jpg";
            }
            //print_r($_POST);

        try{

        			if($user->UsernameAvailable()) {
            				$user->Create(); //INSERT USER INTO TABLE

            				$feedback = "Thanks for signing up!";
            			} else {
            				$feedback = "Username has already been taken!";
            			}
 		}
 		catch (Exception $e)
 		{
        			$feedback = $e->getMessage();
        		}

 	}


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDStagram Registratie</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once("include_navigation.php"); ?>

<section class="login">

<div id="RegisterArea">
        <h1 id="h1Register">Register to IMDStagram</h1>

        <form id="Register" method="post" action="">
            <p><input type="text" id="Username" name="username" placeholder="Set Username"></p>
            <div class="usernameFeedback"><img id="loadingImage" src="images/loading.gif" /><span>checking</span></div>
            <p><input type="password" id="registratiePassword" name="password" placeholder="Set Password"></p>
            <p><input type="text" id="registratieEmail" name="email" placeholder="Set Email"></p>
             <p><label for="prive">Make your account private.</label><input type="checkbox" name="prive" value = 0 ></p>
            <label for="Avatar">Upload profile picture</label>
            <input type="file" name="Avatar" id="uploadProfilePicture">

            <p id="submit"><input type="submit" name="commitRegister" value="Register"></p>
        </form>

    <div class="backToLogin">
        <a href="login.php">Back to login?</a>
    </div>
</div>

</section>

</body>
</html>