<?php 


$host = "localhost";
$user = "u789913190_BSassignment";
$pass = "BraveSpark@2715";
$db   = "u789913190_cee_db";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}


 ?>


<?php 



extract($_POST);

$delExam = $conn->query("DELETE  FROM exam_question_tbl WHERE eqt_id='$id'  ");
if($delExam)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>