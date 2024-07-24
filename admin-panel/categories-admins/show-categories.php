<?php require('../layout/header.php') ?>


<?php

if (!isset($_SESSION['adminname'])) {
  header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

require('../../config/config.php');


$sql = "SELECT * FROM $dbname.categories";
$stmt = $conn->query($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Categories</h5>
        <a href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">update</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $row) : ?>
              <tr>
                <th scope="row"><?= $row->id ?></th>
                <td><?= $row->name ?></td>
                <td><a href="update-category.php?id=<?= $row->id ?>" class="btn btn-warning text-white text-center ">Update Categories</a></td>
                <td><a href="delete-category.php?id=<?= $row->id ?>" class="btn btn-danger  text-center ">Delete Categories</a></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<?php require('../layout/footer.php'); ?>