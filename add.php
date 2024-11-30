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
    <title>Add User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    if($_SESSION["loggedIn"] == 1){
        include 'dash_nav.php';    
    } else {
        include 'nav.php';
    }
    ?>
    <h1>Add New User</h1>
    <form action="talent2db.php" method="POST">
        <p>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </p>
        <p>
            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </p>
        <p>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="model">Model</option>
                <option value="editor">Editor</option>
                <option value="videographer">Videographer</option>
                <option value="photographer">Photographer</option>
                <option value="graphic_designer">Graphic Designer</option>
            </select>
        </p>
        <p>
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" rows="5"></textarea>
        </p>
        <div id="role-specific-fields"></div>
        <button type="submit">Add User</button>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>

