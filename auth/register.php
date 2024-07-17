<?php require('../includes/header.php') ?>
<?php require('../config/config.php') ?>

<?php

if (isset($_POST['submit'])) {
  if (
    $_POST['email'] == '' ||
    $_POST['username'] == '' ||
    $_POST['password'] == ''
  ) {
    echo "Please all fields are required";
  } else {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO $dbname.users (email, username, password) VALUES (:email, :username, :password)";
    $insert = $conn->prepare($sql);

    $insert->execute([
      'email' => $email,
      'username' => $username,
      'password' => $password,
    ]);

    header("Location: login.php");
  }
}

?>

<form method="POST" action="register.php">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
  </div>

  <div class="form-outline mb-4">
    <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
  </div>

  <!-- Submit button -->
  <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">
    Register
  </button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Aleardy a member? <a href="login.php">Login</a></p>
  </div>
</form>
</div>

<?php require('../includes/footer.php') ?>