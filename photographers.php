<?php
 session_start();
 include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shuhari photographers</title>
        <!-- styles -->
        <link rel="stylesheet" href="styles.css"></link>
        <!-- icons -->
        <link rel="icon" href="favicon_io/favicon-16x16.png" type="image/x-icon">
    </head>
<body>
    <!-- home page -->
    <section class="home-page-container-talents">
        <section class="random-img">
            <!-- nav bar -->
            <?php
            if (!empty($_SESSION) && $_SESSION["loggedIn"] == 1) {
                include 'dash_nav.php';    
            } else {
                include 'nav.php';
            }
            ?>
            <!-- end of nav bar -->
        </section>
    <!-- end of home page -->

     <!-- models -->
      <section class="person-container">
        <h1>Photographers</h1>
        <?php
            $sql = "
            SELECT
                users.user_id,
                users.name, 
                users.surname,
                users.profile_image, 
                users.is_active 
            FROM photographers
            INNER JOIN users ON photographers.photographer_id = users.user_id
            WHERE users.is_active = 1
            ";
            $result = $conn->query($sql);

            // Start output
            if ($result->num_rows > 0) {
                echo '<div class="talent-container">'; // Replace "container" with your desired container ID
                while ($row = $result->fetch_assoc()) {
                    // Check if the model's gender is male
                    
                        $fullName = htmlspecialchars($row['name'] . ' ' . $row['surname']);
                        echo '<div class="talent-container2">';
                        echo '    <div class="talent-text-container">';
                        echo '        <div class="talent-title"><h2>' . $fullName . '</h2></div>';
                        echo '        <div class="talent-main-text">';
                        // Uncomment the following lines to display additional information if required
                        // echo '            <h3>Height: ' . htmlspecialchars($row['height'] ?: 'N/A') . ' Waist: ' . htmlspecialchars($row['waist'] ?: 'N/A') . '</h3><br>';
                        // echo '            <h3>Location: ' . htmlspecialchars($row['location'] ?: 'N/A') . '</h3>';
                        echo '        </div>';
                        echo '        <div class="btn person-btn" id="person-btn"><a href="individual.php?user_id=' . $row['user_id'] . '">View</a></div>';
                        echo '    </div>';
                        echo '    <div class="talent-img">';
                        echo '        <a href="individual.php?user_id=' . $row['user_id'] . '"><img src="' . htmlspecialchars($row['profile_image']) . '" alt="' . $fullName . '"></a>';
                        echo '    </div>';
                        echo '</div>';
                    
                }
                echo '</div>'; // Close the container
            } else {
                echo '<p>No models to display.</p>';
            }
        ?>
      </section>
     <!-- end of models -->

    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end of footer -->
</body>
</html>
