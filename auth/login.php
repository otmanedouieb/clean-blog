<?php require('../includes/header.php') ?>
<?php require('../config/config.php') ?>

<?php

if (isset($_POST['submit'])) {
    if ($_POST['email'] == '' || $_POST['email'] == 'password') {
        echo "Please all fields are required";
    } else {

        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



        $stmt = $conn->prepare("SELECT * FROM $dbname.users WHERE email=:email");

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $rowCount = $stmt->rowCount();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);



        if ($rowCount > 0) {
            if (password_verify($password, $result['password'])) {
                echo "logged in";
            }
        }
    }
}

?>


<form method="POST" action="login.php">
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

    <!-- Register buttons -->
    <div class="text-center">
        <p>a new member? Create an acount<a href="register.php"> Register</a></p>



    </div>
</form>


<?php require('../includes/footer.php') ?>