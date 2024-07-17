<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'cleanblog';

try {
    $dsn = "mysql:host=$host;dbname:$dbname";
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
