<?php 
    include 'connect.php'; 
    session_start();
    
    // Check if the user is logged in
    if($_SESSION["loggedIn"] != 1){
        header("Location: admin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visibility</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <?php
        // Get the user ID from the POST request
        $userid = intval($_POST["user_id"]);

        // SQL query to fetch the user's name, surname, and role
        $sql = "
            SELECT 
                u.name AS name, 
                u.surname AS surname, 
                r.role_name AS role,
                u.is_active AS visibility
            FROM 
                Users u
            JOIN 
                UserRoles ur ON u.user_id = ur.user_id
            JOIN 
                Roles r ON ur.role_id = r.role_id
            WHERE 
                u.user_id = ?
            LIMIT 1;
        ";

        // Prepare and execute the query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($row = $result->fetch_assoc()) {
            $name = htmlspecialchars($row['name']);
            $surname = htmlspecialchars($row['surname']);
            $role = htmlspecialchars($row['role']);
            $visibility = intval($row['visibility']);
        } else {
            echo "<p>User not found.</p>";
            exit;
        }
    ?>

    <h1>Edit Visibility</h1>
    <form method="POST" action="update_visibility.php">
        <input type="hidden" name="user_id" value="<?php echo $userid; ?>">
        <p>
            <strong>Name:</strong> <?php echo $name; ?><br>
            <strong>Surname:</strong> <?php echo $surname; ?><br>
            <strong>Role:</strong> <?php echo $role; ?><br>
        </p>
        <p>
            <strong>Visibility:</strong><br>
            <label>
                <input type="radio" name="is_active" value="1" <?php if ($visibility === 1) echo "checked"; ?>>
                Visible
            </label><br>
            <label>
                <input type="radio" name="is_active" value="0" <?php if ($visibility === 0) echo "checked"; ?>>
                Hidden
            </label>
        </p>
        <button type="submit">Update Visibility</button>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>
