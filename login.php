<?php

require('database/connect.php');

if (isset($_SESSION['username'])) {
    header('location: ./');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/cookie.png">
    <link rel="stylesheet" href="style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1 class="title">Cookie clicker login</h1>
    <form class="inputlayout" method="post">
        <img onclick="loggedInCheck()" class="cookie" src="images/cookie.png" alt="cookie">
        <a class="inputboxes" href="pages/register.php">No account?</a>
        <!-- <label class="labelboxes" for="username">Username</label> -->
        <input class="inputboxes" name="username" type="text" placeholder="Username">
        <!-- <label class="labelboxes" for="password">Password</label> -->
        <input class="inputboxes" name="password" type="password" placeholder="Password">
        <button class="inputboxes" type="submit">Login</button>
        <?php

        if (isset($_POST['username']) && (isset($_POST['password']))) {
            $query = "SELECT * FROM users WhERE username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'username' => $_POST['username']
            ]);
            $check = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($check && password_verify($_POST['password'], $check['password'])) {
                $_SESSION['username'] = $check['username'];
                header('location: ./');
                exit();
            }
            echo "<h1 class='title'>Incorrect username or password</h1>" . PHP_EOL;
        }

        ?>
    </form>
    <p></p>
    <h1 class="title">Highscores</h1>
    <table class="highscores">
        <tr>
            <th class="tableh">Position</th>
            <th class="tableh">Player</th>
            <th class="tableh">Score</th>
        </tr>
        <?php

        $querytopscore = "SELECT * FROM users WHERE score IS NOT NULL ORDER BY score DESC LIMIT 10";
        $stmttopscore = $pdo->prepare($querytopscore);
        $stmttopscore->execute();
        $resulttopscore = $stmttopscore->fetchAll(PDO::FETCH_ASSOC);
        $pos = 1;
        for ($i = 0; $i < count($resulttopscore); $i++) {
            echo "<tr><td class='tabledata'>$pos</td>" . PHP_EOL;
            echo "<td class='tabledata'>{$resulttopscore[$i]['username']}</td>" . PHP_EOL;
            echo "<td class='tabledata'>{$resulttopscore[$i]['score']}</td></tr>" . PHP_EOL;
            $pos++;
        }
        ?>
    </table>
        <script src="script/script.js"></script>
</body>

</html>