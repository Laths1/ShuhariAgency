<?php
include 'connect.php';
session_start();

// Check if the user is logged in
if ($_SESSION["loggedIn"] != 1) {
    header("Location: admin.php");
    exit;
}

// Get the data from the POST request
$user_id = intval($_POST['user_id']);
$is_active = intval($_POST['is_active']);

// Update the visibility in the database
$sql = "UPDATE Users SET is_active = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $is_active, $user_id);

if ($stmt->execute()) {
    echo "Visibility updated successfully!";
} else {
    echo "Error updating visibility: " . $conn->error;
}

// Redirect back to the admin page or previous page
header("Location: admin_dashboard.php");
exit;
?>
