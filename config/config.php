<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'cleanblog';


try {
    $connect = new PDO("mysql:host=$host;dbname:$dbname", $user, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
