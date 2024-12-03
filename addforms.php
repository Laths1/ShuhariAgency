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
    <?php 
    if($_POST['role'] == 'model'){
        echo '<h1 id="addtitle">add model</h1>';
        echo '<form action="adddb.php" method="POST" id="talentform">';
        echo '<input type="hidden" name="role" value="model">';
        echo '<p>';
        echo '<p><label for="name">name:</label>';
        echo '<input type="text" id="name" name="name" required></p>';
        echo '<p><label for="surname">surname:</label>';
        echo '<input type="text" id="surname" name="surname" required></p>';
        echo '<p><label for="number">number:</label>';
        echo '<input type="number" id="number" name="number" required></p>';
        echo '<p><label for="email">email:</label>';
        echo '<input type="email" id="email" name="email" required></p>';
        echo '<p><label for="bio">bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" cols="30" placeholder="Enter your bio here..." required></textarea><br>';
        echo '<label for="height">Height (cm):</label>';
        echo '<input type="number" id="height" name="height" required></p>';
        echo '<p><label for="waist">Waist (cm):</label>';
        echo '<input type="number" id="waist" name="waist" required></p>';     
        echo '<p><label for="shoe_size">Shoe Size:</label>';
        echo '<input type="number" step="0.5" id="shoe_size" name="shoe_size" required></p>';       
        echo '<p><label for="location">Location:</label>';
        echo '<input type="text" id="location" name="location" required></p>';
        echo '<p><label for="gender">Gender:</label>';
        echo '<select id="gender" name="gender" required>';
        echo '<option value="Male">Male</option>';
        echo '<option value="Female">Female</option>';
        echo '<option value="Other">Other</option>';
        echo '</select>';
        echo '</p>';
        echo '<button type="submit">submit</button>';
        echo '</form>';
    }
    else if($_POST["role"] == "editor"){
        echo '<h1 id="addtitle">add editor</h1>';
        echo '<form action="adddb.php" method="POST" id="talentform">';
        echo '<input type="hidden" name="role" value="editor">';
        echo '<p>';
        echo '<p><label for="name">name:</label>';
        echo '<input type="text" id="name" name="name" required></p>';
        echo '<p><label for="surname">surname:</label>';
        echo '<input type="text" id="surname" name="surname" required></p>';
        echo '<p><label for="number">number:</label>';
        echo '<input type="number" id="number" name="number" required></p>';
        echo '<p><label for="email">email:</label>';
        echo '<input type="email" id="email" name="email" required></p>';
        echo '<p><label for="bio">bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" cols="30" placeholder="Enter your bio here..." required></textarea><br>';
        echo '<button type="submit">submit</button>';
        echo '</form>';
    }
    else if($_POST["role"] == "photographer"){
        echo '<h1 id="addtitle">add photographer</h1>';
        echo '<form action="adddb.php" method="POST" id="talentform">';
        echo '<input type="hidden" name="role" value="photographer">';
        echo '<p>';
        echo '<p><label for="name">name:</label>';
        echo '<input type="text" id="name" name="name" required></p>';
        echo '<p><label for="surname">surname:</label>';
        echo '<input type="text" id="surname" name="surname" required></p>';
        echo '<p><label for="number">number:</label>';
        echo '<input type="number" id="number" name="number" required></p>';
        echo '<p><label for="email">email:</label>';
        echo '<input type="email" id="email" name="email" required></p>';
        echo '<p><label for="location">Location:</label>';
        echo '<input type="text" id="location" name="location" required></p>';
        echo '<p><label for="bio">bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" cols="30" placeholder="Enter your bio here..." required></textarea><br>';
        echo '<button type="submit">submit</button>';
        echo '</form>';
    }
    else if($_POST["role"] == "videographer"){
        echo '<h1 id="addtitle">add videographer</h1>';
        echo '<form action="adddb.php" method="POST" id="talentform">';
        echo '<input type="hidden" name="role" value="videographer">';
        echo '<p>';
        echo '<p><label for="name">name:</label>';
        echo '<input type="text" id="name" name="name" required></p>';
        echo '<p><label for="surname">surname:</label>';
        echo '<input type="text" id="surname" name="surname" required></p>';
        echo '<p><label for="number">number:</label>';
        echo '<input type="number" id="number" name="number" required></p>';
        echo '<p><label for="email">email:</label>';
        echo '<input type="email" id="email" name="email" required></p>';
        echo '<p><label for="location">Location:</label>';
        echo '<input type="text" id="location" name="location" required></p>';
        echo '<p><label for="bio">bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" cols="30" placeholder="Enter your bio here..." required></textarea><br>';
        echo '<button type="submit">submit</button>';
        echo '</form>';
    }
    else if($_POST["role"] == "graphic designer"){
        echo '<h1 id="addtitle">add graphic_designer</h1>';
        echo '<form action="adddb.php" method="POST" id="talentform">';
        echo '<input type="hidden" name="role" value="graphic designer">';
        echo '<p>';
        echo '<p><label for="name">name:</label>';
        echo '<input type="text" id="name" name="name" required></p>';
        echo '<p><label for="surname">surname:</label>';
        echo '<input type="text" id="surname" name="surname" required></p>';
        echo '<p><label for="number">number:</label>';
        echo '<input type="number" id="number" name="number" required></p>';
        echo '<p><label for="email">email:</label>';
        echo '<input type="email" id="email" name="email" required></p>';
        echo '<p><label for="bio">bio:</label>';
        echo '<textarea id="bio" name="bio" rows="5" cols="30" placeholder="Enter your bio here..." required></textarea><br>';
        echo '<button type="submit">submit</button>';
        echo '</form>';
    }else{
        echo 'role not found';
    }
    ?>
    

   
</body>
</html>
 <?php include 'footer.php'; ?>

