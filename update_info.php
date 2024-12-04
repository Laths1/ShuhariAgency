<?php
include 'connect.php';
session_start();

// Check if the user is logged in
if ($_SESSION["loggedIn"] != 1) {
    header("Location: admin.php");
    exit;
}

// Retrieve form data
// Validate and sanitize inputs
$user_id = intval($_POST['user_id']);
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$bio = trim($_POST['bio']);
$role = trim($_POST['role']); // Ensure this matches valid roles in your system

// Generate username
$username = strtolower($name . $surname);

// Define the target directory
if($role == 'editor' && $role == 'videographer'){
    $targetDir = "$role . 's'/";    
}else{
    $targetDir = "$role/$username/";
}

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true); // Create the directory if it does not exist
}

// Process profile image
if (!empty($_FILES['profile_image']['name'])) {
    $profileImage = $targetDir . basename($_FILES["profile_image"]["name"]);
    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $profileImage)) {
        die("Failed to upload profile image.");
    }
} else {
    $profileImage = $_POST['existing_profile_image'];
}

// Validate role to ensure it's a safe table name
$allowed_roles = ['model', 'editor', 'photographer', 'graphic_designer','videographer']; // Define allowed roles
if (!in_array($role, $allowed_roles)) {
    die("Invalid role specified.");
}

// Process additional images
if (isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0) {
    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
        if (!empty($_FILES['images']['name'][$i])) {
            $table = $role . '_images';
            $imagePath = $targetDir . basename($_FILES['images']['name'][$i]);
            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $imagePath)) {
                // Insert the image into the database
                $stmt = $conn->prepare("INSERT INTO $table (user_id, image_url) VALUES (?, ?)");
                if (!$stmt) {
                    die("Failed to prepare statement.");
                }
                $stmt->bind_param("is", $user_id, $imagePath);
                if (!$stmt->execute()) {
                    die("Failed to insert image into database: " . $stmt->error);
                }
                $stmt->close();
            } else {
                die("Failed to upload image: " . $_FILES['images']['name'][$i]);
            }
        }
    }
}

// Update profile image in the database (optional, depending on your schema)
$stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE user_id = ?");
if ($stmt) {
    $stmt->bind_param("si", $profileImage, $user_id);
    $stmt->execute();
    $stmt->close();
} else {
    die("Failed to prepare statement for updating profile image.");
}


// Role-specific fields
if ($role == 'model') {
    $height = intval($_POST['height']);
    $waist = intval($_POST['waist']);
    $shoe_size = floatval($_POST['shoe_size']);
    $location = htmlspecialchars($_POST['location']);
    $gender = htmlspecialchars($_POST['gender']);
}
if($role == 'photographer' || $role == 'videographer' ){
    $location = htmlspecialchars($_POST['location']);
}
if($role == 'editor' || $role == 'videographer' ){
    $video_link = $_POST['video_link'];
}
// Update database
if ($role == 'model') {
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
    $stmt->bind_param("iidssi", $height, $waist, $shoe_size, $location, $gender, $user_id);
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
    $stmt->bind_param("si", $location, $user_id);
    $stmt->execute();
}
if ($role == 'videographer'){
    $sql = "
        UPDATE videographers 
        SET 
            location = ?,
            youtube_link = ?
        WHERE 
            videographer_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $location, $video_link, $user_id);
    $stmt->execute();
}
if ($role == 'editor'){
    $sql = "
        UPDATE editors 
        SET 
            youtube_link = ?
        WHERE 
            editor_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $video_link, $user_id);
    $stmt->execute();
}


// Update common user fields
$sql = "
    UPDATE Users 
    SET 
        name = ?, 
        surname = ?, 
        bio = ?,
        profile_image = ? 
    WHERE 
        user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $name, $surname, $bio, $profileImage, $user_id);
$stmt->execute();

// Redirect back to the editing page or show success message
header("Location: userdata.php");
exit;
?>
