<?php
$db_hostname = getenv('localhost');
$db_username = 'root';
$db_password = '';

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

//create degree-me db
$sql = "CREATE DATABASE degree_me";
$conn->query($sql);

//close connection
$conn->close();
?>