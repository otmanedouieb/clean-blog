<?php require('../layout/header.php') ?>

<?php

if (!isset($_SESSION['adminname'])) {
  header('Location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

require('../../config/config.php');

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($email != '' && $username != '' && $password != '') {
    $sql = "INSERT INTO $dbname.admins (email, adminname, password) VALUES (:email, :username, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      "email" => $email,
      "username" => $username,
      "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);
  } else {
    echo "Please enter all data";
  }
}

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Admins</h5>
        <form method="POST" action="" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />

          </div>

          <div class="form-outline mb-4">
            <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
          </div>
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
          </div>







          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
</div>


<?php require('../layout/footer.php'); ?>