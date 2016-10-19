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
    $user = getSessionValue("user", array());
    $response = loadAll();
    if(empty($user[0]))
      $user[0] = array('f_name' => "Guest", 'l_name' => "");
    $response[] = $user[0];
    echo json_encode($response);

  }
  elseif($cmd == "saveChecked")
  {
    $response = saveChecked(getValue("checked"), getValue("courseNumber"));
    echo json_encode($response);
  }
  else
  {
    echo json_encode("Please specify a value for cmd. Command supported: loadAll, saveChecked");
  }

  function loadAll()
  {
    $user = getSessionValue("courses", array());
    global $mysqli;
    $response = array();
    $query = 'SELECT c1.course_number, c1.course_name, group_concat(distinct c2.course_name ORDER BY c2.course_name SEPARATOR ", ") AS prerequisite, group_concat(distinct con.conc_name ORDER BY con.conc_name SEPARATOR ", ") AS concentration FROM courses c1 LEFT OUTER JOIN prerequisites pr on (pr.course_id = c1.course_id) LEFT OUTER JOIN courses c2 on (pr.prereq_id = c2.course_id) LEFT OUTER JOIN course_conc cc on (cc.course_id = c1.course_id) LEFT OUTER JOIN concentrations con on (cc.conc_id = con.conc_id) GROUP BY c1.course_number, c1.course_name;';
    $res = $mysqli->query($query) or die(mysqli_error($mysqli));
    while($row = $res->fetch_assoc())
    {
        $response[] = $row;
    }

    setSessionValue("courses", $response);
    return $response;
  }

  function saveChecked($checked, $courseNumber)
  {
    $user = getSessionValue("user", array());

    global $mysqli;
    $userId = $user[0]['user_id'];

    if($checked == true)
      $temp = 1;
    else
      $temp = false;

    //print_r($userId.$courseNumber.$checked);

    $update = "SELECT taken FROM user_courses";
    $res = $mysqli->query($update) or die(mysqli_error($mysqli));

    print_r($res);
    if($update != 0)
    {
      $query = "UPDATE user_courses (user_id, course_id, taken) VALUES ('$userId', (SELECT course_id FROM courses WHERE course_number = '$courseNumber'), '$temp')";
    }
    else
      $query = "INSERT INTO user_courses (user_id, course_id, taken) VALUES ('$userId', (SELECT course_id FROM courses WHERE course_number = '$courseNumber'), '$temp')";

    // $query = "INSERT INTO user_courses (user_id, course_id, taken) VALUES ('$userId', (SELECT course_id FROM courses WHERE course_number = '$course_number'), '$temp')";
    $res = $mysqli->query($query) or die(mysqli_error($mysqli));


    return true;
  }

  $mysqli->close();
?>
