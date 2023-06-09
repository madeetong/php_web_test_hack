<?php
// Function to download the image from URL and save it locally
session_start();
include('DBconnection.php');
$username = $_SESSION['username'];
function saveImageFromUrl($imageUrl, $savePath)
{
    $imageData = file_get_contents($imageUrl);
    if ($imageData !== false) {
        file_put_contents($savePath, $imageData);
        return true;
    }
    return false;
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $imageUrl = $_POST['image_url']; // URL of the image
    $savePath = 'uploads/'; // Directory to save the image
    $filename = uniqid() . '.jpg'; // Generate a unique filename for the image

    // Create the full path to save the image
    $savePath = $savePath . $filename;

    // Save the image from URL
    if (saveImageFromUrl($imageUrl, $savePath)) {
        $insert = $conn->query("UPDATE credential SET `img`='$filename' WHERE username = '$username' ");
        $_SESSION['statusMsg'] = "The file <b>" . $filename . "</b> has been uploaded successfully.";
        header("location: index.php");
    } else {
        $_SESSION['statusMsg'] = "Failed to save image.";
        header("location: index.php");
    }
}
?>