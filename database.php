<?php

$servername = "locahost";
$username = "username";
$password = "password";
$database = "php-project";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection succesfully";
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}