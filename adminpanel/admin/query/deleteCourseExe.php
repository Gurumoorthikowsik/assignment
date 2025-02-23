

<?php
// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db";
$conn = null;

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract POST data safely
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id > 0) {
    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM course_tbl WHERE cou_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }

    $stmt->close();
} else {
    $res = array("res" => "failed");
}

// Close the connection
$conn->close();

// Output the response in JSON format
echo json_encode($res);

?>
