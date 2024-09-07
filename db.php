<?php
$servername = getenv('DB_HOST');
$username = getenv('DB_USER'); // default username for MySQL
$password = getenv('DB_PASSWORD');; // default password for MySQL
$dbname = "todo_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
