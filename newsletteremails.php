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
    <title>Newsletter emails</title>
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

    <h1 id="admin-title">news letter emails</h1>
    <div class="messages-container">
        <?php
        // Fetch messages and user roles from the database
        $sql = "
        SELECT 
            email,
            date
        FROM 
            newsletter 
        ORDER BY 
            date DESC;
        ";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Loop through and display each message with the sender's role
            while ($row = $result->fetch_assoc()) {
                echo '<div class="message">';
                echo '<p><strong>email:</strong> ' . htmlspecialchars($row['email']) . '</p>';
                echo '<p><small><strong>Sent:</strong> ' . htmlspecialchars($row['date']) . '</small></p>';
                echo '</div><hr>';
            }
        } else {
            echo '<p>No emails found.</p>';
        }
        ?>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>