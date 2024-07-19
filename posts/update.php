<?php include('../includes/header.php') ?>
<?php require('../config/config.php') ?>

<?php





if (isset($_GET['id'])) {

    $stmt = $conn->prepare("SELECT * FROM $dbname.posts WHERE id = :id");
    $stmt->bindParam('id', $_GET['id']);
    $stmt->execute();

    $fetch = $stmt->fetch(PDO::FETCH_OBJ);


    if (isset($_POST['update'])) {


        $id = $_GET['id'];

        $stmt = $conn->prepare("UPDATE $dbname.posts set title=:title, subtitle=:subtitle, body=:body, image=:image WHERE id = $id");

        $stmt->execute([
            'title' => $_POST['title'],
            'subtitle' => $_POST['subtitle'],
            'body' => $_POST['body'],
            'image' => $_FILES['image']['name']
        ]);
        $path = 'images/' . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            header('Location: http://localhost/clean-blog/index.php');
        }
    }
}





?>

<form method="POST" action="update.php<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>" enctype="multipart/form-data">
    <!-- title input -->
    <div class="form-outline mb-4">
        <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" value="<?= $fetch->title ?>" />

    </div>
    <!-- subtitle input -->
    <div class="form-outline mb-4">
        <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" value="<?= $fetch->subtitle ?>" />
    </div>
    <!-- subtitle input -->
    <div class=" form-outline mb-4">
        <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"><?= $fetch->body ?></textarea>
    </div>
    <!-- image input -->
    <div class="form-outline mb-4">
        <img id="previewImg" src="http://localhost/clean-blog/posts/images/<?= $fetch->image ?>" class="img-fluid mx-auto d-block" alt="<?= $fetch->title ?>">
    </div>

    <div class="form-outline mb-4">
        <input type="file" name="image" id="imgPreview" class="form-control" placeholder="image" />
    </div>
    <!-- Submit button -->
    <button type="submit" name="update" value="update" class="btn btn-primary  mb-4 text-center">update</button>


</form>


<script>
    const imgInput = document.getElementById("imgPreview");
    const img = document.getElementById("previewImg");
    imgInput.onchange = (event) => {
        const [file] = imgInput.files;
        img.src = URL.createObjectURL(file);
    }
</script>

<?php require('../includes/footer.php') ?>