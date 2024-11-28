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
    <?php include 'nav.php'; ?>
    <?php echo "Welcome " . $_SESSION["username"]; ?>
</body>
</html>
<?php include 'footer.php'; ?>
<?php
    session_unset();
    session_destroy();
?>