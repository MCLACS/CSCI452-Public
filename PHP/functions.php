<?php

/*
  This function allows you to write code that does not care if
  you are working with HTTP GET or HTTP POST
  If you pass this function a key it will search for the associated
  value in the GET and POST in that order
	and return the first one it finds. If the key does not exist,
	an empty string is returned.
*/
function getValue($key)
{
	$ret = "";
	if (isset($_GET[$key]))
		$ret = $_GET[$key];
	else if (isset($_POST[$key]))
		$ret = $_POST[$key];
	return sanitize($ret);
}

function getSessionValue($key, $def)
{
	$ret = $def;
	if (isset($_SESSION[$key]))
		$ret = $_SESSION[$key];
	else
		$_SESSION[$key] = $def;
	return $ret;
}

function setSessionValue($key, $value)
{
	$_SESSION[$key] = $value;
}

function sanitize($t)
{
	global $db_server;
	if (is_array($t))
	{
			foreach($t as $var=>$val)
			{
					$output[$var] = sanitize($val);
			}
	}
	else
	{
		$output = $t;
		$output = strip_tags(trim($t));
		$output = htmlentities($output, ENT_NOQUOTES);
	}
	return $output;
}

  function addCourse($course_name, $course_number, $conc_id, $prereq_id, $course_credits)
  {
      global $mysqli;
      $response = array();
      $query = "INSERT INTO courses (course_name, course_number) VALUES (NULL, ?, ?, ?)";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('ssi', $course_name, $course_number);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();
      
      return true;
  }
  
  function editCourse($course_id, $course_name, $course_number, $course_credits, $prereq_id, $conc_id)
  {
      global $mysqli;
      $response = array();
      
      $query = "UPDATE courses SET course_name = ?, course_number = ?, course_credits = ? WHERE course_id = ?";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('ssii', $course_name, $course_number, $course_credits, $course_id);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();
      
      /*
      delete all from prereq_bridge based on course id
      
      foreach(map of prereq ids){
       SQL(add to prereq bridge)
      }
      */
      
      $query = "DELETE * FROM course_conc WHERE course_id = ?";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('i', $course_id);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();   
      
      $query = "INSERT INTO course_conc VALUES(?, ?)";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('ii', $course_id, $conc_id);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();      
      
  }
  
  function deleteCourse($course_id)
  {
      /*fuck this*/
  }

  
  function addConcentration($conc_id, $conc_name)
  {
      global $mysqli;
      $response = array();
      $query = "INSERT INTO concentrations (conc_name) VALUES (NULL, ?)";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('s', $conc_name);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();
      
      return true;      
  }
  
  function editConcentration($conc_id, $conc_name)
  {
      global $mysqli;
      $response = array();
      $query = "UPDATE concentrations SET conc_name = ? WHERE conc_id = ?";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('si', $conc_name, $conc_id);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();
      
      return true;       
  }
  
  function deleteConcentration()
  {
      
  }
  
  
  function addPrereq($prereq_name)
  {
      global $mysqli;
      $response = array();
      $query = "INSERT INTO prereq_text (prereq_name) VALUES (NULL, ?)";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('s', $prereq_name);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();
      
      return true;      
  }
  
  function editPrereq()
  {
      $query = "UPDATE prereq_text SET prereq_name = ? WHERE prereq_id = ?";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($query) or die(mysqli_error($mysqli));
      $stmt->bind_param('si', $prereq_name, $prereq_id);
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();          
  }
  
  function deletePrereq()
  {
      
  }
?>

