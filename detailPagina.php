<?php
session_start();

include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("classes/Post.class.php");
include_once("classes/GetDetailPosts.class.php");
spl_autoload_register(function ($class_name) {
    include 'classes/' .$class_name . '.class.php';
});

$PostsOphalen = new GetDetailPosts();
$PostsOphalen->UserID = $_SESSION['ID'];
$posts = $PostsOphalen->getPosts();

print_r($posts);
$i = 0;

?>
<!doctype html>
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
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include_once("include_navigation.php"); ?>

    <div id="Profiel">
        <div id="topProfiel">
            <?php echo '<img src="profilePictures/'.$data['Avatar'].'" alt="avatarProfielFoto" id="profielfoto">' ?>
            <?php echo "<p id='detailUsername'>".$data['username']."</p>" ?>
            <a href="#" id="volgen">Volgen</a>
        </div>
        <div id="gallerij"><?php
            if(!empty($posts)){
                foreach ($posts as $post) {
                    echo '<img class="gallerijPost" src="postImages/'. $posts[$i]["foto"] . '" alt="' . $posts[$i]["tekst"] . '" ';
                    echo "<br />";
                    $i++;

                }
            }

        ?></div>
    </div>

</body>
</html>
