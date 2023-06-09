<?php
session_start();
include('DBconnection.php');

// $errors = array();

if (isset($_POST['adminChangeName'])){
    $newusername = mysqli_real_escape_string($conn, $_POST['newName']);
    $username = $_POST['username'];
    $query = "UPDATE credential SET `username`='$newusername' WHERE username = '$username' ";
    $result = mysqli_query($conn, $query);
    echo "<script>
    alert('Change Name success');
    window.location.href='/php_web_inject/adminPage.php';
    </script>";
    // header("location: index.php");

}


?>