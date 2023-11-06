<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['user_role'] === 'admin') {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
}

if (isset($_SESSION['rollno'])) {
    $rollno = $_SESSION['rollno'];

    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname = "php_srms";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete associated records from the results table
    $deleteResultsQuery = "DELETE FROM results WHERE rollno = '$rollno'";
    $deleteResultsResult = mysqli_query($conn, $deleteResultsQuery);

    // Check if deletion was successful
    if ($deleteResultsResult) {
        // Delete the student from the students table
        $deleteStudentQuery = "DELETE FROM students WHERE rollno = '$rollno'";
        $deleteStudentResult = mysqli_query($conn, $deleteStudentQuery);

        if ($deleteStudentResult) {
            echo "Student deleted successfully.";
        } else {
            echo "Error deleting student.";
        }
    } else {
        echo "Error deleting associated results.";
    }

    mysqli_close($conn);
}
