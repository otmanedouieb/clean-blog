<?php require('../layout/header.php') ?>

<?php

if (!isset($_SESSION['adminname'])) {
  header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

require('../../config/config.php');


if (isset($_POST['submit']) && $_POST['name'] != '') {
  $sql = "INSERT INTO $dbname.categories (name) VALUES (:name)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam('name', $_POST['name']);
  $stmt->execute();
  header('Location: http://localhost/clean-blog/admin-panel/categories-admins/show-categories.php');
}


?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Categories</h5>
        <form method="POST" action="" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

          </div>


          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">

</script>
</body>

</html>