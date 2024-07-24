<?php require('../layout/header.php') ?>


<?php

if (!isset($_SESSION['adminname'])) {
  header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

require('../../config/config.php');
require('../../functions.php');

$sql = "SELECT * FROM $dbname.posts";
$stmt = $conn->query($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Posts</h5>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">title</th>
              <th scope="col">category</th>
              <th scope="col">user</th>
              <th scope="col">delete</th>
              <th scope="col">status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $row) : ?>
              <tr>
                <th scope="row"><?= $row->id ?></th>
                <td><?= $row->title ?></td>
                <td><?= get_category($conn, $row->category_id) ?></td>
                <td><?= $row->username ?></td>
                <td><a href="delete-posts.php?id=<?= $row->id ?>" class="btn btn-danger  text-center ">delete</a></td>
                <?php if ($row->status == 0) : ?>
                  <td><a href="post-status.php?id=<?= $row->id ?>&status=activate" class="btn btn-success  text-center ">activate</a></td>
                <?php else : ?>
                  <td><a href="post-status.php?id=<?= $row->id ?>&status=deactivate" class="btn btn-danger  text-center ">deactivate</a></td>
                <?php endif ?>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<?php require('../layout/footer.php'); ?>