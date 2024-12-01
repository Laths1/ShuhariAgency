<?php 
    include 'connect.php'; 
    session_start();
    
    // Check if the user is logged in
    if ($_SESSION["loggedIn"] != 1) {
        header("Location: admin.php");
        exit;
    }

    // Validate the POST data
    if (isset($_POST['role']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['number'])) {
        // Collect common user information
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone_number = $_POST['number'];
        $role = $_POST['role'];
        $bio = $_POST['bio'];

        // Insert into the Users table
        $stmt = $conn->prepare("INSERT INTO users (name, surname, email, bio, phone_number, is_active) VALUES (?, ?, ?, ?, ?, 0)");
        $stmt->bind_param("sssss", $name, $surname, $email, $bio, $phone_number);
        $stmt->execute();
        $user_id = $conn->insert_id; // Get the inserted user's ID

        // Add the user-role association
        $role_stmt = $conn->prepare("INSERT INTO userroles (user_id, role_id) VALUES (?, (SELECT role_id FROM roles WHERE role_name = ?))");
        $role_stmt->bind_param("is", $user_id, $role);
        $role_stmt->execute();

        // Handle role-specific details
        if ($role == 'editor') {
            $stmt = $conn->prepare("INSERT INTO editors (editor_id) VALUES (?)");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
        } elseif ($role == 'model') {
            $height = $_POST['height'];
            $waist = $_POST['waist'];
            $shoe_size = $_POST['shoe_size'];
            $location = $_POST['location'];
            $gender = $_POST['gender'];
            $stmt = $conn->prepare("INSERT INTO models (model_id, height, waist, shoe_size, location, gender) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iidsss", $user_id, $height, $waist, $shoe_size, $location, $gender);
            $stmt->execute();
        } elseif ($role == 'photographer') {
            $location = $_POST['location'];
            $stmt = $conn->prepare("INSERT INTO photographers (photographer_id, location) VALUES (?, ?)");
            $stmt->bind_param("is", $user_id, $location);
            $stmt->execute();
        } elseif ($role == 'videographer') {
            $location = $_POST['location'];
            $stmt = $conn->prepare("INSERT INTO videographers (videographer_id, location) VALUES (?, ?)");
            $stmt->bind_param("iss", $user_id, $location);
            $stmt->execute();
        } elseif ($role == 'graphic_designer') {
            $stmt = $conn->prepare("INSERT INTO graphic_designers (graphic_designer_id, specialization) VALUES (?, ?)");
            $stmt->bind_param("is", $user_id, $specialization);
            $stmt->execute();
        }

        // Close statements
        $stmt->close();
        $role_stmt->close();

        echo "User added successfully!";
    } else {
        echo "Please fill in all required fields.";
    }
    header("Location: admin_dashboard.php");
?>
