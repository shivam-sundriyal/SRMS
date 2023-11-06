<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['user_role'] === 'admin') {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
}

if (isset($_SESSION['rollno'])) {
    $studentRollNo = $_SESSION['rollno'];
    $studentName = $_SESSION['name'];


    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname = "php_srms";


    $conn = mysqli_connect($servername, $username, $password, $dbname);


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $query = "SELECT * FROM students WHERE rollno = '$studentRollNo' AND name = '$studentName'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['name'] = $student['name'];
            $_SESSION['rollno'] = $student['rollno'];
            $_SESSION['email'] = $student['email'];
            $_SESSION['semester'] = $student['semester'];
        }
    } else {
        echo "Student not found.";
        exit();
    }

    $query = "SELECT * FROM users WHERE username = '$studentRollNo' AND fullname = '$studentName'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['full_name'] = $student['name'];
            $_SESSION['username'] = $student['rollno'];
            $_SESSION['email'] = $student['email'];
        }
    } else {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Student</h2>

        <form action="update_student.php" method="POST">
            <input type="hidden" name="id">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="rollno">Roll No:</label>
                <input type="text" name="rollno" id="rollno" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="number" name="semester" id="semester" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
        </form>

        <a href="admin_dashboard.php">Go Back</a>
    </div>

    <script src="path/to/bootstrap.min.js"></script>
</body>

</html>