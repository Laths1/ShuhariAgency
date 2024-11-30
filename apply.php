<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shuhari Agency - Apply</title>
        <!-- styles -->
        <link rel="stylesheet" href="styles.css"></link>
        <!-- icons -->

        <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">
        
        <!-- js -->
      
    </head>

<body>
    <section class="home-page-container-apply">
        <section class="application-container">
           <!-- nav bar -->
            <?php
            if(!empty($_SESSION) && $_SESSION["loggedIn"] == 1){
                include 'dash_nav.php';    
            }else{
                include 'nav.php';
            }
            ?>
            <!-- end of nav bar -->

          <p>Please read the application outline for your chosen category.</p>
          <div class="outlines">
                <div class="cat"><a href="./application outlines/Video Editor - Outline.pdf"><p>Editor</p></a></div>
                <div class="cat"><a href="./application outlines/Model - Outline.pdf"><p>Model</p></a></div>
                <div class="cat"><a href="./application outlines/Graphic Designer - Outline.pdf"><p>Graphic designer</p></a></div>
                <div class="cat"><a href="./application outlines/Videographer - Outline.pdf"><p>Videographer</p></a></div>
                <div class="cat"><a href="./application outlines/Photographer - Outline.pdf"><p>Photographer</p></a></div>
          </div>
          <div class="application">
            <script type="text/javascript" src="https://form.jotform.com/jsform/243241120293040"></script>
          </div>
        
            <div class="text-container">
            </div>
        </section>
    
        <div class="hero-img">
            <!-- <img src="./images/Shuhari Network Drop (6).png" alt=""> -->
            
        </div>
        <!-- end of hero -->
        </section>
         <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
</body>
</html>