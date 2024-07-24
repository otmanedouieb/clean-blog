<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://localhost/clean-blog/admin-panel/styles/bootstrap.css" rel="stylesheet">
    <link href="http://localhost/clean-blog/admin-panel/styles/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="http://localhost/clean-blog/admin-panel/index.php">LOGO</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarText">

                    <ul class="navbar-nav side-nav">
                        <?php if (isset($_SESSION['adminname'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" style="margin-left: 20px;" href="http://localhost/clean-blog/admin-panel/index.php">Home
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/clean-blog/admin-panel/admins/admins.php" style="margin-left: 20px;">Admins</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/clean-blog/admin-panel/categories-admins/show-categories.php" style="margin-left: 20px;">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/clean-blog/admin-panel/posts-admins/show-posts.php" style="margin-left: 20px;">Posts</a>
                            </li>
                        <?php endif ?>
                        <!--  <li class="nav-item">
            <a class="nav-link" href="#" style="margin-left: 20px;">Comments</a>
          </li> -->
                    </ul>


                    <ul class="navbar-nav ml-md-auto d-md-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/clean-blog/admin-panel/index.php">Home
                                <!--<span class="sr-only">(current)</span>-->
                            </a>
                        </li>
                        <?php if (!isset($_SESSION['adminname'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/clean-blog/admin-panel/admins/login-admins.php">login
                                    <!--<span class="sr-only">(current)</span>-->
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if (isset($_SESSION['adminname'])) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $_SESSION['adminname'] ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="http://localhost/clean-blog/admin-panel/logout.php">Logout</a>

                            </li>
                        <?php endif ?>


                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">