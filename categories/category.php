<?php
include('../includes/header.php')
?>
<?php include('../config/config.php') ?>
<?php include('../functions.php') ?>


<?php

if ($_GET['id']) {
    $prepare = $conn->prepare("SELECT * FROM $dbname.posts WHERE category_id = :id");
    $prepare->bindParam('id', $_GET['id']);
    $prepare->execute();

    $fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
}

?>

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
        <?php foreach ($fetch as $f) : ?>
            <!-- Post preview-->
            <div class="post-preview">
                <a href="http://localhost/clean-blog/posts/post.php?id=<?= $f['id'] ?>">
                    <h2 class="post-title"><?= $f['title'] ?></h2>
                    <h3 class="post-subtitle"><?= $f['subtitle'] ?></h3>
                </a>
                <p class="post-meta">
                    Posted by


                    <a href="#!"><?= $f['username'] ?></a>
                    on <?= format_date($f['created_at']) ?>
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
        <?php endforeach ?>

    </div>
</div>

<?php include('../includes/footer.php') ?>