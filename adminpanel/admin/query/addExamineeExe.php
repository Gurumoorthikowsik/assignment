<?php 

header("Content-Type: application/json"); // Ensure JSON response
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "u789913190_BSassignment";
$pass = "BraveSpark@2715";
$db   = "u789913190_cee_db";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db};charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    echo json_encode(["res" => "db_error", "msg" => "Database connection failed!"]);
    exit;
}

// Check if data is received
if ($_SERVER["REQUEST_METHOD"] != "POST" || empty($_POST)) {
    echo json_encode(["res" => "no_data", "msg" => "No data received"]);
    exit;
}

// Extract POST data safely
$fullname = $_POST['fullname'] ?? null;
$gender = $_POST['gender'] ?? null;
$course = $_POST['course'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;




// Validate required fields
if (empty($fullname) || empty($gender) || empty($course) || empty($email) || empty($password)) {
    echo json_encode(["res" => "missing_fields", "msg" => "All fields are required"]);
    exit;
}

// Check gender selection
if ($gender == "0") {
    echo json_encode(["res" => "noGender"]);
    exit;
}

// Check course selection
if ($course == "0") {
    echo json_encode(["res" => "noCourse"]);
    exit;
}

// Check for existing fullname
$selExamineeFullname = $conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_fullname = ?");
$selExamineeFullname->execute([$fullname]);

if ($selExamineeFullname->rowCount() > 0) {
    echo json_encode(["res" => "fullnameExist", "msg" => $fullname]);
    exit;
}

// Check for existing email
$selExamineeEmail = $conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_email = ?");
$selExamineeEmail->execute([$email]);

if ($selExamineeEmail->rowCount() > 0) {
    echo json_encode(["res" => "emailExist", "msg" => $email]);
    exit;
}

// Insert data WITHOUT password encryption
try {
    $insData = $conn->prepare("INSERT INTO examinee_tbl (exmne_fullname, exmne_course, exmne_gender, exmne_email, exmne_password) 
        VALUES (?, ?, ?, ?, ?)");
    $insData->execute([$fullname, $course, $gender, $email, $password]);

    echo json_encode(["res" => "success", "msg" => $fullname . " added successfully"]);
} catch (Exception $e) {
    echo json_encode(["res" => "failed", "msg" => "Error: " . $e->getMessage()]);
}
?>
