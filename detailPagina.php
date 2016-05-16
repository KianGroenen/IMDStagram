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
    
    if($_POST["knopVolgen"]=="volgen"){
        
        echo $_POST["followID"]."<br>".$_SESSION["ID"]."<br>";
        
        $follower = $_SESSION["ID"];
     
    $PDO = Db::getInstance();
        $stmt2 = $PDO->prepare("SELECT * FROM follows WHERE followed_user_ID = :followed AND follower_ID = :follower");
        $stmt2->bindParam(":followed", $_POST["followID"]);
        $stmt2->bindParam(":follower",$follower);
        $stmt2->execute();
        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
        
        if($stmt2->rowCount()>0){
            
            $stmt3=$PDO->prepare("DELETE FROM follows WHERE followed_user_ID = :followed AND follower_ID = :follower");
        $stmt3->bindParam(":followed", $_POST["followID"]);
        $stmt3->bindParam(":follower",$_SESSION["ID"]);
        $stmt3->execute();
            
        }
        else{
    
            $stmt4 = $PDO->prepare("INSERT INTO follows (followed_user_ID, follower_ID) VALUES (:followed, :follower);");
            $stmt4->bindValue(':followed', $_POST["followID"]);
	        $stmt4->bindValue(':follower', $_SESSION["ID"]);
            $stmt4->execute();
        }
    }
    
    
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script type="text/javascript">
        
        $("#knopvolgen").click(function(){
            if(this.text==="volgen"){
                this.text = "volgend";
                
            }
            if(this.text==="volgend"){
                this.text = "volgen";
                
            }
            
        });
        
        
    </script>
</head>
<body>
    <?php include_once("include_navigation.php"); ?>
    <?php echo $feedback; ?>
    <div id="Profiel">
        <div id="topProfiel">
            <?php echo '<img src="profilePictures/'.$data['Avatar'].'" alt="avatarProfielFoto" id="profielfoto">' ?>
            <?php echo "<p id='detailUsername'>".$data['username']."</p>" ?>
            <form action="" method="post">
               <input type="hidden"  name="followID" value="<?php echo $id; ?>">
                <input type="submit" id="knopVolgen" value="volgen" name="knopVolgen">
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