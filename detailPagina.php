<?php
session_start();

include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("classes/Post.class.php");
include_once("classes/GetDetailPosts.class.php");
include_once("classes/DeletePost.class.php");
spl_autoload_register(function ($class_name) {
    include 'classes/' .$class_name . '.class.php';
});
$feedback = "";
//id ophalen via browser bar om juiste gallerijfoto's te laden
$id = $_GET["id"];
//print_r($id);


//sheck private
$PDO = Db::getInstance();
        $stmt = $PDO->prepare("SELECT * FROM users WHERE ID = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch();
        if($data["prive"]==1){
            
            //sheck of ge followed
            
        }



$PostsOphalen = new GetDetailPosts();
$PostsOphalen->UserID = $id;
$posts = $PostsOphalen->getPosts();
//print_r($posts);
$i = 0;

if (isset($_POST["submitDelete"])) {
    $weg = new DeletePost();
    $weg->Identiteit = $_POST["ID"];
    echo "dit is ID" . $_POST["ID"];
    $weg->UserID = $_SESSION["ID"];
    echo "dit is user_ID" . $_SESSION["ID"];
    
    try {
        $weg->Delete();
        $feedback = "Edit Succeeded";
    } catch (Exception $e) {
        $feedback = $e->getMessage();
    }
}


//volgen
if (isset($_POST["followID"])){
    
    print_r($_POST);
    print_r($_SESSION);
    
    $PDO = Db::getInstance();
    $stmt2 = $PDO->prepare("INSERT INTO follows (followed_user_ID, follower_ID) VALUES (:followed, :follower);");
    $stmt2->bindValue(':followed', $_POST["followID"]);
	$stmt2->bindValue(':follower', $_SESSION["ID"]);
    $stmt2->execute();
    
    
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
    $PDO = Db::getInstance();
    $stmt = $PDO->prepare("SELECT * FROM users WHERE ID = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $data = $stmt->fetch();
    echo $data['username'];
    ?>
    </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include_once("include_navigation.php"); ?>
    <?php echo $feedback; ?>
    <div id="Profiel">
        <div id="topProfiel">
            <?php echo '<img src="profilePictures/'.$data['Avatar'].'" alt="avatarProfielFoto" id="profielfoto">' ?>
            <?php echo "<p id='detailUsername'>".$data['username']."</p>" ?>
            <form action="" method="post">
               <input type="hidden" name="followID" value="<?php echo $id; ?>">
                <input type="submit" value="volgen" id="volgen">
            </form>
        </div>
        <div id="gallerij">
            <?php if(!empty($posts)) {
                foreach ($posts as $post) {
                    echo '<img class="gallerijPost" src="postImages/'. $posts[$i]["foto"] . '" alt="' . $posts[$i]["tekst"] . '" >';
                    if ($_SESSION['ID'] == $posts[$i]["user_ID"]) {
                        echo '<form method="post" action="#" id="deleteform">';
                        echo '<input type="hidden" name="ID" value="' . $posts[$i]["ID"] . '">';
                        echo '<input type="submit" name="submitDelete" value="Delete">';
                        echo '</form>';   
                    }
                    echo "<br />";
                    $i++;
                }
            }?>
        </div>
    </div>
</body>
</html>