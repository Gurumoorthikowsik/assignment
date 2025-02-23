<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db";
$conn = null;

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host={$host};dbname={$db};", $user, $pass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

// Start the session
session_start();

// Ensure username and password are received
$username = isset($_POST['username']) ? $_POST['username'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_email = :email AND exmne_password = :password");

// Bind parameters
$stmt->bindParam(':email', $username);
$stmt->bindParam(':password', $pass);

// Execute the statement
$stmt->execute();

// Fetch the result
$selAccRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($selAccRow) {
    // Set session variables on successful login
    $_SESSION['examineeSession'] = array(
        'exmne_id' => $selAccRow['exmne_id'],
        'examineenakalogin' => true
    );
    $res = array("res" => "success");
} else {
    $res = array("res" => "invalid");
}

// Return the response as JSON
echo json_encode($res);
?>
