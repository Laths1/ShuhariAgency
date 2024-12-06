<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_image'])) {
    $user_id = intval($_POST['user_id']);
    $image_name = $_POST['image_name'];
    $role = $_POST['role'];
    $roletable = $role . '_images'; 
    // Delete the image from the server
    $image_path = $image_name;
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete the row with the image from the database (example for models)
    $sql = "DELETE FROM $roletable WHERE user_id = ? AND image_url = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $user_id, $image_name);
    $stmt->execute();

    // Redirect back to the edit page
    header("Location: edit.php");
    exit;
}
?>
