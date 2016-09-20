<?php
$db_hostname = getenv('localhost');
$db_database = 'degree_me';
$db_username = 'root';
$db_password = '';

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

//add users table
$sql = "CREATE TABLE users(id int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	f_name varchar(25) NOT NULL, l_name varchar(25) NOT NULL, email varchar(50) NOT NULL UNIQUE,
	password varchar(25)) AUTO_INCREMENT = 1";
$conn->query($sql);

//close connection
$conn->close();
?>