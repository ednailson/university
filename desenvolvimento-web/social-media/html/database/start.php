<?php
$servername = "db";
$username = "root";
$password = "root";

$conn = new mysqli($servername, $username, $password, "socialmedia");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE TABLE friendship(
   friendship_id INT AUTO_INCREMENT PRIMARY KEY,
   fk_user_1 INT NOT NULL,
   fk_user_2 INT NOT NULL,
   pending TINYINT NOT NULL DEFAULT 1
);");

$conn->query("CREATE TABLE users(
   user_id INT AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(40) NOT NULL UNIQUE,
   name VARCHAR(80) NOT NULL,
   password VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL UNIQUE,
   photo TEXT
);");


$conn->query("CREATE TABLE posts(
   post_id INT AUTO_INCREMENT PRIMARY KEY,
   text VARCHAR(4000) NOT NULL,
   images TEXT,
   date DATETIME NOT NULL DEFAULT NOW(),
   likes INT DEFAULT 0,
   fk_user_id INT NOT NULL
);");

$conn->query("CREATE TABLE friendship_posts(
   friendship_post_id INT AUTO_INCREMENT PRIMARY KEY,
   fk_user_id INT,
   fk_post_id INT,
   liked TINYINT NOT NULL DEFAULT 0
);");

$conn->query("CREATE TABLE comments(
   fk_post_id_comment INT,
   comment TEXT
);");

$conn->query("ALTER TABLE `friendship` ADD CONSTRAINT `fk_user_1` FOREIGN KEY ( `fk_user_1` ) REFERENCES `users` ( `user_id` );");
$conn->query("ALTER TABLE `friendship` ADD CONSTRAINT `fk_user_2` FOREIGN KEY ( `fk_user_2` ) REFERENCES `users` ( `user_id` );");
$conn->query("ALTER TABLE `posts` ADD CONSTRAINT `fk_user_id` FOREIGN KEY ( `fk_user_id` ) REFERENCES `users` ( `user_id` );");
$conn->query("ALTER TABLE `friendship_posts` ADD CONSTRAINT `fk_user_id` FOREIGN KEY ( `fk_user_id` ) REFERENCES `users` ( `user_id` );");
$conn->query("ALTER TABLE `friendship_posts` ADD CONSTRAINT `fk_post_id` FOREIGN KEY ( `fk_post_id` ) REFERENCES `posts` ( `post_id` );");
$conn->query("ALTER TABLE `comments` ADD CONSTRAINT `fk_post_id_comment` FOREIGN KEY ( `fk_post_id_comment` ) REFERENCES `posts` ( `post_id` );");

header('Location: ../index.html');