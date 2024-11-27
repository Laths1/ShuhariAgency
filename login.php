<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <?php include 'connect.php'; ?>
    <form action="login.php" method="POST" id="login"> 
        <p>username</p><input type="text" name="username">
        <p>password</p><input type="password" name="password"><br>
        <input type="submit" value="login">
    </form>
</body>
</html>
<?php
    $username = $password = "";
    $usernameErr = $passwordErr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["username"])){
            $usernameErr = "Username is required";
            echo $usernameErr;
        }else{
            $username = sanitize($_POST["username"]);
        }
        
        if(empty($_POST["password"])){
            $passwordErr = "Password required";
            echo $passwordErr;
        }else{
            $password = sanitize($_POST["password"]);
        }
        
        echo $username;
        echo $password;
    }
    function sanitize($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php include 'footer.php'; ?>