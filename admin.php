<?php include 'connect.php'; ?>
<?php  
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <form action="admin.php" method="POST" id="login">
        <p>Username</p>
        <input type="text" name="username">
        <p>Password</p>
        <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>

    <?php
    session_start();
    $username = $password = "";
    $usernameErr = $passwordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Username is required";
            echo $usernameErr;
        } else {
            $username = sanitize($_POST["username"]);
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
            echo $passwordErr;
        } else {
            $password = sanitize($_POST["password"]);
        }

        if (empty($usernameErr) && empty($passwordErr)) {
            // Use prepared statement to avoid SQL injection
            $stmt = $conn->prepare("SELECT username, password_hash FROM admin WHERE username = ?");
            $stmt->bind_param("s", $username); // "s" indicates the type is string
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Username exists
                $row = $result->fetch_assoc();
                if (password_verify($password, $row["password_hash"])) {
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["admin"] = true;
                    header("Location: admin_dashboard.php");
                } else {
                    echo "Incorrect password";
                }
            } else {
                echo "Username does not exist";
            }

            $stmt->close();
        }
    }

    function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
</body>
</html>
<?php include 'footer.php'; ?>
