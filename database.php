<?php
$dsn = 'mysql:host=localhost;dbname=baseball';
$username = 'mmhs_baseball';
$password = 'INFO4430 is the class for you and me';
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $err) {
    $error_message = $err->getMessage();
    echo 'Internal Server Error: ' . $error_message;
    exit();
}
