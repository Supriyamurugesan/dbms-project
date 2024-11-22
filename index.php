<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="overall.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of candidates</h2>
        <a class="btn btn-primary" href="/onlinecoursedbms/create.php" role="button">New Candidate</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    
                    <th>age</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $port = 3306;
                $username = "root";
                $password = "";
                $database = "onlinecourse";

                // Corrected the port type to integer
                $connection = new mysqli($servername, $username, $password, $database, $port);

                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM candidatedetails";
                $result = $connection->query($sql);

                // Corrected the condition to check for errors
                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    
                    <td>$row[age]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/onlinecoursedbms/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='/onlinecoursedbms/delete.php?id=$row[id]'>Delete</a>
                    </td>
                    </tr>
                    ";
                }
                ?>
                
                
            </tbody>
        </table>
        
    </div>


    <div class="container my-5">
        <h2>List of course details</h2>
        <a class="btn btn-primary" href="/onlinecoursedbms/createcourse.php" role="button">Course details</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>enrollment_id</th>
                    <th>id</th>
                    <th>course_name</th>
                    <th>instructor_name</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $port = 3306;
                $username = "root";
                $password = "";
                $database = "onlinecourse";

                // Corrected the port type to integer
                $connection = new mysqli($servername, $username, $password, $database, $port);

                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM coursedetails";
                $result = $connection->query($sql);

                // Corrected the condition to check for errors
                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[enrollment_id]</td>
                    <td>$row[id]</td>
                    <td>$row[course_name]</td>
                    <td>$row[instructor_name]</td>
    
                    <td>
                        <a class='btn btn-primary btn-sm' href='/onlinecoursedbms/editcourse.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='/onlinecoursedbms/deletecourse.php?id=$row[id]'>Delete</a>
                    </td>
                    </tr>
                    ";
                }
                ?>
                
            </tbody>
        </table>
    </div>
    <div class="container my-5">
    <h2>Performing Joint Query</h2>
        <a class="btn btn-primary" href="/onlinecoursedbms/joint_query.php" role="button">Joint query page</a></br>

            </br>
    
    
    
</body>
</html>
