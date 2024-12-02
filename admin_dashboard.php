<?php 
    include 'connect.php'; 
    session_start();
    if($_SESSION["loggedIn"] != 1){
        header("Location: admin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
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
    <ul class="admin-items">
        <li><a href="userdata.php"><p>user data</p></a></li>
        <li><a href="add.php"><p>Add talent</p></a></li>
        <li><a href="application.php"><p>Applications</p></a></li>
        <li><a href="contact.php"><p>Contact</p></a></li>
        <li><a href="talent_messages.php"><p>talent messages</p></a></li>
    </ul>
</body>
</html>
<?php include 'footer.php'; ?>
