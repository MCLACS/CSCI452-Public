<?php
  session_start();

  require_once "functions.php";
  require_once "db_login.php";

  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');

  $mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
  if ($mysqli->connect_error)
  {
    die("Connection failed: " . $mysqli->connect_error);
  }

  $cmd = getValue("cmd");

  if ($cmd == "create")
  {
    $salt = '$2a$09$kfu783hf76hbdl9jw7yh4i$';
    $a_number = getValue('aNumber');
    $a_number = mysqli_real_escape_string($mysqli,$a_number);
    $password = crypt(getValue('password'), $salt);
    $password = mysqli_real_escape_string($mysqli,$password);
    $f_name = getValue('firstName');
    $f_name = mysqli_real_escape_string($mysqli,$f_name);
    $l_name = getValue('lastName');
    $l_name = mysqli_real_escape_string($mysqli,$l_name);
    $email = getValue('email');
    $email = mysqli_real_escape_string($mysqli,$email);
    $response = create($a_number, $password, $f_name, $l_name, $email);
    echo json_encode($response);
  }
  else
  {
      echo json_encode("Please specify a value for cmd. Command supported: login");
  }

  function create($a_number, $password, $f_name, $l_name, $email)
  {
      global $mysqli;
      $response = array();
      $query = "INSERT INTO users (a_number, f_name, l_name, email, password) VALUES ('$a_number', '$f_name', '$l_name', '$email', '$password')";
      $res = $mysqli->query($query) or die(mysqli_error($mysqli));

      return true;
  }

  $mysqli->close();
?>
