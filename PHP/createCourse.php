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
  
  if (strpos($cmd, 'Course') !== false) {
    $course_name = mysqli_real_escape_string($mysqli,getValue(/*'COURSE NAME ID'*/));
    $course_number = mysqli_real_escape_string($mysqli,getValue(/*'COURSE NUMBER ID'*/));
    $conc_id = mysqli_real_escape_string($mysqli,getValue(/*'CONCENTRATION ID'*/));
    $prereq_id = mysqli_real_escape_string($mysqli,getValue(/*'PREREQ ID'*/));
    $course_credits = mysqli_real_escape_string($mysqli, getValue(/*COURSE_CRDITS*/));
    
    if($cmd == "addCourse")
      $response = addCourse($course_name, $course_number, $conc_id, $prereq_id, $course_credits);
    elseif($cmd == "editCourse")
      $response = editCourse($course_id, $course_name, $course_number, $course_credits, $prereq_id, $conc_id);
    elseif($cmd == "deleteCourse")
      $response = deleteCourse($course_id);
    
    echo json_encode($response);
  }
  
  elseif (strpos($cmd, 'Concentration') !== false) {
    $conc_name = mysqli_real_escape_string($mysqli,getValue(/*'CONCENTRATION NAME'*/));
    $conc_id = mysqli_real_escape_string($mysqli,getValue(/*'CONCENTRATION ID'*/));
    
    if($cmd == "createConcentraion")
      $response = addConcentration($conc_name);
    elseif($cmd == "editConcentration")
      $response = editConcentration($conc_id, $conc_name);
    elseif($cmd == "deleteConcentration")
      $response = deleteConcentration($conc_id);
    
    echo json_encode($response);
  }
  
  elseif (strpos($cmd, 'Prereq') !== false) {
    $prereq_id = mysqli_real_escape_string($mysqli,getValue(/*'PRREQ ID'*/));
    $prereq_name = mysqli_real_escape_string($mysqli,getValue(/*'PREREQ'*/));
    
    if($cmd == "addPrereq")
      $response = addPrereq($prereq_name);
    elseif($cmd == "editPrereq")
      $response = editPrereq($prereq_id, $prereq_name);
    elseif($cmd == "deletePrereq")
      $response = deletePrereq($prereq_id);
    
    echo json_encode($response);
  }  
  
  else
  {
      echo json_encode("Please specify a value for cmd. Command supported: createCourse, editCourse, deleteCourse, createConcentraion, editConcentration, deleteConcentration, createPrereq, editPrereq, deletePrereq");
  }
  

  

  
  $mysqli->close();
?>
