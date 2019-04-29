<?php
$servername = "db";
$username = "root";
$password = "root";

$conn = new mysqli($servername, $username, $password, "socialmedia");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$u = $_POST['user'];
$p = $_POST['password'];
$e = $_POST['email'];

$ok = $conn->query("INSERT INTO users (username, password, email)
VALUES (\"$u\", \"$p\", \"$e\")");

if (!$ok) {
    echo " nao foi porra";
}

if ($ok) {
    echo "foi ";
}