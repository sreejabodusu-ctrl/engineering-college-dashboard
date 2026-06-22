<?php
session_start();
include 'db_connect.php';

$message = "";
$result = null;

/* Initialize View Toggle */
if (!isset($_SESSION['show_students'])) {
    $_SESSION['show_students'] = false;
}

/* Add Student */
if(isset($_POST['add']))
{
    $name = trim($_POST['name']);
    $gender = trim($_POST['gender']);
    $branch = trim($_POST['branch']);
    $year = intval($_POST['year']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $stmt = $conn->prepare(
        "INSERT INTO Student
        (student_name, gender, branch, year_of_study, email, phone)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssiss",
        $name,
        $gender,
        $branch,
        $year,
        $email,
        $phone
    );

    if($stmt->execute())
    {
        $message = "Student Added Successfully!";
    }
    else
    {
        $message = "Error Adding Student!";
    }

    $stmt->close();
}

/* Delete Student */
if(isset($_GET['delete']))
{
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare(
        "DELETE FROM Student WHERE student_id = ?"
    );

    $stmt->bind_param("i", $id);

    if($stmt->execute())
    {
        $message = "Student Deleted Successfully!";
    }

    $stmt->close();
}

/* Search Student */
if(isset($_POST['search']))
{
    $search_name = trim($_POST['search_name']);

    $stmt = $conn->prepare(
        "SELECT * FROM Student
         WHERE student_name LIKE ?"
    );

    $search = "%".$search_name."%";

    $stmt->bind_param("s", $search);
    $stmt->execute();

    $result = $stmt->get_result();
}

/* Toggle Student List */
if(isset($_POST['toggle_students']))
{
    $_SESSION['show_students'] =
        !$_SESSION['show_students'];
}

/* Show All Students */
if($_SESSION['show_students'])
{
    $result = $conn->query(
        "SELECT * FROM Student
         ORDER BY student_id DESC"
    );
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Engineering College Dashboard</title>

<style>

body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:30px;
}

.container{
    width:85%;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}

h1{
    text-align:center;
    color:#333;
}

h2{
    color:#444;
}

.section{
    margin-bottom:30px;
}

input{
    width:100%;
    padding:10px;
    margin-top:8px;
    margin-bottom:12px;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    padding:10px 18px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    color:white;
    margin-right:10px;
}

.add-btn{
    background:#28a745;
}

.search-btn{
    background:#007bff;
}

.view-btn{
    background:#6c757d;
}

.delete-btn{
    background:#dc3545;
    color:white;
    text-decoration:none;
    padding:6px 10px;
    border-radius:4px;
}

.message{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:5px;
    margin-bottom:20px;
}

.no-data{
    color:red;
    font-weight:bold;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th, td{
    border:1px solid #ddd;
    padding:12px;
    text-align:center;
}

th{
    background:#343a40;
    color:white;
}

</style>

</head>

<body>

<div class="container">

<h1>🎓 Engineering College Dashboard</h1>

<?php
if(!empty($message))
{
    echo "<div class='message'>$message</div>";
}
?>

<div class="section">

<h2>Add Student</h2>

<form method="POST">

<input
type="text"
name="name"
placeholder="Student Name"
required>

<input
type="text"
name="gender"
placeholder="Gender"
required>

<input
type="text"
name="branch"
placeholder="Branch"
required>

<input
type="number"
name="year"
placeholder="Year of Study"
required>

<input
type="email"
name="email"
placeholder="Email Address"
required>

<input
type="text"
name="phone"
placeholder="Phone Number"
required>

<button
type="submit"
name="add"
class="add-btn">
Add Student
</button>

</form>

</div>

<hr>

<div class="section">

<h2>Search Student</h2>

<form method="POST">

<input
type="text"
name="search_name"
placeholder="Enter Student Name">

<button
type="submit"
name="search"
class="search-btn">
Search Student
</button>

<button
type="submit"
name="toggle_students"
class="view-btn">

<?php
echo $_SESSION['show_students']
? "Hide All Students"
: "View All Students";
?>

</button>

</form>

</div>

<hr>

<div class="section">

<h2>Student Records</h2>

<?php

if($result && $result->num_rows > 0)
{
    echo "<table>";

    echo "
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Branch</th>
        <th>Year</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>";

    while($row = $result->fetch_assoc())
    {
        echo "<tr>";

        echo "<td>".$row['student_id']."</td>";
        echo "<td>".$row['student_name']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['branch']."</td>";
        echo "<td>".$row['year_of_study']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['phone']."</td>";

        echo "<td>
        <a class='delete-btn'
        href='?delete=".$row['student_id']."'
        onclick=\"return confirm('Are you sure you want to delete this student?');\">
        Delete
        </a>
        </td>";

        echo "</tr>";
    }

    echo "</table>";
}
elseif(isset($_POST['search']))
{
    echo "<p class='no-data'>No Student Found</p>";
}

?>

</div>

</div>

</body>
</html>
```
