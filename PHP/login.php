<?php
  require_once 'login_db.php';
  $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
  if ($conn->connect_error)
  {
      die("Connection failed: " . $conn->connect_error);
  }

  echo "php called";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $id = $_POST['id'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM users WHERE id = '$id' and password = '$password'";
    $result = mysqli_query($sql);
    echo $result;
  }
?>
