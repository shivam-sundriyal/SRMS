<?php
session_start();

if (isset($_SESSION['username'])) {
    if ($_SESSION['user_role'] === 'admin')
        $username = $_SESSION['username'];
} else {
    header("Location: login.php");
}

$servername = "localhost:3308";
$uname = "root";
$password = "";
$dbname = "php_srms";

$conn = mysqli_connect($servername, $uname, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rollno = $_POST['student_rollno'];
    $name = $_POST['student_name'];
    $email = $_POST['student_email'];
    $semester = $_POST['student_semester'];
    $section = $_POST['student_section'];

    $sql = "INSERT INTO students (rollno, name, email, semester, section) VALUES ('$rollno', '$name', '$email', '$semester', '$section')";
    $result = mysqli_query($conn, $sql);

    $sql = "INSERT INTO users (username, password, role, fullname, email) VALUE ('$rollno', '$rollno', 'student', '$name', '$email')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Student added successfully.";
    } else {
        echo "Error adding student.";
    }

    mysqli_close($conn);
}

?>