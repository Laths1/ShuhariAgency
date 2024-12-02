<?php 
    include 'connect.php'; 
    session_start();
    if ($_SESSION["loggedIn"] != 1) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent Dashboard</title>
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
    <?php
    $username = $_SESSION["username"];
    $sql = "
    SELECT 
        u.user_id,
        u.name AS user_name, 
        u.surname AS user_surname, 
        r.role_name AS user_role
    FROM 
        Users u
    JOIN 
        UserRoles ur ON u.user_id = ur.user_id
    JOIN 
        Roles r ON ur.role_id = r.role_id
    WHERE 
        u.username = ?
    ORDER BY 
        u.name, u.surname, r.role_name;
    ";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind the session username to the query
        $stmt->bind_param("s", $username);
        // Execute the query
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();
        // Check if rows are returned
        if ($result->num_rows > 0) {
            // Output the rows and create forms for sending messages
            while ($row = $result->fetch_assoc()) {
                echo "<p>Name: " . htmlspecialchars($row['user_name']) . "</p>";
                echo "<p>Surname: " . htmlspecialchars($row['user_surname']) . "</p>";
                echo "<p>Role: " . htmlspecialchars($row['user_role']) . "</p>";
                
                // Form for sending a message
                echo '<form action="messages.php" method="POST">';
                echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($row['user_id']) . '">';
                echo '<textarea name="message" placeholder="Write your message here..." required></textarea>';
                echo '<button type="submit">Send</button>';
                echo '</form>';
            }
        } else {
            echo "<p>No roles found for the user.</p>";
        }
    } else {
        echo "Error: " . $conn->error;
    }
    // Close the statement
    $stmt->close();
    ?>
</body>
</html>
<?php include 'footer.php'; ?>
