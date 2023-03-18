<?php

require('database/connect.php');

if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie clicker</title>
</head>

<body>
    <form class="inputlayout" method="post">
        <a class="inputboxes" href="pages/logout.php">Logout</a>
        <button class="cookie cookiebutton" name="cookie" value="1">
            <img width="100%" src="images/cookie.png" alt="cookie">
        </button>
        <?php

        $getScore = "SELECT * FROM users WHERE username = :username";
        $stmtscore = $pdo->prepare($getScore);
        $stmtscore->execute([
            'username' => $_SESSION['username']
        ]);
        $scoreresult = $stmtscore->fetch(PDO::FETCH_ASSOC);

        if ($scoreresult['score'] === NULL) {
            $score = 0;
        } else {
            $score = $scoreresult['score'];
        }

        if (isset($_POST['cookie'])) {
            $score++;
            $query = "UPDATE users SET score = :score WHERE username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'score' => $score,
                'username' => $_SESSION['username']
            ]);
        }
        echo "<h1 class='title'>You have clicked the cookie $score times!</h1>" . PHP_EOL;
        ?>
    </form>
    <p></p>
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
</body>

</html>