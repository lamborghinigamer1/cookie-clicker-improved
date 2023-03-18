<?php

session_start();

$dsn = "mysql:host=localhost;dbname=cookie_clicker_improved";
$username = "cookie_clicker_improved";
$password = '123456';

try{
$pdo = new PDO($dsn, $username, $password);
}

catch (PDOException $e){
    echo($e->getmessage());
}

?>