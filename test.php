<?php
session_start();
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "testing_db";
$error = "";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // $username = $_POST["username"];
//     // $password = $_POST["password"];

//     // $sql = "SELECT role FROM users WHERE username = '$username' AND password = '$password'";
    $sql = "SELECT * FROM test_table";
    $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) == 1) {
//         $row = mysqli_fetch_assoc($result);
//         $_SESSION["user_role"] = $row["role"];

//         if ($_SESSION["user_role"] == "admin") {
//             header("Location: admin_dashboard.php");
//             exit();
//         } else {
//             $_SESSION['username'] = $_POST['username'];
//             header("Location: student_results.php");
//             exit();
//         }
    // } else {
    //     $error = "Invalid username or password.";
    // }

// print "
//   <table border=\"5\" cellpadding=\"5\" cellspacing=\"0\" style=\"border-  collapse: collapse\" bordercolor=\"#808080\" width=\"100&#37;\"    id=\"AutoNumber2\" bgcolor=\"#C0C0C0\">
//    <tr>   
//   <td width=100>First Name</td> 
//   <td width=100>Last Name</td> 
//   <td width=100>Gender</td> 
//   <td width=100>Age</td>
//   </tr>"; 
 while($row = mysqli_fetch_array($result))
 { 
echo "<tr>"; 
echo "<td>" . $row['first'] . "</td>"; 
echo "<td>" . $row['last'] . "</td>"; 
echo "<td>" . $row['gender'] . "</td>";
echo "<td>" . $row['age'] . "</td>";
echo "</tr>"; 
echo "</table>"; 
} 
// } else {
//     $error = "Error";
// }
?>