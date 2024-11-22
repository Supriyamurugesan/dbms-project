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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location:/onlinecoursedbms/index.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "DELETE FROM candidatedetails WHERE id = $id";
    $result = $connection->query($sql);

    if (!$result) {
        die("Error executing the query: " . $connection->error);
    } else {
        header("location:/onlinecoursedbms/index.php");
        exit;
    }
}

$connection->close();
?>
