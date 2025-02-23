
<?php 

$host = "localhost";
$user = "u789913190_BSassignment";
$pass = "BraveSpark@2715";
$db   = "u789913190_cee_db";
$conn = null;

// Create connection
$conn = new mysqli($host, $user, $pass, $db);  

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = strtoupper(trim($_POST['course_name']));

    $selCourse = $conn->prepare("SELECT * FROM course_tbl WHERE cou_name = ?");
    $selCourse->bind_param("s", $course_name);
    $selCourse->execute();
    $selCourse->store_result();

    if($selCourse->num_rows > 0) {
        $res = array("res" => "exist", "course_name" => $course_name);
    } else {
        $insCourse = $conn->prepare("INSERT INTO course_tbl (cou_name) VALUES (?)");
        $insCourse->bind_param("s", $course_name);

        if($insCourse->execute()) {
            $res = array("res" => "success", "course_name" => $course_name);
        } else {
            $res = array("res" => "failed", "course_name" => $course_name);
        }
    }

    echo json_encode($res);
}

$conn->close();

?>