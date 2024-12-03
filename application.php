<?php
include 'connect.php';
session_start();

// Check if the required data is present
if (isset($_POST['name']) && isset($_POST['motivation']) && isset($_POST['email']) && isset($_POST['surname'])) {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $number = htmlspecialchars($_POST['number']);
    $location = htmlspecialchars($_POST['location']);
    $portfolio = htmlspecialchars($_POST['portfolio']);
    $social_media = htmlspecialchars($_POST['social_media']);
    $motivation = htmlspecialchars($_POST['motivation']);
    $category = htmlspecialchars($_POST['category']);

    // Insert the message into the Messages table
    $sql = "INSERT INTO application (name, surname, email, number, location, portfolio, social_media_handle, motivation, role, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssss", $name, $surname, $email, $number, $location, $portfolio, $social_media, $motivation, $category);
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
