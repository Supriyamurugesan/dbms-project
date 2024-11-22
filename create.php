<?php
$servername = "localhost";
$port = 3306;
$username = "root";
$password ="";
$database = "onlinecourse";

$connection = new mysqli($servername, $username, $password, $database, $port);


$id="";
$name ="";
$email="";

$age="";
$phone="";
$address="";

$errormessage="";
$successMessage="";

if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
   
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if(empty($id) ||empty($name) || empty($email)  || empty($age) || empty($phone) || empty($address)){
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT INTO candidatedetails (id, name, email, age, phone, address) " .
        "VALUES ('$id', '$name', '$email', '$age', '$phone', '$address')";

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query:" .$connection->error;
            break;
        }


        $id ="";
        $name ="";
        $email="";
        
        $phone="";
        $address="";

        $successMessage="Client added correctly";

        header("location:/onlinecoursedbms/index.php");
        exit;
    }while(false);
}


?>
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
        <h2>New Candidate</h2>

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
    <div class="row mb-3">
            <label class="col-sm-3 col-form-label">id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>
        
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Age</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
            </div>
        </div>
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
        </div>
        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
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
            <div class="col-sm-3 d-grid"><a class="btn btn-outline-primary" href="/onlinecourse/index.php" role="button">Cancel</a>
        </div>
        </div>
    </form></div>
    
</body>
</html>