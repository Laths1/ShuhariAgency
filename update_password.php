<?php
include 'connect.php';
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize inputs
    $user_id = intval($_POST["user_id"]);
    $password = $_POST["pass"];

    // Ensure the password is provided
    if (empty($password)) {
        echo "Password cannot be empty.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the password in the users table
    $sql = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashed_password, $user_id);

    if ($stmt->execute()) {
        header("Location: userdata.php");
    } else {
        echo "Error updating password: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request.";
    exit;
}

// Close the connection
$conn->close();
?>
