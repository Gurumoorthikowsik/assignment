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

$delTimer = $conn->query("DELETE t1, t2 FROM timer t1 
    JOIN exam_attempt t2 ON t1.user_id = t2.exmne_id 
    WHERE t1.user_id = '$id'");

if($delTimer) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}

echo json_encode($res);
?>
