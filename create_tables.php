<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'shuharidb';

    $conn = new mysqli($servername, $username, $password);

    if($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }
    echo "connected";
    // Select the database
$conn->select_db($db);

// SQL statements to create tables
$tables = [
    "Users" => "
        CREATE TABLE IF NOT EXISTS Users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            type ENUM('model', 'editor', 'photographer', 'videographer', 'graphic_designer') NOT NULL,
            bio TEXT,
            profile_image VARCHAR(255),
            is_active BOOLEAN DEFAULT TRUE
        )
    ",
    "Models" => "
        CREATE TABLE IF NOT EXISTS Models (
            model_id INT PRIMARY KEY,
            height DECIMAL(5,2),
            waist DECIMAL(5,2),
            shoe_size DECIMAL(4,2),
            location VARCHAR(255),
            gender ENUM('male', 'female', 'non-binary', 'other') NOT NULL,
            FOREIGN KEY (model_id) REFERENCES Users(user_id) ON DELETE CASCADE
        )
    ",
    "Model_Images" => "
        CREATE TABLE IF NOT EXISTS Model_Images (
            image_id INT AUTO_INCREMENT PRIMARY KEY,
            model_id INT NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            FOREIGN KEY (model_id) REFERENCES Models(model_id) ON DELETE CASCADE
        )
    ",
    "Editors" => "
        CREATE TABLE IF NOT EXISTS Editors (
            editor_id INT PRIMARY KEY,
            youtube_link VARCHAR(255),
            FOREIGN KEY (editor_id) REFERENCES Users(user_id) ON DELETE CASCADE
        )
    ",
    "Videographers" => "
        CREATE TABLE IF NOT EXISTS Videographers (
            videographer_id INT PRIMARY KEY,
            location VARCHAR(255),
            youtube_link VARCHAR(255),
            FOREIGN KEY (videographer_id) REFERENCES Users(user_id) ON DELETE CASCADE
        )
    ",
    "Photographers" => "
        CREATE TABLE IF NOT EXISTS Photographers (
            photographer_id INT PRIMARY KEY,
            location VARCHAR(255),
            FOREIGN KEY (photographer_id) REFERENCES Users(user_id) ON DELETE CASCADE
        )
    ",
    "Photographer_Images" => "
        CREATE TABLE IF NOT EXISTS Photographer_Images (
            image_id INT AUTO_INCREMENT PRIMARY KEY,
            photographer_id INT NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            FOREIGN KEY (photographer_id) REFERENCES Photographers(photographer_id) ON DELETE CASCADE
        )
    ",
    "Graphic_Designers" => "
        CREATE TABLE IF NOT EXISTS Graphic_Designers (
            graphic_designer_id INT PRIMARY KEY,
            FOREIGN KEY (graphic_designer_id) REFERENCES Users(user_id) ON DELETE CASCADE
        )
    ",
    "Graphic_Designer_Images" => "
        CREATE TABLE IF NOT EXISTS Graphic_Designer_Images (
            image_id INT AUTO_INCREMENT PRIMARY KEY,
            graphic_designer_id INT NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            FOREIGN KEY (graphic_designer_id) REFERENCES Graphic_Designers(graphic_designer_id) ON DELETE CASCADE
        )
    ",
    "Admin" => "
        CREATE TABLE IF NOT EXISTS Admin (
            admin_id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL
        )
    "
];

// Execute table creation
foreach ($tables as $table => $query) {
    if ($conn->query($query) === TRUE) {
        echo "Table $table created successfully\n";
    } else {
        echo "Error creating table $table: " . $conn->error . "\n";
    }
}


// Create Messages table
$sql = "
    CREATE TABLE IF NOT EXISTS Messages (
        message_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
    );
";

// SQL to create the Roles table
$rolesTable = "
    CREATE TABLE IF NOT EXISTS Roles (
        role_id INT AUTO_INCREMENT PRIMARY KEY,
        role_name ENUM('model', 'editor', 'photographer', 'videographer', 'graphic_designer') UNIQUE NOT NULL
    );
";

// SQL to create the UserRoles table
$userRolesTable = "
    CREATE TABLE IF NOT EXISTS UserRoles (
        user_id INT NOT NULL,
        role_id INT NOT NULL,
        PRIMARY KEY (user_id, role_id),
        FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
        FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE CASCADE
    );
";

// Alter Users table to remove the `type` column
$alterUsersTable = "
    ALTER TABLE Users
    DROP COLUMN IF EXISTS type;
";

// Execute SQL queries
if ($conn->query($rolesTable) === TRUE) {
    echo "Roles table created successfully.\n";
} else {
    echo "Error creating Roles table: " . $conn->error . "\n";
}

if ($conn->query($userRolesTable) === TRUE) {
    echo "UserRoles table created successfully.\n";
} else {
    echo "Error creating UserRoles table: " . $conn->error . "\n";
}

if ($conn->query($alterUsersTable) === TRUE) {
    echo "Users table altered successfully.\n";
} else {
    echo "Error altering Users table: " . $conn->error . "\n";
}

// Close connection
$conn->close();
?>