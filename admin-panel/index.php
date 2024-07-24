<?php require('layout/header.php'); ?>

<?php

if (!isset($_SESSION['adminname'])) {
  header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

require('../config/config.php');

// Get number of posts
$sql = "SELECT id FROM $dbname.posts";
$stmt = $conn->query($sql);
$stmt->execute();
$post_count = $stmt->rowCount();
// Get number of categories
$sql = "SELECT id FROM $dbname.categories";
$stmt = $conn->query($sql);
$stmt->execute();
$cat_count = $stmt->rowCount();
// Get number of admins
$sql = "SELECT id FROM $dbname.admins";
$stmt = $conn->query($sql);
$stmt->execute();
$admins_count = $stmt->rowCount();

?>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Posts</h5>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
        <p class="card-text">number of posts: <?= $post_count ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Categories</h5>

        <p class="card-text">number of categories: <?= $cat_count ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Admins</h5>

        <p class="card-text">number of admins: <?= $admins_count ?></p>
      </div>
    </div>
  </div>
</div>
<!--  <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
<?php require('layout/footer.php'); ?>