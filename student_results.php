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
    <title>Student Results</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <style>
        body {
            font-size: medium;
            max-width: 100%;
            background-color: #f8f9fa;
        }

        .container {
            margin: 0 auto;
            padding: 50px;
        }

        .student-table {
            background-color: #fff;
            padding-top: 10px;
            padding-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            margin-bottom: 50px;
            margin-top: 0px;
            width: 100%;
        }

        .student-table h2 {
            text-decoration: underline;
            text-align: center;
            margin-bottom: 100px;
        }

        .student-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table th,
        .student-table td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        .result-form {
            width: 35%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            /* margin-top: 200px;   */
            margin-left: 640px;
        }

        .result-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .result-form .form-group {
            margin-bottom: 20px;
        }

        .result-form .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .result-form .form-group select,
        .result-form .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .logout-button {
            margin-top: 100px;
            margin-left: 1000px;
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
    </style>
</head>

<body>
    <div class="student-table">
        <h2>STUDENT INFORMATION</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Email</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost:3308";
                $uname = "root";
                $password = "";
                $dbname = "php_srms";

                $conn = mysqli_connect($servername, $uname, $password, $dbname);

                $query = "SELECT *
                          FROM students s
                          INNER JOIN users u ON  s.rollno = u.username 
                          WHERE u.username = '$username'";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['rollno']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['semester']}</td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <div class="result-form">
        <h2>Generate/View Result</h2>
        <form action="generate_result.php" method="POST">
            <div class="form-group">
                <label for="semester">Semester</label>
                <select name="semester" id="semester" class="form-control">
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Generate/View" class="btn btn-primary" style="cursor: pointer; background-color: lightgreen;">
            </div>
        </form>
    </div>

    <a href="logout.php" class="logout-button">Logout</a>

    <script src="path/to/bootstrap.min.js"></script>
</body>

</html>