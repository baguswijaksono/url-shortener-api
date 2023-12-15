<?php
// Database connection configuration
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "urls"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create a users table with a token column
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(100) NOT NULL
)";

if ($conn->query($sql_users) === TRUE) {
    echo "Users table created successfully<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}

// SQL query to create a urls table
$sql_urls = "CREATE TABLE IF NOT EXISTS urls (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    orurl VARCHAR(255) NOT NULL,
    shurl VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_urls) === TRUE) {
    echo "URLs table created successfully<br>";
} else {
    echo "Error creating URLs table: " . $conn->error . "<br>";
}

$analyticsql = "CREATE TABLE analytics (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    url_id INT(6) UNSIGNED,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (url_id) REFERENCES urls(id) ON DELETE CASCADE
);
";

if ($conn->query($analyticsql) === TRUE) {
    echo "analytics table created successfully<br>";
} else {
    echo "Error creating URLs table: " . $conn->error . "<br>";
}

$conn->close();
?>
