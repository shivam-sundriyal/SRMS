<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            /* padding: 10px; */
        }

        .container {
            max-width: 1500px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        h2,
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 2px solid #000;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Result</h1>

        <?php
        $servername = "localhost:3308";
        $uname = "root";
        $password = "";
        $dbname = "php_srms";

        $conn = mysqli_connect($servername, $uname, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $semester = $_POST['semester'];

        $query = "SELECT r.result_id, r.rollno, r.subject_id, r.mid_sem_marks, r.sessional_marks, r.end_sem_marks, r.total_marks, r.grade, r.grade_point, s.subject_name, s.subject_code
                  FROM results r
                  INNER JOIN subjects s ON r.subject_id = s.subject_id
                  WHERE r.rollno = '$username' AND r.semester = '$semester'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Statement of Marks (Provisional)</h2>";
            echo "<h3>Bachelor of Technology (Computer Science and Engineering) - Semester $semester Examination</h3>";

            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Subject Code</th>";
            echo "<th>Subject Name</th>";
            echo "<th>Mid Sem Marks</th>";
            echo "<th>Sessional Marks</th>";
            echo "<th>End Sem Marks</th>";
            echo "<th>Total Marks</th>";
            echo "<th>Grade</th>";
            echo "<th>Grade Point</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['subject_code']}</td>";
                echo "<td>{$row['subject_name']}</td>";
                echo "<td>{$row['mid_sem_marks']}</td>";
                echo "<td>{$row['sessional_marks']}</td>";
                echo "<td>{$row['end_sem_marks']}</td>";
                echo "<td>{$row['total_marks']}</td>";
                echo "<td>{$row['grade']}</td>";
                echo "<td>{$row['grade_point']}</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No results found for Semester $semester.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>

    <script src="path/to/bootstrap.min.js"></script>
</body>

</html>



<!-- THU201
Advanced Professional Communication

TCH201
Engineering Chemistry

TMA201
Engineering Mathematics-II

TEC201
Basic Electronics Engineering

TEV201
Environmental Science

TCS201
Programming for Problem Solving -->