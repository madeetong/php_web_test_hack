<?php
session_start();
include('DBconnection.php');

// $errors = array();

if (isset($_POST['userlogin'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']) ;
    $password = mysqli_real_escape_string($conn,$_POST['password']) ;

    // $username = $_POST['username'];
    // $password =  $_POST['password'];

    $Hashpassword = hash('sha256',$password);
    $query = "SELECT * FROM credential WHERE username = '$username' AND password = '$Hashpassword' ";
    
    // $query = "SELECT * FROM credential WHERE username = '  ' UNION SELECT NULL,NULL,NULL--   ' AND password = '$Hashpassword' ";
    // $query = "SELECT * FROM credential WHERE username = '  ' UNION SELECT username,password,NULL FROM credential--   ' AND password = '$Hashpassword' ";
    // $query = "SELECT * FROM credential WHERE username = '  unhex(27) UNION SELECT NULL unhex(2C) NULL unhex(2C) NULL unhex(2D2D20)  ' AND password = '$Hashpassword' ";
    // unhex(27) UNION SELECT NULL unhex(2C) NULL unhex(2C) NULL unhex(2D2D20) 

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) >= 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Your are now logged in";
        if($username=='admin'){
            header("location: adminPage.php");
        }else{
            header("location: index.php");
        }
        
    } else {
        // array_push($errors, "Wrong Username or Password");
        $_SESSION['error'] = "Wrong Username or Password!";
        header("location: login.php");
    }
}else {
    // array_push($errors, "Username & Password is required");
    $_SESSION['error'] = "Username & Password is required";
    header("location: login.php");
}

?>