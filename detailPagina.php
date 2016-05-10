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
        $stmt = $PDO->prepare("SELECT * FROM users WHERE ID = '2'");
        $stmt->execute();
        $data = $stmt->fetch();
        echo $data['username'];

        ?></title>

</head>
<body>
    <nav>

    </nav>
    <div id="Profiel">
        <img src="" alt="" id="profielfoto">
        <p id="username"></p>
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
