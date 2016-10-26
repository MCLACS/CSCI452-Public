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

if ($cmd == "edit")
{
  $password = getValue('password');
  $password = mysqli_real_escape_string($mysqli,$password);
  $f_name = getValue('f_name');
  $f_name = mysqli_real_escape_string($mysqli,$f_name);
  $l_name = getValue('l_name');
  $l_name = mysqli_real_escape_string($mysqli,$l_name);
  $email = getValue('email');
  $email = mysqli_real_escape_string($mysqli,$email);
  $response = edit($password, $f_name, $l_name, $email);
  echo json_encode($response);
}
elseif ($cmd == "account")
{
  $response = account();
  echo json_encode($response);
}
elseif ($cmd == "delete")
{
  $response = delete();
  echo json_encode($response);
  session_destroy();
}
else
{
  echo json_encode("Please specify a value for cmd. Command supported: login");
}

function edit($password, $f_name, $l_name, $email)
{
  $user = getSessionValue('user', array());
  global $mysqli;
  $salt = '$2a$09$kfu783hf76hbdl9jw7yh4i$';
  $response = array();
  $password = crypt($password, $salt);
  $temp = $user[0]['user_id'];
  $query = "UPDATE users SET f_name = '$f_name', l_name = '$l_name', email = '$email', password = '$password' WHERE user_id = '$temp'";
  $query2 = "SELECT user_id, f_name, l_name, password, email FROM users WHERE user_id = '$temp'";
  $res = $mysqli->query($query) or die(mysqli_error($mysqli));
  $res2 = $mysqli->query($query2) or die(mysqli_error($mysqli));
  while($row = $res2->fetch_assoc())
    {
        $response[] = $row;
    }
  setSessionValue('user', $response);
  return true;
}

function delete()
{
  $user = getSessionValue('user', array());
  global $mysqli;
  $response = array();
  $temp = $user[0]['user_id'];
  $query = "DELETE FROM users WHERE user_id = '$temp'";
  $res = $mysqli->query($query) or die(mysqli_error($mysqli));

  return true;
}

function account()
{
  $user = getSessionValue("user", array());
  return $user;
}

$mysqli->close();
?>
