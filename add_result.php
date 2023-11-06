<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['user_role'] === 'admin') {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollno = $_POST['rollno'];
    $subject_code = $_POST['subject']; 
    $semester = $_POST['semester'];
    $mid_sem_marks = $_POST['mid_sem_marks'];
    $sessional_marks = $_POST['sessional_marks'];
    $end_sem_marks = $_POST['end_sem_marks'];
    $total_marks = $_POST['total_marks'];
    $grade = $_POST['grade'];
    $grade_point = $_POST['grade_point'];

    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname = "php_srms";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $subjectQuery = "SELECT subject_id FROM subjects WHERE subject_code = '$subject_code'";
    $subjectResult = mysqli_query($conn, $subjectQuery);

    if (mysqli_num_rows($subjectResult) > 0) {
    $subject = mysqli_fetch_assoc($subjectResult);
    $subject_id = $subject['subject_id'];
    }

    $sql = "SELECT subject_id FROM results WHERE rollno = '$rollno'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0) {
        $query = "UPDATE results SET semester = '$semester', mid_sem_marks = '$mid_sem_marks', sessional_marks = '$sessional_marks', end_sem_marks = '$end_sem_marks',
              total_marks = '$total_marks', grade = '$grade', grade_point = '$grade_point'
              WHERE rollno = '$rollno' AND subject_id = '$subject_id'";
    } else {
        $query = "INSERT INTO results (rollno, subject_id, semester, mid_sem_marks, sessional_marks, end_sem_marks, total_marks, grade, grade_point)
          VALUES ('$rollno', '$subject_id', '$semester', '$mid_sem_marks', '$sessional_marks', '$end_sem_marks',
                  '$total_marks', '$grade', '$grade_point')";
    }

    
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Result added successfully.";
    } else {
        echo "Error adding result.";
    }

    mysqli_close($conn);
}
?>