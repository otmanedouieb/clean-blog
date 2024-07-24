<?php include('../includes/header.php') ?>
<?php require('../config/config.php') ?>

<?php

if (isset($_GET['id'])) {

    $stmt = $conn->prepare("SELECT * FROM $dbname.users WHERE id = :id");
    $stmt->bindParam('id', $_GET['id']);
    $stmt->execute();

    $fetch = $stmt->fetch(PDO::FETCH_OBJ);

    if ($_SESSION['id'] !== $fetch->id) {
        header('Location: http://localhost/clean-blog/index.php');
    }

    if (isset($_POST['update'])) {


        $id = $_GET['id'];

        $stmt = $conn->prepare("UPDATE $dbname.users set email=:email, username=:username WHERE id = $id");

        $stmt->execute([
            'email' => $_POST['title'],
            'username' => $_POST['username']
        ]);

        header('Location: http://localhost/clean-blog/index.php');
    }
} else {
    header('Location: http://localhost/clean-blog/index.php');
}




?>

<form method="POST" action="profile.php<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>" enctype="multipart/form-data">
    <!-- email input -->
    <div class="form-outline mb-4">
        <input type="text" name="email" id="form2Example1" class="form-control" placeholder="email" value="<?= $fetch->email ?>" />

    </div>
    <!-- username input -->
    <div class="form-outline mb-4">
        <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" value="<?= $fetch->username ?>" />
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