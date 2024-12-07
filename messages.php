<?php
include 'connect.php';
session_start();

if ($_SESSION["loggedIn"] != 1) {
    header("Location: login.php");
    exit;
}

// Check if the required data is present
if (isset($_POST['user_id']) && isset($_POST['message'])) {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    // Insert the message into the Messages table
    $sql = "INSERT INTO messages (user_id, content, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("is", $user_id, $message);
        if ($stmt->execute()) {
            header("Location: talent_dashboard.php");
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
