<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="http://localhost/clean-blog/css/styles.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="http://localhost/clean-blog/index.php">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">

                    <?php if (isset($_SESSION['username'])) : ?>

                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/clean-blog/index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/clean-blog/posts/create.php">create</a></li>

                        <li class="nav-item dropdown mt-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['username'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="http://localhost/clean-blog/users/profile.php?id=<?= $_SESSION['id'] ?>">Profile</a></li>
                                <li><a class="dropdown-item" href="http://localhost/clean-blog/auth/logout.php">Logout</a></li>
                            </ul>
                        </li>

                    <?php else : ?>

                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/clean-blog/auth/login.php">login</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/clean-blog/auth/register.php">register</a></li>

                    <?php endif ?>


                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="http://localhost/clean-blog/contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('http://localhost/clean-blog/assets/img/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <?php require('../config/config.php') ?>

        <?php

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];
            $image = $_FILES['image']['name'];
            $path = 'images/' . basename($image);
            $user_id = $_SESSION['id'];
            $username = $_SESSION['username'];
            $category_id = $_POST['category'];

            $stmt = $conn->prepare("INSERT INTO $dbname.posts (title, subtitle, body, category_id , image, user_id, username) VALUES (:title, :subtitle, :body,:category_id, :image, :user_id, :username)");

            $stmt->execute([
                'title' => $title,
                'subtitle' => $subtitle,
                'body' => $body,
                'category_id' => $category_id,
                'image' => $image,
                'user_id' => $user_id,
                'username' => $username
            ]);



            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                header('Location: http://localhost/clean-blog/index.php');
            }
        }


        ?>

        <form method="POST" action="create.php" enctype="multipart/form-data">
            <!-- title input -->
            <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />

            </div>
            <!-- subtitle input -->
            <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>
            <!-- subtitle input -->
            <div class="form-outline mb-4">
                <textarea type="text" name="body" id="textarea" class="form-control" placeholder="body" rows="8"></textarea>
            </div>
            <!-- categories -->
            <?php
            $prepare = $conn->prepare("SELECT * FROM $dbname.categories");
            $prepare->execute();
            $cat = $prepare->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div class="form-outline mb-4">
                <select class="form-select" aria-label="Default select example" name="category">
                    <?php foreach ($cat as $c) : ?>
                        <option value="<?= $c->id ?>"><?= $c->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <!-- image input -->
            <div class="form-outline mb-4">
                <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
            </div>
            <!-- Submit button -->
            <button type="submit" name="submit" value="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

        <script>
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#textarea'))
                .catch(error => {
                    console.error(error);
                });
        </script>
        <?php require('../includes/footer.php') ?>