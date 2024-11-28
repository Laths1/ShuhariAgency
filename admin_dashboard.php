<?php 
    include 'connect.php'; 
    session_start();
    if($_SESSION["loggedIn"] != 1){
        header("Location: admin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <?php
    //  echo "Welcome " . $_SESSION["username"];
       $sql = "
    SELECT 
        u.user_id,
        u.name AS name, 
        u.surname AS surname, 
        r.role_name AS role,
        u.phone_number AS number,
        u.email AS email,
        u.is_active AS visibility,
        u.bio AS bio
    FROM 
        Users u
    JOIN 
        UserRoles ur ON u.user_id = ur.user_id
    JOIN 
        Roles r ON ur.role_id = r.role_id
    ORDER BY 
        u.name, u.surname, r.role_name;
";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Get the result
        $stmt->execute();
        $result = $stmt->get_result();
        // Check if rows are returned
        if ($result->num_rows < 1) {
            echo "No roles found for the user.";
        }
    }
    ?>
    <h1 id="admin-title">Users Data</h1>
    <table class="admin-data">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Role</th>
                <th>Number</th>
                <th>Email</th>
                <th>Visibility</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming $result is the result of your database query
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['surname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                echo "<td>" . htmlspecialchars($row['number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['visibility']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bio']) . "</td>";

                // Action buttons
                echo "<td>";
                echo "<form method='POST' action='edit.php' style='display:inline;'>";
                echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
                echo "<button type='submit' class='edit-btn'>Edit</button>";
                echo "</form> ";

                echo "<form method='POST' action='toggle_visibility.php' style='display:inline;'>";
                echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
                echo "<button type='submit' class='toggle-btn'>Toggle Visibility</button>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <button><p>Add talent</p></button>
</body>
</html>
<?php include 'footer.php'; ?>
<?php
    session_unset();
    session_destroy();
?>