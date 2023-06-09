<?php
session_start();
include('DBconnection.php');
echo('delete '.$_SESSION['username']);
$username = $_SESSION['username'];

if (isset($_POST['deleteAccount'])){

    $query = "DELETE FROM credential WHERE username='$username' ";
    mysqli_query($conn, $query);

    echo "<script>
    alert('Account has been deleted');
    window.location.href='/php_web_inject/login.php';
    </script>";

    // header('location: login.php');
}
?>