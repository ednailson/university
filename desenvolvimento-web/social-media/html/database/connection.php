<?php
$servername = "db";
$username = "root";
$password = "root";

$conn = new mysqli($servername, $username, $password, "socialmedia");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}