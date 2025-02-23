


<?php
// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db";
$conn = null;

// Create connection
$conn = new mysqli($host, $user, $pass, $db);  // Fixed the typo: should be `new mysqli`

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract POST data
extract($_POST);

// Query to check if the exam title already exists
$selCourse = $conn->query("SELECT * FROM exam_tbl WHERE ex_title='$examTitle'");

if ($courseSelected == "0") {
    $res = array("res" => "noSelectedCourse");
} elseif ($timeLimit == "0") {
    $res = array("res" => "noSelectedTime");
} elseif (empty($examQuestDipLimit)) {
    $res = array("res" => "noDisplayLimit");
} elseif ($selCourse->num_rows > 0) {
    $res = array("res" => "exist", "examTitle" => $examTitle);
} else {
    // Insert the exam details
    $insExam = $conn->query("INSERT INTO exam_tbl (cou_id, ex_title, ex_time_limit, ex_questlimit_display, ex_description) 
                             VALUES ('$courseSelected', '$examTitle', '$timeLimit', '$examQuestDipLimit', '$examDesc')");

    if ($insExam) {
        $res = array("res" => "success", "examTitle" => $examTitle);
    } else {
        $res = array("res" => "failed", "examTitle" => $examTitle);
    }
}

// Return the response as JSON
echo json_encode($res);

?>







