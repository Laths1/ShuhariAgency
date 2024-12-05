<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shuhari</title>
    <!-- styles -->
    <link rel="stylesheet" href="styles.css"></link>
    <!-- icons -->
    <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">
</head>
<body>
    <!-- nav bar -->
    <?php
    if (!empty($_SESSION) && $_SESSION["loggedIn"] == 1) {
        include 'dash_nav.php';    
    } else {
        include 'nav.php';
    }

    if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
        echo "<p>Invalid user ID.</p>";
        exit;
    }

    $user_id = intval($_GET['user_id']);

    // Fetch user details and role
    $sql = "
    SELECT 
        u.name, 
        u.surname, 
        u.bio, 
        r.role_name AS role
    FROM 
        users u
    JOIN 
        userroles ur ON u.user_id = ur.user_id
    JOIN 
        roles r ON ur.role_id = r.role_id
    WHERE 
        u.user_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<p>User not found.</p>";
        exit;
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    // Display common user information
    $name = htmlspecialchars($user['name']);
    $surname = htmlspecialchars($user['surname']);
    $bio = htmlspecialchars($user['bio']);
    $role = htmlspecialchars($user['role']);

    // Fetch additional information based on role
    switch ($role) {
        case 'model':
            $sql = "
                SELECT 
                    height, 
                    waist, 
                    shoe_size, 
                    location 
                FROM models 
                WHERE model_id = ?
            ";
            break;
        case 'photographer':
            $sql = "
                SELECT 
                    location
                FROM photographers 
                WHERE photographer_id = ?
            ";
            break;
        case 'videographer':
            $sql = "
                SELECT 
                    location,
                    youtube_link
                FROM videographers 
                WHERE videographer_id = ?
            ";
            break;
        case 'editor':
            $sql = "
                SELECT 
                    youtube_link
                FROM editors 
                WHERE editor_id = ?
            ";
            break;
        
        default:
            $sql = "";
    }

    if ($sql) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $details = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        // Display role-specific information
        if ($role === 'model') {
            echo '<div class="profile">';
            echo "<h1 class='name'> $name $surname</h1>";
            echo '<div class="details">';
            echo "<p><strong>Height:</strong> " . htmlspecialchars($details['height'] ?: 'N/A') . " cm</p>";
            echo "<p><strong>Waist:</strong> " . htmlspecialchars($details['waist'] ?: 'N/A') . " cm</p>";
            echo "<p><strong>Shoe Size:</strong> " . htmlspecialchars($details['shoe_size'] ?: 'N/A') . " UK</p>";
            echo '</div>';
            echo '<div class="location">';
            echo "<p><strong>Location:</strong> " . htmlspecialchars($details['location'] ?: 'N/A') . "</p>";
            echo '</div>';
            echo "<p class='bio'> $bio</p>";
            echo '<div class="images-container">';

            // Fetch and display all images for the model
            $image_sql = "SELECT image_url FROM model_images WHERE user_id = ?";
            $stmt = $conn->prepare($image_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $images_result = $stmt->get_result();
            while ($image = $images_result->fetch_assoc()) {
                $image_url = htmlspecialchars($image['image_url']);
                echo "<img src='$image_url' alt='$name $surname'>";
            }
            $stmt->close();

            echo '</div>';
            echo '</div>';
        } elseif ($role === 'photographer') {
            echo '<div class="profile">';
            echo "<h1 class='name'> $name $surname</h1>";
            echo '<div class="location">';
            echo "<p><strong>Location:</strong> " . htmlspecialchars($details['location'] ?: 'N/A') . "</p>";
            echo '</div>';
            echo "<p class='bio'> $bio</p>";
            echo '<div class="images-container">';

            // Fetch and display all images for the model
            $image_sql = "SELECT image_url FROM photographer_images WHERE user_id = ?";
            $stmt = $conn->prepare($image_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $images_result = $stmt->get_result();
            while ($image = $images_result->fetch_assoc()) {
                $image_url = htmlspecialchars($image['image_url']);
                echo "<img src='$image_url' alt='$name $surname'>";
            }
            $stmt->close();

            echo '</div>';
            echo '</div>';
        } elseif ($role === 'graphic_designer') {
            echo '<div class="profile">';
            echo "<h1 class='name'> $name $surname</h1>";
            echo "<p class='bio'> $bio</p>";
            echo '<div class="images-container">';
            // Fetch and display all images for the model
            $image_sql = "SELECT image_url FROM graphic_designer_images WHERE user_id = ?";
            $stmt = $conn->prepare($image_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $images_result = $stmt->get_result();
            while ($image = $images_result->fetch_assoc()) {
                $image_url = htmlspecialchars($image['image_url']);
                echo "<img src='$image_url' alt='$name $surname'>";
            }
            $stmt->close();

            echo '</div>';
            echo '</div>';
        } elseif ($role === 'editor') {
            echo '<div class="profile">';
            echo "<h1 class='name'> $name $surname</h1>";
            echo "<p class='bio'> $bio</p>";
            echo '<div class="videos-container">';

            // Fetch the YouTube link for the editor
            $video_sql = "SELECT youtube_link FROM editors WHERE editor_id = ?";
            $stmt = $conn->prepare($video_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($youtube_link);
            $stmt->fetch();

            if ($youtube_link) {
                $youtube_link = htmlspecialchars($youtube_link);
                // Embed YouTube video
                echo "<iframe width='560' height='315' src='$youtube_link' frameborder='0' allowfullscreen></iframe>";
            } else {
                echo "<p>No video available.</p>";
            }

            $stmt->close();

            echo '</div>';
            echo '</div>';
        } elseif ($role === 'videographer') {
            echo '<div class="profile">';
            echo "<h1 class='name'> $name $surname</h1>";
            echo '<div class="location">';
            echo "<p><strong>Location:</strong> " . htmlspecialchars($details['location'] ?: 'N/A') . "</p>";
            echo '</div>';
            echo "<p class='bio'> $bio</p>";
            echo '<div class="videos-container">';

            // Fetch the YouTube link for the editor
            $video_sql = "SELECT youtube_link FROM videographers WHERE videographer_id = ?";
            $stmt = $conn->prepare($video_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($youtube_link);
            $stmt->fetch();

            if ($youtube_link) {
                $youtube_link = htmlspecialchars($youtube_link);
                // Embed YouTube video
                echo "<iframe width='560' height='315' src='$youtube_link' frameborder='0' allowfullscreen></iframe>";
            } else {
                echo "<p>No video available.</p>";
            }

            $stmt->close();

            echo '</div>';
            echo '</div>';
        }
        else {
        echo "<p>No additional information available for this role.</p>";
        }
    }
    ?>
    <!-- end of nav bar -->
    <div class="profile">
        <h1 class="name"></h1>
        <div class="location"></div>
        <div class="details"></div>
        <p class="bio"></p>
        <div class="images-container"></div> <!-- Container for images -->
        <div class="videos-container"></div>
    </div>
    
    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
</body>
</html>
