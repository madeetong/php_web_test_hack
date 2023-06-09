<?php
session_start();
include('DBconnection.php');
$username = $_SESSION['username'];

if (isset($_POST['updatePassword'])){
    $newpassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $newHashPassword = hash('sha256',$newpassword);
    $query = "UPDATE credential SET `password`='$newHashPassword' WHERE username = '$username' ";
    $result = mysqli_query($conn, $query);
    echo "<script>
    alert('Change Password success');
    window.location.href='/php_web_inject/index.php';
    </script>";
    // header("location: index.php");

}
?>