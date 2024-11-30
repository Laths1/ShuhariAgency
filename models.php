<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shuhari models</title>
        <!-- styles -->
        <link rel="stylesheet" href="styles.css"></link>
        <!-- icons -->
        <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">
        
        <!-- js -->
        <script src="model-card.js" defer></script>
    </head>
<body>
    <!-- home page -->
    <section class="home-page-container-talents">
        <section class="random-img">
            <!-- nav bar -->
            <?php
    if(!empty($_SESSION) && $_SESSION["loggedIn"] == 1){
        include 'dash_nav.php';    
    }else{
        include 'nav.php';
    }
     ?>
            <!-- end of nav bar -->
    </section>
    <!-- end of home page -->

     <!-- models -->
      <h1 id="model-title"> models</h1>
      <section class="model-container">
        
        <!-- men -->
         <div class="men-container">
            <a href="model-men.php">
                <h3>men</h3>
            </a>
         </div>
        <!-- women -->
         <div class="women-container">
            <a href="model-women.php">
                <h3>women</h3>
            </a>
         </div>
      </section>
     <!-- end of models -->

    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
</body>
</html>
