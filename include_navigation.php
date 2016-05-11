<?php

include_once("classes/Db.class.php");
include_once("classes/Search.class.php");
include_once("classes/User.class.php");
include_once("classes/LikePost.class.php");

if (isset($_POST['submit'])) {
    if (isset($_GET['go'])) {

        $zoeken = new Search();
        $zoeken->Search = $_POST["name"];
        $check = trim($_POST["name"]);
        $detectHashT = substr($check, 0, 1);

        $resultSearch = $zoeken->Searching();

        if ($detectHashT == "#") {
            echo "true";
            ?><!--<pre><?php print_r($resultSearch); ?></pre>--><?php
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
            ?><!--<pre><?php print_r($resultSearch); ?></pre>--><?php
            //create foreach loop and loop through result set
            $i = 0;
            foreach($resultSearch as $row) {
                echo "<a href='detailPagina.php' rel='detailPagina' id='searchResult'>".$resultSearch[$i]['username']."<a/>";
                echo "<br />";
                $i++;
            }
        }
    }
}

?>

<nav>
    <ul>
        <li id="IG_logo"><a href="index.php"></a></li>
        <li><form  method="post" action="detailPagina.php?go" id="searchform">
                <input  type="text" name="name">
                <input  type="submit" name="submit" value="Search">
            </form>
        </li>
        <li id="MyProfile"><a href="index.php"></a></li>
    </ul>
</nav>