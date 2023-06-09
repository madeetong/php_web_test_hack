<?php
session_start();
include('DBconnection.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>register</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <h1>Register</h1>

    <form method="POST" action="registerDB.php">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="password" name="confirmPassword" placeholder="Confirm Password" required><br>
      <input type="submit" name="userRegister" value="register">
    </form>

    <?php if (isset($_SESSION['error'])) : ?>
        <div class="error">
            <h3>
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <a style="color:green" href="login.php">Back</a>


  </div>
</body>
</html>
