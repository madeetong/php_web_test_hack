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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    
    <div class="homeheader">
        <h2>Home Page</h2>
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
            <p>Welcome <strong style="font-size:30px"><?php echo $_SESSION['username']; ?></strong></p>
            <?php
                include('DBconnection.php');
                $username = $_SESSION['username'];
                $query = "SELECT img FROM credential where username = '$username' ";
                $result = mysqli_query($conn, $query);
                $row = $result -> fetch_assoc();
                // var_dump(($row))
                $_SESSION['img'] = $row['img'];
                if (!isset($_SESSION['img'])) {
                    $_SESSION['img'] = 'default.png';
                }
                echo 'image file : uploads/'.$_SESSION['img'];

            ?>
            <div>
                <img type="hidden" src=<?php echo "uploads/".$_SESSION['img'] ?> style="height:100px;border-radius: 50%;margin:20px">
            </div>
            
            <!-- <img src="uploads/man (2).png" style="height:100px;border-radius: 50%;margin:20px"> -->
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="file">
                <input type="submit" value="Upload Image" name="submit">
            </form>
            <form action="uploadURL.php" method="post" enctype="multipart/form-data" style="margin-top:10px">
                Enter image URL to upload:
                <input type="text" name="image_url">
                <input type="submit" value="Upload" name="submit">
            </form>
            
            <?php
            if(isset($_SESSION['statusMsg'])){
                echo $_SESSION['statusMsg'];
            }
            ?>
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
        <div>Host name lookup</div>
        <br>
        <form method="GET" action="">
            <input style="width:250px" type="text" name="command">
            <button type="summit" name="commandsummit" >lookup</button>
        </form>
        <?php
           
            if(isset($_GET['commandsummit'])){
                $command = $_GET['command']; 
                exec('nslookup '.$command, $output, $retval);
                // var_dump($output);
                for($i=1;$i<=count($output);$i++){
                    echo $output[$i-1].'<br>' ;

                }
            }
            
        ?>
       
    </div>
    <br>
    <br>
</body>
</html>