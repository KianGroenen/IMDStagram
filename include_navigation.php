<?php

include_once("classes/Db.class.php");
include_once("classes/Search.class.php");
include_once("classes/User.class.php");
include_once("classes/LikePost.class.php");

$user = $_SESSION['ID'];
//print_r($user);

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

$conn = Db::getInstance();

$statement = $conn->prepare("SELECT Avatar FROM users WHERE ID = $user");
$statement->execute();
// FETCH???
$AvatarLink = $statement->fetch(PDO::FETCH_ASSOC);
//print_r($AvatarLink); //print_r geeft altijd array terug

?>

<style>
    #MyProfile{background-image: url("<?php

            echo "../images/".$AvatarLink['Avatar'];

 ?>")}</style>

<nav>
    <ul>
        <li id="IG_logo"><a href="index.php"></a></li>
        <li><form  method="post" action="detailPagina.php?go" id="searchform">
                <input  type="text" name="name">
                <input  type="submit" name="submit" value="Search">
            </form>
        </li>
        <li id="MyProfile" name="ID"><a href="index.php"></a></li>
    </ul>
</nav>