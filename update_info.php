<?php
include 'connect.php';
session_start();

// Check if the user is logged in
if ($_SESSION["loggedIn"] != 1) {
    header("Location: admin.php");
    exit;
}

// Retrieve form data
$user_id = intval($_POST['user_id']);
$name = htmlspecialchars($_POST['name']);
$surname = htmlspecialchars($_POST['surname']);
$bio = htmlspecialchars($_POST['bio']);
$role = htmlspecialchars($_POST['role']); // Make sure this is passed if roles vary

// Role-specific fields
if ($role == 'Model') {
    $height = intval($_POST['height']);
    $waist = intval($_POST['waist']);
    $shoe_size = floatval($_POST['shoe_size']);
    $location = htmlspecialchars($_POST['location']);
    $gender = htmlspecialchars($_POST['gender']);
}

// Update database
if ($role == 'Model') {
    $sql = "
        UPDATE models 
        SET 
            height = ?, 
            waist = ?, 
            shoe_size = ?, 
            location = ?, 
            gender = ?
        WHERE 
            model_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidsssi", $height, $waist, $shoe_size, $location, $gender, $profile_image_path, $user_id);
    $stmt->execute();
}
if ($role == 'photographer') {
    $sql = "
        UPDATE photographers 
        SET 
            location = ?
        WHERE 
            photographer_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidsssi", $location, $user_id);
    $stmt->execute();
}
if ($role == 'videographer') {
    $sql = "
        UPDATE videographers 
        SET 
            location = ?
        WHERE 
            videographer_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidsssi", $location, $user_id);
    $stmt->execute();
}


// Update common user fields
$sql = "
    UPDATE Users 
    SET 
        name = ?, 
        surname = ?, 
        bio = ? 
    WHERE 
        user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $surname, $bio, $user_id);
$stmt->execute();

// Redirect back to the editing page or show success message
header("Location: userdata.php");
exit;
?>
