<?php require('../layout/header.php') ?>

<?php

if (!isset($_SESSION['adminname'])) {
  header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

require('../../config/config.php');

$sql = "SELECT * FROM $dbname.admins";
$stmt = $conn->query($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

?>


<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Admins</h5>
        <a href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">username</th>
              <th scope="col">email</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data as $row) : ?>

              <tr>
                <th scope="row"><?= $row->id ?></th>
                <td><?= $row->adminname ?></td>
                <td><?= $row->email ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<?php require('../layout/footer.php'); ?>