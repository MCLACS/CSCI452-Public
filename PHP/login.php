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

  if ($cmd == "login")
  {
    $a_number = getValue('a_number');
    $a_number = mysqli_real_escape_string($mysqli,$a_number);
    $password = md5(getValue('password'));
    $password = mysqli_real_escape_string($mysqli,$password);
    $response = login($a_number, $password);
    echo json_encode($response);
  }
  elseif ($cmd == "checkLogin") {
    $response = checkLogin();
    echo json_encode($response);
  }
  elseif ($cmd == "logout") {
    $response = logout();
    echo json_encode($response);
  }
  else
  {
    echo json_encode("Please specify a value for cmd. Command supported: login");
  }

  function login($a_number, $password)
  {
    $user = getSessionValue("user", array());
    global $mysqli;
    $response = array();
    $query = "SELECT user_id, f_name, l_name, password, email FROM users WHERE a_number= '$a_number' AND password= '$password'";
    $res = $mysqli->query($query) or die(mysqli_error($mysqli));
    while($row = $res->fetch_assoc())
    {
        $response[] = $row;
    }
    setSessionValue("user", $response);
    return $response;
  }

  function checkLogin() {
    $user = getSessionValue("user", array());
    return $user;
  }

  function logout() {
    setSessionValue("user", array());
    $response = getSessionValue("user", array());
  }

  $mysqli->close();
?>
