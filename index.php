<?php

    include_once("classes/Db.class.php");
    include_once("classes/Search.class.php");
    include_once("classes/User.class.php");
    include_once("classes/LikePost.class.php");

    $like = new LikePost();

    if (isset($_POST['submit'])) {
        if (isset($_GET['go'])) {
            
            $zoeken = new Search();
            $zoeken->Search = $_POST["name"];
            $check = trim($_POST["name"]);
            $detectHashT = substr($check, 0, 1);
            
            $resultSearch = $zoeken->Searching();
            
            if ($detectHashT == "#") {
                echo "true";
                ?><pre><?php print_r($resultSearch); ?></pre><?php
                //create foreach loop and loop through result set
                $i = 0;
                foreach($resultSearch as $row) {
                    echo $resultSearch[$i]['ID'] . " ";
                    echo $resultSearch[$i]['user_ID'] . " ";
                    echo $resultSearch[$i]['tekst'] . " ";
                    echo $resultSearch[$i]['foto'] . " ";
                    echo "<br />";
                    $i++;
                }
            } else {         
                ?><pre><?php print_r($resultSearch); ?></pre><?php
                //create foreach loop and loop through result set
                $i = 0;
                foreach($resultSearch as $row) {
                    echo $resultSearch[$i]['username'];
                    echo "<br />";
                    $i++;
                }
            }
        }
    }

if(!empty($_POST["hartje"])){
    $PDO = Db::getInstance();
    $stmt = $PDO->prepare("SELECT * FROM posts WHERE user_ID = :user_ID");
    $stmt->bindValue(':user_ID', $this->m_iUserID, PDO::PARAM_INT);
    $stmt->execute();

    $imgID = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $imgURL = $result['foto'];
        echo"<img id =\"$imgID\" src=\"$imgURL\"/>";
        $imgID = $imgID + 1;
    }
}



?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script src="js/like.js" type="text/javascript"></script>
</head>
<body>
    <form  method="post" action="index.php?go"  id="searchform"> 
        <input  type="text" name="name"> 
        <input  type="submit" name="submit" value="Search"> 
    </form>

    <a href="#"><div id="InstaPost" rel="Instapost Fabio"></div></a>
    <a href="#"><div  id="hartje" name="like" ></div></a>

    <a href="#"><div id="InstaPost2" rel="Instapost Fabio"></div></a>
    <a href="#"><div  id="hartje2" name="like" ></div></a>

    <a href="#"><div id="InstaPost3" rel="Instapost Fabio"></div></a>
    <a href="#"><div  id="hartje3" name="like" ></div></a>
</body>
</html>