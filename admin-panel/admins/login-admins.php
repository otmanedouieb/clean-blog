<?php require('../layout/header.php'); ?>
<?php require('../../config/config.php'); ?>

<?php

if (isset($_SESSION['adminname'])) {
  header('Location: http://localhost/clean-blog/admin-panel/index.php');
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($email != '' && $password != '') {
    $sql = "SELECT * FROM $dbname.admins WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('email', $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $user = $stmt->fetch(PDO::FETCH_OBJ);
      if (password_verify($password, $user->password)) {
        $_SESSION['adminname'] = $user->adminname;
        $_SESSION['admin_id'] = $user->id;
        header('Location: http://localhost/clean-blog/admin-panel/index.php');
      } else {
        echo "<div class='alert alert-danger'>Please check your email or password</div>";
      }
    } else {
      echo "<div class='alert alert-danger'>Please check your email or password</div>";
    }
  } else {
    echo "<div class='alert alert-danger'>Please enter email and password</div>";
  }
}

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mt-5">Login</h5>
        <form method="POST" class="p-auto" action="login-admins.php">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

          </div>


          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

          </div>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php require('../layout/footer.php'); ?>