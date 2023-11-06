<?php
session_start();

if (isset($_SESSION['username']) && ($_SESSION['user_role'] == 'admin')) {
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

$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

$subjectQuery = "SELECT subject_code FROM subjects";
$subjectResult = mysqli_query($conn, $subjectQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
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
            margin-bottom: 100px;
        }

        th,
        td {
            padding: 20px;
            text-align: center;
            border: 2px solid #000;
        }

        th {
            background-color: #f2f2f2;
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
            width: 98%;
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

        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        #manage-results {
            border: 2px solid #000;
            padding: 20px;
            margin-bottom: 80px;
        }

        #add-student-form {
            border: 2px solid #000;
            padding: 20px;
            margin-bottom: 80px;
        }
    </style>

</head>

<body>
    <div class="container">
        <?php
        echo "<h2>Manage Student Details and Results</h2>";

        echo "<h4>Student Details</h4>";
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Roll No</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Semester</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['rollno']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['semester']; ?></td>
                <td>
                    <form action="edit_student.php" method="POST" style="display: inline;">
                        <input type="hidden" name="id">
                        <?php $_SESSION['rollno'] = $row['rollno']; ?>
                        <?php $_SESSION['name'] = $row['name']; ?>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

        </tbody>
        </table>

        <h4>Manage Results</h4>
        <form action="add_result.php" id="manage-results" method="POST">
            <div class="form-group">
                <label for="rollno">Roll No:</label>
                <input type="text" name="rollno" id="rollno" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <select name="subject" id="subject" class="form-control" required>
                    <?php while ($subjectRow = mysqli_fetch_assoc($subjectResult)) : ?>
                        <option value="<?php echo $subjectRow['subject_code']; ?>"><?php echo $subjectRow['subject_code']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" name="semester" id="semester" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mid_sem_marks">Mid Sem Marks:</label>
                <input type="text" name="mid_sem_marks" id="mid_sem_marks" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sessional_marks">Sessional Marks:</label>
                <input type="text" name="sessional_marks" id="sessional_marks" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_sem_marks">End Sem Marks:</label>
                <input type="text" name="end_sem_marks" id="end_sem_marks" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_marks">Total Marks:</label>
                <input type="text" name="total_marks" id="total_marks" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="grade">Grade:</label>
                <input type="text" name="grade" id="grade" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="grade_point">Grade Point:</label>
                <input type="text" name="grade_point" id="grade_point" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Result" class="btn btn-primary">
            </div>
        </form>

        <h4>Add Student</h4>
        <form action="add_student.php" id="add-student-form" method="POST">
            <div class="form-group">
                <label for="student_rollno">Roll No:</label>
                <input type="text" name="student_rollno" id="student_rollno" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="student_name">Name:</label>
                <input type="text" name="student_name" id="student_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="student_email">Email:</label>
                <input type="email" name="student_email" id="student_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="student_semester">Semester:</label>
                <input type="number" name="student_semester" id="student_semester" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="student_section">Section:</label>
                <input type="text" name="student_section" id="student_section" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Student" class="btn btn-primary">
            </div>
        </form>

        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <script src="path/to/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>