<?php 
    include 'connect.php'; 
    session_start();
    
    // Check if the user is logged in
    if($_SESSION["loggedIn"] != 1){
        header("Location: admin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit user</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    if($_SESSION["loggedIn"] == 1){
        include 'dash_nav.php';    
    }else{
        include 'nav.php';
    }
     ?>

    <?php
        // Get the user ID from the POST request
        $user_id = intval($_POST["user_id"]);

        // SQL query to fetch the user's name, surname, and role
        $sql = "
            SELECT 
                u.name AS name, 
                u.user_id, 
                u.surname AS surname, 
                u.profile_image,
                r.role_name AS role,
                u.is_active AS visibility,
                u.bio AS bio,
                u.email AS email,
                u.phone_number AS phone_number,
                m.height AS model_height,
                m.waist AS model_waist,
                m.shoe_size AS model_shoe_size,
                m.location AS model_location,
                m.gender AS model_gender,
                e.youtube_link AS editor_youtube_link,
                v.youtube_link AS videographer_youtube_link,
                v.location AS videographer_location,
                p.location AS photographer_location,
                mi.image_url AS model_images, 
                pi.image_url AS photographer_images, 
                gdi.image_url AS graphic_designer_images 
            FROM 
                users u
            JOIN 
                userroles ur ON u.user_id = ur.user_id
            JOIN 
                roles r ON ur.role_id = r.role_id
            LEFT JOIN 
                models m ON u.user_id = m.model_id
            LEFT JOIN 
                editors e ON u.user_id = e.editor_id
            LEFT JOIN 
                videographers v ON u.user_id = v.videographer_id
            LEFT JOIN 
                photographers p ON u.user_id = p.photographer_id
            LEFT JOIN 
                graphic_designers gd ON u.user_id = gd.graphic_designer_id
            LEFT JOIN 
                model_images mi ON m.model_id = mi.user_id  
            LEFT JOIN 
                photographer_images pi ON p.photographer_id = pi.user_id  
            LEFT JOIN 
                graphic_designer_images gdi ON gd.graphic_designer_id = gdi.user_id 
            WHERE 
                u.user_id = ?
            LIMIT 1;
        ";


        // Prepare and execute the query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

                // Check if the user exists
                
        if ($row = $result->fetch_assoc()) {
            echo '<div class="edit-container">';
            echo "<h1 id='admin-title'>User Details</h1>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
            echo "<p><strong>Surname:</strong> " . htmlspecialchars($row['surname']) . "</p>";
            echo "<p><strong>Role:</strong> " . htmlspecialchars($row['role']) . "</p>";
            echo "<p><strong>Bio:</strong> " . htmlspecialchars($row['bio']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
            echo "<p><strong>Phone Number:</strong> " . htmlspecialchars($row['phone_number']) . "</p>";

            // Display role-specific details
            if ($row['role'] == 'model') {
                echo "<p><strong>Height:</strong> " . htmlspecialchars($row['model_height']) . " cm</p>";
                echo "<p><strong>Waist:</strong> " . htmlspecialchars($row['model_waist']) . " cm</p>";
                echo "<p><strong>Shoe Size:</strong> " . htmlspecialchars($row['model_shoe_size']) . "</p>";
                echo "<p><strong>Location:</strong> " . htmlspecialchars($row['model_location']) . "</p>";
                echo "<p><strong>Gender:</strong> " . htmlspecialchars($row['model_gender']) . "</p>";

                // Fetch and display model images from the database
                $user_id = $row['user_id'];
                $image_query = "SELECT * FROM model_images WHERE user_id = ?";
                $stmt = $conn->prepare($image_query);
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $image_result = $stmt->get_result();

                if ($image_result->num_rows > 0) {
                    echo "<p><strong>Model Images:</strong></p>";
                    while ($image_row = $image_result->fetch_assoc()) {
                        echo '<div>';
                        echo '<img src="' . htmlspecialchars($image_row['image_url']) . '" alt="Model Image" style="width: 100px; height: 100px;">';
                        echo '<form action="delete_image.php" method="POST">';
                        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($user_id) . '">';
                        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
                        echo '<input type="hidden" name="image_name" value="' . htmlspecialchars($image_row['image_url']) . '">';
                        echo '<button type="submit" name="delete_image">Delete</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No images found for this model.</p>";
                }
            } elseif ($row['role'] == 'photographer') {
                echo "<p><strong>Location:</strong> " . htmlspecialchars($row['photographer_location']) . "</p>";
    
                // Fetch and display photographer images
                $image_query = "SELECT * FROM photographer_images WHERE user_id = ?";
                $stmt = $conn->prepare($image_query);
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $image_result = $stmt->get_result();
                
                if ($image_result->num_rows > 0) {
                    echo "<p><strong>Photographer Images:</strong></p>";
                    while ($image_row = $image_result->fetch_assoc()) {
                        echo '<div>';
                        echo '<img src="' . htmlspecialchars($image_row['image_url']) . '" alt="Photographer Image" style="width: 100px; height: 100px;">';
                        echo '<form action="delete_image.php" method="POST">';
                        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($user_id) . '">';
                        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
                        echo '<input type="hidden" name="image_name" value="' . htmlspecialchars($image_row['image_url']) . '">';
                        echo '<button type="submit" name="delete_image">Delete</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No images found for this photographer.</p>";
                }
            } elseif ($row['role'] == 'graphic_designer') {
                // Fetch and display graphic designer images
                $image_query = "SELECT * FROM graphic_designer_images WHERE user_id = ?";
                $stmt = $conn->prepare($image_query);
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $image_result = $stmt->get_result();

                if ($image_result->num_rows > 0) {
                    echo "<p><strong>Graphic Designer Images:</strong></p>";
                    while ($image_row = $image_result->fetch_assoc()) {
                        echo '<div>';
                        echo '<img src="' . htmlspecialchars($image_row['image_url']) . '" alt="Graphic Designer Image" style="width: 100px; height: 100px;">';
                        echo '<form action="delete_image.php" method="POST">';
                        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($user_id) . '">';
                        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
                        echo '<input type="hidden" name="image_name" value="' . htmlspecialchars($image_row['image_url']) . '">';
                        echo '<button type="submit" name="delete_image">Delete</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No images found for this graphic designer.</p>";
                }
            }
        } else {
            echo "<p>User not found.</p>";
        }


        echo '</div>';
    ?>

    <h1 id="admin-title">Edit details</h1>

    <?php
    if ($row['role'] == 'model') {
        echo '<div class="edit-container">';
        echo '<form action="update_info.php" method="POST" enctype="multipart/form-data">';
        
        // Hidden field to include the user's ID
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($row['user_id']) . '">';
        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
        
        echo '<p><label for="name">Name:</label>';
        echo '<input type="text" id="name" name="name" value="' . htmlspecialchars($row['name']) . '" required></p>';
        
        echo '<p><label for="surname">Surname:</label>';
        echo '<input type="text" id="surname" name="surname" value="' . htmlspecialchars($row['surname']) . '" required></p>';
        
        echo '<p><label for="height">Height (cm):</label>';
        echo '<input type="number" id="height" name="height" value="' . htmlspecialchars($row['model_height']) . '" required></p>';
        
        echo '<p><label for="waist">Waist (cm):</label>';
        echo '<input type="number" id="waist" name="waist" value="' . htmlspecialchars($row['model_waist']) . '" required></p>';
        
        echo '<p><label for="shoe_size">Shoe Size:</label>';
        echo '<input type="number" step="0.5" id="shoe_size" name="shoe_size" value="' . htmlspecialchars($row['model_shoe_size']) . '" required></p>';
        
        echo '<p><label for="location">Location:</label>';
        echo '<input type="text" id="location" name="location" value="' . htmlspecialchars($row['model_location']) . '" required></p>';
        
        echo '<p><label for="gender">Gender:</label>';
        echo '<select id="gender" name="gender" required>';
        echo '<option value="Male"' . ($row['model_gender'] == 'Male' ? ' selected' : '') . '>Male</option>';
        echo '<option value="Female"' . ($row['model_gender'] == 'Female' ? ' selected' : '') . '>Female</option>';
        echo '<option value="Other"' . ($row['model_gender'] == 'Other' ? ' selected' : '') . '>Other</option>';
        echo '</select></p>';
        
        echo '<p><label for="bio">Bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" required>' . htmlspecialchars($row['bio']) . '</textarea></p>';
        
        echo '<p><label for="profile_image">Profile Image:</label>';
        echo '<input type="file" id="profile_image" name="profile_image" accept="image/*">';
        // Hidden input to store the existing profile image path
        echo '<input type="hidden" name="existing_profile_image" value="' . htmlspecialchars($row['profile_image']) . '"></p>';

        
        echo '<p><label for="images">Additional Images:</label>';
        echo '<input type="file" id="images" name="images[]" accept="image/*" multiple></p>';
        
        echo '<button type="submit">Update Info</button>';
        echo '</form>';
        echo '</div>';
    }
    else if ($row['role'] == 'photographer') {
        echo '<div class="edit-container">';
        echo '<form action="update_info.php" method="POST" enctype="multipart/form-data">';
        
        // Hidden field to include the user's ID
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($row['user_id']) . '">';
        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
        
        echo '<p><label for="name">Name:</label>';
        echo '<input type="text" id="name" name="name" value="' . htmlspecialchars($row['name']) . '" required></p>';
        
        echo '<p><label for="surname">Surname:</label>';
        echo '<input type="text" id="surname" name="surname" value="' . htmlspecialchars($row['surname']) . '" required></p>';
        
        echo '<p><label for="location">Location:</label>';
        echo '<input type="text" id="location" name="location" value="' . htmlspecialchars($row['photographer_location']) . '" required></p>';
        
        echo '<p><label for="bio">Bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" required>' . htmlspecialchars($row['bio']) . '</textarea></p>';
        
        echo '<p><label for="profile_image">Profile Image:</label>';
        echo '<input type="file" id="profile_image" name="profile_image" accept="image/*">';
        // Hidden input to store the existing profile image path
        echo '<input type="hidden" name="existing_profile_image" value="' . htmlspecialchars($row['profile_image']) . '"></p>';

        
        echo '<p><label for="images">Additional Images:</label>';
        echo '<input type="file" id="images" name="images[]" accept="image/*" multiple></p>';
        
        echo '<button type="submit">Update Info</button>';
        echo '</form>';
        echo '</div>';
    }
    else if ($row['role'] == 'videographer') {
        echo '<div class="edit-container">';
        echo '<form action="update_info.php" method="POST" enctype="multipart/form-data">';
        
        // Hidden field to include the user's ID
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($row['user_id']) . '">';
        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
        
        echo '<p><label for="name">Name:</label>';
        echo '<input type="text" id="name" name="name" value="' . htmlspecialchars($row['name']) . '" required></p>';
        
        echo '<p><label for="surname">Surname:</label>';
        echo '<input type="text" id="surname" name="surname" value="' . htmlspecialchars($row['surname']) . '" required></p>';

        echo '<p><label for="yt_video_link">Youtube video link:</label>';
        echo '<input type="text" id="yt_video_link" name="video_link" value="' . htmlspecialchars($row['videographer_youtube_link']) . '" required></p>';
        
        echo '<p><label for="location">Location:</label>';
        echo '<input type="text" id="location" name="location" value="' . htmlspecialchars($row['videographer_location']) . '" required></p>';
        
        echo '<p><label for="bio">Bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" required>' . htmlspecialchars($row['bio']) . '</textarea></p>';
        
        echo '<p><label for="profile_image">Profile Image:</label>';
        echo '<input type="file" id="profile_image" name="profile_image" accept="image/*">';
        // Hidden input to store the existing profile image path
        echo '<input type="hidden" name="existing_profile_image" value="' . htmlspecialchars($row['profile_image']) . '"></p>';
        
        echo '<button type="submit">Update Info</button>';
        echo '</form>';
        echo '</div>';
    }
    else if ($row['role'] == 'editor') {
        echo '<div class="edit-container">';
        echo '<form action="update_info.php" method="POST" enctype="multipart/form-data">';
        
        // Hidden field to include the user's ID
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($row['user_id']) . '">';
        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
        
        echo '<p><label for="name">Name:</label>';
        echo '<input type="text" id="name" name="name" value="' . htmlspecialchars($row['name']) . '" required></p>';
        
        echo '<p><label for="surname">Surname:</label>';
        echo '<input type="text" id="surname" name="surname" value="' . htmlspecialchars($row['surname']) . '" required></p>';
        
        echo '<p><label for="yt_editor_link">Editor video link:</label>';
        echo '<input type="text" id="yt_editor_link" name="video_link" value="' . htmlspecialchars($row['editor_youtube_link']) . '" required></p>';

        echo '<p><label for="bio">Bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" required>' . htmlspecialchars($row['bio']) . '</textarea></p>';
        
        echo '<p><label for="profile_image">Profile Image:</label>';
        echo '<input type="file" id="profile_image" name="profile_image" accept="image/*">';
        // Hidden input to store the existing profile image path
        echo '<input type="hidden" name="existing_profile_image" value="' . htmlspecialchars($row['profile_image']) . '"></p>';
        
        echo '<button type="submit">Update Info</button>';
        echo '</form>';
        echo '</div>';
    }
    else if ($row['role'] == 'graphic_designer') {
        echo '<div class="edit-container">';
        echo '<form action="update_info.php" method="POST" enctype="multipart/form-data">';
        
        // Hidden field to include the user's ID
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($row['user_id']) . '">';
        echo '<input type="hidden" name="role" value="' . htmlspecialchars($row['role']) . '">';
        
        echo '<p><label for="name">Name:</label>';
        echo '<input type="text" id="name" name="name" value="' . htmlspecialchars($row['name']) . '" required></p>';
        
        echo '<p><label for="surname">Surname:</label>';
        echo '<input type="text" id="surname" name="surname" value="' . htmlspecialchars($row['surname']) . '" required></p>';
        
        echo '<p><label for="bio">Bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" required>' . htmlspecialchars($row['bio']) . '</textarea></p>';
        
        echo '<p><label for="profile_image">Profile Image:</label>';
        echo '<input type="file" id="profile_image" name="profile_image" accept="image/*">';
        // Hidden input to store the existing profile image path
        echo '<input type="hidden" name="existing_profile_image" value="' . htmlspecialchars($row['profile_image']) . '"></p>';

        
        echo '<p><label for="images">Additional Images:</label>';
        echo '<input type="file" id="images" name="images[]" accept="image/*" multiple></p>';
        
        echo '<button type="submit">Update Info</button>';
        echo '</form>';
        echo '</div>';
    }else {
        echo 'Not found!';
    }
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>
