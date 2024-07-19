<?php include('../includes/navbar.php') ?>
<?php include('../config/config.php') ?>


<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $stmt = $conn->prepare("SELECT * FROM $dbname.posts WHERE id = :id");

    $stmt->bindParam('id', $id);

    $stmt->execute();

    $fetch = $stmt->fetch(PDO::FETCH_OBJ);
}


?>

<!-- Page Header-->
<header class="masthead" style="background-image: url('http://localhost/clean-blog/posts/images/<?= $fetch->image ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1><?= $fetch->title ?></h1>
                    <span class="subheading"><?= $fetch->subtitle ?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content-->
<div class="container px-4 px-lg-5">

    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>
                        <?= $fetch->body ?>
                    </p>

                    <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $fetch->user_id) : ?>
                        <a href="http://localhost/clean-blog/posts/delete.php?id=<?= $fetch->id ?>" class="btn btn-danger txt-center float-end">Delete</a>
                        <a href="http://localhost/clean-blog/posts/update.php?id=<?= $fetch->id ?>" class="btn btn-warning txt-center">Update</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </article>

    <?php include('../includes/footer.php') ?>