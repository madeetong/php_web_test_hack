<?php
session_start();
include('DBconnection.php');

$username = $_POST['username'];

if (isset($_POST['adminDeleteUser'])){

    $query = "DELETE FROM credential WHERE username='$username' ";
    mysqli_query($conn, $query);

    echo "<script>
    alert('Account has been deleted');
    window.location.href='/php_web_inject/adminPage.php';
    </script>";

    // header('location: login.php');
}
?>