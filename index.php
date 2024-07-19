<?php include('includes/header.php') ?>
<?php include('config/config.php') ?>
<?php include('functions.php') ?>


<?php

echo date('M', strtotime("2024-07-18 23:21:24")) . ' - ' . date('d', strtotime("2024-07-18 23:21:24"))  . ' - ' . date('Y', strtotime("2024-07-18 23:21:24"));

$stmt = $conn->prepare("SELECT * FROM $dbname.posts");

$stmt->execute();

$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $conn->query("SELECT * FROM $dbname.categories");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_OBJ);



?>



<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
        <?php foreach ($fetch as $post) : ?>
            <!-- Post preview-->
            <div class="post-preview">
                <a href="http://localhost/clean-blog/posts/post.php?id=<?= $post['id'] ?>">
                    <h2 class="post-title"><?= $post['title'] ?></h2>
                    <h3 class="post-subtitle"><?= $post['subtitle'] ?></h3>
                </a>
                <p class="post-meta">
                    Posted by


                    <a href="#!"><?= $post['username'] ?></a>
                    on <?= format_date($post['created_at']) ?>
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
        <?php endforeach ?>
        <!-- Pager-->

    </div>
</div>

<div class="row gx-4 gx-lg-5 justify-content-center">
    <h3>Categories</h3>
    <div class="col-md-6">
        <?php foreach ($categories as $cat) : ?>
            <div class="alert alert-primary" role="alert">
                <a href="http://localhost/clean-blog/categories/category.php?id=<?= $cat->id ?>"><?= $cat->name ?></a>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php include('includes/footer.php') ?>