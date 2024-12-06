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
