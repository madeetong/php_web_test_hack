<?php
session_start();
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header('location: login.php');
}

include('DBconnection.php');

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Account</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <h1>Edit Account</h1>
    <p>Change Name</p>

    <form method="POST" action="editNamedDB.php">
      <input type="text" name="newUsername" placeholder="New Username" required><br>
      <input type="submit" name="updateName" value="update name">
    </form>
    <a style="color:green" href="index.php">Back</a>

  </div>
</body>
</html>
