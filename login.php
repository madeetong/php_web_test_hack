<?php
session_start();
include('DBconnection.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Hacker Login</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <h1>Datafarm Hacker Login</h1>

    <form method="POST" action="loginDB.php">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" name="userlogin" value="Login">
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
    <p>Not yet a member? <a style="color:orange" href="register.php">Sign Up</a></p>


  </div>
</body>
</html>
