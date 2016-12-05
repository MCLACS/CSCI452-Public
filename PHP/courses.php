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
    $taken = getValue('taken');
    $course = getValue('course');
    saveChecked($taken, $course);
  }
  else
  {
    echo json_encode("Please specify a value for cmd. Command supported: loadAll, saveChecked");
  }

  function loadAll()
  {
    global $mysqli;

    $user = getSessionValue("user", array());
    $userId = $user[0]['user_id'];

    $response2 = array();
    $query2 = "select course_id from user_courses where user_id = ".$userId.";";
    $res = $mysqli->query($query2) or die(mysqli_error($mysqli));
    while($row = $res->fetch_assoc())
    {
        $response2[] = $row;
    }

    $response1 = array();
    $query1 = 'SELECT uc.taken, c1.course_id, c1.course_number, c1.course_name, group_concat(distinct pt.prereq_name ORDER BY pt.prereq_name SEPARATOR ", ") AS prerequisite, group_concat(distinct con.conc_name ORDER BY con.conc_name SEPARATOR ", ") AS concentration FROM courses c1 LEFT OUTER JOIN prereq_bridge pr on (pr.course_id = c1.course_id) LEFT OUTER JOIN prereq_text pt on (pr.prereq_id = pt.prereq_id) LEFT OUTER JOIN course_conc cc on (cc.course_id = c1.course_id) LEFT OUTER JOIN concentrations con on (cc.conc_id = con.conc_id) LEFT OUTER JOIN user_courses uc on (c1.course_id = uc.course_id) GROUP BY c1.course_number, c1.course_name;';
    $res = $mysqli->query($query1) or die(mysqli_error($mysqli));
    while($row = $res->fetch_assoc())
    {
        $row["taken"] = 0;
        foreach ($response2 as $value)
        {
          if ($value["course_id"] == $row["course_id"])
          {
            $row["taken"] = 1;
            break;
          }
        }
        $response1[] = $row;
    }
    return $response1;
  }

  function saveChecked($taken, $course){
    $user = getSessionValue("user", array());
    global $mysqli;
    $userId = $user[0]['user_id'];
    $query = "REPLACE INTO user_courses (user_id, course_id, taken) VALUES ('".$userId."', (SELECT course_id FROM courses WHERE course_number = '".$course."'), '".$taken."');";
    $res = $mysqli->query($query) or die(mysqli_error($mysqli));
  }

  $mysqli->close();
?>
