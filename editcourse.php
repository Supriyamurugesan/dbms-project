<?php
$servername = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "onlinecourse";

$connection = new mysqli($servername, $username, $password, $database, $port);
$enrollment_id = "";
$id = "";
$course_name = "";
$instructor_name = "";

$errormessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location:/onlinecoursedbms/indexcourse.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM coursedetails WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:/onlinecoursedbms/indexcourse.php");
        exit;
    }
    $enrollment_id = $row["enrollment_id"];
    $id = $row["id"];
    $course_name = $row["course_name"];
    $instructor_name = $row["instructor_name"];
} else {
    $enrollment_id = $_POST["enrollment_id"];
    $id = $_POST["id"];
    $course_name = $_POST["course_name"];
    $instructor_name = $_POST["instructor_name"];

    // Check if the ID already exists in the database
    $check_sql = "SELECT id FROM coursedetails WHERE id = ? AND enrollment_id <> ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("ii", $id, $enrollment_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $errorMessage = "Course with ID $id already exists for a different enrollment. Please choose a different ID.";
    } else {
        // Proceed with the update
        $sql = "UPDATE coursedetails SET enrollment_id=?, course_name=?, instructor_name=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issi", $enrollment_id, $course_name, $instructor_name, $id);

        if ($stmt->execute()) {
            $successMessage = "Course updated correctly";
            header("location:/onlinecoursedbms/indexcourse.php");
            exit;
        } else {
            die("Error executing the query: " . $stmt->error);
        }
    }
}
?>
<!-- Rest of your HTML code remains unchanged -->

<!-- Rest of your HTML code remains unchanged -->

<!-- Rest of your HTML code remains unchanged -->

<!-- Rest of your HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="overall.css">
</head>
<body>
    <div class="container my-5">
        <h2>Course</h2>

        <?php
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            

       ";
        }

         ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">enrollment_id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="enrollment_id" value="<?php echo $enrollment_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
            </div>
        </div>
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">course_name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="course_name" value="<?php echo $course_name; ?>">
            </div>
        </div>
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">instructor_name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="instructor_name" value="<?php echo $instructor_name; ?>">
            </div>
        

        <?php
        if(!empty($successMessage)){
            echo"
            <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            </div>
            </div>
            
            
            ";
        }

?>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid"><a class="btn btn-outline-primary" href="/onlinecoursedbms/indexcourse.php" role="button">Cancel</a>
        </div>
        </div>
    </form></div>
    
</body>
</html>