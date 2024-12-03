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
    <title>Admin Dashboard</title>
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

    <h1 id="admin-title">talent messages</h1>
    <div class="messages-container">
        <?php
        // Fetch messages and user roles from the database
        $sql = "
        SELECT 
            m.message_id, 
            u.name AS sender_name, 
            u.surname AS sender_surname, 
            r.role_name AS sender_role, 
            m.content, 
            m.created_at 
        FROM 
            Messages m
        JOIN 
            Users u ON m.user_id = u.user_id
        JOIN 
            UserRoles ur ON u.user_id = ur.user_id
        JOIN 
            Roles r ON ur.role_id = r.role_id
        ORDER BY 
            m.created_at DESC;
        ";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Loop through and display each message with the sender's role
            while ($row = $result->fetch_assoc()) {
                echo '<div class="message">';
                echo '<p><strong>From:</strong> ' . htmlspecialchars($row['sender_name']) . ' ' . htmlspecialchars($row['sender_surname']) . ' (' . htmlspecialchars($row['sender_role']) . ')</p>';
                echo '<p><strong>Message:</strong> ' . htmlspecialchars($row['content']) . '</p>';
                echo '<p><small><strong>Sent:</strong> ' . htmlspecialchars($row['created_at']) . '</small></p>';
                echo '</div><hr>';
            }
        } else {
            echo '<p>No messages found.</p>';
        }
        ?>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
