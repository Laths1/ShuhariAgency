<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shuhari graphic designers</title>
        <!-- styles -->
        <link rel="stylesheet" href="styles.css"></link>
        <!-- icons -->

        <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">

        <!-- js -->
        <script src="graphic-designer-card.js" defer></script>
    </head>
<body>
    <!-- home page -->
    <section class="home-page-container-talents">
        <!-- nav bar -->
        <?php
    if(!empty($_SESSION) && $_SESSION["loggedIn"] == 1){
        include 'dash_nav.php';    
    }else{
        include 'nav.php';
    }
     ?>
        <!-- end of nav bar -->
        <!-- end of hero -->
    </section>
    <!-- end of home page -->
     
    <section class="person-container">
        <h1> graphic designers</h1>
        <section class="talent-container"></section>  
    </section>
    
    
   <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
</body>
</html>