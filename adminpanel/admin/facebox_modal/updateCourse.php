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

  $id = $_GET['id'];


  // Fetch the course details using MySQLi
  $selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id'")->fetch_assoc();

  
  $courseId = $selCourse['cou_id'];





?>

<fieldset style="width:543px;">
    <legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Update Course Name ( <?php echo strtoupper($selCourse['cou_name']); ?> )</i></legend>
    <div class="col-md-12 mt-4">
   
        <form method="post" id="updateCourseFrm">
            <div class="form-group">
                <legend>Course Name</legend>
                <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($courseId); ?>">
                <input type="text" name="newCourseName" class="form-control" required value="<?php echo htmlspecialchars($selCourse['cou_name']); ?>">
            </div>
            <div class="form-group" align="right">
                <button type="submit" class="btn btn-sm btn-primary">Update Now</button>
            </div>
        </form>

        
    </div>
</fieldset>












