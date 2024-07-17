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

    $stmt = $conn->prepare("INSERT INTO $dbname.posts (title, subtitle, body, image, user_id) VALUES (:title, :subtitle, :body, :image, :user_id)");

    $stmt->execute([
        'title' => $title,
        'subtitle' => $subtitle,
        'body' => $body,
        'image' => $image,
        'user_id' => $user_id,
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
    <!-- image input -->
    <div class="form-outline mb-4">
        <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
    </div>
    <!-- Submit button -->
    <button type="submit" name="submit" value="submit" class="btn btn-primary  mb-4 text-center">create</button>


</form>


<?php require('../includes/footer.php') ?>