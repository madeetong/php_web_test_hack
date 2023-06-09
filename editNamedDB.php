<?php
session_start();
include('DBconnection.php');
$username = $_SESSION['username'];

if (isset($_POST['updateName'])){
    $newusername = mysqli_real_escape_string($conn, $_POST['newUsername']);
    $query = "UPDATE credential SET `username`='$newusername' WHERE username = '$username' ";
    $result = mysqli_query($conn, $query);
    echo "<script>
    alert('Change Name success');
    window.location.href='/php_web_inject/index.php';
    </script>";
    // header("location: index.php");
    $_SESSION['username'] = $newusername;

}
?>