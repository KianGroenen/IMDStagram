<?php
session_start();
print_r($_SESSION);

include_once("classes/post.class.php");
include_once("classes/User.class.php");

if(!empty($_POST))
{
    
    /*print_r($_POST);
    echo "<br>".$_POST["postText"]."<br>";*/
    
    if(!empty($_FILES))
    {
        $imageError = $_FILES["postFoto"]["error"];
        $imageType = $_FILES["postFoto"]["type"];
        $imageName = $_FILES["postFoto"]["name"];
        $imageTmpName = $_FILES["postFoto"]["tmp_name"];
        $user = $_SESSION["ID"];
        
       /* echo  $uploadName . "<br>"
            . $uploadType . "<br>"
            . $uploadTmpName . "<br>"
            . $uploadError . "<br>";
        
        print_r($_FILES);*/
        try
        {
        $post = new post($user, $_POST["postText"], $imageType, $imageName, $imageTmpName, $imageError);
        $succes = $post->post();
        }
        catch(exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload foto</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
       <label for="postFoto"> upload picture</label>
        <input type="file" name="postFoto" id="postFoto">
        <label for="potsText"> input tekst</label>
        <input type="text" name="postText" id="postText">
        <input type="submit" value="upload post" name="submit">
    </form>
</body>
</html>