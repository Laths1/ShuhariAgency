<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shuhari</title>
        <!-- styles -->
        <link rel="stylesheet" href="styles.css"></link>
        <!-- icons -->
        <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">
        <!-- js -->
    
    </head>
</head>
<body>
    <!-- nav bar -->
    <?php include 'nav.php'; ?>
    <!-- end of nav bar -->
    <div class="profile">
    <h1 class="name"></h1>
    <div class="location"></div>
    <div class="details"></div>
    <p class="bio"></p>
    <div class="images-container"></div> <!-- Container for images -->
    <div class="videos-container"></div>
    </div>

    <script src="individual.js" defer></script>
    
    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
</body>
</html>