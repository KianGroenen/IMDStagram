<?php
    include_once("classes/Db.class.php");
    include_once("classes/User.class.php");

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
            <?php echo "<p id='username'>".$data['username']."</p>" ?>
            <a href="#" id="volgen">Volgen</a>
        </div>
        <div id="gallerij">



        </div>
    </div>

    <?php

    $PDO = Db::getInstance();
    $stmt = $PDO->prepare("SELECT * FROM users WHERE ");
    $stmt->execute();
    for($i=0; $data = $stmt->fetch(); $i++){
        ?>
        <tr class="record">
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['email']; ?></td>
        </tr>
        <?php
    }
    ?>


</body>
</html>
