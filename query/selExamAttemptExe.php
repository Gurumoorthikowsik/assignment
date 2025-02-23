<?php 
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "cee_db";
$conn = null;

try {
    $conn = new PDO("mysql:host={$host};dbname={$db};charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo json_encode(["res" => "error", "msg" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

if (!isset($_SESSION['examineeSession']['exmne_id'])) {
    echo json_encode(["res" => "error", "msg" => "Session expired. Please log in again."]);
    exit;
}

$exmneId = $_SESSION['examineeSession']['exmne_id'];
date_default_timezone_set('Asia/Kolkata');

if (!isset($_POST['thisId'])) {
    echo json_encode(["res" => "error", "msg" => "Invalid request. Exam ID is missing."]);
    exit;
}

$thisId = $_POST['thisId'];

try {
    // Check if the user has already attempted the exam
    $selExamAttmpt = $conn->prepare("SELECT * FROM exam_attempt WHERE exmne_id = ? AND exam_id = ?");
    $selExamAttmpt->execute([$exmneId, $thisId]);

    if ($selExamAttmpt->rowCount() > 0) {
        echo json_encode(["res" => "alreadyExam", "msg" => $thisId]);
        exit;
    }

    // Fetch exam details
    $selExam = $conn->prepare("SELECT ex_time_limit, ex_questlimit_display FROM exam_tbl WHERE ex_id = ?");
    $selExam->execute([$thisId]);
    $exam = $selExam->fetch();

    if (!$exam) {
        echo json_encode(["res" => "error", "msg" => "Exam not found."]);
        exit;
    }

    $selExamTimeLimit = $exam['ex_time_limit'];
    $exDisplayLimit = (int) $exam['ex_questlimit_display']; // Ensure it's an integer

    // Fetch random questions
    $selQuest = $conn->prepare("SELECT * FROM exam_question_tbl WHERE exam_id = ? ORDER BY RAND() LIMIT $exDisplayLimit");
    $selQuest->execute([$thisId]);

    if ($selQuest->rowCount() > 0) {
        // Check if timer already exists
        $check_count = $conn->prepare("SELECT * FROM timer WHERE user_id = ? AND quiz_id = ?");
        $check_count->execute([$exmneId, $thisId]);

        if ($check_count->rowCount() == 0) {
            $newtimestamp = strtotime("+$selExamTimeLimit minutes");
            $ex_time = date('Y-m-d H:i:s', $newtimestamp);
            $data_time = date('Y-m-d H:i:s');

            $insFedd = $conn->prepare("INSERT INTO timer (user_id, quiz_id, date_time, created_at) VALUES (?, ?, ?, ?)");
            $insFedd->execute([$exmneId, $thisId, $ex_time, $data_time]);
        }

        echo json_encode(["res" => "takeNow"]);
    } else {
        echo json_encode(["res" => "noques", "msg" => "No questions available for this exam."]);
    }
} catch (Exception $e) {
    echo json_encode(["res" => "error", "msg" => "An error occurred: " . $e->getMessage()]);
}
