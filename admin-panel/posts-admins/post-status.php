<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}


require('../../config/config.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];

    $sql = "UPDATE $dbname.posts SET status = ";

    if ($_GET['status'] === "activate") {
        $sql .= "1";
    } else if ($_GET['status'] === "deactivate") {
        $sql .= "2";
    } else {
        //404
    }




    $sql .= " WHERE id = $id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    header('Location: http://localhost/clean-blog/admin-panel/posts-admins/show-posts.php');
}
