<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shuhari videographers</title>
<!-- styles -->
<link rel="stylesheet" href="styles.css">
</link>
<!-- icons -->

<link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">

<!-- js -->

<script src="videographer-card.js" defer></script>
</head>

<body>
    <!-- header -->
        <!-- nav bar -->
        <?php
    if(!empty($_SESSION) && $_SESSION["loggedIn"] == 1){
        include 'dash_nav.php';    
    }else{
        include 'nav.php';
    }
     ?>
        <!-- end of nav bar -->
    <!-- end of header -->

    <!-- videographers -->
    <section class="person-container">
        <h1>videographers</h1>
        <section class="talent-container"></section>
    </section>
    <!-- end of videographers -->
     
     <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
</body>
</html>