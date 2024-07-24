<?php

if (!isset($_SESSION['adminname'])) {
    header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

require '../../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM $dbname.posts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('id', $id);
    $stmt->execute();

    header('Location: http://localhost/clean-blog/admin-panel/posts-admins/show-posts.php');
}
