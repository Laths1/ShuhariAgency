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
    <h1 id="addnewtalent">Add New User</h1>
    <form action="addforms.php" method="POST" id="addform">
    <p>
        <label for="option1">
            <input type="radio" name="role" value="model" id="option1" required>
            Model
        </label>
    </p>
    <p>
        <label for="option2">
            <input type="radio" name="role" value="editor" id="option2" required>
            Editors
        </label>
    </p>
    <p>
        <label for="option3">
            <input type="radio" name="role" value="graphic_designer" id="option3" required>
            Graphic Designer
        </label>
    </p>
    <p>
        <label for="option4">
            <input type="radio" name="role" value="photographer" id="option4" required>
            Photographer
        </label>
    </p>
    <p>
        <label for="option5">
            <input type="radio" name="role" value="videographer" id="option5" required>
            Videographer
        </label>
    </p>
    <button type="submit">Submit</button>
</form>


    <?php include 'footer.php'; ?>
</body>
</html>

