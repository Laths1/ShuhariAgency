<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shuhari Agency</title>
    <!-- styles -->
    <link rel="stylesheet" href="styles.css"></link>
    <!-- icons -->
    <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- js -->
    <script src="script.js" defer></script>    
</head>
<body>
    <!-- home page -->
    <section class="home-page-container">
    <!-- nav bar -->
    <?php
    if(!empty($_SESSION) && $_SESSION["loggedIn"] == 1){
        include 'dash_nav.php';    
    }else{
        include 'nav.php';
    }
     ?>
    <!-- end of nav bar -->

    <!-- hero -->
    <header class="hero-container">
        <div class="hero-main-text"><h1>shuhari agency</h1></div>
        <div class="hero-sub-text"><p>Elevate your next project with Shuhari Agency, where innovation meets excellence. Let us craft bespoke solutions that deliver exceptional results and bring your vision to life.</p></div>
        <div class="call-to-action">
            <div class="btn about-us-btn"><a href="./apply.php">apply</a></div>
            <!-- <div class="btn contribute-btn"><a href="#contributions">apply</a></div> -->
        </div>
    </header>

    <div class="hero-img">
        <!-- <img src="./images/Shuhari Network Drop (6).png" alt=""> -->
        
    </div>
    <!-- end of hero -->
    </section>
    <!-- end of home page -->

    <!-- facts -->
    <section class="facts-container">
        <ul class="facts-items">
            
            <li> <a href="models.php">
                <div class="icon"><i class="fa-solid fa-person"></i></div>
                <!-- <div class="number"><h2>20 +</h2></div> -->
                <div class="fact-text"><p>models</p></div>
                </a>
            </li>
            <li> <a href="graphicDesigner.php">
                <div class="icon"><i class="fa-solid fa-pen"></i></div>
                <!-- <div class="number"><h2>10 +</h2></div> -->
                <div class="fact-text"><p>graphic designers</p></div>
                </a>
            </li>
            <li>
            <a href="photographers.php">
                <div class="icon"><i class="fa-solid fa-camera"></i></div>
                <!-- <div class="number"><h2>10 +</h2></div> -->
                <div class="fact-text"><p>photographers</p></div>
                </a>
            </li>
            <li> 
                <a href="videosgrapher.php">
                <div class="icon"><i class="fa-solid fa-video"></i></div>
                <!-- <div class="number"><h2>10 +</h2></div> -->
                <div class="fact-text"><p>videographers</p></div>
                </a>
            </li>
            <li> <a href="editors.php">
                <div class="icon"><i class="fa-solid fa-computer"></i></div>
                <!-- <div class="number"><h2>10 +</h2></div> -->
                <div class="fact-text"><p>editors</p></div>
                </a>
            </li>
                   
        </ul>
    </section>
    <!-- end of facts -->

    <!-- about -->
    <section class="about-container" id="about">
        <div class="about-text-container">
            <div class="about-title"><h2>about</h2></div>
            <div class="about-main-text"><h1>Shuhari Agency is a full-service creative agency </h1></div>
            <div class="about-sub-text"><p>At Shuhari Agency, we prioritize bringing your ideas to life. Our services cater to businesses, entrepreneurs and individuals like yourself, offering a comprehensive range of solutions such as professional models, high end photographers, videographers, graphic designers, and expert video editors. Whether you're seeking striking photography, engaging video content, or exceptional modeling services, we tailor our approach to meet your unique needs. With commitment to innovation and excellence, Shuhari Agency will deliver results that exceed expectations. Let us take your project to the next level.</p></div>
        </div>
        <div class="about-img"></div>
    </section>
    <!-- end of about -->

    <!-- features -->
    <section class="features-container">
        <div class="features-text">
            <div class="features-title"><h2>reviews</h2></div>
            <div class="features-main-text"><h1>Client Testimonials </h1></div>
        </div>
        <div class="features-cards-con">
            <div class="features-card">
                <div class="card-icon">
                    <!-- <span class="material-symbols-outlined">
                        record_voice_over
                        </span> -->
                        <img src="./Worked with/IMG-20240701-WA0049.jpg" alt="">
                </div>
                <div class="card-title"><h3>artunio</h3></div>
                <div class="card-text"><p><i class="fa-solid fa-quote-left"></i> They were very professional. They didn't give us any problems <i class="fa-solid fa-quote-right"></i></p></div>
            </div>
            <div class="features-card">
                <div class="card-icon">
                    
                        <img src="./Worked with/Glory Wines_.jpg" alt="">
                </div>
                <div class="card-title"><h3>glory wines</h3></div>
                <div class="card-text"><p><i class="fa-solid fa-quote-left"></i> The entire team displayed a high level of professionalism throughout the project <i class="fa-solid fa-quote-right"></i></p></div>
            </div>
            <div class="features-card">
                <div class="card-icon">
                    
                        <img src="./Worked with/ICONIC TAPES.jpeg" alt="">
                </div>
                <div class="card-title"><h3>iconic tapes</h3></div>
                <div class="card-text"><p><i class="fa-solid fa-quote-left"></i> We needed some extras to be part of our music videos and Shuhari delivered <i class="fa-solid fa-quote-right"></i></p></div>
            </div>
            
        </div>
        <a href="reviews.php" id="reviews">See more testimonials</a>
    </section>
    <!-- end of features -->

    <!-- gallery -->
    <h2 id="gallery">Shuhari Gallery</h2>
    <div class="carousel">
    <div class="carousel-items">
        <div class="carousel-item">
            <img src="./photographers/Photographers/Gift Mathunjwa/Gift Mathunjwa/4.jpg" alt="Gift Mathunjwa">
            <div class="carousel-caption">
                <p>Photographer: Gift Mathunjwa</p>
                <div class="btn"><a href="apply.php">apply</a></div>
            </div>
          </div>
        <div class="carousel-item">
            <img src="./models/Models/Logan Kirby/2.jpg" alt="Logan Kirby">
            <div class="carousel-caption">
                <p>Model: Logan Kirby</p>
                <div class="btn"><a href="apply.php">apply</a></div>
            </div>
          </div>
      <div class="carousel-item">
        <img src="./photographers/Photographers/Melo Bopape/profile p.jpg" alt="Melo Bopape">
        <div class="carousel-caption">
            <p>Photographer: Melo Bopape</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./graphic designers/Graphic Design/Khanyiso Booi/3.jpg" alt="Khanyiso Booi">
        <div class="carousel-caption">
            <p>Graphic designer: Khanyiso Booi</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./graphic designers/Graphic Design/Mabeka Kola/4.png" alt="Mabeka Kola">
        <div class="carousel-caption">
            <p>Graphic designer: Mabeka Kola</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./photographers/Photographers/Katlego Khumalo/Katlego Khumalo/1.jpg" alt="Katlego Khumalo">
        <div class="carousel-caption">
            <p>Photographer: Katlego Khumalo </p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./photographers/Photographers/Gift Mathunjwa/Gift Mathunjwa/3.jpg" alt="Gift Mathunjwa">
        <div class="carousel-caption">
            <p>Photographer : Gift Mathunjwa</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div>
    <div class="carousel-item">
        <img src="./graphic designers/Graphic Design/Khanyiso Booi/9.png" alt="Khanyiso Booi">
        <div class="carousel-caption">
            <p>Graphic designer: Khanyiso Booi</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div><div class="carousel-item">
        <img src="./photographers/Photographers/Wessy/6.jpg" alt="Wessy">
        <div class="carousel-caption">
            <p>Photographer : Wessy</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div><div class="carousel-item">
        <img src="./graphic designers/Graphic Design/Tshepang Bapela/4.png" alt="Tshepang Bapela">
        <div class="carousel-caption">
            <p>Graphic designer: Tshepang Bapela</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div><div class="carousel-item">
        <img src="./models/Models/Mpho Ryan Sihamba/Profile_.jpg" alt="Ryan Sihamba">
        <div class="carousel-caption">
            <p>Model: Ryan Sihamba</p>
            <div class="btn"><a href="apply.php">apply</a></div>
        </div>
      </div>     
    </div>
    <button class="prev" onclick="prevSlide()">&#10094;</button>
    <button class="next" onclick="nextSlide()">&#10095;</button>
  </div>
        
    <!-- contributions -->
    <section class="contributions-container" id="contributions">
        <div class="contributions-text">
            <div class="contributions-title"><h2>why work with us?</h2></div>
            <div class="contributions-main-text"><h1>creativity</h1></div>
            <div class="contributions-sub-text"><p>We provide all the talent and expertise you need to complete your project seamlessly. From concept to execution, Shuhari Agency ensures a smooth and successful process, delivering exceptional results every step of the way.
            </p></div>
            <div class="contributions-main-text"><h1>excellence</h1></div>
            <div class="contributions-sub-text"><p>Our team is dedicated to maintaining the highest standards of creativity, quality, and professionalism in everything we do.

            </p></div>
        </div>
        
    </section>
    <!-- end of contributions -->

    <!-- contact -->
    <section class="contact-container" id="contact-us">
        <div class="contact-text">
            <div class="contact-title"><h2>contact us</h2></div>
            
        </div>
        <div class="contact-btn-con">
              <form class="contact-form" id="contact-form" method="POST" action="contact.php">
                <label for="contact-name">Name</label>
                <input type="text" id="contact-name" name="name" required>

                <label for="contact-name">Suranme</label>
                <input type="text" id="contact-name" name="surname" required>
            
                <label for="contact-email">Email</label>
                <input type="email" id="contact-email" name="email" required>
            
                <label for="contact-message">Message</label>
                <textarea id="contact-message" name="message" rows="4" required></textarea>
            
                <button type="submit">Send</button>
                
              </form>
        </div>
    </section>
    <!-- end of contact -->
<?php include 'footer.php'; ?>    
    
</body>
</html>