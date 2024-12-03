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
             <form action="application.php" method="POST" class="contact-form">
                <h2>Application Form</h2>

                <!-- Name Fields -->
                <label for="first_name">First Name*</label>
                <input type="text" id="first_name" name="name" placeholder="Enter your first name" required>

                <label for="last_name">Last Name*</label>
                <input type="text" id="last_name" name="surname" placeholder="Enter your last name" required>

                <!-- Email -->
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" placeholder="example@example.com" required>

                <!-- Phone Number -->
                <label for="phone">Phone Number*</label>
                <input type="tel" id="phone" name="number" placeholder="000 000 0000" title="Please enter a valid phone number in the format (000) 000-0000">

                <!-- Location -->
                <label for="location">Location (City/Province)</label>
                <input type="text" id="location" name="location" placeholder="Enter your city and province">

                <!-- Portfolio Link -->
                <label for="portfolio">Link to Portfolio</label>
                <input type="url" id="portfolio" name="portfolio" placeholder="Personal website, Google Drive, Behance, YouTube, etc.">

                <!-- Social Media Handle -->
                <label for="social_media">Social Media Handle</label>
                <input type="text" id="social_media" name="social_media" placeholder="Instagram handle preferred" >

                <!-- Motivation -->
                <label for="motivation">Motivation*</label>
                <textarea id="motivation" name="motivation" rows="4" placeholder="Tell us about yourself and your experience" required></textarea>

                <!-- Category Selection -->
                <label for="category">Select a Category*</label>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="model">Model</option>
                    <option value="editor">Editor</option>
                    <option value="graphic_designer">Graphic Designer</option>
                    <option value="photographer">Photographer</option>
                    <option value="videographer">Videographer</option>
                </select>

                <!-- Submit Button -->
                <button type="submit">Submit</button>
            </form>
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