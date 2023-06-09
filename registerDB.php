<?php
session_start();
include('DBconnection.php');

// $errors = array();

if (isset($_POST['userRegister'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    $user_check_query = "SELECT * FROM credential WHERE username = '$username' LIMIT 1";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) { // if user exists
        if ($result['username'] === $username) {
            $_SESSION['error'] = "Account already exists";
            header('location: register.php');
        }
        }else if($password == $confirmPassword){
            $Hashpassword = hash('sha256',$password);
            $query = "INSERT INTO credential (username, password) VALUES ('$username', '$Hashpassword')";
            mysqli_query($conn, $query);
            $_SESSION['success'] = "Register successfully";
            echo "<script>
                alert('Register success');
                window.location.href='/php_web_inject/login.php';
                </script>";
            // header('location: login.php');
        }else {
            $_SESSION['error'] = "password doesn't match";
            header('location: register.php');
        }
    
}else {
    $_SESSION['error'] = "Please fullfill required box";
    header("location: register.php");
}

?>