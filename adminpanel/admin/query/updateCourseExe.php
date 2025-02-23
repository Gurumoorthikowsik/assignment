<?php 
$host = "localhost";
$user = "u789913190_BSassignment";
$pass = "BraveSpark@2715";
$db   = "u789913190_cee_db";
$conn = null;

  // Create connection using MySQLi
  $conn = new mysqli($host, $user, $pass, $db);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $id = $_POST["course_id"];

  // Fetch the course details using MySQLi
  $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id'")->fetch_assoc();
?>

<?php


 extract($_POST);


$newCourseName = strtoupper($newCourseName);
$updCourse = $conn->query("UPDATE course_tbl SET cou_name='$newCourseName' WHERE cou_id='$course_id' ");
if($updCourse)
{
	   $res = array("res" => "success", "newCourseName" => $newCourseName);
}
else
{
	   $res = array("res" => "failed");
}



 echo json_encode($res);	
?>