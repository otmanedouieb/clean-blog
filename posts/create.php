<?php require('../includes/header.php') ?>
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
        <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
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


<?php require('../includes/footer.php') ?>