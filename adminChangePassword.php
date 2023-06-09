<?php
session_start();
include('DBconnection.php');

// $errors = array();

if (isset($_POST['adminChangePassword'])){
    $newpassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $newHashPassword = hash('sha256',$newpassword);
    $username = $_POST['username'];
    $query = "UPDATE credential SET `password`='$newHashPassword' WHERE username = '$username' ";
    $result = mysqli_query($conn, $query);
    echo "<script>
    alert('Change Password success');
    window.location.href='/php_web_inject/adminPage.php';
    </script>";
    // header("location: index.php");

}


?>