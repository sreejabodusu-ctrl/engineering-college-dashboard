<?php
include 'db_connect.php';

if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $branch=$_POST['branch'];
    $year=$_POST['year'];

    $sql="INSERT INTO Student
    (student_name,branch,year_of_study)
    VALUES
    ('$name','$branch','$year')";

    if($conn->query($sql))
    {
        echo "Student Added Successfully";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Student</title>
</head>

<body>

<h2>Add Student</h2>

<form method="POST">

Name:
<input type="text" name="name">

<br><br>

Branch:
<input type="text" name="branch">

<br><br>

Year:
<input type="number" name="year">

<br><br>

<input type="submit" name="submit">

</form>

</body>
</html>