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
    <link rel="stylesheet" href="style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1 class="title">Cookie clicker login</h1>
    <form class="inputlayout" method="post">
        <img class="cookie" src="images/cookie.png" alt="cookie">
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

</body>

</html>