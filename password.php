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
                u.password, 
                u.user_id
            FROM
                users u         
            WHERE 
                u.user_id = ?

            
        ";


        // Prepare and execute the query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

                // Check if the user exists
                
        
?>
    <h1 id="admin-title">Edit password</h1>

    <?php
        echo '<div class="edit-container">';
        echo '<form action="update_password.php" method="POST" enctype="multipart/form-data">';
        
        // Hidden field to include the user's ID
        echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
        echo '<p><label for="name">Enter password:</label>';
        echo '<input type="password" id="name" name="pass" required></p>';
        echo '<button type="submit">Update password</button>';
        echo '</form>';
        echo '</div>';
    
?>
    <?php include 'footer.php'; ?>
</body>
</html>
