<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['user_role'] === 'admin') {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
}

$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "php_srms";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

if (isset($_POST['name']) && isset($_POST['rollno']) && isset($_POST['email']) && isset($_POST['semester'])) {
    $studentName = $_POST['name'];
    $studentRollNo = $_POST['rollno'];
    $studentEmail = $_POST['email'];
    $studentSemester = $_POST['semester'];

    $query = "UPDATE students SET name = '$studentName', email = '$studentEmail', semester = '$studentSemester' WHERE rollno = '$studentRollNo'";

    if (mysqli_query($conn, $query)) {
        echo "Student details updated successfully.";
    } else {
        echo "Error updating student details: " . mysqli_error($conn);
    }

} else {
    echo "Invalid request.";
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if (isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['email'])) {
    $studentName = $_POST['full_name'];
    $studentRollNo = $_POST['username'];
    $studentEmail = $_POST['email'];

    $query = "UPDATE users SET full_name = '$studentName', email = '$studentEmail' WHERE rollno = '$studentRollNo'";

    if (mysqli_query($conn, $query)) {
        echo "Student details updated successfully.";
    } else {
        echo "Error updating student details: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>