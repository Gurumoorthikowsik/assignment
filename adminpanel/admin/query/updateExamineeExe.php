<?php 
header("Content-Type: application/json"); // Ensure JSON response
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db};charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    echo json_encode(["res" => "db_error", "msg" => "Database connection failed!"]);
    exit;
}

// Ensure POST request
if ($_SERVER["REQUEST_METHOD"] != "POST" || empty($_POST)) {
    echo json_encode(["res" => "no_data", "msg" => "No data received"]);
    exit;
}

// Extract and validate data
$exmne_id  = $_POST['exmne_id'] ?? null;
$exFullname = $_POST['exFullname'] ?? null;
$exGender  = $_POST['exGender'] ?? null;
$exCourse  = $_POST['exCourse'] ?? null;
$exEmail   = $_POST['exEmail'] ?? null;
$exPass    = $_POST['exPass'] ?? null;
$exStatus  = $_POST['newCourseName'] ?? null;  // Assuming it's status



if (empty($exmne_id) || empty($exFullname) || empty($exGender) || empty($exCourse) || empty($exEmail) || empty($exPass) || empty($exStatus)) {
    echo json_encode(["res" => "missing_fields", "msg" => "All fields are required"]);
    exit;
}

// Use Prepared Statements to prevent SQL Injection
try {
    $query = "UPDATE examinee_tbl 
              SET exmne_fullname = ?, exmne_course = ?, exmne_gender = ?, 
                  exmne_email = ?, exmne_password = ?, exmne_status = ? 
              WHERE exmne_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$exFullname, $exCourse, $exGender, $exEmail, $exPass, $exStatus, $exmne_id]);

    echo json_encode(["res" => "success", "msg" => "Details has been successfully updated!"]);
} catch (Exception $e) {
    echo json_encode(["res" => "failed", "msg" => "Error: " . $e->getMessage()]);
}
?>
