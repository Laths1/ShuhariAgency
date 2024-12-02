<?php
include 'connect.php';
session_start();

// Check if the required data is present
if (isset($_POST['name']) && isset($_POST['message']) && isset($_POST['email']) && isset($_POST['surname'])) {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Insert the message into the Messages table
    $sql = "INSERT INTO contact (name, surname, email, message, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $surname, $email, $message);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error sending message: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
} else {
    echo "Invalid input.";
}

$conn->close();
?>
