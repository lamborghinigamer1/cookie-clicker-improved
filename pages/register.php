<?php

require('../database/connect.php');

if (isset($_SESSION['username'])) {
    header('location: ../');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1 class="title">Cookie clicker register</h1>
    <form class="inputlayout" method="post">
        <img class="cookie" src="../images/cookie.png" alt="cookie">
        <a class="inputboxes" href="../login.php">Login instead</a>
        <input class="inputboxes" name="username" type="text" placeholder="Username">
        <input class="inputboxes" name="password" type="password" placeholder="Password">
        <button class="inputboxes" type="submit">Sign up</button>
        <?php

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $check = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($check);
        $stmt->execute([
            'username' => $_POST['username']
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo "<h1 class='title'>Username already exists</h1>" . PHP_EOL;
            exit();
        }
        $password = trim($_POST['password']);
        if (strlen($password) < 6) {
            echo "<h1 class='title'>Your password must atleast be 6 characters long</h1>" . PHP_EOL;
        }
        $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $querysignup = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmtsignup = $pdo->prepare($querysignup);
        $stmtsignup->execute([
            'username' => $_POST['username'],
            'password' => $hashedpassword
        ]);
        header('location: ../');
        exit();
    }

    ?>
    </form>
    
</body>

</html>