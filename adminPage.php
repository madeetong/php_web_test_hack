<?php 
    session_start();
    include('DBconnection.php');

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    
    <div class="homeheader">
        <h2>Admin Page</h2>
    </div>

    <div class="homecontent">
        <!--  notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
    
        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p>Welcome master <strong style="font-size:30px"><?php echo $_SESSION['username']; ?></strong></p>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file"  name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
            <p><a style="text-decoration: none;" class="button" href="index.php?logout='1'">Logout</a></p>
        <?php endif ?>
    </div>
    <div class="homecontent">
        <a style="text-decoration: none;" class="button" href="editName.php" >Change Name</a>
        <a style="text-decoration: none;" class="button" href="editPassword.php" >Change Password</a>
        <form method="POST" action="deleteAccount.php">
            <button class="button" type="summit" name="deleteAccount" >Delete Account</button>
        </form>
    </div>
    <div class="homecontent">
        <p>Search User</p>
        <form method="GET" action="">
            <input type="text" name="user">
            <button type="submit" class="button">search</button>
        </form>

        <?php
        // echo $_GET['user'];
        if(isset($_GET['user'])){  
            $searchUser = mysqli_real_escape_string($conn,$_GET['user']);
            $query = "SELECT username FROM credential where username = '$searchUser'";
            $result = mysqli_query($conn, $query);
            $row = $result -> fetch_assoc();
                // var_dump($row);
                echo '<div class="homecontent">
                        user : '.$row['username'].
                        '<br><br>'.
                        '<form method="POST" action="adminChangeName.php">
                            <input type="text" name="newName">
                            <input type="hidden" name="username" value='.$row['username'].'>
                            <button type="summit" name="adminChangeName" class="button" >Edit Name </button>
                        </form>'.
                        '<form method="POST" action="adminChangePassword.php">
                            <input type="hidden" name="username" value='.$row['username'].'>
                            <input type="text" name="newPassword">
                            <button type="summit" name="adminChangePassword" class="button" >Edit Password </button>
                        </form>'.
                        '<form method="POST" action="adminDeleteUser.php">
                            <input type="hidden" name="username" value='.$row['username'].'>
                            <button class="button" type="summit" name="adminDeleteUser" >Delete User</button>
                        </form>
                    </div>';
        }
        
        ?>
    </div>
    <div class="homecontent">
        <?php
         $query = "SELECT username FROM credential ";
         $result = mysqli_query($conn, $query);

         for($i=1;$i<=mysqli_num_rows($result);$i++){
            $row = $result -> fetch_assoc();
            // var_dump($row);
            echo '<div class="homecontent">
                    user : '.$row['username'].
                    '<br><br>'.
                    '<form method="POST" action="adminChangeName.php">
                        <input type="text" name="newName">
                        <input type="hidden" name="username" value='.$row['username'].'>
                        <button type="summit" name="adminChangeName" class="button" >Edit Name </button>
                    </form>'.
                    '<form method="POST" action="adminChangePassword.php">
                        <input type="hidden" name="username" value='.$row['username'].'>
                        <input type="text" name="newPassword">
                        <button type="summit" name="adminChangePassword" class="button" >Edit Password </button>
                    </form>'.
                    '<form method="POST" action="adminDeleteUser.php">
                        <input type="hidden" name="username" value='.$row['username'].'>
                        <button class="button" type="summit" name="adminDeleteUser" >Delete User</button>
                    </form>
                </div>';
         }
         
        ?>
    </div>

</body>
</html>