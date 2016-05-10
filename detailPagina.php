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
        $stmt = $PDO->prepare("SELECT * FROM users WHERE ID = '27'");
        $stmt->execute();
        $data = $stmt->fetch();
        echo $data['username'];

        ?></title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <nav>

    </nav>
    <div id="Profiel">
        <?php echo '<img src="postImages/'.$data['Avatar'].'" alt="avatarProfielFoto" id="profielfoto">' ?>
        <?php echo "<p id='username'>".$data['username']."</p>" ?>
        <a href="#" id="profielBewerken">Profiel Bewerken</a>
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
