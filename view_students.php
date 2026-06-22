<?php
include 'db_connect.php';

$sql="SELECT * FROM Student";

$result=$conn->query($sql);
?>

<!DOCTYPE html>

<html>

<head>
<title>Students List</title>
</head>

<body>

<h2>Students</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Name</th>
<th>Branch</th>
<th>Year</th>
</tr>

<?php

while($row=$result->fetch_assoc())
{
?>

<tr>

<td><?php echo $row['student_id']; ?></td>

<td><?php echo $row['student_name']; ?></td>

<td><?php echo $row['branch']; ?></td>

<td><?php echo $row['year_of_study']; ?></td>

</tr>

<?php
}
?>

</table>

</body>

</html>