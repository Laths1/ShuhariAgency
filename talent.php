<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shuhari Talent</title>
    <!-- styles -->
    <link rel="stylesheet" href="styles.css"></link>
    <!-- icons -->
    <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">
    

</head>
<body>
<section>
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
    <div class="manifesto-container clearfix">
        <article class="manifesto-card">
          <div class="manifesto-img-container">
            <img src="./models/place holder ( models ).jpg" class="manifesto-img" alt="Models"/>
          </div>
          <div class="manifesto-info">
            <h3>Models</h3>
            <p>
              Discover top-tier models and talent with Shuhari Agency, where we connect brands with the best professionals for fashion, lifestyle, and commercial projects. Let us bring your vision to life with unparalleled expertise and creativity.
            </p>
            <a href="models.php" class="btn manifesto-btn">see more</a>
          </div>
        </article>
        <article class="manifesto-card">
          <div class="manifesto-img-container">
            <img src="./photographers/Place holder ( photographer ).jpg" class="manifesto-img" alt="Photographers"/>

          </div>
          <div class="manifesto-info">
            <h3>photographers</h3>
            <p>
              Explore a diverse portfolio of professional photographers at Shuhari Agency, perfect for creative shoots, events, and commercial photography. Capture every moment with expert precision and artistry tailored to your project’s needs.
            </p>
            <a href="photographers.php" class="btn manifesto-btn">see more</a>
          </div>
        </article>
        <article class="manifesto-card">
          <div class="manifesto-img-container">
            <img src="./videographers/Place holder ( videography ).jpg" class="manifesto-img" alt="videographers"/>

          </div>
          <div class="manifesto-info">
            <h3>videographers</h3>
            <p>
              Find talented videographers at Shuhari Agency, specialising in capturing high-quality visuals for films, events, and promotional video projects. Let us bring your story to life with compelling and cinematic content
            </p>
            <a href="videosgrapher.php" class="btn manifesto-btn">see more</a>
          </div>
        </article>
    </div>
    <div class="manifesto-container clearfix">
        <article class="manifesto-card">
          <div class="manifesto-img-container">
            <img src="./graphic_designers/mabekakola/3.png" class="manifesto-img" alt="Graphic designer"/>
          </div>
          <div class="manifesto-info">
            <h3>graphic designers</h3>
            <p>
              Discover skilled graphic designers at Shuhari Agency, specialising in brand identity, digital art, and creative visual solutions. Elevate your brand with designs that captivate and inspire.
            </p>
            <a href="graphicDesigner.php" class="btn manifesto-btn">see more</a>
          </div>
        </article>
        <article class="manifesto-card">
          <div class="manifesto-img-container">
            <img src="./editors/place holder ( editor ).jpg" class="manifesto-img" alt="Editors"/>

          </div>
          <div class="manifesto-info">
            <h3>editors</h3>
            <p>
              Connect with expert editors at Shuhari Agency for seamless video, photo, and content editing. We bring your vision to life with precision and creativity, ensuring polished, professional results.
            </p>
            <a href="editors.php" class="btn manifesto-btn">see more</a>
          </div>
      </article>
        
    </div>
   
     <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
  </section>
    
</body>
</html>