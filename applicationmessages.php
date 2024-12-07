<?php 
    include 'connect.php'; 
    session_start();
    if ($_SESSION["loggedIn"] != 1) {
        header("Location: admin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    if ($_SESSION["loggedIn"] == 1) {
        include 'dash_nav.php';    
    } else {
        include 'nav.php';
    }
    ?>
    
        <h1 id="admin-title">applications</h1>
        <div class="messages-container">
            <?php
        try{
            // Fetch messages and user roles from the database
            $sql = "
            SELECT 
                name,
                surname,
                email,
                number,
                location,
                portfolio,
                social_media_handle,
                motivation,
                role,
                created_at
            FROM 
                application 
            ORDER BY 
                created_at DESC;
            ";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                // Loop through and display each message with the sender's role
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="message">';
                    echo '<p><strong>From:</strong> ' . htmlspecialchars($row['name']) . ' ' . htmlspecialchars($row['surname']) . ' (' . htmlspecialchars($row['email']) . ')</p>';
                    echo '<p><strong>Number:</strong> ' . htmlspecialchars($row['number']) . '</p>';
                    echo '<p><strong>Location:</strong> ' . htmlspecialchars($row['location']) . '</p>';
                    echo '<p><strong>Portfolio:</strong> ' . htmlspecialchars($row['portfolio']) . '</p>';
                    echo '<p><strong>Social media handle:</strong> ' . htmlspecialchars($row['social_media_handle']) . '</p>';
                    echo '<p><strong>Motivation:</strong> ' . htmlspecialchars($row['motivation']) . '</p>';
                    echo '<p><strong>Category:</strong> ' . htmlspecialchars($row['role']) . '</p>';
                    echo '<p><small><strong>Sent:</strong> ' . htmlspecialchars($row['created_at']) . '</small></p>';
                    echo '</div><hr>';
                }
        } else {
            echo '<p>No messages found.</p>';
        }
    }catch(Exception $e){
        header("Location: error.php");
    }
    
        ?>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
