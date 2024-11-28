<?php 
    include 'connect.php'; 
    session_start();
    if($_SESSION["loggedIn"] != 1){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <?php
    $username = $_SESSION["username"];
    $sql = "
    SELECT 
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
        // Output the rows
        while ($row = $result->fetch_assoc()) {
            echo "Name: " . $row['user_name'] . "\n";
            echo "Surname: " . $row['user_surname'] . "\n";
            echo "Role: " . $row['user_role'] . "\n";
        }
    } else {
        echo "No roles found for the user.";
    }
}else{
    echo "error" . $conn->error;
}
    // Close the statement
    $stmt->close();


    ?>
</body>
</html>
<?php include 'footer.php'; ?>
<?php
    session_unset();
    session_destroy();
?>