<?php
$servername = "db";
$username = "root";
$password = "root";

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
}

// Create connection
$conn = new mysqli($servername, $username, $password, "socialmedia");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$ok = $conn->query("SELECT 1 FROM user LIMIT 1;");

echo $ok->num_rows;
echo "vem bitch";