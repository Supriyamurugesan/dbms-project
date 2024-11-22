<?php
$servername = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "onlinecourse";

$connection = new mysqli($servername, $username, $password, $database, $port);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT candidatedetails.id, candidatedetails.name, coursedetails.course_name, coursedetails.instructor_name 
          FROM candidatedetails 
          INNER JOIN coursedetails ON candidatedetails.id = coursedetails.id 
          ORDER BY candidatedetails.id";

$result = $connection->query($query);

if (!$result) {
    die("Error executing the query: " . $connection->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joint Query Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="overall.css">
</head>
<body>
    <div class="container my-5">
        <h2>Joint Query Results</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course Name</th>
                    <th>Instructor Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['course_name']}</td>";
                    echo "<td>{$row['instructor_name']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$connection->close();
?>
