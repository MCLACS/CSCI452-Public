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

  if ($cmd == "loadAll")
  {
    $response = loadAll();
    echo json_encode($response);
  }
  else
  {
    echo json_encode("Please specify a value for cmd. Command supported: loadAll");
  }

  function loadAll()
  {
    $user = getSessionValue("courses", array());
    global $mysqli;
    $response = array();
    $query = "SELECT course_number, course_name FROM courses";
    $res = $mysqli->query($query) or die(mysqli_error($mysqli));
    while($row = $res->fetch_assoc())
    {
        $response[] = $row;
    }
    setSessionValue("courses", $response);
    return $response;
  }

  $mysqli->close();
?>
