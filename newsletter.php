<?php 
    include 'connect.php'; 
    session_start();
    
    // Check if the user is logged in
    if($_SESSION["loggedIn"] != 1){
        header("Location: admin.php");
        exit;
    }
?>
<?php
include 'connect.php';
session_start();

// Check if the required data is present
if (isset($_POST['email-input'])) {
    $email = htmlspecialchars($_POST['email-input']);

    // Insert the message into the Messages table
    $sql = "INSERT INTO newsletter (email, date) VALUES ( ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            header("Location: error.php");
        }
        $stmt->close();
    } else {
        header("Location: error.php");
    }
} else {
    header("Location: error.php");
}

$conn->close();
?>
