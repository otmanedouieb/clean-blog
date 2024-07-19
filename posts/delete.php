<?php
require('../config/config.php');

if (isset($_GET['id'])) {


    $stmt = $conn->prepare("DELETE FROM $dbname.posts WHERE id = :id");
    $stmt->bindParam('id', $_GET['id']);
    $stmt->execute();
    var_dump($stmt);
}
